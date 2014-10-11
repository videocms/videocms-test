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
                <div class="panel-heading">Dodaj kategorię</div>
                     <div class="panel-body">
                         <div class="row">
                              <div class="col-lg-12">
                                  <div class="alert alert-warning" role="alert">
                                       <p class="note">Pola oznacone <span class="required">*</span> są wymagane.</p>
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
                                <?php echo $form->labelEx($ModelCategory,'name'); ?>
                                <?php echo $form->textField($ModelCategory,'name', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
                                <?php echo $form->error($ModelCategory,'name'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($ModelCategory,'published'); ?>
                                    <?php echo $form->dropDownList($ModelCategory, 'published',array('1' => 'Opublikowano', '0' => 'Nie opublikowano'),array('options' => array('1' => array('selected' => 'selected')), 'class' => 'form-control')); ?>                                <?php echo $form->error($ModelCategory,'published'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo CHtml::submitButton('Zapisz', array('class' => 'btn btn-success')); ?>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <?php echo $form->labelEx($ModelCategory, 'alias'); ?>
                            <?php echo $form->textField($ModelCategory, 'alias', array('class' => 'form-control', 'placeholder' => 'Alias', 'readonly' => false)); ?>
                            <?php echo $form->error($ModelCategory, 'alias'); ?>
                                </div>
                            <div class="form-group">
                                <?php $parents = CmsvideoCategories::model()->findAll('parent_id = 1');
                                $cm = new CommonMethods();
                                $data = $cm->makeDropDown($parents);
                                ?>
                                <?php echo $form->labelEx($ModelCategory, 'parent_id'); ?>
                                <?php echo $form->dropDownList($ModelCategory, 'parent_id',$data, array('class' => 'form-control')); ?>
                                <?php echo $form->error($ModelCategory, 'parent_id'); ?>
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
<script type="text/javascript">
 var title = $('#CmsvideoCategories_name'),
    slug = $('#CmsvideoCategories_alias');

title.on('keyup', function() {
  var val = $(this).val();
  val = val.toLowerCase()
    .replace(/ /g, '-');
  slug.val(val);
});
</script>