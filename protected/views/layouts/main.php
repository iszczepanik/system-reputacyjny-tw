<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Register', 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Negotiators', 'url'=>array('/user/UserList'), 'visible'=>(!Yii::app()->user->isGuest)),
				array('label'=>'My negotiations', 'url'=>array('/negotiation/user'), 'visible'=>(Yii::app()->user->name!='admin' && !Yii::app()->user->isGuest)),
				array('label'=>'My profile', 'url'=>array('/user/TkiProfile'), 'visible'=>(Yii::app()->user->name!='admin' && !Yii::app()->user->isGuest)),
				array('label'=>'Users', 'url'=>array('/user/admin'), 'visible'=>Yii::app()->user->name=='admin'),
				array('label'=>'Negotiation Cases', 'url'=>array('/negotiationcase/admin'), 'visible'=>Yii::app()->user->name=='admin'),
				array('label'=>'Negotiations', 'url'=>array('/negotiation/admin'), 'visible'=>Yii::app()->user->name=='admin'),
				array('label'=>'Criteria', 'url'=>array('/criteria/admin'), 'visible'=>Yii::app()->user->name=='admin'),
				array('label'=>'Preferences', 'url'=>array('/weighing/admin'), 'visible'=>(Yii::app()->user->name!='admin' && !Yii::app()->user->isGuest)),
			),
		)); ?>
		</div><!-- mainmenu -->
		
	</div><!-- header -->
	<!-- breadcrumbs		
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?> -->
	




	<?php echo $content; ?>


	<div id="footer">
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->
</div><!-- page -->

</body>
</html>