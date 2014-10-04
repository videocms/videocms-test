
<div class="panel-body">
    <?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'cmsvideo-users-login-form',
        'enableAjaxValidation'=>false,
        'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
      ));
?>
    <p class="note">Pola wypełnione <span class="required">*</span> są wymagane.</p>
  <?php
  if($ErrorData)
  {
      echo '<p class="text-warning">Wpisałeś złe dane!</p>';
  }
  echo $form->errorSummary($ModelUsers);
  ?>
    <div class="form-group">
        <?php 
        echo $form->labelEx($ModelUsers,'user_login');
        echo $form->textField($ModelUsers,'user_login', array('class' => 'form-control', 'placeholder'=>'Login'));
        echo $form->error($ModelUsers,'user_login', array('class' => 'bg-danger', 'placeholder'=>'Login'));
        ?>
    </div>
    <div class="form-group">
        <?php 
        echo $form->labelEx($ModelUsers,'user_pass');
        echo $form->passwordField($ModelUsers,'user_pass', array('class' => 'form-control', 'placeholder'=>'Hasło'));
        echo $form->error($ModelUsers,'user_pass', array('class' => 'bg-danger', 'placeholder'=>'Hasło'));
        ?>
    </div>
  <div class="panel-body">
    <div class="row buttons">
        <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-lg btn-success btn-block')); ?>
    </div>
  </div>
    <?php $this->endWidget(); ?>
    
</div>
