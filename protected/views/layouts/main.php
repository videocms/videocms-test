<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="pl" />
        <meta name="advertising" content="ask" />
        <meta property="og:title" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php if ($this->pageTitle == 'embed-video-site'){
            ?>
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
<?php echo $content; ?>
</body>
</html>
        <?php 
        }
        else{
            
        ?>
            <?php if (!empty($this->pageMetaDescription))
                {
        echo '    <meta name="description" content="' . $this->pageMetaDescription . '" />';
        echo '    <meta property="og:description" content="' . $this->pageMetaDescription . '" />';
                } 
                if (!empty($this->pageMetaRobots))
                {
        echo '    <meta name="robots" content="' . $this->pageMetaRobots . '" />';
        echo '<meta property="og:image" content="http://videocms-test.pl/' . $this->pageMetaOgImage.'" />';
        echo '<meta property="og:locale" content="pl_PL"/>';
                } 
                if (!empty($this->pageMetaKeywords))
                {
        echo '    <meta name="keywords" content="' . $this->pageMetaKeywords . '" />';
                }
            ?>
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
         selector: "textarea",theme: "modern",width: '100%',height: 485,
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

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/js/jssor.slider.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/js/jssor.js"></script>
        <!-- Caption Style -->
    <style> 
        .captionOrange, .captionBlack
        {
            color: #fff;
            font-size: 20px;
            line-height: 30px;
            text-align: center;
            border-radius: 4px;
        }
        .captionOrange
        {
            background: #EB5100;
            background-color: rgba(235, 81, 0, 0.6);
        }
        .captionBlack
        {
        	font-size:16px;
            background: #000;
            background-color: rgba(0, 0, 0, 0.4);
        }
        a.captionOrange, A.captionOrange:active, A.captionOrange:visited
        {
        	color: #ffffff;
        	text-decoration: none;
        }
        a.captionOrange:hover
        {
            color: #eb5100;
            text-decoration: underline;
            background-color: #eeeeee;
            background-color: rgba(238, 238, 238, 0.7);
        }
        .bricon
        {
            background: url(<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/img/browser-icons.png);
        }
    </style>
<script>
    jQuery(document).ready(function ($) {
        var _CaptionTransitions = [];
            _CaptionTransitions["L"] = { $Duration: 800, x: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["R"] = { $Duration: 800, x: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["T"] = { $Duration: 800, y: 0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["B"] = { $Duration: 800, y: -0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["TL"] = { $Duration: 800, x: 0.6, y: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["TR"] = { $Duration: 800, x: -0.6, y: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["BL"] = { $Duration: 800, x: 0.6, y: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["BR"] = { $Duration: 800, x: -0.6, y: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };

            _CaptionTransitions["WAVE|L"] = { $Duration: 1500, x: 0.6, y: 0.3, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave }, $Opacity: 2, $Round: { $Top: 2.5} };
            _CaptionTransitions["MCLIP|B"] = { $Duration: 600, $Clip: 8, $Move: true, $Easing: $JssorEasing$.$EaseOutExpo };

        var options = { 
            $AutoPlay: true,
            $SlideDuration: <?php echo $this->slider_duration; ?>,
            $DragOrientation: <?php echo $this->slider_dragorientation; ?>,
            $SlideSpacing: <?php echo $this->slider_slidespacing; ?>,
            $MinDragOffsetToSlide: <?php echo $this->slider_mindragoffsettoslide; ?>,
            $Loop: <?php echo $this->slider_loop; ?>,
            $HWA: <?php echo $this->slider_hwa; ?>,
            $ArrowKeyNavigation: <?php echo $this->slider_arrowkeynavigation; ?>,
            $LazyLoading: <?php echo $this->slider_lazyloading; ?>,
            $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: <?php echo $this->slider_arrow; ?>,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 0,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                },
            $CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
                    $Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
                    $CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
                    $PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
                    $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
                }
            };
        var jssor_slider1 = new $JssorSlider$('slider1_container', options);
    });
</script>
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
                            array('label'=>'Slider', 'url'=>array('/admin/slider')),
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

        
<?php
                }?>
