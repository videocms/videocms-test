<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edycja kategorii</h1>
    </div>
</div>
<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-category-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo 'Edytujesz: '.$ModelCategory->category_name; ?></div>
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
                                echo $form->errorSummary($ModelCategory); 
                                if($AddCategory)
                                   {
                                    echo '<div class="alert alert-success" role="alert">Nowa kategoria została dodana!</div>';
                                   }
                                ?>
                                <?php echo $form->labelEx($ModelCategory,'category_name'); ?>
                                <?php echo $form->textField($ModelCategory,'category_name', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelCategory,'category_name'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo CHtml::submitButton('Dodaj', array('class' => 'btn btn-primary')); ?>
                                    </div>
                        </div>
                       </div>
                   </div>
             </div>
         </div>
    </div>
<?php $this->endWidget(); ?>
</div>