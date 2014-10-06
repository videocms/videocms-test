<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Zarządzanie reklamami</h1>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-category-grid',
'htmlOptions'=>array('class'=>'table-responsive'),
'summaryCssClass' => 'dataTables_info',
'template' => '<div class="alert alert-info fade in" role="alert">{summary}</div>{items}<div class="row"><div class="col-md-4"></div><div class="col-md-8">{pager}<br /></div></div>',
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
'pagerCssClass'=>'pagination',
'itemsCssClass'=>'table table-hover',   
'columns'=>array(
        'vast_id',
        'vast_title',
        'vast_video_cat',
        'vast_source',
        'vast_link',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete} {update}',
            'buttons'=>array
            (
                'delete' => array
                (
                    'label'=>'',
                    'options'=>array('class' => 'fa fa-times fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Usuń'),
                    'imageUrl'=>'',
                    'url' => 'Yii::app()->createUrl("admin/vastdelete/".$data->vast_id)',
                ),
                'update' => array
                (
                    'label'=>'',
                    'options'=>array('class' => 'fa fa-pencil fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Edytuj'),
                    'imageUrl'=>'',
                    'url'=> 'Yii::app()->createUrl("admin/vastupdate/".$data->vast_id)',
                ),
            ),
        ),
    ),
));
?>

<div class="form">
    <h2 class="admin">Dodaj nową reklame</h2>
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-vast-form',
        'enableAjaxValidation'=>false,
    ));
    ?>
    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
    <?php 
    echo $form->errorSummary($ModelVast); 
    if($AddVast)
    {
        echo '<div>Nowa reklama została dodana.</div>';
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
            <div class="panel-heading">Dodaj reklamę</div>
                <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-12">
                         <div class="alert alert-warning" role="alert">
                               <p class="note">Pola oznacone <span class="required">*</span> są wymagane.</p>
                        </div>
                        </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast,'vast_title'); ?>
                            <?php echo $form->textField($ModelVast,'vast_title', array('size' => 60, 'maxlength' => 65, 'class' => 'form-control', 'placeholder' => 'Nazwa reklamy')); ?>
                            <?php echo $form->error($ModelVast,'vast_title'); ?>
                             </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast,'vast_source'); ?>
                            <?php echo $form->textField($ModelVast,'vast_source', array('class' => 'form-control', 'placeholder' => 'Adres URL reklamy'));?>
                            <?php echo $form->error($ModelVast,'vast_source'); ?>
                            </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast,'vast_link'); ?>
                            <?php echo $form->textField($ModelVast,'vast_link', array('class' => 'form-control', 'placeholder' => 'Odlinkowanie reklamy')); ?>
                            <?php echo $form->error($ModelVast,'vast_link'); ?>
                            </div>
                        <div class="form-group">
                            <?php echo CHtml::submitButton('Dodaj',array('class' => 'btn btn-primary')); ?>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast, 'video_category'); ?>
                                <?php
                                    $htmlOptions = array( 
                                       'multiple' => 'true',
                                       'class'    => 'form-control',
                                       'size'     => 10,
                                        );
                                    echo $form->listBox($ModelVast,'video_category', CHtml::listData(CmsvideoCategories::model()->findAll(), 'category_id', 'category_name'), $htmlOptions);?>
                            <?php echo $form->error($ModelVast, 'video_category'); ?>
                        </div>
                    </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div>