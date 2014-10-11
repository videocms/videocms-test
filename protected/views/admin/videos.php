<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Biblioteka wideo</h1>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Zarządzanie</div>
<div class="panel-body">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-videos-grid',
'htmlOptions'=>array('class'=>'table-responsive'),
'summaryCssClass' => 'dataTables_info',

'dataProvider'=>$Data,
'pager'=>array( 
    'cssFile'=>false,   
    'header'=>'',           
    'maxButtonCount'=>'7',
    'selectedPageCssClass'=>'active',
    'htmlOptions'=>array(
            'class'=>'pagination'
        ),
    ),
   // 'template' => '<div class="alert alert-info fade in" role="alert">{summary}</div>{items}<div class="row"><div class="col-md-4"></div><div class="col-md-8">{pager}<br /></div></div>',
    'template'=>'{items}<div class="col-sm-4">{summary}</div><div class="col-sm-8">{pager}</div>',
    'pagerCssClass'=>'dataTables_paginate paging_simple_numbers',
    'itemsCssClass'=>'table table-striped table-hover dataTable no-footer',
    'columns'=>
     array(
       // 'class'=>'CCheckBoxColumn',
        //'selectableRows' => '10',
        array(
                'header' => '#',
                'value' => '$data->video_id',
                'name' => 'video_id',
        ),
        array(
                'type' => 'raw',
                'class'=>'ImageLinkColumn',
                'urlExpression'=>'array("admin/videoupdate/".$data->video_id)',
                'value' => 'CHtml::image("/" . $data->video_thumb, $data->video_title, array("style"=>"width: 80px; height: 50px;", "class"=>"table-bordered"))',
              ),
        array(
                'type'=>'raw',
                'header'=>'Nazwa',
                'value'=> '"<b>".CHtml::link($data->video_title, array("admin/videoupdate/$data->video_id"))."</b><br /><small>Kategoria: ".$data->category->name."</small>"',
                'name'=>'video_category',
            ),
        array(  
                'header'=>'Typ',
                'value'=>'$data->player_type',
                'name'=>'player_type',
            ),
        'video_date',
        array(  
                'header'=>'Stan',
                'value'=>'$data->video_published',
                'name'=>'video_published',
            ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete} {update}',
            'buttons'=>array
            (
                'delete' => array
                (
                    'label'=>'',
                    //'options'=>array('class' => 'btn btn-danger', 'type' => 'button'),
                    'options'=>array('class' => 'fa fa-times fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Usuń'),
                    'imageUrl'=>'',
                    'url' => 'Yii::app()->createUrl("admin/videodelete/".$data->video_id)',
                ),
                'update' => array
                (
                    'label'=>'',
                    'options'=>array('class' => 'fa fa-pencil fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Edytuj'),
                    'imageUrl'=>'',
                    'url'=> 'Yii::app()->createUrl("admin/videoupdate/".$data->video_id)',
                ),
            ),
        ),
),
));
?>
</div>
</div>
</div>
</div>
<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-video-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
  
    
    <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Dodaj nowe wideo</div>
            <div class="panel-body">
            <div class="row">
            <div class="col-lg-12">
                            <?php 
                                if($VideoAdd)
                                {
                                    echo '<div class="alert alert-success" role="alert"><p class="note">';
                                    echo 'Nowe wideo zostało dodane!';
                                    echo '</p></div>';
                                }
                                else {
                                    echo '<div class="alert alert-warning" role="alert"><p class="note">';
                                    echo 'Pola oznaczone <span class="required">*</span> są wymagane.';
                                    echo '</p></div>';
                                }
                                if($form->errorSummary($ModelVideo)) {
                                    echo '<div class="alert alert-danger" role="alert"><p class="note">';
                                    echo $form->errorSummary($ModelVideo);
                                    echo '</p></div>';
                                    $fieldStat = 'has-error';
                                    $iconStat = 'glyphicon-remove';
                                }
                            ?>
            </div>
            <div class="col-lg-6">
            <div class="form-group <?php echo $fieldStat; ?> has-feedback">
                <?php echo $form->labelEx($ModelVideo, 'video_title'); ?>
                <?php echo $form->textField($ModelVideo, 'video_title', array('size' => 60, 'maxlength' => 65, 'class' => 'form-control', 'placeholder' => 'Tytuł')); ?>
                <span class="glyphicon <?php echo $iconStat; ?> form-control-feedback"></span>
            </div>
            <div class="form-group <?php echo $fieldStat; ?> has-feedback">
                <?php echo $form->labelEx($ModelVideo, 'video_text'); ?>
                <?php echo $form->textArea($ModelVideo, 'video_text'); ?>
                <?php echo $form->error($ModelVideo, 'video_text', array('class' => 'text-danger')); ?> 
                <span class="glyphicon <?php echo $iconStat; ?> form-control-feedback"></span>
            </div>
             <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_description'); ?>
                <?php echo $form->textField($ModelVideo, 'video_description', array('size' => '60', 'maxlength' => '160', 'class' => 'form-control', 'placeholder' => 'Opis wideo')); ?>
                <?php echo $form->error($ModelVideo, 'video_description'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_published'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'video_published',array('1' => 'Opublikowano', '0' => 'Nie opublikowano'),array('options' => array('1' => array('selected' => 'selected')), 'class' => 'form-control')); ?> 
            </div>
            <div class="form-group">
                <?php echo CHtml::submitButton('Dodaj', array('class' => 'btn btn-primary')); ?>
            </div>
            </div>
           <div class="col-lg-6">
             <div class="form-group <?php echo $fieldStat; ?> has-feedback">
                <?php echo $form->labelEx($ModelVideo, 'video_alias'); ?>
                <?php echo $form->textField($ModelVideo, 'video_alias', array('class' => 'form-control', 'placeholder' => 'Alias', 'readonly' => true)); ?>
                <?php echo $form->error($ModelVideo, 'video_alias'); ?>
                <span class="glyphicon <?php echo $iconStat; ?> form-control-feedback"></span>
               </div>
             <div class="form-group <?php echo $fieldStat; ?> has-feedback">
                <?php echo $form->labelEx($ModelVideo, 'video_480p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_480p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 480p')); ?> 
                <?php echo $form->error($ModelVideo, 'video_480p', array('class' => 'text-danger')); ?> 
                <span class="glyphicon <?php echo $iconStat; ?> form-control-feedback"></span>
             </div>
            <div class="form-group <?php echo $fieldStat; ?> has-feedback">
                <?php echo $form->labelEx($ModelVideo, 'video_720p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_720p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 720p')); ?>
                <?php echo $form->error($ModelVideo, 'video_720p', array('class' => 'text-danger')); ?>
                <span class="glyphicon <?php echo $iconStat; ?> form-control-feedback"></span>
            </div>
            <div class="form-group <?php echo $fieldStat; ?> has-feedback">
                <?php echo $form->labelEx($ModelVideo, 'video_1080p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_1080p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 1080p')); ?>
                <?php echo $form->error($ModelVideo, 'video_1080p', array('class' => 'text-danger')); ?> 
                <span class="glyphicon <?php echo $iconStat; ?> form-control-feedback"></span>
            </div>
            <div class="form-group <?php echo $fieldStat; ?> has-feedback">
                <?php   $parents = CmsvideoCategories::model()->findAll('parent_id = 1');
                        $cm = new CommonMethods();
                        $data = $cm->makeDropDown($parents);
                ?>
                <?php echo $form->labelEx($ModelVideo, 'video_category'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'video_category',$data, array('class' => 'form-control')); ?>
                <?php echo $form->error($ModelVideo, 'video_category'); ?>
            </div> 
            <div class="form-group <?php echo $fieldStat; ?> has-feedback">
                <?php echo $form->labelEx($ModelVideo, 'player_type'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'player_type', array('video/mp4' => 'mp4', 'video/webm' => 'webm', 'video/ogg' => 'ogg', 'rtmp/mp4' => 'rtmp'),array('class' => 'form-control'));?>
                <?php echo $form->error($ModelVideo, 'player_type'); ?>
            </div>
            <div class="form-group <?php echo $fieldStat; ?> has-feedback">
                <?php if ($ImageAdd) {echo '<div>Plik został wgrany na serwer</div>';} ?>
                <?php echo $form->labelEx($ModelVideo, 'video_image'); ?>
                <?php echo $form->fileField($ModelVideo, 'video_image'); ?>
                <?php echo $form->error($ModelVideo, 'video_image', array('class' => 'text-danger')); ?>
                <span class="glyphicon <?php echo $iconStat; ?> form-control-feedback"></span>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_keywords'); ?>
                <?php echo $form->textField($ModelVideo, 'video_keywords', array('class' => 'form-control', 'placeholder' => 'Słowa kluczowe')); ?>
                <?php echo $form->error($ModelVideo, 'video_keywords'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'tag_name'); ?>
                <?php echo $form->textField($ModelVideo, 'tag_name', array('class' => 'form-control', 'placeholder' => 'Tagi')); ?>
                <?php echo $form->error($ModelVideo, 'tag_name', array('class' => 'text-danger')); ?>
             </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
 var title = $('#CmsvideoVideo_video_title'),
    slug = $('#CmsvideoVideo_video_alias');

title.on('keyup', function() {
  var val = $(this).val();
  val = val.toLowerCase()
    .replace(/ /g, '-');
  slug.val(val);
});
</script>
<script type="text/javascript">
 var tags = $('#CmsvideoVideo_tag_name'),
    keywords = $('#CmsvideoVideo_video_keywords');

tags.on('keyup', function() {
  var val = $(this).val();
  keywords.val(val);
});
</script>