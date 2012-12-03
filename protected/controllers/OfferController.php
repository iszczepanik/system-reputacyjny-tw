<?php

class OfferController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','admin'),
				'users'=>array('admin'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','respond','createNew','admin','compromise','chart','score'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function saveScore()
	{
		$model = $this->loadModel($_POST['Offer']['OFR_ID']);
		$model->attributes = $_POST['Offer'];

		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/gridview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		
		if (empty($model->OFR_SCORE_REC))
		{
			$this->render('view',array(
			'model'=>$model,
			'canRespond'=>true,
			'isMyOffer'=>false,
			'mustScore'=>true,
			'message'=>'Score must be set'
			));
			return;
		}
		
		$model->save();

		$this->render('view',array(
			'model'=>$model,
			'canRespond'=>true,
			'isMyOffer'=>false,
			'mustScore'=>false,
		));
	}
	
	public function actionScore()
	{
		if(isset($_POST['Offer']))
		{
			//echo "post offer: ".$_POST['Offer']."<br />";
			$this->saveScore();
			return;
		}

		$negotiation = $this->CanUserSeeTheseOffers();
		$isActive = $this->IsThisNegotiationActive($negotiation, true);
		$respondeeOffer = $this->CanUserRespond($negotiation, true, null);
		$mustScore = $this->UserMustScore($negotiation,true,$respondeeOffer->OFR_ID);
		
		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/gridview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		
		$this->render('view',array(
			'model'=>$this->loadModel($respondeeOffer->OFR_ID),
			'canRespond'=>($isActive == "" ? $this->CanUserRespond($respondeeOffer->Offer_negotiation, false, $id) : false),
			'isMyOffer'=>($respondeeOffer->OFR_NAD_USR_ID == Yii::app()->user->id),
			'mustScore'=>true,
		));
	}
	
	public function actionView($id)
	{
		if(isset($_POST['Offer']))
		{
			$this->saveScore();
			return;
		}
		if ($id != null)
		{
			//echo "action View<br />";
			$offer = $this->CanUserSeeThisOffer($id);
			
			$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/gridview/styles.css";
			Yii::app()->clientScript->registerCssFile($uri);
			//echo "I can see this offer<br />";
			$mustScore = $this->UserMustScore($offer->Offer_negotiation,false,$offer->OFR_ID);
			
			$isActive = $this->IsThisNegotiationActive($offer->Offer_negotiation, false);
			//($isActive == "" ? $this->CanUserRespond($model->Offer_negotiation, false, null) : false),
			$this->render('view',array(
				'model'=>$this->loadModel($id),
				'canRespond'=>($isActive == "" ? $this->CanUserRespond($offer->Offer_negotiation, false, $id) : false),
				'isMyOffer'=>($offer->OFR_NAD_USR_ID == Yii::app()->user->id),
				'mustScore'=>$mustScore,
			));
		}
	}
	
	public function RedirectToNegotiations()
	{
		if (Yii::app()->user->name == 'admin')
			$this->redirect(array('negotiation/admin',));
		else
			$this->redirect(array('negotiation/user',));
		//echo "RedirectToNegotiations<br />";
	}
	
	public function RedirectToOffers()
	{
		//echo "RedirectToOffers<br />";
		// if (Yii::app()->user->name == 'admin')
			// $this->redirect(array('negotiation/admin',));
		// else
			// $this->redirect(array('negotiation/user',));
		///$this->actionAdmin();
		$this->redirect(array('offer/admin&NEG_ID='.$_GET['NEG_ID'],));
	}
	
	public function CanUserSeeThisOffer($id)
	{
		//echo "CanUserSeeTheseOffers ";
		$offer = Offer::model()->findByPk($id);
		
		if ($offer == null)
			$this->RedirectToOffers();
			//$this->RedirectToNegotiations();
			
		if (!($offer->Offer_negotiation->NEG_USR1 == Yii::app()->user->id || $offer->Offer_negotiation->NEG_USR2 == Yii::app()->user->id))
			$this->RedirectToOffers();
			//$this->RedirectToNegotiations();
		
		return $offer;
	}
	
	public function CanUserSeeTheseOffers()
	{
		//echo "CanUserSeeTheseOffers ";
		if(!isset($_GET['NEG_ID']))
			$this->RedirectToNegotiations();
		
		//echo "NEG_ID is set ";
		
		$neg_id = $_GET['NEG_ID'];
		$negotiation = Negotiation::model()->findByPk($neg_id);
		
		if ($negotiation == null)
			$this->RedirectToNegotiations();
			
		if (!($negotiation->NEG_USR1 == Yii::app()->user->id || $negotiation->NEG_USR2 == Yii::app()->user->id))
			$this->RedirectToNegotiations();
		
		return $negotiation;
	}

	public function IsThisNegotiationActive($negotiation,$redirect)
	{
		$result = "";
		//1.Is this negotiation inactive due to start and end date?
		$now = new DateTime("now");
		$startDate = new DateTime($negotiation->NEG_START_DATE);
		$endDate = new DateTime($negotiation->NEG_END_DATE);
		
		//var_dump($negotiation->NEG_ID);
		//var_dump($now);
		//var_dump($startDate);
		//var_dump($endDate);
		//var_dump($now >= $startDate);
		//var_dump($now < $endDate);
		
		if (!($now >= $startDate))
			$result .= "This negotiation has not yet started, start date: ".$startDate->format('Y-m-d H:i:s')."<br />";
			
		if (!($now < $endDate))
			$result .= "This negotiation has ended on: ".$endDate->format('Y-m-d H:i:s')."<br />";
		
		//2.Has this offer ended with compromise?
		$query = "SELECT * FROM ofr WHERE `OFR_NEG_ID` = '".$negotiation->NEG_ID."' and `OFR_COMPROMISE` = '1'";
		$compromiseOffer = Offer::model()->findBySql($query);//if this has entity then yes.
		//var_dump($query);
		//var_dump($compromiseOffer);
		if($compromiseOffer != null)
		{		
			if ($result == "")
				$result .= "This negotiation has ended<br /><span class='compromise' >compromise</span><br />";
			else
				$result .= "<span class='compromise' >compromise</span><br />";
		}
		else if ($result != "")
			$result .= "<span class='nocompromise' >No compromise</span><br />";
			
		//var_dump($result);
		//return $redirect ? $result;
		if (!$redirect)
			return $result;
				
		if ($result != "")
			$this->RedirectToOffers();
	}
	
	public function UserMustScore($negotiation,$redirect,$id)
	{
		if(!isset($_GET['OFR_ID']) && $id == null)//on action admin
		{
			//1.Are there any offers at all?
			if (count($negotiation->negotiation_offers) == 0)
			{
				return $redirect ? null : false;
			}
		
			//2.Was the last offer sent by logged user?
			$query = "SELECT * FROM ofr WHERE 	
			ofr_id = (select max(ofr_id) from ofr 		
			WHERE `OFR_NEG_ID` = ". $negotiation->NEG_ID .")";	
			$respondeeOffer = Offer::model()->findBySql($query);
			
			if ($respondeeOffer->OFR_NAD_USR_ID != Yii::app()->user->id)
			{	
				//3.Is this offer scored?
				if ($respondeeOffer->OFR_SCORE_REC == null)
					return $redirect ? $respondeeOffer : true;
			
			}
				
			if (!$redirect)
				return false;
				
			$this->RedirectToOffers();
		}
		else //on action with ofr_id: view or respond
		{
			//get offer id
			$OFR_ID = isset($_GET['OFR_ID']) ? $_GET['OFR_ID'] : $id;
			
			//get the offer based on it's id
			$respondeeOffer = Offer::model()->findByPk($OFR_ID);

			//if ($compromiseOffer != null)
			//	return $redirect ? $respondeeOffer : false;
			
			//1.Is the offer exist?
			if ($respondeeOffer == null)
			{
				if (!$redirect) return false;
				else 
				{
					$this->RedirectToOffers();
				}
			}
			
			//2.Is this offer the last offer?
			$query = "SELECT * FROM ofr WHERE 	
			ofr_id = (select max(ofr_id) from ofr 		
			WHERE `OFR_NEG_ID` = ". $negotiation->NEG_ID .")";	
			$lastOffer = Offer::model()->findBySql($query);
			
			if ($lastOffer->OFR_ID != $respondeeOffer->OFR_ID)
			{
				if (!$redirect) return false;
				else 
				{
					$this->RedirectToOffers();
				}
			}
			
			//2.Was this offer not sent by logged user and not compromised?
			if ($respondeeOffer->OFR_NAD_USR_ID != Yii::app()->user->id && $respondeeOffer->OFR_COMPROMISE == false)
			{	
				//3.Is this offer scored?
				if ($respondeeOffer->OFR_SCORE_REC == null)
					return $redirect ? $respondeeOffer : true;
			}
				
			if (!$redirect)
				return false;
				
			$this->RedirectToOffers();
			//$this->RedirectToNegotiations();
		}
	}
	
	public function CanUserRespond($negotiation,$redirect,$id)
	{	
		//echo "CanUserRespond?<br />";
		if(!isset($_GET['OFR_ID']) && $id == null)
		{
			//no offer id - admin view
			//echo "no ofr id<br />";
			//can respond to last offer
			//1.Are there any offers at all?
			if (count($negotiation->negotiation_offers) == 0)
			{
				return $redirect ? null : false;
				//var_dump($negotiation->negotiation_offers);
			}
			
			//2.Was the last offer sent by logged user?
			$query = "SELECT * FROM ofr WHERE 	
			ofr_id = (select max(ofr_id) from ofr 		
			WHERE `OFR_NEG_ID` = ". $negotiation->NEG_ID .")";	
			$respondeeOffer = Offer::model()->findBySql($query);
			
			if ($respondeeOffer->OFR_NAD_USR_ID != Yii::app()->user->id)
				return $redirect ? $respondeeOffer : true;
				
			if (!$redirect)
				return false;
				
			$this->RedirectToOffers();
			
		}
		else
		{
			//can respond to this offer
			$OFR_ID = isset($_GET['OFR_ID']) ? $_GET['OFR_ID'] : $id;
			//echo "i have ofr id".$OFR_ID."<br />";
			
			$respondeeOffer = Offer::model()->findByPk($OFR_ID);
			
			if ($compromiseOffer != null)
				return $redirect ? $respondeeOffer : false;
			
			if ($respondeeOffer == null)
			{
				//echo "can't find this offer<br />";
				if (!$redirect) return false;
				else 
				{
					$this->RedirectToOffers();
				}
			}
			
			$query = "SELECT * FROM ofr WHERE 	
			ofr_id = (select max(ofr_id) from ofr 		
			WHERE `OFR_NEG_ID` = ". $negotiation->NEG_ID .")";	
			$lastOffer = Offer::model()->findBySql($query);
			
			if ($lastOffer->OFR_ID != $respondeeOffer->OFR_ID)
			{
				if (!$redirect) return false;
				else 
				{
					$this->RedirectToOffers();
				}
			}

			if ($respondeeOffer->OFR_NAD_USR_ID != Yii::app()->user->id && $respondeeOffer->OFR_COMPROMISE == false)
				return $redirect ? $respondeeOffer : true;
				
			if (!$redirect)
				return false;
				
			$this->RedirectToOffers();
			//$this->RedirectToNegotiations();
		}
	}
	
	public function actionCompromise()
	{
		$negotiation = $this->CanUserSeeTheseOffers();
		$isActive = $this->IsThisNegotiationActive($negotiation, true);
		$respondeeOffer = $this->CanUserRespond($negotiation, true, null);
		$respondeeOffer->OFR_COMPROMISE = true;
		$respondeeOffer->save();
		
		$this->EmailNotification($respondeeOffer, "email_content_compromise");
		
		$this->actionAdmin();
	}
	
	public function normalize($x, $xNis, $xPis)
	{
		return ($x - $xNis) / ($xPis - $xNis);
	}
	
	public function CalculateScore($arr_criterias)
	{
		$debug = false;
		$Dpis = 0;
		$Dnis = 0;
		
		foreach($arr_criterias as $key=>$det)
		{
			$crt = $det->Detail_criteria;
			if ($debug) echo "obliczamy score dla ".$crt->CRT_NAME." = ".$det->DET_VALUE."<br />";

			$wgh = Weighing::model()->findBySql("SELECT * FROM wgh where WGH_USR_ID = ".Yii::app()->user->id." and WGH_CRT_ID = ".$crt->CRT_ID);
			if ($wgh == null)
				return null;
			//if ($debug) var_dump($wgh);
			
			//liczymy normaln¹
			$n = $this->normalize($det->DET_VALUE, $wgh->WGH_NIS, $wgh->WGH_PIS);
			if ($debug) echo "normalna = ".$n."<br />";
			
			//liczymy odleglosc
			$odl = pow((1 - $n),$wgh->WGH_P);
			if ($debug) echo "odleglosc = ".$odl."<br />";
			
			//mno¿ymy przez wage i dodajemy do Dpisu
			$Dpis += ($odl * $wgh->WGH_WEIGHT);
			
			//liczymy AntyScore
			$antyScore = 1 - pow((1 - $n),(1/$wgh->WGH_P));
			if ($debug) echo "antyScore = ".$antyScore."<br />";
			
			//mno¿ymy przez wage i dodajemy do Dnisu
			$Dnis += ($antyScore * $wgh->WGH_WEIGHT);
		}
		if ($debug) echo "Dpis = ".$Dpis."<br />";
		if ($debug) echo "Dnis = ".$Dnis."<br />";
		
		//I liczymy Score
		$SG = $Dnis / ($Dnis + $Dpis);
		
		return $SG;
	}
	
	public function actionCreateNew()
	{
		$negotiation = $this->CanUserSeeTheseOffers();
		$this->IsThisNegotiationActive($negotiation, true);
		
		$this->includeRatingFiles();
		
		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/gridview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/detailview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
	
		$model = new Offer;
		$model->OFR_NEG_ID = $negotiation->NEG_ID;
		//echo "create new offer in neg_id=".$negotiation->NEG_ID."<br />";
		
		if (isset($_POST['Offer']))
		{
			$model->attributes = $_POST['Offer'];
		
			$negotiationCase = $negotiation->negotiation_case;
			$CaseCriterias = $negotiationCase->Criterias;
			
			$allCriteriaNotEmpty = true;
			$atLeastOneCriteriaNotEmpty = false;
			
			//read values, to create objects criteria
			foreach($CaseCriterias as $key=>$caseCriteria)
			{
				$det=new Detail;
				$det->DET_CRT_ID = $caseCriteria->CRT_ID;
				$det->DET_VALUE = $_POST['DET_VALUE_'.$caseCriteria->CRT_ID."_".$key];
				$arr_criterias[$key] = $det;
				
				$allCriteriaNotEmpty = $allCriteriaNotEmpty && !empty($det->DET_VALUE);
				$atLeastOneCriteriaNotEmpty = $atLeastOneCriteriaNotEmpty || !empty($det->DET_VALUE);
			}
			
			$Score = $this->CalculateScore($arr_criterias);
			
			if ($atLeastOneCriteriaNotEmpty && empty($Score))
			{
				$this->render('create',array(
						'model'=>$model,
						'message'=>"Score must be set when sending an offer. Go to <a href='index.php?r=weighing/admin'>Preferences</a> to set weights and preferences needed to calculate your score.",
					));
				return;
			}
			if (!$atLeastOneCriteriaNotEmpty && !empty($Score))
			{
				$this->render('create',array(
						'model'=>$model,
						'message'=>"Score must not be set with no offer details.",
					));
				return;
			}
			
			//read values, to create objects thread
			$new_threads_count = $_POST['new_threads_count'];
			for ($i = 0; $i < $new_threads_count; $i++)
			{
				$thr_content = $_POST['NEW_THR_CONTENT_'.$i];
				if (!empty($thr_content))
				{
					$thr = new Thread;
					$thr->THR_RESP_THR_ID = null;
					$thr->THR_CONTENT = $thr_content;
					$thr->THR_IMPORTANCE = $_POST['NEW_THR_IMPORTANCE_'.$i];
					$thr->THR_TYPE = 0;
					$arr_threads[$i] = $thr;
				}
			}
			
			if ($new_threads_count > 0 || $atLeastOneCriteriaNotEmpty)
			{
				$model->attributes = $_POST['Offer'];
				$model->OFR_DATETIME = date('Y-m-d H:i:s');
				$model->OFR_NAD_USR_ID = Yii::app()->user->id;
				$model->OFR_COMPROMISE = 0;
				$model->OFR_SCORE_NAD = $Score;
				if($model->save())
				{
					if (count($arr_criterias) > 0)
					foreach($arr_criterias as $key=>$det)
					{
						$det->DET_OFR_ID = $model->OFR_ID;
						$det->save();
					}
					if (count($arr_threads) > 0)
					foreach($arr_threads as $key=>$thr)
					{
						$thr->THR_OFR_ID = $model->OFR_ID;
						$thr->save();
					}
					
					$this->EmailNotification($model, "email_content_new");
					
					$this->redirect(array('view','id'=>$model->OFR_ID));
				}
			}
			else
			{
				$this->render('create',array(
						'model'=>$model,
						'message'=>"Can't send an ampty offer.",
					));
				return;
			}
		}
		
		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionChart()
	{
		$negotiation = $this->CanUserSeeTheseOffers();
		$model=new Offer('search');
		$model->unsetAttributes();  // clear any default values

		$model->OFR_NEG_ID = $negotiation->NEG_ID;
	
		if (Yii::app()->user->id == $negotiation->NEG_USR1)
		{
			$serie_me = Offer::model()->findAllByAttributes(array("OFR_NEG_ID"=>$negotiation->NEG_ID , "OFR_NAD_USR_ID"=>$negotiation->NEG_USR1));
			$serie_my_name = $negotiation->negotiator_1->USR_NAZWA;
			
			$serie_him = Offer::model()->findAllByAttributes(array("OFR_NEG_ID"=>$negotiation->NEG_ID , "OFR_NAD_USR_ID"=>$negotiation->NEG_USR2));
			$serie_his_name = $negotiation->negotiator_2->USR_NAZWA;
		}
		else
		{
			$serie_me = Offer::model()->findAllByAttributes(array("OFR_NEG_ID"=>$negotiation->NEG_ID , "OFR_NAD_USR_ID"=>$negotiation->NEG_USR2));
			$serie_my_name = $negotiation->negotiator_2->USR_NAZWA;
			
			$serie_him = Offer::model()->findAllByAttributes(array("OFR_NEG_ID"=>$negotiation->NEG_ID , "OFR_NAD_USR_ID"=>$negotiation->NEG_USR1));
			$serie_his_name = $negotiation->negotiator_1->USR_NAZWA;
		}
	
		$serie_me_string = "";
		foreach($serie_me as $key=>$detail){
			if ($detail->OFR_SCORE_NAD == null) continue;
			$datetime = strtotime($detail->OFR_DATETIME);
			$serie_me_string .= "[Date.UTC(".date('Y', $datetime).",  ".(date('m', $datetime)-1).", ".date('d', $datetime).
			", ".date('H', $datetime).", ".date('i', $datetime).", ".date('s', $datetime).
			"), ".$detail->OFR_SCORE_NAD."   ], ";
		}
		$serie_him_string = "";
		foreach($serie_him as $key=>$detail){
			if ($detail->OFR_SCORE_REC == null) continue;
			$datetime = strtotime($detail->OFR_DATETIME);
			$serie_him_string .= "[Date.UTC(".date('Y', $datetime).",  ".(date('m', $datetime)-1).", ".date('d', $datetime).
			", ".date('H', $datetime).", ".date('i', $datetime).", ".date('s', $datetime).
			"), ".$detail->OFR_SCORE_REC."   ], ";
		}
		
	
		$uri = "http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/highcharts.js";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/modules/exporting.js";
		Yii::app()->clientScript->registerScriptFile($uri);

		$this->render('chart',array(
			'model'=>$model,
			'canRespond'=>false,
			'isActive'=>$this->IsThisNegotiationActive($negotiation, false),
			'serie_usr1'=>$serie_me_string,
			'serie_usr2'=>$serie_him_string,
			'serie_usr1_name'=>$serie_my_name,
			'serie_usr2_name'=>$serie_his_name,
		));
	}
	
	public function includeRatingFiles()
	{
		$uri = Yii::app()->request->baseUrl."/js/jquery.ui.stars-3.0/jquery.min.js?v=1.5.1";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/jquery.ui.stars-3.0/jquery-ui.custom.min.js?v=1.8.13";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/jquery.ui.stars-3.0/jquery.uni-form.js?v=1.3";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/jquery.ui.stars-3.0/jquery.ui.stars.js?v=3.0.1b44";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/jquery.ui.stars-3.0/jquery.ui.stars.css?v=3.0.1b44";
		Yii::app()->clientScript->registerCssFile($uri);
		
		$uri = "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css";
		Yii::app()->clientScript->registerCssFile($uri);
		$uri = Yii::app()->request->baseUrl."/css/jquery_slider.css";
		Yii::app()->clientScript->registerCssFile($uri);
		
		//$uri = "http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js";
		//Yii::app()->clientScript->registerScriptFile($uri);
		$uri = "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js";
		Yii::app()->clientScript->registerScriptFile($uri);
		//<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
		//<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		//<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
	}
	
	public function actionRespond()
	{
		//echo "action Respond";
		$negotiation = $this->CanUserSeeTheseOffers();
		$isActive = $this->IsThisNegotiationActive($negotiation, true);
		$respondeeOffer = $this->CanUserRespond($negotiation, true, null);
		
		$this->includeRatingFiles();
		
		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/gridview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/detailview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
	
		$model = new Offer;
		$model->OFR_NEG_ID = $negotiation->NEG_ID;

		if(isset($_POST['Offer']))
		{	
			$model->attributes = $_POST['Offer'];
			//echo (2 / (1-1) * 8);
			//validate (all details filled)
			$negotiationCase = $negotiation->negotiation_case;
			$CaseCriterias = $negotiationCase->Criterias;
			
			$atLeastOneCriteriaNotEmpty = false;
			$allCriteriaNotEmpty = true;
			
			//read values, to create objects criteria
			foreach($CaseCriterias as $key=>$caseCriteria)
			{
				$det=new Detail;
				$det->DET_CRT_ID = $caseCriteria->CRT_ID;
				$det->DET_VALUE = $_POST['DET_VALUE_'.$caseCriteria->CRT_ID."_".$key];
				$arr_criterias[$key] = $det;
				
				$allCriteriaNotEmpty = $allCriteriaNotEmpty && !empty($det->DET_VALUE);
				$atLeastOneCriteriaNotEmpty = $atLeastOneCriteriaNotEmpty || !empty($det->DET_VALUE);
			}
			
			$Score = $this->CalculateScore($arr_criterias);
			
			if ($atLeastOneCriteriaNotEmpty && empty($Score))
			{
				$this->render('create',array(
						'model'=>$model,
						'respondeeOffer'=>$respondeeOffer,
						'message'=>"Score must be set when sending an offer. Go to <a href='index.php?r=weighing/admin'>Preferences</a> to set weights and preferences needed to calculate your score.",
					));
				return;
			}
			if (!$atLeastOneCriteriaNotEmpty && !empty($Score))
			{
				$this->render('create',array(
						'model'=>$model,
						'respondeeOffer'=>$respondeeOffer,
						'message'=>"Score must not be set with no offer details.",
					));
				return;
			}
			
			//read values, to create objects thread
			foreach($respondeeOffer->Offer_threads as $key=>$thread)
			{
				$thr_content = $_POST['THR_CONTENT_'.$thread->THR_ID];
				if (!empty($thr_content))
				{
					$thr = new Thread;
					$thr->THR_RESP_THR_ID = $thread->THR_ID;
					$thr->THR_CONTENT = $thr_content;
					//echo "THR_IMPORTANCE_".$thread->THR_ID." ". $_POST['THR_IMPORTANCE_'.$thread->THR_ID]."<br />";
					$thr->THR_IMPORTANCE = $_POST['THR_IMPORTANCE_'.$thread->THR_ID];
					
					$type = $_POST['THR_TYPE_'.$thread->THR_ID];
					if ($type == "0")
						$thr->THR_TYPE = 0;
					else
					{
						$pieces = explode("_", $type);
						$value = (int)$pieces[1];
						$value = $value / 3;
						if ($pieces[0] == "neg")
							$value = -$value;
							
						$thr->THR_TYPE = $value;
					}
					$arr_threads[$thread->THR_ID] = $thr;
				}
			}
			
			//read values, to create objects new thread
			$new_threads_count = $_POST['new_threads_count'];
			for ($i = 0; $i < $new_threads_count; $i++)
			{
				$thr_content = $_POST['NEW_THR_CONTENT_'.$i];
				if (!empty($thr_content))
				{
					$thr = new Thread;
					$thr->THR_RESP_THR_ID = null;
					$thr->THR_CONTENT = $thr_content;
					$thr->THR_IMPORTANCE = $_POST['NEW_THR_IMPORTANCE_'.$i];
					$thr->THR_TYPE = 0;
					$arr_newthreads[$i] = $thr;
				}
			}
		
			if ($new_threads_count > 0 || count($arr_threads) > 0 || $atLeastOneCriteriaNotEmpty)
			{
				$model->attributes = $_POST['Offer'];
				$model->OFR_DATETIME = date('Y-m-d H:i:s');
				$model->OFR_NAD_USR_ID = Yii::app()->user->id;
				$model->OFR_COMPROMISE = 0;
				$model->OFR_SCORE_NAD = $Score;
				if($model->save())
				{
					$negotiationCase = $negotiation->negotiation_case;
					$CaseCriterias = $negotiationCase->Criterias;
				
					if (count($arr_criterias) > 0)
					foreach($arr_criterias as $key=>$det)
					{
						$det->DET_OFR_ID = $model->OFR_ID;
						$det->save();
					}
					if (count($arr_threads) > 0)
					foreach($arr_threads as $key=>$thr)
					{
						$thr->THR_OFR_ID = $model->OFR_ID;
						$thr->save();
						
						//counting assertivity and cooperativity
						$thr_resp = Thread::model()->findByPk($thr->THR_RESP_THR_ID);
						$importance1 = $thr_resp->THR_IMPORTANCE;
						
						$importance2 = $thr->THR_IMPORTANCE;
						$type2 = $thr->THR_TYPE;
						
						$mark = $type2 * ($importance1 / 7) * ($importance2 / 7);
						
						$me = User::model()->findByPk(Yii::app()->user->id);
						$him = User::model()->findByPk($respondeeOffer->OFR_NAD_USR_ID);
						
						$me->USR_COOPER = $me->USR_COOPER + $mark;
						$him->USR_ASSERT = $him->USR_ASSERT + $mark;
						
						$me->USR_COOPER_COUNT = $me->USR_COOPER_COUNT + 1;
						$him->USR_ASSERT_COUNT = $him->USR_ASSERT_COUNT + 1;
						
						$me->save();
						$him->save();
						
					}
					if (count($arr_newthreads) > 0)
					foreach($arr_newthreads as $key=>$thr)
					{
						$thr->THR_OFR_ID = $model->OFR_ID;
						$thr->save();
					}
					
					$this->EmailNotification($model, "email_content_response");

					$this->redirect(array('view','id'=>$model->OFR_ID));
				}
			}
			else
			{
				$this->render('create',array(
						'model'=>$model,
						'respondeeOffer'=>$respondeeOffer,
						'message'=>"Can't send an ampty offer.",
					));
				return;
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'respondeeOffer'=>$respondeeOffer,
			'message'=>"",
		));
	}

	public function actionAdmin()
	{
		$this->CanUserSeeTheseOffers();

		$model=new Offer('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['NEG_ID']))
			$model->OFR_NEG_ID = $_GET['NEG_ID'];
			
		$isActive = $this->IsThisNegotiationActive($model->Offer_negotiation, false);
		
		$isEmptyNegotation = (count($model->Offer_negotiation->negotiation_offers) == 0);
		$canRespond = ($isActive == "" ? $this->CanUserRespond($model->Offer_negotiation, false, null) : false);
		$mustScore = $canRespond ? $this->UserMustScore($model->Offer_negotiation, false, null) : false;

		$this->render('admin',array(
			'model'=>$model,
			'isActive'=>$isActive,
			'canRespond'=>$canRespond,
			'mustScore'=>$mustScore,
			'isEmptyNegotation' => $isEmptyNegotation,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Offer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function EmailNotification($offer, $type)
	{
		require("PHPMailer/class.phpmailer.php");

		$mail = new PHPMailer();
		$mail->Mailer = "smtp";

		$mail->SMTPAuth   = true; 
		$mail->Host       = "poczta.o2.pl";
		$mail->Port       = 587; 

		$mail->Username   = "testowy13@o2.pl";
		$mail->Password   = "qwerty";

		$mail->From       = "testowy13@o2.pl";
		$mail->FromName   = "notice";
		$mail->Subject    = "New Offer notice";
		
		$mail->WordWrap   = 50;

		$cnf = Configurations::model()->findByAttributes(array('CNF_NAME'=>$type));
		$msg = $cnf->CNF_VALUE;

		$value = $offer->Offer_negotiation->NEG_ID;
		$pattern = "{{NEG_ID}}";
		$msg = str_replace($pattern, $value, $msg);
		
		$mail->AltBody    = $msg;
		$mail->MsgHTML($msg);

		$mail->AddReplyTo("testowy13@o2.pl","notice");

		$mail->AddAddress("izabela.szczepanik@gazeta.pl","Izabela Szczepanik");

		if ($offer->Offer_negotiation->NEG_USR1 == $offer->OFR_NAD_USR_ID)
		{
			//sending to NEG_USR2
			$mail->AddAddress($offer->Offer_negotiation->negotiator_2->USR_EMAIL,$offer->Offer_negotiation->negotiator_2->WholeName());
		}
		else
		{
			//sending to NEG_USR1
			$mail->AddAddress($offer->Offer_negotiation->negotiator_1->USR_EMAIL,$offer->Offer_negotiation->negotiator_1->WholeName());
		}

		$mail->IsHTML(true);

		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  //echo "Message has been sent";
		}
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='offer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
