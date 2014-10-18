<style type="text/css">
    .video-js {padding-top: 56.25%;}
    .vjs-fullscreen {padding-top: 0px}
    .col-centered{
    float: none;
    margin: 0 auto;
    }
    .float-right {
        float: right;
    }
    input[type="checkbox"] { 
	position: absolute;
	opacity: 0;
}

input[type="checkbox"] { 
	position: absolute;
	opacity: 0;
}

/* Normal Track */
input[type="checkbox"].ios-switch + div {
	vertical-align: middle;
	width: 40px;	height: 20px;
	border: 1px solid rgba(0,0,0,.4);
	border-radius: 999px;
	background-color: rgba(0, 0, 0, 0.1);
	-webkit-transition-duration: .4s;
	-webkit-transition-property: background-color, box-shadow;
	box-shadow: inset 0 0 0 0px rgba(0,0,0,0.4);
	margin: 15px 1.2em 15px 2.5em;
}


/* Big Track */
input[type="checkbox"].bigswitch.ios-switch + div {
	width: 50px;	height: 25px;
}

/* Green Track */
input[type="checkbox"].green.ios-switch:checked + div {
	background-color: #00e359;
	border: 1px solid rgba(0, 162, 63,1);
	box-shadow: inset 0 0 0 10px rgba(0,227,89,1);
}

/* Normal Knob */
input[type="checkbox"].ios-switch + div > div {
	float: left;
	width: 18px; height: 18px;
	border-radius: inherit;
	background: #ffffff;
	-webkit-transition-timing-function: cubic-bezier(.54,1.85,.5,1);
	-webkit-transition-duration: 0.4s;
	-webkit-transition-property: transform, background-color, box-shadow;
	-moz-transition-timing-function: cubic-bezier(.54,1.85,.5,1);
	-moz-transition-duration: 0.4s;
	-moz-transition-property: transform, background-color;
	box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(0, 0, 0, 0.4);
	pointer-events: none;
	margin-top: 1px;
	margin-left: 1px;
}

/* Big Knob */
input[type="checkbox"].bigswitch.ios-switch + div > div {
	width: 23px; height: 23px;
	margin-top: 1px;
}

/* Checked Big Knob (Blue Style) */
input[type="checkbox"].bigswitch.ios-switch:checked + div > div {
	-webkit-transform: translate3d(25px, 0, 0);
	-moz-transform: translate3d(16px, 0, 0);
	box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172,1);
}

/* Green Knob */
input[type="checkbox"].green.ios-switch:checked + div > div {
	box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(0, 162, 63,1);
}

</style>

<?php
//$cookie_name = "tryb_panoramiczny";
//if(!isset($_COOKIE[$cookie_name])) {
//    echo "Cookie named '" . $cookie_name . "' does not exist!";
//    $cookie_value = "1";
//    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
//} else {
//    echo "Cookie is named: " . $cookie_name . "<br>Value is: " . $_COOKIE[$cookie_name];
//}

foreach ($ModelCategories as $ModelCategoryShow)
{
    $Category[$ModelCategoryShow->id] = $ModelCategoryShow->name;
}
?>

