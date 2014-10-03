<h1>Edycja Kategorii</h1> 
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
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
                echo '<div class="alert alert-success" role="alert">Kategoria została zaktualizowana!</div>';
            }
            ?>
            <?php echo $form->labelEx($ModelCategory,'category_name'); ?>
            <?php echo $form->textField($ModelCategory,'category_name', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($ModelCategory,'category_name'); ?>
            <?php echo CHtml::submitButton('Zapisz', array('class' => 'btn btn-success')); ?>
            <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
         </div>
    </div>
    <?php $this->endWidget(); ?>
</div>