<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="pl" />
        <div class=""
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <!-- video -->
        
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video-js.css" rel="stylesheet" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video.js"></script>
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/videojs-contrib-ads/videojs.ads.css" rel="stylesheet" type="text/css">
 	<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/videojs.vast.css" rel="stylesheet" type="text/css">
	
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/button-styles.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video-quality-selector.js"></script>
	<!--[if lt IE 9]><script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/es5.js"></script><![endif]-->
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/videojs-contrib-ads/videojs.ads.js"></script>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/vast-client.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/videojs.vast.js"></script>
<style type="text/css">
    #vid1 {
      width: 75%;
    }
  </style>
  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  
<script>
$.noConflict();
// Code that uses other library's $ can follow here.
</script>
        
        <!-- koniec video js -->
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php if(Yii::app()->session['zalogowany'] == 'tak')
                {
                    $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/cmsvideo/index')),
				array('label'=>'Wyloguj', 'url'=>array('/zaloguj/wyloguj')),
                            array('label'=>'Wpisy', 'url'=>array('/admin/wpisy')),
				array('label'=>'Kategorie', 'url'=>array('/admin/kategorie')),
				//array('label'=>'komentarze', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Zmień hasło', 'url'=>array('/admin/haslo')),
			),
                ));}
                else
                {
                    $this->widget('zii.widgets.CMenu',array('items'=>array(
                        array('label'=>'Strona główna', 'url'=>array('cmsvideo/index')),
                        array('label'=>'Zaloguj', 'url'=>array('cmsvideo/zaloguj')),
                    ),
                  ));
                }
?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
