<?php
foreach ($DataCategory as $ModelCategoryShow)
{
    $Category[$ModelCategoryShow['category_id']] = $ModelCategoryShow['category_name'];
}

foreach ($DataVideo as $ModelSite)
{
    echo '<h1>'.$ModelSite['video_title'].'</h1>';
    echo '<h1>'.$ModelSite['video_views'].'</h1>';
    echo '<p class="data">Data publikacji: '.$ModelSite['video_date'].'</p>';
    echo '<p class="tresc">'.$ModelSite['video_text'].'</p>';
    if ($Category[$ModelSite['video_category']] != '')
    {
        echo '<p class="kategoria"> Kategoria: '.CHtml::link($Category[$ModelSite['video_category']], 
                array('cmsvideo/category/'.$ModelSite['video_category'])).'</p>';
    }
?>
    <script>
   $.noConflict();
   // Code that uses other library's $ can follow here.
   </script>
  
   <video id="example-2" class="video-js vjs-default-skin" preload="auto" controls width="640" height="360" poster="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $ModelSite['video_image']; ?>" data-setup='{ "plugins" : { "resolutionSelector" : { "default_res" : "480" } } }'>		
        <?php             if (($ModelSite['video_720p'] == NULL) && ($ModelSite['video_1080p'] == NULL))
                     {
                          echo'<source src="'.$ModelSite['video_480p'].'" type="video/mp4" data-res="480" />';
                     }
                          elseif (($ModelSite['video_480p'] == NULL) && ($ModelSite['video_1080p'] == NULL)) {
                                  echo'<source src="'.$ModelSite['video_720p'].'" type="video/mp4" data-res="720" />';
                     }
                          elseif (($ModelSite['video_480p'] == NULL) && ($ModelSite['video_720p'] == NULL)){
                                  echo'<source src="'.$ModelSite['video_1080p'].'" type="video/mp4" data-res="1080" />';
                     }
                          elseif ($ModelSite['video_480p'] == NULL) {
                                  echo'<source src="'.$ModelSite['video_720p'].'" type="video/mp4" data-res="720" />';
                                  echo'<source src="'.$ModelSite['video_1080p'].'" type="video/mp4" data-res="1080" />';
                     }
                          elseif ($ModelSite['video_720p'] == NULL) {
                                  echo'<source src="'.$ModelSite['video_480p'].'" type="video/mp4" data-res="480" />';
                                  echo'<source src="'.$ModelSite['video_1080p'].'" type="video/mp4" data-res="1080" />';
                     }
                          elseif ($ModelSite['video_1080p'] == NULL) {
                                  echo'<source src="'.$ModelSite['video_480p'].'" type="video/mp4" data-res="480" />';
                                  echo'<source src="'.$ModelSite['video_720p'].'" type="video/mp4" data-res="720" />'; 
                     }
                     else {
                          echo'<source src="'.$ModelSite['video_480p'].'" type="video/mp4" data-res="480" />';
                          echo'<source src="'.$ModelSite['video_720p'].'" type="video/mp4" data-res="720" />';
                          echo'<source src="'.$ModelSite['video_1080p'].'" type="video/mp4" data-res="1080" />';
                    }
    ?>
        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
    </video>


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
            //url: '/cmsvideo/vastxml/?id=<?php echo $ModelSite['category_vast']; ?>.xml'
            <?php  //do sprawdzenia pozostawione do testu
            if (count($ModelSite['category_vast']) === 1) {
                          echo 'url: "/cmsvideo/vastxml/?id='.$ModelSite['category_vast'].'.xml"';
            }
            else{ // do testu, ciekawe co wyswietli
                echo $ModelSite['category_vast'][array_rand($ModelSite['category_vast'])];
            }
                ?>
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