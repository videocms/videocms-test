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
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
  
    
    <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Edytuj slide</div>
            <div class="panel-body">
            <div class="row">
            <div class="col-lg-12">
                            <?php 
                                if($SliderUpdate)
                                {
                                    echo '<div class="alert alert-success" role="alert"><p class="note">';
                                    echo 'Slide został edytowany!';
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
                                    $fieldStat = 'has-error';
                                    $iconStat = 'glyphicon-remove';
                                }
                            ?>
            </div>
       <div class="col-lg-5">
             <div class="form-group input-group">
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model' => $ModelSlider,
                    'attribute' => 'slider_title',
                    'sourceUrl' => Yii::app()->createUrl('admin/autocompletevideo'),
                    'options' => array(
                        'minLength' => '1',
                        'select' => 'js:function(event, ui) {
                            $("#Slider_slider_idvideo").val(ui.item.idvideo);
                            $("#Slider_slider_updateimg").val(ui.item.image);
                            $("#Slider_slider_title").val(ui.item.label);
                            return false;
                        }'
                    ),
                    'htmlOptions' => array('size' => 60, 'class'=>'form-control', 'placeholder'=>'Nagłówek'),
                ));
                ?>
                <span class="input-group-btn">
                    <div class="btn btn-default disabled"><i class="fa fa-search"></i></div>
                </span>
                <?php echo $form->error($ModelSlider, 'slider_title', array('class' => 'text-danger')); ?>
            </div>
            <div class="form-inline">   
                <div class="form-group">
                    <?php echo $form->textField($ModelSlider, 'slider_idvideo', array('type'=>'number', 'class' => 'form-control', 'placeholder'=>'Id video')); ?>
                    <?php echo $form->error($ModelSlider, 'slider_idvideo'); ?> 
                </div>  
                 <div class="form-group">
                <?php echo $form->dropDownList($ModelSlider, 'slider_published',array('1' => 'Opublikowano', '0' => 'Nie opublikowano'),array('options' => array('1' => array('selected' => 'selected')), 'class' => 'form-control')); ?> 
               </div>
            </div>       
        </div>
        
        <div class="col-lg-7">
            <div class="form-group">
                <div id="upload">
                    <div class='col-md-4 col-lg-4'>
                       <img src="/../<?php echo $ModelSlider->slider_thumb; ?>" class="img-thumbnail" style="height: 80px;"/>
                    </div>
                 <div class='col-md-8 col-lg-8'>
                    <?php echo $form->textField($ModelSlider, 'slider_image',array('readonly'=>true, 'class' => 'form-control')); ?>
                    <input class="btn btn-default btn-sm" style="margin-top:14px;" name="upload1" type="button" value="zmien" onclick="changeMode()" />     
                 </div>
                </div>  
                 <?php echo $form->error($ModelSlider, 'slider_image'); ?>
              <div class='clearfix'></div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <?php echo CHtml::submitButton('Zapisz', array('class' => 'btn btn-success')); ?>
            </div>
        </div>    
        </div>
        </div>
        </div>
        </div>
    </div>

<?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
     $.noConflict();
function changeMode() {
    var mode;
    mode='<?php echo $form->textField($ModelSlider, 'slider_updateimg', array('class' => 'form-control', 'placeholder'=>'URL nowego zdjęcia.')); ?>';
	document.getElementById('upload').innerHTML = mode;
}
 </script>