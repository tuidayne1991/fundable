<?php 
	/* @var $this Controller */ 
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" /> -->
	<!--[if lt IE 8]>1
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!--
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-switch.css" />
	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/rotate3Di.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-css-transform.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.timer.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/upclick.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-switch.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<?= $this->renderPartial("//layouts/header",array('middle' => false))?>
	
	<div id="main">
		<div class="container">
			<?php echo $content; ?>
		</div>
	</div>

	<footer class="bs-footer" role="contentinfo">
     	<div class="container">
        	<p>Designed and built by Tony Cao</p>
    	</div>
    </footer>

</body>
</html>