<div class="container">
<?php
foreach ($Model as $ModelSite)
{
?>
    <?php
    if ($_COOKIE[widescreen_mode] == "0" || $_COOKIE[widescreen_mode] == NULL)
        {
            echo '<div class="video-overlay"></div> ';}
                else {
              echo '<div class="video-overlay-enabled"></div>';
            }?>
<div class="row">
    <?php
         if ($_COOKIE[widescreen_mode] == "0" || $_COOKIE[widescreen_mode] == NULL)
            {
                echo '<div id="test" class="col-md-8 col-normal">';}
                    else {
                   echo '<div id="test" class="col-centered player-width">';
                }?>        
     <!-- VIDEO! --> 
        <div class="wrapper">
            <div class="videocontent">
                <?php
                         if ($_COOKIE[widescreen_mode] == "0" || $_COOKIE[widescreen_mode] == NULL)
                                {
                                    echo '<div id="myvideo_vjs1" class="video-js">';}
                                    else {
                                       echo '<div id="myvideo_vjs1" class="video-js watch-medium">';
                                    }?>    
                    <video id="example-2" class="vjs-playing vjs-default-skin" preload="auto" controls width="auto" height="auto" poster="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $ModelSite->video_image; ?>" data-setup='{ "plugins" : { "resolutionSelector" : { "default_res" : "480" } } }'>		
                        <?php      
                        if (($ModelSite->video_720p == NULL) && ($ModelSite->video_1080p == NULL))
                         {
                              echo'<source src="'.$ModelSite->video_480p.'" type="'.$ModelSite->player_type.'" data-res="480" />';
                         }
                              elseif (($ModelSite->video_480p == NULL) && ($ModelSite->video_1080p == NULL)) {
                                      echo'<source src="'.$ModelSite->video_720p.'" type="'.$ModelSite->player_type.'" data-res="720" />';
                         }
                              elseif (($ModelSite->video_480p == NULL) && ($ModelSite->video_720p == NULL)){
                                      echo'<source src="'.$ModelSite->video_1080p.'" type="'.$ModelSite->player_type.'" data-res="1080" />';
                         }
                              elseif ($ModelSite->video_480p == NULL) {
                                      echo'<source src="'.$ModelSite->video_720p.'" type="'.$ModelSite->player_type.'" data-res="720" />';
                                      echo'<source src="'.$ModelSite->video_1080p.'" type="'.$ModelSite->player_type.'" data-res="1080" />';
                         }
                              elseif ($ModelSite->video_720p == NULL) {
                                      echo'<source src="'.$ModelSite->video_480p.'" type="'.$ModelSite->player_type.'" data-res="480" />';
                                      echo'<source src="'.$ModelSite->video_1080p.'" type="'.$ModelSite->player_type.'" data-res="1080" />';
                         }
                              elseif ($ModelSite->video_1080p == NULL) {
                                      echo'<source src="'.$ModelSite->video_480p.'" type="'.$ModelSite->player_type.'" data-res="480" />';
                                      echo'<source src="'.$ModelSite->video_720p.'" type="'.$ModelSite->player_type.'" data-res="720" />'; 
                         }
                         else {
                              echo'<source src="'.$ModelSite->video_480p.'" type="'.$ModelSite->player_type.'" data-res="480" />';
                              echo'<source src="'.$ModelSite->video_720p.'" type="'.$ModelSite->player_type.'" data-res="720" />';
                              echo'<source src="'.$ModelSite->video_1080p.'" type="'.$ModelSite->player_type.'" data-res="1080" />';
                        }
        ?>
                    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                    </video>
                </div>
            </div>
        </div>
        <!-- VIDEO -->
    </div>
    
    <div id="sidebar-modules" class="col-md-4 float-right">

        <div class="watch-sidebar-section">
            <div id="relatedVideos" class="watch-sidebar-body">
                
                    <?php foreach($VideoList as $RelatedVideo) : ?>
                    <div class="row video-list-item related-list-item">
                        <a href="<?php echo $RelatedVideo->video_id; ?>" class="">
                            <div class="col-xs-6 col-md-4">
                                <span class="vc-thumb  is-small">
                                    <span class="video-thumb  vc-thumb vc-thumb-120">
                                        <span class="vc-thumb-default">
                                          <span class="vc-thumb-clip">
                                            <img aria-hidden="true" alt="<?php echo $RelatedVideo->video_title; ?>" src="/../<?php echo $RelatedVideo->video_thumb; ?>" width="120">
                                            <span class="vertical-align"></span>
                                          </span>
                                        </span>
                                    </span>
                                </span>
                            </div>
                            
                            <div class="col-xs-12 col-sm-6 col-md-8">
                                <h5 class="title"><?php echo $RelatedVideo->video_title; ?></h5>
                                <h5 class="stat"><small>Autor</small></h5>
                                <h5 class="stat"><small><?php echo $RelatedVideo->video_views; ?> wyświetlenia</small></h5>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
            </div> 
        <?php $this->widget("ext.yiinfinite-scroll.YiinfiniteScroller", array('contentSelector' => '#relatedVideos', "itemSelector" => "div.row.video-list-item.related-list-item",'loadingText' => 'Ładuję...', 'donetext' => 'Wszystko zostało wyświetlone', "pages" => $pages)); ?>

        </div>
        
        
    </div>
    
    <div class="col-md-8 col-normal2">
    <label><input type="checkbox" name="widescreen" class="ios-switch green  bigswitch" id="widescreen_mode" onchange="set_check();" /><div><div></div></div></label>

         <?php
    echo '<h1 class="page-header">'.$ModelSite->video_title.'</h1>';
    echo '<h1>'.$ModelSite->video_views.'</h1>';
    echo '<p class="data">Data publikacji: '.$ModelSite->video_date.'</p>';
    echo '<p class="tresc">'.$ModelSite->video_text.'</p>';
    ?>
    <p class="tresc">Embed: <input type="text" value="<iframe src='http://videocms-test.pl/embed/<?php echo $ModelSite->video_id; ?>.html' frameborder='0' allowfullscreen></iframe>"></p><?php
    //echo '<p class="tresc">Embed: <input type="text" value"<iframe width="560" height="315" src="http://videocms-test.pl/cmsvideo/embed/'.$ModelSite->video_id.'.html" frameborder="0" allowfullscreen></iframe>"></p>';
    if ($Category[$ModelSite->video_category] != '')
        {
        echo '<p class="kategoria"> Kategoria: '.CHtml::link($Category[$ModelSite->video_category], 
        array('category/'.$ModelSite->video_category)).'</p>';
        }
//                foreach (unserialize($ModelSite->video_tags) as $Tag) {
//                    echo $Tag.' ';
//                }
    ?>
        <p>Lorem Ipsum jest tekstem stosowanym jako przykładowy wypełniacz w przemyśle poligraficznym. Został po raz pierwszy użyty w XV w. przez nieznanego drukarza do wypełnienia tekstem próbnej książki. Pięć wieków później zaczął być używany przemyśle elektronicznym, pozostając praktycznie niezmienionym. Spopularyzował się w latach 60. XX w. wraz z publikacją arkuszy Letrasetu, zawierających fragmenty Lorem Ipsum, a ostatnio z zawierającym różne wersje Lorem Ipsum oprogramowaniem przeznaczonym do realizacji druków na komputerach osobistych, jak Aldus PageMaker.</p>
    </div>
    
</div>
    

<script type="text/javascript">
	var vid1 = videojs( 'example-2', { plugins : { resolutionSelector : {
            // Pass any options here
            default_res : '480'
            // Define an on.ready function
            } } }, function() {
                        // "this" will be a reference to the player object
			var player = this;
			// Listen for the changeRes event
			player.on( 'changeRes', function() {
				// player.getCurrentRes() can be used to get the currently selected resolution
				console.log( 'Current Res is: ' + player.getCurrentRes() );
			});
                    });
	vid1.ads();
	vid1.vast({
            url: '/vastxml/?vid=<?php echo $ModelSite->video_id; ?>.xml'
        });
</script>
<script type="text/javascript">
		//var vid1 = videojs('example-2');

    //vid1.ads();
    //vid1.vast({
    //  url: 'http://ad3.liverail.com/?LR_PUBLISHER_ID=1331&LR_CAMPAIGN_ID=229&LR_SCHEMA=vast2'
   // });
 
    </script>
<?php } ?>
</div>
<!--<script type="text/javascript">

    
$(function() {
 $( "#button-watch-medium" ).click(function(){
      $( ".col-md-8.col-normal" ).switchClass( "col-md-8 col-normal", "col-centered player-width", 3 );
      $( ".col-centered" ).switchClass( "col-centered player-width", "col-md-8 col-normal", 3 );
      
      $( ".video-overlay" ).switchClass( "video-overlay", "video-overlay-enabled", 3 );
      $( ".video-overlay-enabled" ).switchClass( "video-overlay-enabled", "video-overlay", 3 );
      
     $(".video-js").toggleClass("watch-medium", 3);
    // $(".col-md-4").toggleClass("float-right", 3);
    });
  });
