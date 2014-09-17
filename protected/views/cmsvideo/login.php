<h1>Zaloguj się</h1>
<div class="form">
    <?php
    $form=$this->beginWidget('CActiveForm', array('id'=>'videocms-login-form','enableAjaxValidation'=>false,
      ));
?>
    <p class="note">Pola wypełnione <span class="required">*</span> są wymagane.</p>
  <?php
  if($ErrorData)
  {
      echo '<div class="zle">Wpisałeś złe dane!</div>';
  }
  echo $form->errorSummary($ModelUsers);
  ?>
    <div class="row">
        <?php 
        echo $form->labelEx($ModelUsers,'user_login');
        echo $form->textField($ModelUsers,'user_login');
        echo $form->error($ModelUsers,'user_login');
        ?>
    </div>
    <div class="row">
        <?php 
        echo $form->labelEx($ModelUsers,'user_pass');
        echo $form->textField($ModelUsers,'user_pass');
        echo $form->error($ModelUsers,'user_pass');
        ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
