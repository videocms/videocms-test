<div class="jumbotron">
        <div id="slider1_container">
            <!-- Slides Container -->
            <div u="slides" class="slides">
            <?php foreach($DataSlider as $Data) : ?>
                <div>
                    <a href="video/<?php echo $Data->slider_idvideo; ?>-<?php echo implode(",",Yii::app()->db->createCommand()
                    ->select('video_alias')
                    ->from('videocms_video')
                    ->where('video_id=:video_id', array(':video_id'=>$Data->slider_idvideo))
                    ->queryRow());?>">
                        <img u="image" src="<?php echo $Data->slider_image; ?>"/>
                        <div class="caption" u="caption" t="MCLIP|B">
                            <div class="cap caption1">
                                <h2><?php echo $Data->slider_title; ?></h2>
                            </div>
                            <div class="cap caption2">
                                <h4><?php echo $Data->slider_text.'...'; ?></h4>
                            </div>
                        </div>
                    </a>
                </div>    
            <?php endforeach; ?>      
            </div>
             <style>
                    /* jssor slider arrow navigator skin 03 css */
                    /*
                    .jssora03l              (normal)
                    .jssora03r              (normal)
                    .jssora03l:hover        (normal mouseover)
                    .jssora03r:hover        (normal mouseover)
                    .jssora03ldn            (mousedown)
                    .jssora03rdn            (mousedown)
                    */
                    .jssora14l, .jssora14r, .jssora14ldn, .jssora14rdn
                    {
                        position: absolute;
                        cursor: pointer;
                        display: block;
                        background: url(<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/img/a14.png) no-repeat;
                        overflow:hidden;
                    }
                    .jssora14l { background-position: -15px -35px; }
                    .jssora14r { background-position: -75px -35px; }
                    .jssora14l:hover { background-position: -135px -35px; }
                    .jssora14r:hover { background-position: -195px -35px; }
                    .jssora14ldn { background-position: -255px -35px; }
                    .jssora14rdn { background-position: -315px -35px; }
                </style>
                <!-- Arrow Left -->
                <span u="arrowleft" class="jssora14l" style="width: 30px; height: 50px; top: 123px; left: 0px;"></span>
                <!-- Arrow Right -->
                <span u="arrowright" class="jssora14r" style="width: 30px; height: 50px; top: 123px; right: 0px"></span>
                <!-- Arrow Navigator Skin End -->
        </div>
        <div class="clearfix"></div>
</div>

<div class="container">
<div class="row column">
<?php
    foreach ($ModelCategories as $ModelCategoryShow)
        {
          $Category[$ModelCategoryShow->id] = $ModelCategoryShow->name;  
        }
?>
    <div class="col-md-12">
        <h3>Najnowsze</h3>
    </div>
    <?php foreach ($VideoLatest as $Video) : ?>
	<div id="<?php echo $Video->video_id; ?>" class="col-xs-6 col-sm-6 col-md-3" data-toggle="popover" data-placement="top" data-trigger="hover" title="Więcej informacji" data-content="<?php echo $Video->video_description.'...'; ?>">
		<div class="vc-lockup-video">
		
				  <div class="vc-lockup-thumbnail">
                                      <a href="video/<?php echo $Video->video_id; ?>-<?php echo $Video->video_alias; ?>" title="<?php echo $Video->video_title; ?>">   
						<span class="video-thumb  vc-thumb vc-thumb-196 vc-thumb-fluid">
						  <span class="vc-thumb-default">
							<span class="vc-thumb-clip">
							  <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $Video->video_thumb; ?>" alt="">
								<span class="vertical-align"></span>
							</span>
						  </span>
						</span> 
						</a>
					</div>
				<div class="vc-lockup-content">
					<h3 class="title">
                                        <?php echo CHtml::link($Video->video_title, array('video/'.$Video->video_id.'-'.$Video->video_alias), array('class'=>'vc-lockup-link vc-ui-ellipsis', 'title'=>$Video->video_title));?>
					</h3>
                                        <h5 class="stat"><small>Autor</small></h5>
                                        <h5 class="stat"><small><?php echo $Video->video_views; ?> wyświetlenia</small></h5>
				</div>
		
		</div>
            </div>
     <script type="text/javascript">
