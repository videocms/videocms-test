<h1>Zaloguj się</h1>
<div class="form">
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
  ?><div class="row">
  <div class="col-xs-6 col-md-4">
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
  
    <div class="row buttons">
        <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-default')); ?>
    </div>
  </div>
  </div>
    <?php $this->endWidget(); ?>
    
</div>
