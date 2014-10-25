<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ustawienia</h1>
    </div>
</div>        <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-settings-form',
        'enableAjaxValidation'=>false,
    )); 
    ?>
    <?php echo '<div class="alert alert-warning" role="alert"><p class="note">';
          echo 'Pola oznaczone <span class="required">*</span> są wymagane.';
          echo '</p></div>'; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
            <div class="panel-heading">Ustawienia SEO</div>
                <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-12">
                            <?php echo $form->errorSummary($ModelSettings); ?>
                                <?php
                                if($SettingsUpdate)
                                {
                                    echo '<div class="pozytywnie">ustawienia zostały zaktualizowane</div>';
                                }
                                ?>
                      </div>
                        <div class="col-lg-12">
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'settings_keywords'); ?>
        <div class="input-group">
        <div class="input-group-addon">10</div>
        <?php echo $form->textField($ModelSettings, 'settings_keywords', array('class' => 'form-control')); ?></div>
        <?php echo $form->error($ModelSettings, 'settings_keywords'); ?>
        </div>
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'settings_robots'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'settings_robots', array('noindex,nofollow' => 'noindex,nofollow', 'index,nofollow' => 'index,nofollow', 'index,follow' => 'index,follow'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'settings_robots'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'settings_ogtitle'); ?>
        <?php echo $form->textField($ModelSettings, 'settings_ogtitle', array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'settings_ogtitle'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'settings_ogimage'); ?>
        <?php echo $form->textField($ModelSettings, 'settings_ogimage', array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'settings_ogimage'); ?>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'settings_description'); ?>
        <?php echo $form->textField($ModelSettings, 'settings_description', array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'settings_description'); ?>
        </div>
                        </div></div></div></div>
            <div class="panel panel-default">
            <div class="panel-heading">Ustawienia Slidera</div>
           <div class="panel-body">
          <div class="row">
              <div class="col-lg-12">
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'slider_duration'); ?>
        <?php echo $form->textField($ModelSettings, 'slider_duration', array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'slider_duration'); ?>
    </div>
    Szczałki 0->szczałek niema, 1 -> szczałki po najchaniu sie pojawiają, 2 -> są cały czas
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'slider_arrow'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_arrow', array('0' => '0', '1' => '1', '2' => '2'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'slider_arrow'); ?>
    </div>
    przesuwanie np mobilnie palcem: domyślnie 1
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'slider_dragorientation'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_dragorientation', array('0' => '0', '1' => '1', '2' => '2', '3' => '3'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'slider_dragorientation'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'slider_slidespacing'); ?>
        <?php echo $form->textField($ModelSettings, 'slider_slidespacing', array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'slider_slidespacing'); ?>
    </div>
    czułość przesuwania domyslnie: (20):
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'slider_mindragoffsettoslide'); ?>
        <?php echo $form->textField($ModelSettings, 'slider_mindragoffsettoslide', array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'slider_mindragoffsettoslide'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'slider_loop'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_loop', array('0' => '0', '1' => '1', '2' => '2'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'slider_loop'); ?>
    </div>
    Enable hardware acceleration:
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'slider_hwa'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_hwa', array('false' => 'false', 'true' => 'true'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'slider_hwa'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'slider_arrowkeynavigation'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_arrowkeynavigation', array('false' => 'false', 'true' => 'true'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'slider_arrowkeynavigation'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'slider_lazyloading'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'slider_lazyloading', array('0' => '0', '1' => '1', '2' => '2'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'slider_lazyloading'); ?>
    </div>
              </div></div></div></div>
    <div class="panel panel-default">
        <div class="panel-heading">Ustawienia Disqus</div>
        <div class="panel-body">
        <div class="row">
        <div class="col-lg-12">
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'disqus_shortname'); ?>
        <?php echo $form->textField($ModelSettings, 'disqus_shortname', array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'disqus_shortname'); ?>
    </div>
            </div></div></div></div>
            <div class="panel panel-default">
        <div class="panel-heading">Ustawienia Player</div>
        <div class="panel-body">
        <div class="row">
        <div class="col-lg-12">
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'player_autoplay'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'player_autoplay', array('autoplay' => 'autoplay', '' => 'manual'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'player_autoplay'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'player_preload'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'player_preload', array('auto' => 'Auto', 'true' => 'True', 'metadata' => 'Metadata', 'none' => 'None'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'player_preload'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($ModelSettings, 'player_loop'); ?>
        <?php echo $form->dropDownList($ModelSettings, 'player_loop', array('loop' => 'true', '' => 'false'), array('class' => 'form-control')); ?>
        <?php echo $form->error($ModelSettings, 'player_loop'); ?>
    </div>
            </div></div></div></div>
        <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
         <div class="col-lg-12">
    <div class="form-group">
        <?php echo CHtml::submitButton('Zapisz', array('class' => 'btn btn-success')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
        </div></div></div></div></div>