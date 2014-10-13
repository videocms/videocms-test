<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edycja Menu</h1>
    </div>
</div>
<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-menu-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dodaj Menu</div>
                     <div class="panel-body">
                         <div class="row">
                              <div class="col-lg-12">
                                  <div class="alert alert-warning" role="alert">
                                       <p class="note">Pola oznacone <span class="required">*</span> są wymagane.</p>
                                  </div>
                            
                         <div class="col-lg-6">
                            <div class="form-group">
                                <?php 
                                echo $form->errorSummary($ModelMenu); 
                                if($AddMenu)
                                   {
                                    echo '<div class="alert alert-success" role="alert">Nowe menu zostało dodane!</div>';
                                   }
                                ?>
                                <?php echo $form->labelEx($ModelMenu,'menu_name'); ?>
                                <?php echo $form->textField($ModelMenu,'menu_name', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelMenu,'menu_name'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo CHtml::submitButton('Dodaj', array('class' => 'btn btn-primary')); ?>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo $form->labelEx($ModelMenu,'menu_text'); ?>
                                <?php echo $form->textField($ModelMenu,'menu_text', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelMenu,'menu_text'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ModelMenu,'menu_link'); ?>
                                <?php echo $form->textField($ModelMenu,'menu_link', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelMenu,'menu_link'); ?>
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