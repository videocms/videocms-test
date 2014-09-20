<?php
echo '<h1>Wideo</h1>';
echo '<table style="width: 850px;">';

echo '<tr>';
echo '<th>ID</th>';
echo '<th>Nazwa</th>';
echo '<th>Vast</th>';
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
    echo '<td class="'.$RowClass.'">'.$ModelCategoryShow['category_vast'].'</td>';
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

    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
    <?php 
    echo $form->errorSummary($ModelCategory); 
    if($AddCategory)
    {
        echo '<div>Nowa kategoria została dodana.</div>';
    }
    ?>

    <div class="row">
        <?php echo $form->labelEx($ModelCategory,'category_name'); ?>
        <?php echo $form->textField($ModelCategory,'category_name', array('size' => 50,'maxlength' => 50)); ?>
        <?php echo $form->error($ModelCategory,'category_name'); ?>
    </div>
    
   <div class="row">
        <?php echo $form->labelEx($ModelCategory, 'category_vast'); ?>
        <?php echo $form->dropDownList($ModelCategory, 'category_vast', CHtml::listData($ModelVast->DownloadVast(), 'vast_source_vast', 'vast_title'), array('style'=>'width: 400px;')
                ); 
        ?>
        <?php echo $form->error($ModelCategory, 'category_vast'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Dodaj'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>