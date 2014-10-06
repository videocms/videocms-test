<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edycja użytkownika</h1>
    </div>
</div>
<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-user-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo 'Edytujesz: '.$ModelUser->user_login; ?></div>
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
                                echo $form->errorSummary($ModelUser); 
                                if($AddUser)
                                   {
                                    echo '<div class="alert alert-success" role="alert">Edycja zakończona powodzeniem!</div>';
                                   }
                                ?>
                                <?php echo $form->labelEx($ModelUser,'user_login'); ?>
                                <?php echo $form->textField($ModelUser,'user_login', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelUser,'user_login'); ?>
                                </div>
                             <div class="form-group">
                                <?php echo $form->labelEx($ModelUser,'user_pass'); ?>
                                <?php echo $form->passwordField($ModelUser,'user_pass', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelUser,'user_pass'); ?>
                                </div>
                                <div class="form-group">
                                <?php echo $form->labelEx($ModelUser,'user_newpass'); ?>
                                <?php echo $form->passwordField($ModelUser,'user_newpass', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelUser,'user_newpass'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo CHtml::submitButton('Dodaj', array('class' => 'btn btn-primary')); ?>
                                    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
                                    </div>
                        </div>
                       </div>
                   </div>
             </div>
         </div>
    </div>
<?php $this->endWidget(); ?>
</div>