<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
 Edytuj SEO
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Seo Edytowanie</h4>
      </div>
      <div class="modal-body">
        <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-settings-form',
        'enableAjaxValidation'=>false,
    )); 
    ?>
    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
    <?php echo $form->errorSummary($ModelSettings); ?>
    <?php
    if($SettingsUpdate)
    {
        echo '<div class="pozytywnie">ustawienia zostały zaktualizowane</div>';
    }
    ?>
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'settings_keywords'); ?>
        <?php echo $form->textField($ModelSettings, 'settings_keywords'); ?>
        <?php echo $form->error($ModelSettings, 'settings_keywords'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'settings_robots'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'settings_robots', array('noindex,nofollow' => 'noindex,nofollow', 'index,nofollow' => 'index,nofollow', 'index,follow' => 'index,follow')); ?>
        <?php echo $form->error($ModelSettings, 'settings_robots'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'settings_ogtitle'); ?>
        <?php echo $form->textField($ModelSettings, 'settings_ogtitle'); ?>
        <?php echo $form->error($ModelSettings, 'settings_ogtitle'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'settings_ogimage'); ?>
        <?php echo $form->textField($ModelSettings, 'settings_ogimage'); ?>
        <?php echo $form->error($ModelSettings, 'settings_ogimage'); ?>
    </div>
        <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'settings_description'); ?>
        <?php echo $form->textField($ModelSettings, 'settings_description'); ?>
        <?php echo $form->error($ModelSettings, 'settings_description'); ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Zapisz'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        
      </div>
    </div>
  </div>
</div>
<?php
?>

