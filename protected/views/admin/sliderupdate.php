<h1>Edycja Slidera</h1> 
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-slider-form',
        'enableAjaxValidation'=>false,
    ));
    ?>
    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
    <?php echo $form->errorSummary($ModelSlider); ?>
    <?php
    if($SliderUpdated)
    {
        echo '<div class="pozytywnie">Slider został zaktualizowany</div>';
    }
    ?>
    <div class="row">
        <?php echo $form->labelEx($ModelSlider,'slider_image'); ?>
        <?php echo $form->textField($ModelSlider,'slider_image', array('size' => 50,'maxlength' => 255)); ?>
        <?php echo $form->error($ModelSlider,'slider_image'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelSlider,'slider_text'); ?>
        <?php echo $form->textField($ModelSlider,'slider_text'); ?>
        <?php echo $form->error($ModelSlider,'slider_text'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Zapisz'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>