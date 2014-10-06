<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Zarządzanie kategoriami</h1>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-category-grid',
'htmlOptions'=>array('class'=>'table-responsive'),
'dataProvider'=>$Data,
'pager'=>array( 
   'cssFile'=>false,   
        // 'header'=>'testttt',           
    'maxButtonCount'=>'7',
    'selectedPageCssClass'=>'active',
   'htmlOptions'=>array(
           'class'=>'pagination'
       ),
    ),
'pagerCssClass'=>'pagination',
'itemsCssClass'=>'table table-hover',    
'columns'=>array(
        'category_id',
        'category_name',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}{update}',
            'buttons'=>array
            (
                'delete' => array
                (
                    'url' => 'Yii::app()->createUrl("admin/categorydelete/".$data->category_id)',
                ),
                'update' => array
                (
                    'url'=> 'Yii::app()->createUrl("admin/categoryupdate/".$data->category_id)',
                ),
            ),
        ),
    ),
));
?>

<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-category-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dodaj kategorię</div>
                     <div class="panel-body">
                         <div class="col-lg-6">
                            <div class="form-group">
                                <?php 
                                echo $form->errorSummary($ModelCategory); 
                                if($AddCategory)
                                   {
                                    echo '<div class="alert alert-success" role="alert">Nowa kategoria została dodana!</div>';
                                   }
                                ?>
                                <?php echo $form->labelEx($ModelCategory,'category_name'); ?>
                                <?php echo $form->textField($ModelCategory,'category_name', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelCategory,'category_name'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo CHtml::submitButton('Dodaj', array('class' => 'btn btn-primary')); ?>
                                    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
                                    </div>
                        </div>
                   </div>
             </div>
         </div>
    </div>
    <?php $this->endWidget(); ?>
</div>