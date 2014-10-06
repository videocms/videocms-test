



<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Zmiana hasła</h1>
    </div>
</div>
<div class="form">
    <?php 
            $form=$this->beginWidget('CActiveForm', array(
            'id'=>'videocms-users-form',
            'enableAjaxValidation' => false,
            )); 
        ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo 'Edytujesz swoje hasło';?></div>
                     <div class="panel-body">
                         <div class="row">
                            <div class="col-lg-12">
                                 <div class="alert alert-warning" role="alert">
                                      <p class="note">Pola oznacone <span class="required">*</span> są wymagane.</p>
                                </div>
                            </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                <?php
                                    if($ErrorChangePass == 'wrong_pass')
                                    {
                                        echo '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Twoje stare hasło nie zgadza się z hasłem znajdującym się obecnie w bazie danych!</div>';
                                    }

                                    if($ErrorChangePass == 'pass_no_match')
                                    {
                                        echo '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Nowe hasło i jego potwierdzenie nie pasują do siebie!</div>';
                                    }

                                    if($ErrorChangePass == 'brak_bledow')
                                    {
                                        echo '<div class="pozytywnie">Twoje hasło zostało poprawnie zmienione.</div>';
                                    }

                                    ?>
                                <?php 
                                if ($form->errorSummary($ModelPass) == true)
                                     {
                                         echo '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                                    echo $form->errorSummary($ModelPass); 
                                     echo '</div>';}

                                if($ChangePass)
                                   {
                                    echo '<div class="alert alert-success" role="alert">Hasło zostało zmienione!</div>';
                                   }
                                ?>
                                <div class="form-group">
                                    <?php echo $form->labelEx($ModelPass, 'user_pass'); ?>
                                    <?php echo $form->passwordField($ModelPass, 'user_pass'); ?>
                                    <?php echo $form->error($ModelPass, 'user_pass'); ?>
                                </div>

                                <div class="form-group">
                                    <?php echo $form->labelEx($ModelPass, 'user_newpass'); ?>
                                    <?php echo $form->passwordField($ModelPass, 'user_newpass'); ?>
                                    <?php echo $form->error($ModelPass, 'user_newpass'); ?>
                                </div>

                                <div class="form-group">
                                    <?php echo $form->labelEx($ModelPass, 'user_newpass2'); ?>
                                    <?php echo $form->passwordField($ModelPass, 'user_newpass2'); ?>
                                    <?php echo $form->error($ModelPass, 'user_newpass2'); ?>
                                </div>
                                </div>
                                <div class="form-group">
                                    <?php echo CHtml::submitButton('Zmień', array('class' => 'btn btn-primary')); ?>
                                    </div>
                        </div>
                       </div>
                   </div>
             </div>
         </div>
    </div>
<?php $this->endWidget(); ?>
</div>