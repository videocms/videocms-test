<div class="jumbotron">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 980px; height: 380px;">
    <!-- Slides Container -->
    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 980px; height: 380px; overflow: hidden;">
    <?php foreach($DataSlider as $Data) : ?>
        
             <div>
                <a href="video/<?php echo $Data->slider_idvideo; ?>">
                    <img u="image" src="<?php echo $Data->slider_image; ?>" style="width: 980px; height: auto;top: 0px;left: 0px;position: absolute;" />
                    <div u="caption" t="MCLIP|B" style="position: absolute; top: 330px; left: 0px; width: 980px; height: 50px; transform: perspective(2000px);">
                        <div style="position: absolute; top: 0px; left: 0px; width: 980px; height: 50px; background-color: Black; opacity: 0.5; filter: alpha(opacity=50); transform: perspective(2000px);"></div>
                        <div style="position: absolute; top: 0px; left: 0px; width: 980px; height: 50px; color: White; font-size: 16px; font-weight: bold; line-height: 50px; text-align: center; transform: perspective(2000px);">
                            <?php echo $Data->slider_title; ?>
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
        <span u="arrowleft" class="jssora14l" style="width: 30px; height: 50px; top: 123px; left: 0px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora14r" style="width: 30px; height: 50px; top: 123px; right: 0px">
        </span>
        <!-- Arrow Navigator Skin End -->
</div>
</div>
</div>
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
	<div class="col-xs-6 col-sm-6 col-md-3">
		<div class="vc-lockup-video">
		
				  <div class="vc-lockup-thumbnail">
                                      <a href="video/<?php echo $Video->video_id; ?>-<?php echo $Video->video_alias; ?>" title="<?php echo $Video->video_title; ?>">   
						<span class="video-thumb  vc-thumb vc-thumb-196 vc-thumb-fluid">
						  <span class="vc-thumb-default">
							<span class="vc-thumb-clip">
							  <img class="img-responsive" src="/<?php echo $Video->video_thumb; ?>" alt="">
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
							  <img class="img-responsive" src="/<?php echo $Video->video_thumb; ?>" alt="">
								<span class="vertical-align"></span>
							</span>
						  </span>
						</span> 
						</a>
					</div>
				<div class="vc-lockup-content">
					<h3 class="title">
                                        <?php echo CHtml::link($Video->video_title.'-'.$Video->video_alias, array('video/'.$Video->video_id), array('class'=>'vc-lockup-link vc-ui-ellipsis', 'title'=>$Video->video_title));?>
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
        //responsive code begin
        function ScaleSlider() {
            var parentWidth = $('#slider1_container').parent().width();
            if (parentWidth) {
                jssor_slider1.$ScaleWidth(parentWidth);
            }
            else
                window.setTimeout(ScaleSlider, 30);
        }
        //Scale slider after document ready
        ScaleSlider();
        if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
            //Capture window resize event
            $(window).bind('resize', ScaleSlider);
        }
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