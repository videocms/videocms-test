<h1>Ustawienia</h1> 
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
    <h2>SEO</h2> 
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
        </div>
    <h2>Slider</h2> 
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'slider_duration'); ?>
        <?php echo $form->textField($ModelSettings, 'slider_duration'); ?>
        <?php echo $form->error($ModelSettings, 'slider_duration'); ?>
    </div>
    Szczałki 0->szczałek niema, 1 -> szczałki po najchaniu sie pojawiają, 2 -> są cały czas
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'slider_arrow'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_arrow', array('0' => '0', '1' => '1', '2' => '2')); ?>
        <?php echo $form->error($ModelSettings, 'slider_arrow'); ?>
    </div>
    przesuwanie np mobilnie palcem: domyślnie 1
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'slider_dragorientation'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_dragorientation', array('0' => '0', '1' => '1', '2' => '2', '3' => '3')); ?>
        <?php echo $form->error($ModelSettings, 'slider_dragorientation'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'slider_slidespacing'); ?>
        <?php echo $form->textField($ModelSettings, 'slider_slidespacing'); ?>
        <?php echo $form->error($ModelSettings, 'slider_slidespacing'); ?>
    </div>
    czułość przesuwania domyslnie: (20):
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'slider_mindragoffsettoslide'); ?>
        <?php echo $form->textField($ModelSettings, 'slider_mindragoffsettoslide'); ?>
        <?php echo $form->error($ModelSettings, 'slider_mindragoffsettoslide'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'slider_loop'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_loop', array('0' => '0', '1' => '1', '2' => '2')); ?>
        <?php echo $form->error($ModelSettings, 'slider_loop'); ?>
    </div>
    Enable hardware acceleration:
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'slider_hwa'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_hwa', array('false' => 'false', 'true' => 'true')); ?>
        <?php echo $form->error($ModelSettings, 'slider_hwa'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'slider_arrowkeynavigation'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_arrowkeynavigation', array('false' => 'false', 'true' => 'true')); ?>
        <?php echo $form->error($ModelSettings, 'slider_arrowkeynavigation'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'slider_lazyloading'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_lazyloading', array('0' => '0', '1' => '1', '2' => '2')); ?>
        <?php echo $form->error($ModelSettings, 'slider_lazyloading'); ?>
    </div>
    komentarze:
    <div class="row">
        <?php echo $form->labelEx($ModelSettings, 'disqus_shortname'); ?>
        <?php echo $form->textField($ModelSettings, 'disqus_shortname'); ?>
        <?php echo $form->error($ModelSettings, 'disqus_shortname'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Zapisz', array('class' => 'btn btn-success')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>