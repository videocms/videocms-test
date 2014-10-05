<?php
echo '<h1>Kategorie wideo</h1>';
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-category-grid',
'dataProvider'=>$Data,
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
    <h2 class="admin">Dodaj nową kategorię</h2>
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-category-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <div class="row">
        <div class="col-xs-4">
             
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
            <?php echo CHtml::submitButton('Dodaj', array('class' => 'btn btn-primary')); ?>
            <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
         </div>
    </div>
    <?php $this->endWidget(); ?>
</div>