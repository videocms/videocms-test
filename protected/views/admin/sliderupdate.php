<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edycja slide</h1>
    </div>
</div>
<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-slider-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <div class="row">
       <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Edycja slide</div> 
            <div class="panel-body">
            <div class="row">
            <div class="col-lg-12">
                            <?php 
                                if($SliderUpdate)
                                {
                                    echo '<div class="alert alert-success" role="alert"><p class="note">';
                                    echo 'Slider został zaktualizowany!';
                                    echo '</p></div>';
                                }
                                else {
                                    echo '<div class="alert alert-warning" role="alert"><p class="note">';
                                    echo 'Pola oznaczone <span class="required">*</span> są wymagane.';
                                    echo '</p></div>';
                                }
                                if($form->errorSummary($ModelSlider)) {
                                    echo '<div class="alert alert-danger" role="alert"><p class="note">';
                                    echo $form->errorSummary($ModelSlider);
                                    echo '</p></div>';
                                }
                            ?> 
            </div>
       <div class="col-lg-6">
            <div class="form-group">
                <?php echo $form->labelEx($ModelSlider, 'slider_image'); ?>
                <?php echo $form->textField($ModelSlider, 'slider_image', array('class' => 'form-control')); ?>
                <?php echo $form->error($ModelSlider, 'slider_image'); ?> 
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelSlider,'slider_published'); ?>
                <?php echo $form->dropDownList($ModelSlider, 'slider_published',array('1' => 'Opublikowano', '0' => 'Nie opublikowano'),array('options' => array('1' => array('selected' => 'selected')), 'class' => 'form-control')); ?>                                
                <?php echo $form->error($ModelSlider,'slider_published'); ?>
            </div>
        </div>
        
        <div class="col-lg-6">         
            <div class="form-group">
                <?php echo $form->labelEx($ModelSlider, 'slider_text'); ?>
                <?php echo $form->textArea($ModelSlider, 'slider_text', array('rows'=>'5', 'class' => 'form-control')); ?>
                <?php echo $form->error($ModelSlider, 'slider_text'); ?> 
            </div>
            <div class="form-group">
                <?php echo CHtml::submitButton('Zapisz', array('class' => 'btn btn-success')); ?>
            </div>
        </div>
                
        </div>
        </div>
        </div>
        </div>
    </div>
    </div>
<?php $this->endWidget(); ?>
</div>