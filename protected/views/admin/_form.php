<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>FALSE,
)); ?>

	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Formularz</div>
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
            foreach (Yii::app()->user->getFlashes() as $type=>$flash) {
                echo '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                  echo "<div class='{$type}'>{$flash}</div>";
                echo '</div>';
                
            }
        ?>
	<?php 
                if ($form->errorSummary($model) == TRUE)
                {
                echo '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo $form->errorSummary($model); 
                echo '</div>';
                } 
                ?>
                            </div>

	    <?php if ($model->isNewRecord) { ?>
	    <div class="form-group">
		    <?php echo $form->labelEx($model,'username'); ?>
		    <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128, 'class' => 'form-control')); ?>
		    <?php echo $form->error($model,'username', array('class' => 'text-danger')); ?>
	    </div>
	    <?php } ?>
	    
	    <div class="form-group">
		    <?php echo $form->labelEx($model,'firstname'); ?>
		    <?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>128, 'class' => 'form-control')); ?>
		    <?php echo $form->labelEx($model,'lastname'); ?>
		    <?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>128, 'class' => 'form-control')); ?>
		    <?php echo $form->error($model,'firstname', array('class' => 'text-danger')); ?>
	    </div>


	    <div class="form-group">
		    <?php echo $form->labelEx($model,'email'); ?>
		    <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128, 'class' => 'form-control')); ?>
		    <?php echo $form->error($model,'email', array('class' => 'text-danger')); ?>
	    </div>

	    <?php if ($model->isNewRecord && Yii::app()->user->isAdmin()) { ?>
	    <div class="form-group">
		    <?php echo $form->labelEx($model,'role'); ?>
		    <?php echo $form->textField($model,'role', array('class' => 'form-control')); ?>
		    <?php echo $form->error($model,'role', array('class' => 'text-danger')); ?>
	    </div>
	    <?php } ?>
	    <div class="form-group">
		    <?php echo $form->labelEx($model,'passwordSave'); ?>
		    <?php echo $form->passwordField($model,'passwordSave',array('size'=>60,'maxlength'=>256, 'class' => 'form-control')); ?>
		    <?php echo $form->error($model,'passwordSave', array('class' => 'text-danger')); ?>
	    </div>
	    <div class="form-group">
		    <?php echo $form->labelEx($model,'repeatPassword'); ?>
		    <?php echo $form->passwordField($model,'repeatPassword',array('size'=>60,'maxlength'=>256, 'class' => 'form-control')); ?>
		    <?php echo $form->error($model,'repeatPassword', array('class' => 'text-danger')); ?>
	    </div>

	    <div class="form-group">
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Zapisz' : 'Zapisz', array('class' => 'btn btn-primary')); ?>
	    </div>
	
	
<?php $this->endWidget(); ?>

</div>
                       </div>
                   </div>
             </div>
         </div>
    </div><!-- form -->
</div>