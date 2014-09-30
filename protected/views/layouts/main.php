<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="pl" />
        <meta name="advertising" content="ask" />
            <?php if (!empty($this->pageMetaDescription))
                {
        echo '    <meta name="description" content="' . $this->pageMetaDescription . '" />';
        echo '    <meta property="og:description" content="' . $this->pageMetaDescription . '" />';
                } 
                if (!empty($this->pageMetaRobots))
                {
        echo '    <meta name="robots" content="' . $this->pageMetaRobots . '" />';
                } 
                if (!empty($this->pageMetaKeywords))
                {
        echo '    <meta name="keywords" content="' . $this->pageMetaKeywords . '" />';
                }
            ?>
        <meta property="og:title" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
        <?php
            echo '<meta property="og:image" content="http://videocms-test.pl/' . $this->pageMetaOgImage.'" />';
        ?>
 
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <div class=""
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
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
  <!--
<script>
$.noConflict();
// Code that uses other library's $ can follow here.
</script> -->
        <script>
    videojs.options.flash.swf = "video-js.swf";
  </script>
        <!-- koniec video js -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/twitter-bootstrap/js/bootstrap.min.js"></script>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/twitter-bootstrap/css/bootstrap.css" rel="stylesheet" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({
         selector: "textarea",theme: "modern",width: 980,height: 500,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true,
   
   external_filemanager_path:"/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
        });</script>

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
                            array('label'=>'Wideo', 'url'=>array('/admin/videos')),
				array('label'=>'Kategorie', 'url'=>array('/admin/category')),
                            array('label'=>'Reklamy', 'url'=>array('/admin/vast')),
                            array('label'=>'Ustawienia', 'url'=>array('/admin/settings')),
                            array('label'=>'Seo', 'url'=>array('/admin/seo/1')),
				//array('label'=>'komentarze', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Zmień hasło', 'url'=>array('/admin/pass')),
                            array('label'=>'Wyloguj', 'url'=>array('/login/logout')),
			),
                ));}
                else
                {
                    $this->widget('zii.widgets.CMenu',array('items'=>array(
                        array('label'=>'Strona główna', 'url'=>array('/index')),
                        array('label'=>'Zaloguj', 'url'=>array('/login/index')),
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
		<!--<?php echo Yii::powered(); ?>-->
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
