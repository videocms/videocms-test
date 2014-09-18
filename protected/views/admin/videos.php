<?php
echo '<h1>Wideo</h1>';
echo '<table style="width: 850px;">';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Tytuł</th>';
echo '<th>Video 480p</th>';
echo '<th>Video 720p</th>';
echo '<th>Video 1080p</th>';
echo '<th>Data</th>';
echo '<th>Edytuj</th>';
echo '<th>Usuń</th>';
echo '<tr>';

foreach($Data as $ModelVideosShow)
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
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_id'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_title'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_480p'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_720p'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_1080p'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_date'].'</td>';
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link('Edytuj',array('admin/videoupdate/'.$ModelVideosShow['video_id']));
    echo '</td>';
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link(
            'Usuń',
            array('admin/videodelete/'.$ModelVideosShow['video_id']),
            array('confirm' => 'Czy na pewno chcesz usunąć ten rekord?'));
    echo '</td>';
    echo '<tr>';
}

echo '</table>';
echo '<br /><br />';

$this->widget('CLinkPager', array(
    'pages' => $Site,
))
        
?>

<div class="form">
    <h2 class="admin">Dodaj nowe wideo</h2>
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-video-form',
        'enableAjaxValidation'=>false,
    ));
    ?>
    
    
    <p class="note">Pola oznacone <span class="required">*</span> są wymagane.</p>
    
    <?php echo $form->errorSummary($ModelVideo); ?>
    <?php  
    if($VideoAdd)
    {
        echo '<div>Nowe wideo zostało dodane.</div>';
    }
    ?>
    
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_title'); ?>
        <?php echo $form->textField($ModelVideo, 'video_title', array('size' => 60, 'maxlength' => 65)); ?>
        <?php echo $form->error($ModelVideo, 'video_title'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_text'); ?>
        <?php echo $form->textArea($ModelVideo, 'video_text', array('rows' => 25, 'cols' => 50)); ?>
        <?php echo $form->error($ModelVideo, 'video_text'); ?>
    </div>
     <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_480p'); ?>
        <?php echo $form->textField($ModelVideo, 'video_480p'); ?>
        <?php echo $form->error($ModelVideo, 'video_480p'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_720p'); ?>
        <?php echo $form->textField($ModelVideo, 'video_720p'); ?>
        <?php echo $form->error($ModelVideo, 'video_720p'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_1080p'); ?>
        <?php echo $form->textField($ModelVideo, 'video_1080p'); ?>
        <?php echo $form->error($ModelVideo, 'video_1080p'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_category'); ?>
        <?php echo $form->dropDownList($ModelVideo, 'video_category', CHtml::listData($ModelCategories->DownloadCategories(), 'category_id', 'category_name'), array('style'=>'width: 400px;')
                ); 
        ?>
        <?php echo $form->error($ModelVideo, 'video_category'); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Dodaj'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
 <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'CmsvideoVideo[video_text]' );
            </script>
