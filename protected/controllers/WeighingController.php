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
				'actions'=>array('admin','chart','create','update'),
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
			
			foreach($case->Criterias as $key=>$criterion)
			{
				//var_dump($criterion);
				//zebranie ustawionych atrybutów
				$model = new Weighing;
				$model->attributes = $_POST['Weighing_'.$criterion->CRT_ID];
				$model->WGH_IMPORTANCE = $model->WGH_WEIGHT;
				//przypisanie atrybutów wynikających z kontekstu
				$model->WGH_CRT_ID = $criterion->CRT_ID;
				$model->WGH_USR_ID = Yii::app()->user->id;

				$model->CalculateStuff($weight_sum, $criterion);

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
			$model->WGH_VALUES = $criterion->CRT_VALUES;
			
			$models[$key] = $model;
		}

		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/detailview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/gridview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		
		$this->includeRatingFiles();
		
		
		$this->render('create',array(
			'models'=>$models,
		));
	}
	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$crt_id = $model->WGH_CRT_ID;
		
		//var_dump($_POST);
		
		if(isset($_POST['yt0']) || isset($_POST['yt1']))
		{
			$model->attributes = $_POST['Weighing_'.$crt_id];
			$weight_sum = $model->GetWeightSumOfOther() + $model->WGH_IMPORTANCE;
			$model->WGH_IMPORTANCE = $model->WGH_WEIGHT;
			$model->CalculateStuff($weight_sum, $model->weighing_criterion);
			if($model->save() && isset($_POST['yt0']))
			{
				$this->actionAdmin();
				return;
			}
		}

		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/detailview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		$uri = Yii::app()->request->baseUrl."/assets/3bb6b5ce/gridview/styles.css";
		Yii::app()->clientScript->registerCssFile($uri);
		
		$uri = "http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/highcharts.js";
		Yii::app()->clientScript->registerScriptFile($uri);
		$uri = Yii::app()->request->baseUrl."/js/modules/exporting.js";
		Yii::app()->clientScript->registerScriptFile($uri);
		
		$this->includeRatingFiles();
		
		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function normalize($x, $xNis, $xPis)
	{
		return ($x - $xNis) / ($xPis - $xNis);
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
