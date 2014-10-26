<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Slider</h1>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Zarządzanie</div>
<div class="panel-body">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-slider-grid',
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
    'template'=>'{items}<div class="col-sm-4">{summary}</div><div class="col-sm-8">{pager}</div>',
    'pagerCssClass'=>'dataTables_paginate paging_simple_numbers',
    'itemsCssClass'=>'table table-striped table-hover dataTable no-footer',
    'columns'=>
     array(
       // 'class'=>'CCheckBoxColumn',
        //'selectableRows' => '10',
        array(
                'header' => '#',
                'value' => '$data->slider_id',
                'name' => 'slider_id',
        ),
        array(
                'type' => 'raw',
                'header'=>'Slide',
                'name'=>'slider_id',
                'class'=>'ImageLinkColumn',
                'urlExpression'=>'array("admin/sliderupdate/".$data->slider_id)',
                'value' => 'CHtml::image("/" . $data->slider_thumb, $data->slider_title, array("style"=>"width: 80px; height: 50px;", "class"=>"table-bordered"))',
              ),
        array(
                'type'=>'raw',
                'header' => 'Video',
                'value' => '"<b>".CHtml::link($data->video->video_title, array("video/$data->slider_idvideo"))."</b>"',
                'name' => 'slider_idvideo',
        ),
        array(  
                'header'=>'Stan',
                'value'=>'$data->slider_published',
                'name'=>'slider_published',
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
                    'url' => 'Yii::app()->createUrl("admin/sliderdelete/".$data->slider_id)',
                ),
                'update' => array
                (
                    'label'=>'',
                    'options'=>array('class' => 'fa fa-pencil fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Edytuj'),
                    'imageUrl'=>'',
                    'url'=> 'Yii::app()->createUrl("admin/sliderupdate/".$data->slider_id)',
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
        'id'=>'videocms-slider-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
  
    
    <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Dodaj nowy slide</div>
            <div class="panel-body">
            <div class="row">
            <div class="col-lg-12">
                            <?php 
                                if($SliderAdd)
                                {
                                    echo '<div class="alert alert-success" role="alert"><p class="note">';
                                    echo 'Nowy slide został dodany!';
                                    echo '</p></div>';
                                }
                                else {
                                    echo '<div class="alert alert-warning" role="alert"><p class="note">';
                                    echo 'Pola oznaczone <span class="required">*</span> są wymagane.';
                                    echo '</p></div>';
                                }
                                if($form->errorSummary($ModelSlider)) {
                                    echo '<div class="alert alert-danger" role="alert"><p class="note">';
                                    echo $form->errorSummary($ModelSlider);
                                    echo '</p></div>';
                                    $fieldStat = 'has-error';
                                    $iconStat = 'glyphicon-remove';
                                }
                            ?>
            </div>
       <div class="col-lg-6">
            <div class="form-group">
                <?php echo $form->labelEx($ModelSlider, 'slider_image'); ?>
                <?php echo $form->textField($ModelSlider, 'slider_image', array('class' => 'form-control')); ?>
                <?php echo $form->error($ModelSlider, 'slider_image'); ?> 
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelSlider, 'slider_published'); ?>
                <?php echo $form->dropDownList($ModelSlider, 'slider_published',array('1' => 'Opublikowano', '0' => 'Nie opublikowano'),array('options' => array('1' => array('selected' => 'selected')), 'class' => 'form-control')); ?> 
            </div>
        </div>
        
        <div class="col-lg-6">         
            <div class="form-group">
                <?php echo $form->labelEx($ModelSlider, 'slider_title'); ?>
                <?php echo $form->textField($ModelSlider, 'slider_title', array('rows'=>'5', 'class' => 'form-control')); ?>
                <?php echo $form->error($ModelSlider, 'slider_title'); ?> 
            </div>
            <div class="form-group">
                <?php echo CHtml::submitButton('Dodaj', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
                
        </div>
        </div>
        </div>
        </div>
    </div>

<?php $this->endWidget(); ?>
</div>