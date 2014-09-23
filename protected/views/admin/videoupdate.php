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
    <?php echo $form->dropDownList($ModelVideo, 'video_published',
        array(
        '1' => 'Opublikowano',
        '0' => 'Nie opublikowano',
        )); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Aktualizuj', array('class' => 'btn btn-primary')); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
function changeMode() {
    var mode;
    mode='<?php echo $form->fileField($ModelVideo, 'video_image'); ?>';
	document.getElementById('upload').innerHTML = mode;
}
</script>
