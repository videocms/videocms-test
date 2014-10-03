<?php
echo '<h1>Wideo</h1>';
echo '<table class="table table-hover">';
echo '<tr class="active">';
echo '<th>ID</th>';
echo '<th>Nazwa</th>';
echo '<th>Edytuj</th>';
echo '<th>Usuń</th>';
echo '<tr>';

foreach($Data as $ModelCategoryShow)
{
    if($Class == 0)
    {
        $Class = 1;
        $RowClass = 'row1';
    }
    else
    {
        $Class = 0;
        $RowClass = 'row2';
    }
    
    echo '<tr>';
    echo '<td class="'.$RowClass.'">'.$ModelCategoryShow['category_id'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelCategoryShow['category_name'].'</td>';
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link(
            'Edytuj',
            array('admin/categoryupdate/'.$ModelCategoryShow['category_id'])
            );
    echo '</td>';
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link(
            'Usuń',
            array('admin/categorydelete/'.$ModelCategoryShow['category_id']),
            array('confirm' => 'Czy na pewno chcesz usunąć rekord?')
            );
    echo '</td>';
    echo '</tr>';
}

echo '</table>';
?>

<div class="form">
    <h2 class="admin">Dodaj nową kategorię</h2>
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-category-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <div class="row">
        <div class="col-xs-4">
             <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
            <?php 
            echo $form->errorSummary($ModelCategory); 
            if($AddCategory)
            {
                echo '<div>Nowa kategoria została dodana.</div>';
            }
            ?>
            <?php echo $form->labelEx($ModelCategory,'category_name'); ?>
            <?php echo $form->textField($ModelCategory,'category_name', array('size' => 50,'maxlength' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($ModelCategory,'category_name'); ?>
            <?php echo CHtml::submitButton('Dodaj', array('class' => 'btn btn-primary')); ?>
         </div>
    </div>
    <?php $this->endWidget(); ?>
</div>