</script>-->
<?php
if ($_COOKIE[widescreen_mode] == "0" || $_COOKIE[widescreen_mode] == NULL)
{
    ?>
        <script type="text/javascript">
        $('#widescreen_mode').change(function(){

            if($(this).attr('checked')){
                  $(this).val('TRUE');
                  $( ".col-md-8.col-normal" ).switchClass( "col-md-8 col-normal", "col-centered player-width", 3 );
              $( ".col-centered" ).switchClass( "col-centered player-width", "col-md-8 col-normal", 3 );

              $( ".video-overlay" ).switchClass( "video-overlay", "video-overlay-enabled", 3 );
              $( ".video-overlay-enabled" ).switchClass( "video-overlay-enabled", "video-overlay", 3 );

             $(".video-js").toggleClass("watch-medium", 3);
             }else{

              $( ".col-centered" ).switchClass( "col-centered player-width", "col-md-8 col-normal", 3 );
              $( ".col-md-8.col-normal" ).switchClass( "col-md-8 col-normal", "col-centered player-width", 3 );

              $( ".video-overlay-enabled" ).switchClass( "video-overlay-enabled", "video-overlay", 3 );
              $( ".video-overlay" ).switchClass( "video-overlay", "video-overlay-enabled", 3 );

             $(".video-js").toggleClass("watch-medium", 3);
                  $(this).val('FALSE');
             }


        });

            </script>
<?php
    
} else {
    ?>
            <script type="text/javascript">
        $('#widescreen_mode').change(function(){

            if($(this).attr('checked')){
                  $(this).val('TRUE');
                  $( ".col-centered" ).switchClass( "col-centered player-width", "col-md-8 col-normal", 3 );
                  $( ".col-md-8.col-normal" ).switchClass( "col-md-8 col-normal", "col-centered player-width", 3 );

                 $( ".video-overlay-enabled" ).switchClass( "video-overlay-enabled", "video-overlay", 3 );
                 $( ".video-overlay" ).switchClass( "video-overlay", "video-overlay-enabled", 3 );

             $(".video-js").toggleClass("watch-medium", 3);

             }else{

              $( ".col-md-8.col-normal" ).switchClass( "col-md-8 col-normal", "col-centered player-width", 3 );
              $( ".col-centered" ).switchClass( "col-centered player-width", "col-md-8 col-normal", 3 );

              $( ".video-overlay" ).switchClass( "video-overlay", "video-overlay-enabled", 3 );
              $( ".video-overlay-enabled" ).switchClass( "video-overlay-enabled", "video-overlay", 3 );

             $(".video-js").toggleClass("watch-medium", 3);
                  $(this).val('FALSE');
             }


        });

            </script>
    <?php
    
}
?>
<!--<script type="text/javascript">
    $.cookie("test", "1", { expires: 7 });
    </script>-->

    <script type="text/javascript">
          function setCookie(c_name,value,expiredays) {
                var exdate=new Date()
                exdate.setDate(exdate.getDate()+expiredays)
                document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate)
            }

            function getCookie(c_name) {
                if (document.cookie.length>0) {
                    c_start=document.cookie.indexOf(c_name + "=")
                    if (c_start!=-1) { 
                        c_start=c_start + c_name.length+1 
                        c_end=document.cookie.indexOf(";",c_start)
                        if (c_end==-1) c_end=document.cookie.length
                            return unescape(document.cookie.substring(c_start,c_end))
                    } 
                }
                return null
            }
        onload=function(){
        if (getCookie("widescreen_mode") == "1")
                widescreen_mode.checked = true;
        else
                widescreen_mode.checked = false;	
        }
        function set_check(){
        setCookie('widescreen_mode', document.getElementById('widescreen_mode').checked? 1 : 0, 360); //360 <-- rok
        }
</script>
<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>


<!--<div class="afs_ads">&nbsp;</div>
<script>
(function() {
    var message = "Wyłącz AdBlocka.";

        // Define a function for showing the message.
        // Set a timeout of 2 seconds to give adblocker
        // a chance to do its thing
        var tryMessage = function() {
            setTimeout(function() {
                if(!document.getElementsByClassName) return;
                var ads = document.getElementsByClassName('afs_ads'),
                    ad  = ads[ads.length - 1];

                if(!ad
                    || ad.innerHTML.length == 0
                    || ad.clientHeight === 0) {
                    alert(message);
                    //window.location.href = '[URL of the donate page. Remove the two slashes at the start of thsi line to enable.]';
                } else {
                    ad.style.display = 'none';
                }

            }, 2000);
        }

        /* Attach a listener for page load ... then show the message */
        if(window.addEventListener) {
            window.addEventListener('load', tryMessage, false);
        } else {
            window.attachEvent('onload', tryMessage); //IE
        }
})();
</script>
-->
<script type="text/javascript">
    
    </script>