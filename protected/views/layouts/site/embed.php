<!DOCTYPE html>
<html lang="pl">

<head>

    <meta charset="utf-8">
    <meta name="language" content="pl" />
         <meta name="advertising" content="ask" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
         <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video-js.css" rel="stylesheet" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video.js"></script>
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/videojs-contrib-ads/videojs.ads.css" rel="stylesheet" type="text/css" />
 	<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/videojs.vast.css" rel="stylesheet" type="text/css" />
	
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
<?php echo $content; ?>
</body>
</html>