<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Skrzynka</h1>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-message-grid',
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
    'id',    
    'sender',
    'recipient',
    'text',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array
            (
                'delete' => array
                (   
                    'label'=>'',
                    //'options'=>array('class' => 'btn btn-danger', 'type' => 'button'),
                    'options'=>array('class' => 'fa fa-times fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Usuń'),
                    'imageUrl'=>'',
                    'url' => 'Yii::app()->createUrl("admin/messagedelete/".$data->id)',
                ),
                
            ),
        ),
    ),
));

?>

<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-message-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dodaj nową wiadomość</div>
                     <div class="panel-body">
                         <div class="row">
                              <div class="col-lg-12">
                                  <div class="alert alert-warning" role="alert">
                                       <p class="note">Pola oznacone <span class="required">*</span> są wymagane.</p>
                                  </div>
                            
                         <div class="col-lg-6">
                            <div class="form-group">
                                <?php 
                                echo $form->errorSummary($ModelMessage); 
                                if($AddMessage)
                                   {
                                    echo '<div class="alert alert-success" role="alert">Nowa została wysłana!</div>';
                                   }
                                ?>
                                <?php echo $form->labelEx($ModelMessage,'sender'); ?>
                                <?php echo $form->textField($ModelMessage,'sender', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelMessage,'sender'); ?>
                                </div>
                                 <div class="form-group">
                                 <?php echo $form->labelEx($ModelMessage,'recipient'); ?>
                                <?php echo $form->textField($ModelMessage,'recipient', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelMessage,'recipient'); ?>
                                </div>
                             <div class="form-group">
                                 <?php echo $form->labelEx($ModelMessage,'text'); ?>
                                <?php echo $form->textField($ModelMessage,'text', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelMessage,'text'); ?>
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
    </div>
    <?php $this->endWidget(); ?>
</div>