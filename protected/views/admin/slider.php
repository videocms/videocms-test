<?php
echo '<h1>Slider</h1>';
echo '<table class="table table-hover">';
echo '<tr class="active">';
echo '<th>ID</th>';
echo '<th>Image</th>';
echo '<th>Edytuj</th>';
echo '<th>Usuń</th>';
echo '<tr>';

foreach($Data as $ModelSliderShow)
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
    echo '<td class="'.$RowClass.'">'.$ModelSliderShow['slider_id'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelSliderShow['slider_image'].'</td>';
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link(
            'Edytuj',
            array('admin/sliderupdate/'.$ModelSliderShow['slider_id'])
            );
    echo '</td>';
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link(
            'Usuń',
            array('admin/sliderdelete/'.$ModelSliderShow['slider_id']),
            array('confirm' => 'Czy na pewno chcesz usunąć rekord?')
            );
    echo '</td>';
    echo '</tr>';
}

echo '</table>';
?>

<div class="form">
    <h2 class="admin">Dodaj nowy slider</h2>
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-slider-form',
        'enableAjaxValidation'=>false,
    ));
    ?>

    <p class="note">Pola oznaczone <span class="required">*</span> są wymagane.</p>
    <?php 
    echo $form->errorSummary($ModelSlider); 
    if($AddSlider)
    {
        echo '<div>Nowy Slider został dodany!</div>';
    }
    ?>

    <div class="row">
        <?php echo $form->labelEx($ModelSlider,'slider_image'); ?>
        <?php echo $form->textField($ModelSlider,'slider_image', array('size' => 50,'maxlength' => 255)); ?>
        <?php echo $form->error($ModelSlider,'slider_image'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelSlider,'slider_text'); ?>
        <?php echo $form->textField($ModelSlider,'slider_text'); ?>
        <?php echo $form->error($ModelSlider,'slider_text'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Dodaj'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
