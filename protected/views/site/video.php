<style type="text/css">
.video-js {
    padding-top: 56.25%;
    }
.vjs-fullscreen {
    padding-top: 0px;
    }
.col-centered {
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
    width: 40px;	
    height: 20px;
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
    width: 50px;	
    height: 25px;
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
    width: 23px; 
    height: 23px;
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
//foreach ($ModelTags as $ModelTagShow)
//    {
//       // $Tag[$ModelTagShow->tag_id] = $ModelTagShow->tag_name;
//    echo 'tomek'.$ModelTagShow->tag_name;
//    }

    
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
                           echo '<div id="myvideo_vjs1" class="video-js">';
                        }
                        else
                            {
                                echo '<div id="myvideo_vjs1" class="video-js watch-medium">';
                            }
                            ?> 
                
                    <video id="example-2" class="vjs-playing vjs-default-skin" <?php echo $this->player_loop; ?> preload="<?php echo $this->player_preload; ?>" controls <?php echo $this->player_autoplay; ?> width="auto" height="auto" poster="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $Model->video_image; ?>" data-setup='{ "nativeControlsForTouch": <?php echo $this->player_controls; ?>, "plugins" : { "resolutionSelector" : { "default_res" : "480" } } }'>		
                        <?php      
                        if (($Model->video_720p == NULL) && ($Model->video_1080p == NULL))
                         {
                              echo'<source src="'.$Model->video_480p.'" type="'.$Model->player_type.'" data-res="480" />';
                         }
                              elseif (($Model->video_480p == NULL) && ($Model->video_1080p == NULL)) {
                                      echo'<source src="'.$Model->video_720p.'" type="'.$Model->player_type.'" data-res="720" />';
                         }
                              elseif (($Model->video_480p == NULL) && ($Model->video_720p == NULL)){
                                      echo'<source src="'.$Model->video_1080p.'" type="'.$Model->player_type.'" data-res="1080" />';
                         }
                              elseif ($Model->video_480p == NULL) {
                                      echo'<source src="'.$Model->video_720p.'" type="'.$Model->player_type.'" data-res="720" />';
                                      echo'<source src="'.$Model->video_1080p.'" type="'.$Model->player_type.'" data-res="1080" />';
                         }
                              elseif ($Model->video_720p == NULL) {
                                      echo'<source src="'.$Model->video_480p.'" type="'.$Model->player_type.'" data-res="480" />';
                                      echo'<source src="'.$Model->video_1080p.'" type="'.$Model->player_type.'" data-res="1080" />';
                         }
                              elseif ($Model->video_1080p == NULL) {
                                      echo'<source src="'.$Model->video_480p.'" type="'.$Model->player_type.'" data-res="480" />';
                                      echo'<source src="'.$Model->video_720p.'" type="'.$Model->player_type.'" data-res="720" />'; 
                         }
                         else {
                              echo'<source src="'.$Model->video_480p.'" type="'.$Model->player_type.'" data-res="480" />';
                              echo'<source src="'.$Model->video_720p.'" type="'.$Model->player_type.'" data-res="720" />';
                              echo'<source src="'.$Model->video_1080p.'" type="'.$Model->player_type.'" data-res="1080" />';
                        }
        ?>
                    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                    </video>
                </div>
            </div>
        </div>
        <!-- VIDEO -->
    </div>
    
    <div id="sidebar-modules" class="col-xs-5 col-md-4 column float-right">

        <div class="watch-sidebar-section">
            <div id="relatedVideos" class="watch-sidebar-body">
                
                    <?php foreach($VideoList as $RelatedVideo) : ?>
                    <div class="row video-list-item related-list-item">
                        <a href="<?php echo $RelatedVideo->video_id; ?>" class="">
                            <div class="col-xs-7 col-md-5">
                                <span class="vc-thumb">
                                    <span class="video-thumb  vc-thumb">
                                        <span class="vc-thumb-default">
                                          <span class="vc-thumb-clip">
                                            <img class="img-responsive" alt="<?php echo $RelatedVideo->video_title; ?>" src="/../<?php echo $RelatedVideo->video_thumb; ?>">
                                            <span class="vertical-align"></span>
                                          </span>
                                        </span>
                                    </span>
                                </span>
                            </div>
                            
                            <div class="content-stat">
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
    <div class="col-xs-7 col-md-8 col-normal2">
        <div class="column">
        <div class="col-md-12" itemscope itemid="" itemtype="http://schema.org/VideoObject">
            <?php echo '<h1 class="page-video">'.$Model->video_title.'</h1>'; ?>
            <link itemprop="url" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/<?php echo $Model->video_id; ?>">
            <meta itemprop="name" content="<?php echo $Model->video_title; ?>">
            <meta itemprop="description" content="<?php echo $Model->video_text; ?>">
           <!-- <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                <link itemprop="url" href="autor">
            </span> -->
          <!--  <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                <link itemprop="url" href="https://plus.google.com/103696814831605329975">
            </span> -->
            <link itemprop="thumbnailUrl" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/<?php echo $Model->video_image; ?>">
            <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
                <link itemprop="url" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/<?php echo $Model->video_image; ?>">
                <meta itemprop="width" content="1440">
                <meta itemprop="height" content="900">
            </span>
            <link itemprop="embedURL" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/embed/<?php echo $Model->video_id; ?>">
            <meta itemprop="playerType" content="HTML5 Flash">
            <meta itemprop="width" content="1920">
            <meta itemprop="height" content="1080">
            <meta itemprop="isFamilyFriendly" content="True">
            <meta itemprop="regionsAllowed" content="AD,AE,AF,AG,AI,AL,AM,AO,AQ,AR,AS,AT,AU,AW,AX,AZ,BA,BB,BD,BE,BF,BG,BH,BI,BJ,BL,BM,BN,BO,BQ,BR,BS,BT,BV,BW,BY,BZ,CA,CC,CD,CF,CG,CH,CI,CK,CL,CM,CN,CO,CR,CU,CV,CW,CX,CY,CZ,DE,DJ,DK,DM,DO,DZ,EC,EE,EG,EH,ER,ES,ET,FI,FJ,FK,FM,FO,FR,GA,GB,GD,GE,GF,GG,GH,GI,GL,GM,GN,GP,GQ,GR,GS,GT,GU,GW,GY,HK,HM,HN,HR,HT,HU,ID,IE,IL,IM,IN,IO,IQ,IR,IS,IT,JE,JM,JO,JP,KE,KG,KH,KI,KM,KN,KP,KR,KW,KY,KZ,LA,LB,LC,LI,LK,LR,LS,LT,LU,LV,LY,MA,MC,MD,ME,MF,MG,MH,MK,ML,MM,MN,MO,MP,MQ,MR,MS,MT,MU,MV,MW,MX,MY,MZ,NA,NC,NE,NF,NG,NI,NL,NO,NP,NR,NU,NZ,OM,PA,PE,PF,PG,PH,PK,PL,PM,PN,PR,PS,PT,PW,PY,QA,RE,RO,RS,RU,RW,SA,SB,SC,SD,SE,SG,SH,SI,SJ,SK,SL,SM,SN,SO,SR,SS,ST,SV,SX,SY,SZ,TC,TD,TF,TG,TH,TJ,TK,TL,TM,TN,TO,TR,TT,TV,TW,TZ,UA,UG,UM,US,UY,UZ,VA,VC,VE,VG,VI,VN,VU,WF,WS,YE,YT,ZA,ZM,ZW">
                <div class="tab-tr" id="t1">
                    <label>
                       <input type="checkbox" name="widescreen" class="ios-switch green  bigswitch" id="widescreen_mode" onchange="set_check();" />
                       <div>
                           <div>     
                           </div>   
                       </div>
                    </label>
                    <!--udostepnianie tutaj przycisk -->
                    <dic class="embedclass">
                        <button type="button" class="btn btn-info" style="float: left; margin: 11px 1.2em 11px 2.5em;" data-toggle="modal" data-target="#myModal">embed</button>
                        </dic>
                    <div class="stat-cnt">
                        <div class="rate-count">
                            <?php echo $Model->video_views; ?>
                        </div>
                        <div class="stat-bar">
                            <div class="bg-green" style="width:<?php $this->widget('likedislike.widgets.LikeDislikeView',array('field_id'=>$Model->video_id)); ?>%">
                            </div>
                            <div class="bg-red" style="width:<?php $this->widget('likedislikedis.widgets.LikeDislikedisView',array('field_iddis'=>$Model->video_id)); ?>%">
                            </div>
                        </div>
                        <div class="dislike-count">
                            <?php $this->widget('likedislikedis.widgets.LikeDislikedisButton',array('field_iddis'=>$Model->video_id)); ?><?php $this->widget('likedislikedis.widgets.LikeDislikedisLike',array('field_iddis'=>$Model->video_id)); ?>
                        </div>
                        <div class="like-count">
                            <?php $this->widget('likedislike.widgets.LikeDislikeButton',array('field_id'=>$Model->video_id)); ?><?php $this->widget('likedislike.widgets.LikeDislikeLike',array('field_id'=>$Model->video_id)); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="column">
            <div class="col-md-12">
                <h5 class="data">Data publikacji: <?php echo $Model->video_date; ?></h5>
                <p class="tresc"><?php echo $Model->video_text; ?></p>
                
                <?php
                if (!empty($Category[$Model->video_category]))
                    {
                    echo '<p class="kategoria"> Kategoria: '.CHtml::link($Category[$Model->video_category], 
                    array('category/'.$Model->video_category)).'</p>';
                    }
                    echo 'Tagi';
                    foreach ($ModelTags as $Tag) {
                        echo $Tag->tag_name;
                    }
                ?>
                <br />
                    <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                        //var disqus_shortname = 'videocmstestplnew'; // required: replace example with your forum shortname
                           var disqus_shortname = '<?php echo $this->disqus_shortname; ?>'; // Required - Replace example with your forum shortname
                           var disqus_identifier = '<?php echo $Model->video_id; ?>';
                           var disqus_title = '<?php echo $Model->video_title; ?>';
                           //var disqus_url = 'a unique URL for each page where Disqus is present';
                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

            </div>
            <div class="clearfix"></div>
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
                     function loadXMLDoc(dname) 
                    {
                    if (window.XMLHttpRequest)
                      {
                      xhttp=new XMLHttpRequest();
                      }
                    else
                      {
                      xhttp=new ActiveXObject("Microsoft.XMLHTTP");
                      }
                    xhttp.open("GET",dname,false);
                    xhttp.send();
                    return xhttp.responseXML;
                    }
                    
                    xmlDoc=loadXMLDoc('/vastxml/?vid=<?php echo $Model->video_id; ?>.xml');
                    x=xmlDoc.getElementsByTagName("Ad")[0].getAttributeNode("id");
                    IdVast=x.nodeValue;
                    if (IdVast)
                    {
                        vid1.ads();
                        vid1.vast({
                            url: '/vastxml/?vid=<?php echo $Model->video_id; ?>.xml'
                        });
                    }
