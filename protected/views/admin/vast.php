<?php
echo '<h1>Reklamy</h1>';
echo '<table class="table table-hover">';
echo '<tr class="active">';
echo '<th>ID</th>';
echo '<th>Tytuł</th>';
echo '<th>Źródło</th>';
echo '<th>Kategorie Wideo</th>';
echo '<th>Link</th>';
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
    echo '<td class="'.$RowClass.'">'.$ModelVastShow['vast_video_cat'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVastShow['vast_link'].'</td>';
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
    <div class="col-xs-12 col-md-8">
        <div class="row">
            <?php echo $form->labelEx($ModelVast,'vast_title'); ?>
            <?php echo $form->textField($ModelVast,'vast_title', array('size' => 60, 'maxlength' => 65, 'class' => 'form-control', 'placeholder' => 'Nazwa reklamy')); ?>
            <?php echo $form->error($ModelVast,'vast_title'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($ModelVast,'vast_source'); ?>
            <?php echo $form->textField($ModelVast,'vast_source', array('class' => 'form-control', 'placeholder' => 'Adres URL reklamy'));?>
            <?php echo $form->error($ModelVast,'vast_source'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($ModelVast,'vast_link'); ?>
            <?php echo $form->textField($ModelVast,'vast_link', array('class' => 'form-control', 'placeholder' => 'Odlinkowanie reklamy')); ?>
            <?php echo $form->error($ModelVast,'vast_link'); ?>
        </div>
    </div>
    <div class="col-xs-6 col-md-4">
        <div class="row">
            <?php echo $form->labelEx($ModelVast, 'video_category'); ?>
            <?php
                $htmlOptions = array( 
                   'multiple' => 'true',
                   'class' => 'form-control',
                    'size' => 9,
                  );
                 echo $form->listBox($ModelVast,'video_category', CHtml::listData($ModelCategories->DownloadCategories(), 'category_id', 'category_name'), $htmlOptions);?>
            <?php echo $form->error($ModelVast, 'video_category'); ?>
        </div>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Dodaj',array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
</div>
    <?php $this->endWidget(); ?>
</div>