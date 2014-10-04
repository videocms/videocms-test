<?php
foreach ($DataVideo as $ModelSite)
{

?>
<style type="text/css">
	.video-js {padding-top: 56.25%}
.vjs-fullscreen {padding-top: 0px}
</style>
    <script>
   $.noConflict();
   // Code that uses other library's $ can follow here.
   </script>
   <div class="container">
   <video id="example-2" class="video-js vjs-default-skin vjs-playing vjs-fullscreen" preload="auto" controls width="auto" height="auto" poster="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $ModelSite['video_image']; ?>" data-setup='{ "plugins" : { "resolutionSelector" : { "default_res" : "480" } } }'>		
        <?php             if (($ModelSite['video_720p'] == NULL) && ($ModelSite['video_1080p'] == NULL))
                     {
                          echo'<source src="'.$ModelSite['video_480p'].'" type="'.$ModelSite['player_type'].'" data-res="480" />';
                     }
                          elseif (($ModelSite['video_480p'] == NULL) && ($ModelSite['video_1080p'] == NULL)) {
                                  echo'<source src="'.$ModelSite['video_720p'].'" type="'.$ModelSite['player_type'].'" data-res="720" />';
                     }
                          elseif (($ModelSite['video_480p'] == NULL) && ($ModelSite['video_720p'] == NULL)){
                                  echo'<source src="'.$ModelSite['video_1080p'].'" type="'.$ModelSite['player_type'].'" data-res="1080" />';
                     }
                          elseif ($ModelSite['video_480p'] == NULL) {
                                  echo'<source src="'.$ModelSite['video_720p'].'" type="'.$ModelSite['player_type'].'" data-res="720" />';
                                  echo'<source src="'.$ModelSite['video_1080p'].'" type="'.$ModelSite['player_type'].'" data-res="1080" />';
                     }
                          elseif ($ModelSite['video_720p'] == NULL) {
                                  echo'<source src="'.$ModelSite['video_480p'].'" type="'.$ModelSite['player_type'].'" data-res="480" />';
                                  echo'<source src="'.$ModelSite['video_1080p'].'" type="'.$ModelSite['player_type'].'" data-res="1080" />';
                     }
                          elseif ($ModelSite['video_1080p'] == NULL) {
                                  echo'<source src="'.$ModelSite['video_480p'].'" type="'.$ModelSite['player_type'].'" data-res="480" />';
                                  echo'<source src="'.$ModelSite['video_720p'].'" type="'.$ModelSite['player_type'].'" data-res="720" />'; 
                     }
                     else {
                          echo'<source src="'.$ModelSite['video_480p'].'" type="'.$ModelSite['player_type'].'" data-res="480" />';
                          echo'<source src="'.$ModelSite['video_720p'].'" type="'.$ModelSite['player_type'].'" data-res="720" />';
                          echo'<source src="'.$ModelSite['video_1080p'].'" type="'.$ModelSite['player_type'].'" data-res="1080" />';
                    }
    ?>
        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
    </video>

   </div>
<!--<div class="afs_ads">&nbsp;</div>
<script>
(function() {
    var message = "Bejtam wypierdol tego adblocka!";

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
            url: '/cmsvideo/vastxml/?vid=<?php echo $ModelSite['video_id']; ?>.xml'
            
    
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