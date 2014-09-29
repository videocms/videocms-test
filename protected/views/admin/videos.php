<?php
echo '<h1>Wideo</h1>';
echo '<table class="table table-hover" id="lol">';
echo '<tr class="active">';
echo '<th>ID</th>';
echo '<th>Thumb</th>';
echo '<th>Tytuł</th>';
echo '<th>Kategoria</th>';
echo '<th>Video 480p</th>';
echo '<th>Video 720p</th>';
echo '<th>Video 1080p</th>';
echo '<th>Wyświetlenia</th>';
echo '<th>Data</th>';
echo '<th>Public</th>';
echo '<th>Usuń</th>';
echo '<tr>'; 

foreach ($DataCategory as $ModelCategoryShow)
{
    $Category[$ModelCategoryShow['category_id']] = $ModelCategoryShow['category_name'];
}

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
    echo '<td class="'.$RowClass.'">'.CHtml::link('<img src="../'.$ModelVideosShow['video_thumb'].'" style="width: 60px; height: 60px;"/>',array('admin/videoupdate/'.$ModelVideosShow['video_id'])).'</td>';
    echo '<td class="'.$RowClass.'">'.CHtml::link($ModelVideosShow['video_title'],array('admin/videoupdate/'.$ModelVideosShow['video_id'])).'</td>';
    echo '<td class="'.$RowClass.'">'.$Category[$ModelVideosShow['video_category']].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_480p'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_720p'].'</td>';
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_1080p'].'</td>';
    echo '<td class="'.$RowClass.'"><center>'.$ModelVideosShow['video_views'].'</center></td>';
    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_date'].'</td>';
    if ($ModelVideosShow['video_published'] == "1")
    {
        echo '<td class="glyphicon glyphicon-ok"><input type="hidden" class="form-control" placeholder="'.$ModelVideosShow['video_published'].'"></td>';
    }  else {
        echo '<td class="glyphicon glyphicon-remove"><input type="hidden" class="form-control" placeholder="'.$ModelVideosShow['video_published'].'"></td>';
    }
    echo '<td class="'.$RowClass.'">';
    
    echo CHtml::link(
            'Usuń',
            array('admin/videodelete/'.$ModelVideosShow['video_id']),
            array('confirm' => 'Czy na pewno chcesz usunąć ten rekord?'));
   // echo CHtml::ajaxLink(
   // 'delete',
   // array('admin/videodelete/', 'id' => $ModelVideosShow['video_id']), // Yii URL
   // array('update' => '#lol') // jQuery selector
//);
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
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
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
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'player_type'); ?>
        <?php echo $form->dropDownList($ModelVideo, 'player_type', array('video/mp4' => 'mp4', 'video/webm' => 'webm', 'video/ogg' => 'ogg', 'rtmp/mp4' => 'rtmp'));
        ?>
        <?php echo $form->error($ModelVideo, 'player_type'); ?>
    </div>
    
    <?php        
    if ($ImageAdd) {
        echo '<div>Plik został wgrany na serwer</div>';
    }
    ?>
    <div class="row">
    <?php echo $form->labelEx($ModelVideo, 'video_image'); ?>
    <?php echo $form->fileField($ModelVideo, 'video_image'); ?>
    <?php echo $form->error($ModelVideo, 'video_image'); ?>
    </div>
    
    <div class="row">
    <?php echo $form->dropDownList($ModelVideo, 'video_published',
    array(
    '1' => 'Opublikowano',
    '0' => 'Nie opublikowano',
    ),
    array(
    'options' => array('1' => array('selected' => 'selected'))
    )); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_description'); ?>
        <?php echo $form->textField($ModelVideo, 'video_description'); ?>
        <?php echo $form->error($ModelVideo, 'video_description'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'video_keywords'); ?>
        <?php echo $form->textField($ModelVideo, 'video_keywords'); ?>
        <?php echo $form->error($ModelVideo, 'video_keywords'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($ModelVideo, 'tag_name'); ?>
        <?php echo $form->textField($ModelVideo, 'tag_name'); ?>
        <?php echo $form->error($ModelVideo, 'tag_name'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Dodaj'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                //CKEDITOR.replace( 'CmsvideoVideo[video_text]' );
</script>
