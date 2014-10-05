<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edycja reklamy</h1>
        </div>
</div>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', 
         array(
            'id'=>'videocms-vast-form',
            'enableAjaxValidation'=>false,
        )); 
    ?>
    <div class="row">
        <?php echo $form->errorSummary($ModelVast); ?>
        <?php
        if($VastUpdate)
        {
            echo '<div class="alert alert-success" role="alert">Reklama została zaktulizowana!</div>';
        }
        ?>
        <div class="col-lg-12">
            <div class="panel panel-default">
            <div class="panel-heading"><?php echo 'Reklama: '.$ModelVast->vast_title; ?></div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast,'vast_title'); ?>
                            <?php echo $form->textField($ModelVast,'vast_title', array('size' => 60, 'maxlength' => 65, 'class' => 'form-control', 'placeholder' => 'Nazwa reklamy')); ?>
                            <?php echo $form->error($ModelVast,'vast_title'); ?>
                            </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast,'vast_source'); ?>
                            <?php echo $form->textField($ModelVast,'vast_source', array('class' => 'form-control', 'placeholder' => 'Adres URL reklamy'));?>
                            <?php echo $form->error($ModelVast,'vast_source'); ?>
                            </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($ModelVast,'vast_link'); ?>
                            <?php echo $form->textField($ModelVast,'vast_link', array('class' => 'form-control', 'placeholder' => 'Odlinkowanie reklamy')); ?>
                            <?php echo $form->error($ModelVast,'vast_link'); ?>
                            </div>
                        <div class="form-group">
                            <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
                            </div>
                        </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <?php echo $form->labelEx($ModelVast, 'video_category'); ?>
                        <?php
                        $optionCategories = explode(',',$ModelVast->vast_video_cat);
                        $optionsCategory = array();
                        foreach ($optionCategories as $optionCatgory) {
                        if ($optionCatgory) {
                           $optionsCategory[$optionCatgory] = array('selected' => 'selected');
                           }
                        }
                            echo $form->listBox($ModelVast,'video_category', CHtml::listData(CmsvideoCategories::model()->findAll(), 'category_id', 'category_name'), array(
                               'size' => 9, 
                               'multiple' => 'true',
                               'class' => 'form-control',
                               'options' => $optionsCategory
                                ));
                            ?>
                        <?php echo $form->error($ModelVast, 'video_category'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo CHtml::submitButton('Zapisz',array('class' => 'btn btn-success')); ?>
                            <?php echo CHtml::link('Anuluj',array('admin/vast'),array('class'=>'btn btn-danger')); ?>
                            </div>
                   </div>
                </div>
        </div>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div>