<div class="row">
    <div class="col-md-4">
        <a href="/video/<?php echo $data->video_id ?>-<?php echo $data->video_alias ?>"><img src="<?php echo $data->video_thumb ?>" class="img-responsive" style="width: 100%;"></a>
    </div>
    <div class="col-md-8">
        <h3><a href="/video/<?php echo $data->video_id ?>-<?php echo $data->video_alias ?>"><?php echo $data->video_title ?></a><br/></h3>
        <h5><?php echo 'Wyświetleń: '.$data->video_views ?></h5>
        <?php echo $data->video_text ?>
    </div>
</div><hr>