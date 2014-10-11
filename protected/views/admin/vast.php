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
        'vast_start',
        'vast_end',
        array(
        'header'=>'Wyświetlenia',
        'value'=> '$data->vast_views',
        'name'=>'vast_views'
        ),
        'vast_published',
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
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-vast-form',
        'enableAjaxValidation'=>false,
    ));
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
            <div class="panel-heading">Dodaj nową reklamę</div>
                <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-12">
                         <?php 
                                if($AddVast)
                                {
                                    echo '<div class="alert alert-success" role="alert"><p class="note">';
                                    echo 'Nowa reklama została dodana!';
                                    echo '</p></div>';
                                }
                                else {
                                    echo '<div class="alert alert-warning" role="alert"><p class="note">';
                                    echo 'Pola oznaczone <span class="required">*</span> są wymagane.';
                                    echo '</p></div>';
                                }
                                if($form->errorSummary($ModelVast)) {
                                    echo '<div class="alert alert-danger" role="alert"><p class="note">';
                                    echo $form->errorSummary($ModelVast);
                                    echo '</p></div>';
                                }
                            ?>
                      </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast,'vast_title'); ?>
                            <?php echo $form->textField($ModelVast,'vast_title', array('size' => 60, 'maxlength' => 65, 'class' => 'form-control', 'placeholder' => 'Nazwa reklamy')); ?>
                            <?php echo $form->error($ModelVast,'vast_title', array('class' => 'text-danger')); ?>
                             </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast,'vast_source'); ?>
                            <?php echo $form->textField($ModelVast,'vast_source', array('class' => 'form-control', 'placeholder' => 'Adres URL reklamy'));?>
                            <?php echo $form->error($ModelVast,'vast_source', array('class' => 'text-danger')); ?>
                            </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast,'vast_link'); ?>
                            <?php echo $form->textField($ModelVast,'vast_link', array('class' => 'form-control', 'placeholder' => 'Odlinkowanie reklamy')); ?>
                            <?php echo $form->error($ModelVast,'vast_link', array('class' => 'text-danger')); ?>
                            </div>
                        <div class="form-group">
                            <?php   
                            $parents = CmsvideoCategories::model()->findAll('parent_id = 1');
                            $cm = new CommonMethods();
                            $data = $cm->makeDropDown($parents);
                            
                            echo $form->labelEx($ModelVast, 'video_category');
                         
                                echo $form->listBox($ModelVast,'video_category', $data, array(
                                   'size' => 6, 
                                   'multiple' => 'true',
                                   'class' => 'form-control',
                                    ));
                            ?>
                            <?php echo $form->error($ModelVast, 'video_category', array('class' => 'text-danger')); ?>
                        </div>
                        <div class="form-group">
                                    <?php echo $form->dropDownList($ModelVast, 'vast_published',array('1' => 'Opublikowano', '0' => 'Nie opublikowano'),array('options' => array('1' => array('selected' => 'selected')), 'class' => 'form-control')); ?>         </div>
                        <div class="form-group">
                               <?php echo CHtml::submitButton('Dodaj',array('class' => 'btn btn-success')); ?>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                                    <?php echo $form->labelEx($ModelVast,'vast_start'); ?>
                                    <?php 
                                    Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                                        $this->widget('CJuiDateTimePicker',array(
                                            'model'=>$ModelVast, //Model object
                                            'htmlOptions' => array('class' => 'form-control'),
                                            'attribute'=>'vast_start', //attribute name
                                            'mode'=>'datetime', //use "time","date" or "datetime" (default)
                                            'options'=>array(
                                                "dateFormat"=>'yy-mm-dd',
                                                "timeFormat"=>'hh:mm:ss',
                                                ), // jquery plugin options
                                        ));
                                    ?>                
                                    <?php echo $form->error($ModelVast,'vast_start', array('class' => 'text-danger')); ?>
                                    </div>
                            <div class="form-group">
                                    <?php echo $form->labelEx($ModelVast,'vast_end'); ?>
                                    <?php 
                                    Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                                        $this->widget('CJuiDateTimePicker',array(
                                            'model'=>$ModelVast, //Model object
                                            'htmlOptions' => array('class' => 'form-control'),
                                            'attribute'=>'vast_end', //attribute name
                                            'mode'=>'datetime', //use "time","date" or "datetime" (default)
                                            'options'=>array(
                                                "dateFormat"=>'yy-mm-dd',
                                                "timeFormat"=>'hh:mm:ss',
                                                ), // jquery plugin options
                                        ));
                                    ?>                
                                    <?php echo $form->error($ModelVast,'vast_end', array('class' => 'text-danger')); ?>
                                </div>
                    </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div>