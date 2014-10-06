<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Zarządzanie użytkownikami</h1>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-adduser-grid',
'htmlOptions'=>array('class'=>'table-responsive'),
'summaryCssClass' => 'dataTables_info',
'template' => '<div class="alert alert-info fade in" role="alert">{summary}</div>{items}<div class="row"><div class="col-md-4"></div><div class="col-md-8">{pager}<br /></div></div>',
'dataProvider'=>$Data,
'pager'=>array( 
   'cssFile'=>false,   
    'header'=>'',  
    'maxButtonCount'=>'7',
    'selectedPageCssClass'=>'active',
   'htmlOptions'=>array(
           'class'=>'pagination'
       ),
    ),
'pagerCssClass'=>'pagination',
'itemsCssClass'=>'table table-hover',    
'columns'=>array(
        'user_id',
        'user_login',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete} {update}',
            'buttons'=>array
            (
                'delete' => array
                (   
                    'label'=>'',
                    //'options'=>array('class' => 'btn btn-danger', 'type' => 'button'),
                    'options'=>array('class' => 'fa fa-times fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Usuń'),
                    'imageUrl'=>'',
                    'url' => 'Yii::app()->createUrl("admin/adduserdelete/".$data->user_id)',
                ),
                'update' => array
                (
                    'label'=>'',
                    'options'=>array('class' => 'fa fa-pencil fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Edytuj'),
                    'imageUrl'=>'',
                    'url'=> 'Yii::app()->createUrl("admin/userupdate/".$data->user_id)',
                ),
            ),
        ),
    ),
));
?>

<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-adduser-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dodaj użytkownika</div>
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
                                if($ErrorData)
                                    {
                                           echo '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';

                                           echo '<p class="text-danger">Twoje hasła są różne!</p></div>';
                                     }
                                echo $form->errorSummary($ModelUser); 
                                if($UserAdd)
                                   {
                                    echo '<div class="alert alert-success" role="alert">Nowy użytkownik został dodany!</div>';
                                   }
                                ?>
                                <div class="form-group">
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