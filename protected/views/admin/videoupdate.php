<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edytuj wideo</h1>
    </div>
</div>
<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-videos-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <div class="row">
        <?php echo $form->errorSummary($ModelVideo); ?>
    
        <?php
        if($VideoUpdate)
        {
            echo '<div class="alert alert-success" role="alert">Wideo zostało zaktualizowane!</div>';
        }
        ?>
        <div class="col-lg-12">
             <div class="panel panel-default">
                 <div class="panel-heading"><?php echo '<b>'.$ModelVideo->video_title.'</b>'; ?></div>
                 <div class="panel-body">
                       <div class="col-lg-6">
           <div class="form-group">
            <?php echo $form->labelEx($ModelVideo, 'video_title'); ?>
            <?php echo $form->textField($ModelVideo, 'video_title', array('size' => 60, 'maxlength' => 65, 'class' => 'form-control', 'placeholder' => 'Tytuł')); ?>
            <?php echo $form->error($ModelVideo, 'video_title'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_text'); ?>
                <?php echo $form->textArea($ModelVideo, 'video_text'); ?>
                <?php echo $form->error($ModelVideo, 'video_text'); ?>
            </div>
            </div>
      <div class="col-lg-6">
          <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_alias'); ?>
                <?php echo $form->textField($ModelVideo, 'video_alias', array('class' => 'form-control', 'placeholder' => 'Alias', 'readonly' => true)); ?>
                <?php echo $form->error($ModelVideo, 'video_alias'); ?>
          </div>
           <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_480p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_480p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 480p')); ?>
                <?php echo $form->error($ModelVideo, 'video_480p'); ?>  
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_720p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_720p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 720p')); ?>
                <?php echo $form->error($ModelVideo, 'video_720p'); ?>  
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_1080p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_1080p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 1080p')); ?>
                <?php echo $form->error($ModelVideo, 'video_1080p'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_category'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'video_category', CHtml::listData(CmsvideoCategories::model()->findAll(), 'category_id', 'category_name'), array('class' => 'form-control')); ?>
                <?php echo $form->error($ModelVideo, 'video_category'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'player_type'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'player_type', array('video/mp4' => 'mp4', 'video/webm' => 'webm', 'video/ogg' => 'ogg', 'rtmp/mp4' => 'rtmp'),array('class' => 'form-control'));?>
                <?php echo $form->error($ModelVideo, 'player_type'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_image'); ?>
                <p id="upload">
                <div class="col-xs-10">
                <?php echo $form->textField($ModelVideo, 'video_image',array('readonly'=>true, 'class' => 'col-md-4 form-control')); ?>
                </div>
                <input class="btn btn-default btn-sm" name="upload1" type="button" value="zmien" onclick="changeMode()" /></p>       
                 <?php echo $form->error($ModelVideo, 'video_image'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->textField($ModelVideo, 'video_thumb',array('hidden'=>true)); ?>
                <?php echo $form->error($ModelVideo, 'video_thumb'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_description'); ?>
                <?php echo $form->textField($ModelVideo, 'video_description', array('class' => 'form-control', 'placeholder' => 'Opis wideo')); ?>
                <?php echo $form->error($ModelVideo, 'video_description'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_keywords'); ?>
                <?php echo $form->textField($ModelVideo, 'video_keywords', array('class' => 'form-control', 'placeholder' => 'Słowa kluczowe')); ?>
                <?php echo $form->error($ModelVideo, 'video_keywords'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'tag_name'); ?>
                <?php echo $form->textField($ModelVideo, 'tag_name', array('class' => 'form-control', 'placeholder' => 'Tagi')); ?>
                <?php echo $form->error($ModelVideo, 'tag_name'); ?>
            </div>
            <div class="form-group">
                <?php
                 $tagi = $ModelTags->DownloadTag($ModelVideo->video_id);
                foreach($tagi as $data) { ?>
                <div class="checkbox_wrapper" id="<?php echo $data['tag_name'];?>" style="display:block">
                    <input type="checkbox" name="c" class="checkbox" onclick="showMe('<?php echo $data['tag_name'];?>'), deleteTag(), tagname()"/> 
                    <label class="form-control"><?php echo $data['tag_name'];?></label></div>
                <?php } ?>
            </div>    
            <div class="form-group">      
                <?php echo $form->hiddenField($ModelVideo, 'tag_delete', array('type'=>"hidden")); ?>
            </div>
            <div class="form-group">
                <?php echo $form->dropDownList($ModelVideo, 'video_published',array('1' => 'Opublikowano', '0' => 'Nie opublikowano'),array('options' => array('1' => array('selected' => 'selected')), 'class' => 'form-control')); ?>            </div>
            <div class="form-group">
                <?php echo CHtml::submitButton('Aktualizuj', array('class' => 'btn btn-success')); ?>
                <?php echo CHtml::link('Anuluj',array('admin/videos'),array('class'=>'btn btn-danger')); ?>
            </div>
    </div>
    </div>
    </div>
    </div>
    </div>
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