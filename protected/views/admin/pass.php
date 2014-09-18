<h1>Zmiana hasła</h1>
<div class="form">
<?php 
$form=$this->beginWidget('CActiveForm', array(
'id'=>'videocms-users-form',
'enableAjaxValidation' => false,
)); 
?>
    
<p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>

<?php echo $form->errorSummary($ModelPass); ?>

<?php
if($ErrorChangePass == 'zle_haslo')
{
    echo '<div class="zle">Twoje stare hasło nie zgadza się z hasłem znajdującym się obecnie w bazie danych.</div>';
}

if($ErrorChangePass == 'hasla_nie_pasuja')
{
    echo '<div class="zle">Nowe hasło i jego potwierdzenie nie pasują do siebie.</div>';
}

if($ErrorChangePass == 'brak_bledow')
{
    echo '<div class="pozytywnie">Twoje hasło zostało poprawnie zmienione.</div>';
}

?>

<div class="row">
    <?php echo $form->labelEx($ModelPass, 'user_pass'); ?>
    <?php echo $form->passwordField($ModelPass, 'user_pass'); ?>
    <?php echo $form->error($ModelPass, 'user_pass'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($ModelPass, 'user_newpass'); ?>
    <?php echo $form->passwordField($ModelPass, 'user_newpass'); ?>
    <?php echo $form->error($ModelPass, 'user_newpass'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($ModelPass, 'user_newpass2'); ?>
    <?php echo $form->passwordField($ModelPass, 'user_newpass2'); ?>
    <?php echo $form->error($ModelPass, 'user_newpass2'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Zmień'); ?>
</div>

<?php $this->endWidget(); ?>
</div>