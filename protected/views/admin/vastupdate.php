<h1>Edycja reklamy</h1>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-vast-form',
        'enableAjaxValidation'=>false,
    ));
    ?>
    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
    <?php echo $form->errorSummary($ModelVast); ?>
    <?php
    if($VastUpdate)
    {
        echo '<div class="pozytywnie">Reklama została zaktualizowana</div>';
    }
    ?>
    <div class="row">
        <?php echo $form->labelEx($ModelVast, 'vast_title'); ?>
        <?php echo $form->textField($ModelVast, 'vast_title', array(
            'size'=>40,
            'maxlength'=>40
        )); ?>
        <?php echo $form->error($ModelVast, 'vast_title'); ?>
        <div class="row">
        <?php echo $form->labelEx($ModelVast, 'vast_source'); ?>
        <?php echo $form->textField($ModelVast, 'vast_source'); ?>
        <?php echo $form->error($ModelVast, 'vast_source'); ?>
    </div>
        <div class="row">
        <?php echo $form->labelEx($ModelVast, 'vast_link'); ?>
        <?php echo $form->textField($ModelVast, 'vast_link'); ?>
        <?php echo $form->error($ModelVast, 'vast_link'); ?>
    </div>
        <div class="row">
        <?php echo $form->labelEx($ModelVast, 'vast_source_vast'); ?>
        <?php echo $form->textField($ModelVast, 'vast_source_vast'); ?>
        <?php echo $form->error($ModelVast, 'vast_source_vast'); ?>
    </div>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Zapisz'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>