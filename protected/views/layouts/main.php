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

	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/rotate3Di.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-css-transform.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.timer.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/upclick.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>


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

    <div id="chatbox" class="row" style="display:none;">
    	<div class="col-lg-2" style="position:fixed;left:auto;right:0;bottom:0;z-index:200">
        <div id="chatbox">
            <div class="panel panel-default">
                <div class="panel-heading">
                	Thong Nguyen
                	<a id="remove-chatbox" class="pull-right" href="#"><i class="glyphicon glyphicon-remove"></i></a>
               	</div>
                <div class="panel-body" style="height:250px">
                
                </div>
                <div class="panel-footer">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="input-group">
                          <input type="text" class="form-control">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                          </span>
                        </div><!-- /input-group -->
                      </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div>
            </div> 
        </div>
    </div>
</div>

</body>
</html>
<?
$remove_chatbox_script = <<<EO_SCRIPT
$(document).on('click', '#remove-chatbox', function(event){
    $("#chatbox").hide( );

});
EO_SCRIPT;
Yii::app()->clientScript->registerScript('remove_chatbox', $remove_chatbox_script, CClientScript::POS_READY);
?>