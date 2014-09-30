<?php
echo '<table class="table table-hover" id="lol">';
echo '<tr class="active">';
echo '<th>Tagi</th>';
echo '<tr>'; 

foreach($DataTag as $ModelTagsShow)
{
    if($Class == 0)
    {
        $Class = 1;
        $RowClass = 'row1';
    }
    else 
    {
        $Class = 0;
        $RowClass = 'row2';
    }
    echo '<tr>';
   ?> <td class="<?php echo $RowClass;?>"><div class="checkbox_wrapper" id="<?php echo $ModelTagsShow['tag_name'];?>" style="display:block"><input type="checkbox" name="c" class="checkbox" onclick="showMe('<?php echo $ModelTagsShow['tag_name'];?>'), submit()"/> <label><?php echo $ModelTagsShow['tag_name'];?></label></div></td> <?php
    echo '<tr>';
}

echo '</table>';
echo '<br /><br />';
?>


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
                <input name="upload1" type="button" value="zmien" onclick="changeMode()" />
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
        <?php echo $form->labelEx($ModelVideo, 'tag_name'); ?>
        <?php echo $form->textField($ModelVideo, 'tag_name'); ?>
        <?php echo $form->error($ModelVideo, 'tag_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'tag_delete'); ?>
        <?php echo $form->textField($ModelVideo, 'tag_delete'); ?>
        <?php echo $form->error($ModelVideo, 'tag_delete'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Aktualizuj', array('class' => 'btn btn-primary')); ?>
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
function submit(check) {
    var checked = [];
    $('input:checkbox:checked').each(function() {
        checked.push( $(this).next('label').text() );
    });
        $('#CmsvideoVideo_tag_delete').val(checked.join(","));
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