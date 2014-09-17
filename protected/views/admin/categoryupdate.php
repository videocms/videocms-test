<h1>Edycja Kategorii</h1>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-category-form',
        'enableAjaxValidation'=>false,
    ));
    ?>
    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
    <?php echo $form->errorSummary($ModelCategory); ?>
    <?php
    if($CategoryUpdated)
    {
        echo '<div class="pozytywnie">Kategoria została zaktualizowana</div>';
    }
    ?>
    <div class="row">
        <?php echo $form->labelEx($ModelCategory, 'category_name'); ?>
        <?php echo $form->textField($ModelCategory, 'category_name', array(
            'size'=>50,
            'maxlength'=>50
        )); ?>
        <?php echo $form->error($ModelCategory, 'category_name'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Zapisz'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>