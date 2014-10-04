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
    ?>
        <p class="tresc">Embed: <input type="text" value="<iframe width='560' height='315' src='http://videocms-test.pl/embed/<?php echo $ModelSite['video_id'];?>.html' frameborder='0' allowfullscreen></iframe>"></p><?php
    //echo '<p class="tresc">Embed: <input type="text" value"<iframe width="560" height="315" src="http://videocms-test.pl/cmsvideo/embed/'.$ModelSite['video_id'].'.html" frameborder="0" allowfullscreen></iframe>"></p>';
    if ($Category[$ModelSite['video_category']] != '')
    {
        echo '<p class="kategoria"> Kategoria: '.CHtml::link($Category[$ModelSite['video_category']], 
                array('category/'.$ModelSite['video_category'])).'</p>';
    }
    foreach (unserialize($ModelSite['video_tags']) as $Tag) {
        echo $Tag.' ';
    }
?>
    <script>
   $.noConflict();
   // Code that uses other library's $ can follow here.
   </script>
  
   <video id="example-2" class="video-js vjs-default-skin" preload="auto" controls width="640" height="360" poster="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $ModelSite['video_image']; ?>" data-setup='{ "plugins" : { "resolutionSelector" : { "default_res" : "480" } } }'>		
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
            url: '/vastxml/?vid=<?php echo $ModelSite['video_id']; ?>.xml'
            
    
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