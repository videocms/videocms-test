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
</style>

<?php
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
 <div class="video-overlay"></div>   
<div class="row">
    <div id="test" class="col-md-8 col-normal">
     <!-- VIDEO! --> 
        <div class="wrapper">
            <div class="videocontent">
                <div id="myvideo_vjs1" class="video-js">
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
        <button id="button-watch-medium" type="button" class="btn btn-default" style="margin-top: 10px;">Rozmiar</button>
    <!-- VIDEO -->
    </div>
    
    <div class="col-md-4">
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
    </div>
    
    <div class="col-md-8 col-normal2">
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
<script type="text/javascript">
$(function() {
 $( "#button-watch-medium" ).click(function(){
      $( ".col-md-8.col-normal" ).switchClass( "col-md-8 col-normal", "col-centered player-width", 3 );
      $( ".col-centered" ).switchClass( "col-centered player-width", "col-md-8 col-normal", 3 );
      
      $( ".video-overlay" ).switchClass( "video-overlay", "video-overlay-enabled", 3 );
      $( ".video-overlay-enabled" ).switchClass( "video-overlay-enabled", "video-overlay", 3 );
      
     $(".video-js").toggleClass("watch-medium", 3);
     $(".col-md-4").toggleClass("float-right", 3);
    });
  });
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