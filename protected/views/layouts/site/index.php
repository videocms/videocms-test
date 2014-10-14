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
        <?php   if (!empty($this->pageMetaDescription))
                    {
                        echo '<meta name="description" content="' . $this->pageMetaDescription . '" />';
                        echo '<meta property="og:description" content="' . $this->pageMetaDescription . '" />';
                    } 
                if (!empty($this->pageMetaRobots))
                    {
                        echo '<meta name="robots" content="' . $this->pageMetaRobots . '" />';
                        echo '<meta property="og:image" content="http://videocms-test.pl/' . $this->pageMetaOgImage.'" />';
                        echo '<meta property="og:locale" content="pl_PL"/>';
                    } 
                if (!empty($this->pageMetaKeywords))
                    {
                         echo '<meta name="keywords" content="' . $this->pageMetaKeywords . '" />';
                    }
        ?>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/videojs.vast.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/videojs-contrib-ads/videojs.ads.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video-js.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/video/button-styles.css" rel="stylesheet" type="text/css" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/twitter-bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/component.css" rel="stylesheet" />
         <!-- Custom CSS -->
        <style type="text/css">
            #vid1 {
              width: 75%;
            }
        </style>
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
        <!-- video -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/video-quality-selector.js"></script>
	<!--[if lt IE 9]><script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/es5.js"></script><![endif]-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/videojs-contrib-ads/videojs.ads.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/lib/vast-client.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/video/videojs.vast.js"></script>
        <script>
             videojs.options.flash.swf = "video-js.swf";
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->      
</head>
<body style="padding-top:50px">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div id="wrapper">
        <div class="row">
          <div class="col-xs-5 col-sm-4 col-md-2" style="padding-top:7px; padding-left: 30px;">
           <img src="http://videotube.marstheme.com/wp-content/themes/videotube/img/logo.png" alt="tekst">
         </div>
        <div class="col-xs-1 col-sm-1" style="padding-top:7px;"><button id="showLeft" class="btn btn-default"><span class="glyphicon glyphicon-align-justify"></span></button></div>
    <div class="col-xs-6 col-sm-6" style="padding-top:7px;">    
      <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Szukaj</button>
      </span>
      <input type="text" class="form-control">
    </div>
  </div>
  </div>
  </div>
</div>
<div class="cbp-spmenu-push">
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
        
    <!-- Navigation -->

        <!-- Brand and toggle get grouped for better mobile display -->

           
            <!-- Collect the nav links, forms, and other content for toggling -->
          <!--  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
          <div>     <?php 
                        $this->widget('application.components.ActiveMenu',array(
                            //'id'=>'bs-example-navbar-collapse-1',
                           // 'items'=>$this->myMenu,
                           // 'htmlOptions'=>array(
                           //                'class'=>'nav navbar-nav'),
                          ) 
                        );
                ?>

              
            </div><!-- /.navbar-collapse -->

 </nav>
    <!-- Page Content -->
    <div class="container">
        <div class="main">
            <section>
       <?php echo $content; ?>
            </section>
        </div>
    </div>
    <!-- /.container -->
</div>
    <!-- jQuery -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/js/jssor.slider.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/js/jssor.js"></script>
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
    <script>tinymce.init({
         selector: "textarea",theme: "modern",width: '100%',height: 535,
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
        });
    </script>
    <script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeft = document.getElementById( 'showLeft' ),
				body = document.body;

			showLeft.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
			}			
		</script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/twitter-bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/classie.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tinymce/tinymce.min.js"></script>
</body>
</html>
