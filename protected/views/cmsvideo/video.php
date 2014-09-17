<?php

foreach ($DataCategory as $ModelCategoryShow)
{
    $Category[$ModelCategoryShow['category_id']] = $ModelCategoryShow['category_name'];
}

foreach ($DataVideo as $ModelSite)
{
    echo '<h1>'.$ModelSite['video_title'].'</h1>';
    echo '<p class="data">Data publikacji: '.$ModelSite['video_date'].'</p>';
    echo '<p class="tresc">'.$ModelSite['video_text'].'</p>';
    if ($Category[$ModelSite['video_category']] != '')
    {
        echo '<p class="kategoria"> Kategoria: '.CHtml::link($Category[$ModelSite['video_category']], array('cmsvideo/category/'.$ModelSite['video_category'])).'</p>';
    }
    
    ?>
 <script>
$.noConflict();
// Code that uses other library's $ can follow here.
</script>
   
   <video id="example-2" class="video-js vjs-default-skin" controls width="640" height="360" poster="http://video-js.zencoder.com/oceans-clip.png" data-setup='{ "plugins" : { "resolutionSelector" : { "default_res" : "480" } } }'>
		<source src="<?php echo ''.$ModelSite['video_480p'].'';?>" type="video/mp4" data-res="480" />
		<source src="<?php echo ''.$ModelSite['video_720p'].'';?>" type="video/mp4" data-res="720" />
		<source src="<?php echo ''.$ModelSite['video_1080p'].'';?>" type="video/mp4" data-res="1080" />
<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
	</video>

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
      url: 'http://ad3.liverail.com/?LR_PUBLISHER_ID=1331&LR_CAMPAIGN_ID=229&LR_SCHEMA=vast2'
    });
	</script>
   <script type="text/javascript">
		//var vid1 = videojs('example-2');

    //vid1.ads();
    //vid1.vast({
    //  url: 'http://ad3.liverail.com/?LR_PUBLISHER_ID=1331&LR_CAMPAIGN_ID=229&LR_SCHEMA=vast2'
   // });
 
	</script>



<?php
}

?>
