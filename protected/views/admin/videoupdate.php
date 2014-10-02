<div class="form">
    <h2>Edycja wpisu</h2>
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-videos-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
      
    <?php echo $form->errorSummary($ModelVideo); ?>
    
    <?php
    if($VideoUpdate)
    {
        echo '<div class="pozytywnie">Wpis został zaktualizowany.</div>';
    }
    ?>
    
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_title');?>
        <?php echo $form->textField($ModelVideo, 'video_title', array('size' => 60, 'maxlength' => 65)); ?>
        <?php echo $form->error($ModelVideo, 'video_title'); ?> 
    </div>
  
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_text');?>
        <?php echo $form->textArea($ModelVideo, 'video_text', array('rows' => 25, 'cols' => 50)); ?>
        <?php echo $form->error($ModelVideo, 'video_text'); ?> 
    </div>
 
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_480p'); ?>
        <?php echo $form->textField($ModelVideo, 'video_480p'); ?>
        <?php echo $form->error($ModelVideo, 'video_480p'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_720p'); ?>
        <?php echo $form->textField($ModelVideo, 'video_720p'); ?>
        <?php echo $form->error($ModelVideo, 'video_720p'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_1080p'); ?>
        <?php echo $form->textField($ModelVideo, 'video_1080p'); ?>
        <?php echo $form->error($ModelVideo, 'video_1080p'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_category');?>
        <?php echo $form->dropDownList($ModelVideo, 'video_category', CHtml::listData($ModelCategories->DownloadCategories(), 'category_id', 'category_name'), 
                array('style'=>'width: 400px;')); ?>
        <?php echo $form->error($ModelVideo, 'video_category'); ?> 
    </div>
    
    <div class="row">
         <?php echo $form->labelEx($ModelVideo, 'video_image'); ?>
            <p id="upload">
                <?php echo $form->textField($ModelVideo, 'video_image',array('readonly'=>true)); ?>
                <input class="btn btn-default btn-sm" name="upload1" type="button" value="zmien" onclick="changeMode()" />
            </p>       
         <?php echo $form->error($ModelVideo, 'video_image'); ?>
    </div>
    
   <div class="row">
        <?php echo $form->textField($ModelVideo, 'video_thumb',array('hidden'=>true)); ?>
        <?php echo $form->error($ModelVideo, 'video_thumb'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'player_type'); ?>
        <?php echo $form->dropDownList($ModelVideo, 'player_type', array('video/mp4' => 'mp4', 'video/webm' => 'webm', 'video/ogg' => 'ogg', 'rtmp/mp4' => 'rtmp'));
        ?>
        <?php echo $form->error($ModelVideo, 'player_type'); ?>
    </div>
    
    <div class="row">
    <?php echo $form->dropDownList($ModelVideo, 'video_published',
        array(
        '1' => 'Opublikowano',
        '0' => 'Nie opublikowano',
        )); ?>
    </div>
     <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_description'); ?>
        <?php echo $form->textField($ModelVideo, 'video_description'); ?>
        <?php echo $form->error($ModelVideo, 'video_description'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_keywords'); ?>
        <?php echo $form->textField($ModelVideo, 'video_keywords'); ?>
        <?php echo $form->error($ModelVideo, 'video_keywords'); ?>
    </div>
    <div class="row">
        <?php
         $tagi = $ModelTags->DownloadTag($ModelVideo->video_id);
        foreach($tagi as $data) { ?>
        <div class="checkbox_wrapper" id="<?php echo $data['tag_name'];?>" style="display:block">
            <input type="checkbox" name="c" class="checkbox" onclick="showMe('<?php echo $data['tag_name'];?>'), deleteTag(), tagname()"/> 
            <label><?php echo $data['tag_name'];?></label></div>
        <?php } ?>
    </div>    
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'tag_name'); ?>
        <?php echo $form->textField($ModelVideo, 'tag_name') ?>
        <?php echo $form->error($ModelVideo, 'tag_name'); ?>
    </div>
    <div class="row">       
        <?php echo $form->hiddenField($ModelVideo, 'tag_delete', array('type'=>"hidden")); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Aktualizuj', array('class' => 'btn btn-success')); ?>
        <?php echo CHtml::link('Anuluj',array('admin/videos'),array('class'=>'btn btn-danger')); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>
   <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
     $.noConflict();
function changeMode() {
    var mode;
    mode='<?php echo $form->fileField($ModelVideo, 'video_image'); ?>';
	document.getElementById('upload').innerHTML = mode;
}
 </script>
<script type="text/javascript">
function deleteTag(check) {
    var checked = [];
    $('input:checkbox:checked').each(function() {
        checked.push( $(this).next('label').text() );
    });
        $('#CmsvideoVideo_tag_delete').val(checked.join(","));
}
function tagname(check) {
    var checked = [];
    $('input:checkbox:not(:checked)').each(function() {
        checked.push( $(this).next('label').text() );
    });
	
        $('#CmsvideoVideo_tag_name').val(checked.join(","));

}
function showMe (box) {

    var chboxs = document.getElementsByName("c");
    var vis = "block";
    for(var i=0;i<chboxs.length;i++) { 
        if(chboxs[i].checked){
         vis = "none";
            break;
        }
    }
    document.getElementById(box).style.display = vis;

}
 </script>