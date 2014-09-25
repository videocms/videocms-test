<h1>Edycja playera!</h1>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-player-form',
        'enableAjaxValidation'=>false,
    )); 
    ?>
    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
    <?php echo $form->errorSummary($ModelPlayer); ?>
    <?php
    if($PlayerUpdate)
    {
        echo '<div class="pozytywnie">player została zaktualizowana</div>';
    }
    ?>
    <div class="row">
        <?php echo $form->labelEx($ModelPlayer, 'player_type'); ?>
        <?php echo $form->textField($ModelPlayer, 'player_type'); ?>
        <?php echo $form->error($ModelPlayer, 'player_type'); ?>
    </div>
        <div class="row">
        <?php echo $form->labelEx($ModelPlayer, 'player_autoplay'); ?>
        <?php echo $form->textField($ModelPlayer, 'player_autoplay'); ?>
        <?php echo $form->error($ModelPlayer, 'player_autoplay'); ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Zapisz'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>