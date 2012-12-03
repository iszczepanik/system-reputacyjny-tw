<?php

class WeighingController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('admin','chart','create'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
		
		$uri = "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js";
		Yii::app()->clientScript->registerScriptFile($uri);
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//$model=new Weighing;
		//$model->WGH_CRT_ID = $_GET['cas_id'];
		$model->WGH_USR_ID = Yii::app()->user->id;
		$case = NegotiationCase::model()->findByPk($_GET['cas_id']);
		
		//var_dump($_POST);
		
		if(isset($_POST['yt0']))
		{
			//trzeba obliczyć sume wag
			$weight_sum = 0;
			foreach($case->Criterias as $key=>$criterion)
			{
				$weight_sum += $_POST['Weighing_'.$criterion->CRT_ID]['WGH_WEIGHT'];
			}
			
			//var_dump($weight_sum);
			
			//if (false)
			foreach($case->Criterias as $key=>$criterion)
			{
				//var_dump($criterion);
				//zebranie ustawionych atrybutów
				$model = new Weighing;
				$model->attributes = $_POST['Weighing_'.$criterion->CRT_ID];
				//przypisanie atrybutów wynikających z kontekstu
				$model->WGH_CRT_ID = $criterion->CRT_ID;
				$model->WGH_USR_ID = Yii::app()->user->id;
				$model->WGH_VALUE = 0; //nie używane
				//wyznaczenie pis i nis
				$model->WGH_PIS = $model->WGH_PREF == "min" ? $criterion->CRT_MIN : $criterion->CRT_MAX;
				$model->WGH_NIS = $model->WGH_PREF == "min" ? $criterion->CRT_MAX : $criterion->CRT_MIN;
				//obliczenie wagi
				$model->WGH_WEIGHT = $model->WGH_WEIGHT / $weight_sum;
				//obliczenie P
				$middle_weight = $_POST['Weighing_'.$criterion->CRT_ID]['WGH_AVG'];
				//var_dump($middle_weight);
				$middle_weight = 1 - ($middle_weight / 100);
				//var_dump($middle_weight);
				$model->WGH_P = log($middle_weight, 0.5);
				//var_dump($model->WGH_P);
				$model->save();
					//var_dump($model);
			}
			
			$this->actionAdmin();
			return;
		}

		foreach($case->Criterias as $key=>$criterion)
		{
			//var_dump($criterion);
			$model = new Weighing;
			$model->WGH_CRT_ID = $criterion->CRT_ID;
			$model->WGH_USR_ID = Yii::app()->user->id;
			
			$models[$key] = $model;
		}
		//var_dump($models);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		

		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/detailview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/gridview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		
		$this->includeRatingFiles();
		
		
		$this->render('create',array(
			'models'=>$models,
		));
	}
	
	public function normalize($x, $xNis, $xPis)
	{
		return ($x - $xNis) / ($xPis - $xNis);
	}
	
	public function actionChart($id)
	{
		$wgh = Weighing::model()->findByPk($id);
		$crt = $wgh->weighing_criterion;
	
		$uri = "http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/highcharts.js";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/modules/exporting.js";
		Yii::app()->clientScript->registerScriptFile($uri);

		//najpierw jakie mamy min i max?
		$min = $crt->CRT_MIN;
		$max = $crt->CRT_MAX;
		//wyznaczamy punkty pośrednie
		$avg = ($min + $max) / 2;
		$avg_min = ($min + $avg) / 2; 
		$avg_max = ($avg + $max) / 2;
		//to jeszcze 4
		$p1 = ($min + $avg_min) / 2;
		$p3 = ($avg_min + $avg) / 2;
		$p5 = ($avg + $avg_max) / 2;
		$p7= ($avg_max + $max) / 2;
		
		//jakie mamy pis i nis?
		$nis = $wgh->WGH_NIS;
		$pis = $wgh->WGH_PIS;
		
		//obliczamy
		$min_val = 1 - pow((1 - $this->normalize($min, $nis, $pis)),$wgh->WGH_P);
		$max_val = 1 - pow((1 - $this->normalize($max, $nis, $pis)),$wgh->WGH_P);
		$avg_val = 1 - pow((1 - $this->normalize($avg, $nis, $pis)),$wgh->WGH_P);
		$avg_min_val = 1 - pow((1 - $this->normalize($avg_min, $nis, $pis)),$wgh->WGH_P);
		$avg_max_val = 1 - pow((1 - $this->normalize($avg_max, $nis, $pis)),$wgh->WGH_P);
		$p1_val = 1 - pow((1 - $this->normalize($p1, $nis, $pis)),$wgh->WGH_P);
		$p3_val = 1 - pow((1 - $this->normalize($p3, $nis, $pis)),$wgh->WGH_P);
		$p5_val = 1 - pow((1 - $this->normalize($p5, $nis, $pis)),$wgh->WGH_P);
		$p7_val = 1 - pow((1 - $this->normalize($p7, $nis, $pis)),$wgh->WGH_P);
		
		$data = "[";
		$data .= "[".$min.",".$min_val."],";
		$data .= "[".$p1.",".$p1_val."],";
		$data .= "[".$avg_min.",".$avg_min_val."],";
		$data .= "[".$p3.",".$p3_val."],";
		$data .= "[".$avg.",".$avg_val."],";
		$data .= "[".$p5.",".$p5_val."],";
		$data .= "[".$avg_max.",".$avg_max_val."],";
		$data .= "[".$p7.",".$p7_val."],";
		$data .= "[".$max.",".$max_val."]";
		$data .= "]";

		$this->render('chart',array(
			'id'=>$id,
			'name'=>$crt->CRT_NAME,
			'min'=>$min,
			'max'=>$max,
			'data'=>$data,
		));
	
	}

	public function hasCriteriaToWeight()
	{	
		$command = Yii::app()->db->createCommand("SELECT `cas`.`cas_id` , `cas`.`cas_desc`
			FROM `neg`
			JOIN `cas` ON `cas`.`cas_id` = `neg`.`neg_cas_id`
			WHERE (
			`NEG_USR1` = ".Yii::app()->user->id."
			OR `NEG_USR2` = ".Yii::app()->user->id."
			)");
		$casesArray = $command->queryAll();
		//var_dump($casesArray);
		
		foreach ($casesArray as $key=>$cas)
		{
			$command = Yii::app()->db->createCommand("
				SELECT *
				FROM `cas`
				WHERE 
				`CAS_ID` = ".$cas['cas_id']."
				and
				(
				SELECT count(*)
				FROM `crt`
				WHERE `CRT_CAS_ID` = ".$cas['cas_id']."
				) >
				(
				SELECT count(*) 
				FROM `wgh` 
				WHERE 
				`WGH_USR_ID` = ".Yii::app()->user->id."
				and
				`WGH_CRT_ID` in
				(select crt_id from crt where crt_cas_id = ".$cas['cas_id'].")
				)
				");
			//var_dump($command);

			$missing = $command->queryAll();
			if ($missing != null)
			{
				$unsetCrtWgh[$cas['cas_id']] = $cas['cas_desc'];
			}
		}

		//var_dump($unsetCrtWgh);
		return $unsetCrtWgh;
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		//$this->hasCriteriaToWeight();
	
		$model=new Weighing('search');
		$model->unsetAttributes();  // clear any default values
		//if(isset($_GET['Weighing']))
		//	$model->attributes=$_GET['Weighing'];
		$model->WGH_USR_ID = Yii::app()->user->id;
		
		$this->render('admin',array(
			'model'=>$model,
			'unsetCrtWgh'=>$this->hasCriteriaToWeight(),
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Weighing::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='weighing-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