</script>
<?php
?>
<script>

//xmlDoc=loadXMLDoc("/vastxml/?vid=4649.xml");
//
//
//txt=x.nodeValue;
//document.write(txt);
</script>
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
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/likedislikedis.js"></script>
<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
        $('#like').click(function() {
                $('.like').show();
            setTimeout(function() {
        $('.like').hide();
    }, 2500);
        });
    });
    $(document).ready(function() {
        $('#dis-like').click(function() {
                $('.dis-like').show();
            setTimeout(function() {
        $('.dis-like').hide();
    }, 2500);
        });
    });
 $(document).ready(function() {
        $('#like-dis').click(function() {
                $('.like-dis').show();
            setTimeout(function() {
        $('.like-dis').hide();
    }, 2500);
        });
    });
 $(document).ready(function() {
        $('#dis-like-dis').click(function() {
                $('.dis-like-dis').show();
            setTimeout(function() {
        $('.dis-like-dis').hide();
    }, 2500);
        });
    });
    </script>
    <!--
<div class="afs_ads">&nbsp;</div>
<script>
(function() {
    var message = "Proszę wyłączyć AdBlocka na tej stronie!";

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
<!-- modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Embed</h4>
      </div>
      <div class="modal-body">
                <p class="tresc">Embed: <input type="text" class="form-control" size="45" value="<iframe src='http://videocms-test.pl/embed/<?php echo $Model->video_id; ?>' frameborder='0' allowfullscreen></iframe>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>

<!-- koniec modal -->