$('#<?php echo $Video->video_id; ?>').popover({
    placement : 'top',
    //html : true,
    trigger : 'hover', 
    delay: { 
       show: "500", 
       hide: "300"
    }
//    content: function() {
//        return $('#1-<?php echo $Video->video_id; ?>').html();
//    }
});
       </script>
    <?php endforeach; ?> 
   
    <div class="clearfix"></div>
    <hr>
    <div class="col-md-12">
        <h3>Popularne</h3>
    </div>
    <?php foreach ($VideoPopular as $Video) : ?>
	<div class="col-xs-6 col-sm-6 col-md-3">
		<div class="vc-lockup-video">
		
				  <div class="vc-lockup-thumbnail">
                                      <a href="video/<?php echo $Video->video_id; ?>-<?php echo $Video->video_alias; ?>" title="<?php echo $Video->video_title; ?>">   
						<span class="video-thumb  vc-thumb vc-thumb-196 vc-thumb-fluid">
						  <span class="vc-thumb-default">
							<span class="vc-thumb-clip">
							  <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $Video->video_thumb; ?>" alt="">
								<span class="vertical-align"></span>
							</span>
						  </span>
						</span> 
						</a>
					</div>
				<div class="vc-lockup-content">
					<h3 class="title">
                                        <?php echo CHtml::link($Video->video_title, array('video/'.$Video->video_id.'-'.$Video->video_alias), array('class'=>'vc-lockup-link vc-ui-ellipsis', 'title'=>$Video->video_title));?>
					</h3>
                                        <h5 class="stat"><small>Autor</small></h5>
                                        <h5 class="stat"><small><?php echo $Video->video_views; ?> wyświetlenia</small></h5>
				</div>
		
		</div>
            </div>
    <?php endforeach; ?>
    
        
</div>
</div>
<!--    wyszukiwanie po stronie google   https://developers.google.com/webmasters/richsnippets/sitelinkssearch
<script type="application/ld+json">
{
   "@context": "http://schema.org",
   "@type": "WebSite",
   "url": "https://www.example-petstore.com/",
   "potentialAction": {
     "@type": "SearchAction",
     "target": "https://query.example-petstore.com/search?q={search_term_string}",
     "query-input": "required name=search_term_string"
   }
}
</script> -->
     <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/js/jssor.slider.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/js/jssor.js"></script>
    <script>
    jQuery(document).ready(function ($) {
var _CaptionTransitions = [];
            _CaptionTransitions["L"] = { $Duration: 900, x: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["R"] = { $Duration: 900, x: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["T"] = { $Duration: 900, y: 0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["B"] = { $Duration: 900, y: -0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["ZMF|10"] = { $Duration: 900, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 };
            _CaptionTransitions["RTT|10"] = { $Duration: 900, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} };
            _CaptionTransitions["RTT|2"] = { $Duration: 900, $Zoom: 3, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 0.5} };
            _CaptionTransitions["RTTL|BR"] = { $Duration: 900, x: -0.6, y: -0.6, $Zoom: 11, $Rotate: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} };
            _CaptionTransitions["CLIP|LR"] = { $Duration: 900, $Clip: 15, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic }, $Opacity: 2 };
            _CaptionTransitions["MCLIP|L"] = { $Duration: 900, $Clip: 1, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };
            _CaptionTransitions["MCLIP|R"] = { $Duration: 900, $Clip: 2, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };

            var _SlideshowTransitions = [{
                    $Duration:1000,$Opacity:2                  
        }];
            
        var options = { 
            $FillMode: 2,
            $AutoPlay: true,
            $AutoPlayInterval: 4000,
            $PauseOnHover: 1,
            $ArrowKeyNavigation: <?php echo $this->slider_arrowkeynavigation; ?>,
            $SlideEasing: $JssorEasing$.$EaseOutQuint,
            $SlideDuration: <?php echo $this->slider_duration; ?>,
            $MinDragOffsetToSlide: <?php echo $this->slider_mindragoffsettoslide; ?>,
            $SlideSpacing: <?php echo $this->slider_slidespacing; ?>,
            $DisplayPieces: 1,
            $ParkingPosition: 0,
            $UISearchMode: 1,   
            $PlayOrientation: 1,
            $DragOrientation: <?php echo $this->slider_dragorientation; ?>,
            $Loop: <?php echo $this->slider_loop; ?>,
            $HWA: <?php echo $this->slider_hwa; ?>,
            
            $LazyLoading: <?php echo $this->slider_lazyloading; ?>,
            
            $CaptionSliderOptions: {
                    $Class: $JssorCaptionSlider$,     
                    $CaptionTransitions: _CaptionTransitions,
                    $PlayInMode: 1,
                    $PlayOutMode: 3
                },
            $BulletNavigatorOptions: {                          //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                 //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 8,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                    $Scale: false,                                  //Scales bullets navigator or not while slider scale
                },           
            $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: <?php echo $this->slider_arrow; ?>,                                //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                },
            $SlideshowOptions: {                                //Options which specifies enable slideshow or not
                $Class: $JssorSlideshowRunner$,                 //Class to create instance of slideshow
                $Transitions: _SlideshowTransitions            //Transitions to play slide, see jssor slideshow transition builder
            }
            };
            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
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
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tinymce/tinymce.min.js"></script>
