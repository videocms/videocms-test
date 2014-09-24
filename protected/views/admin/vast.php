<?php
echo '<h1>Vast</h1>';
echo '<table style="width: 850px;">';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>tytul</th>';
echo '<th>source</th>';
echo '<th>link</th>';
//echo '<th>source_vast</th>';
echo '<th>Edytuj</th>';
echo '<th>Usuń</th>';
echo '<tr>';

foreach($Data as $ModelVastShow)
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
    echo '<td class="'.$RowClass.'">'.$ModelVastShow['vast_id'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVastShow['vast_title'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVastShow['vast_source'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVastShow['vast_link'].'</td>';
    //echo '<td class="'.$RowClass.'">'.$ModelVastShow['vast_source_vast'].'</td>';
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link(
            'Edytuj',
            array('admin/vastupdate/'.$ModelVastShow['vast_id'])
            );
    echo '</td>';
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link(
            'Usuń',
            array('admin/vastdelete/'.$ModelVastShow['vast_id']),
            array('confirm' => 'Czy na pewno chcesz usunąć rekord?')
            );
    echo '</td>';
    echo '</tr>';
}

echo '</table>';
?>

<div class="form">
    <h2 class="admin">Dodaj nową reklame</h2>
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-vast-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
    <?php 
    echo $form->errorSummary($ModelVast); 
    if($AddVast)
    {
        echo '<div>Nowa reklama została dodana.</div>';
    }
    ?>

    <div class="row">
        <?php echo $form->labelEx($ModelVast,'vast_title'); ?>
        <?php echo $form->textField($ModelVast,'vast_title', array('size' => 40,'maxlength' => 40)); ?>
        <?php echo $form->error($ModelVast,'vast_title'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVast,'vast_source'); ?>
        <?php echo $form->textField($ModelVast,'vast_source');?>
        <?php echo $form->error($ModelVast,'vast_source'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVast,'vast_link'); ?>
        <?php echo $form->textField($ModelVast,'vast_link'); ?>
        <?php echo $form->error($ModelVast,'vast_link'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Dodaj'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>