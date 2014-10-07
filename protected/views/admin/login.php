<div class="panel-body">
    <?php
$this->breadcrumbs=array(
	'admin/Login',
);
        $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    
    <div class="alert alert-warning fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <p class="bg-warning">Pola wypełnione <span class="required">*</span> są wymagane.</p></div>
  <?php
  
  //echo $form->errorSummary($ModelUsers);
  ?>
    <?php
    if (($form->error($model,'username') == true) || ($form->error($model,'password') == true))
    {
     echo '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
     echo $form->error($model,'username', array('class' => 'text-danger'));
     echo $form->error($model,'password', array('class' => 'text-danger'));
    echo '</div>';}
     ?>
    <div class="form-group">
        <?php 
        echo $form->labelEx($model,'username'); 
        echo $form->textField($model,'username', array('class' => 'form-control', 'placeholder'=>'Login'));
        ?>
    </div>
    <div class="form-group">
        <?php 
        echo $form->labelEx($model,'password');
        echo $form->passwordField($model,'password', array('class' => 'form-control', 'placeholder'=>'Hasło'));
        ?>
    </div>
    <div class="form-group">
        <?php 
        echo $form->checkBox($model,'rememberMe', array('class' => 'checkbox-inline'));
	echo $form->label($model,'rememberMe', array('class' => ''));
	echo $form->error($model,'rememberMe');
        ?>
    </div>
  <div class="panel-body">
    <div class="row buttons">
        <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-lg btn-success btn-block')); ?>
    </div>
  </div>
    <?php $this->endWidget(); ?>
    
</div>

