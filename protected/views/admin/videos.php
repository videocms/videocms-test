<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Wideo</h1>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-videos-grid',
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
       // 'class'=>'CCheckBoxColumn',
        //'selectableRows' => '10',
        array(
              'type' => 'raw',
              'class'=>'ImageLinkColumn',
              'urlExpression'=>'array("admin/videoupdate/".$data->video_id)',
              'value' => 'CHtml::image("/" . $data->video_thumb, $data->video_title, array("style"=>"width: auto; height: 60px;", "class"=>"img-thumbnail"))',
            ),
        'video_id',
        'video_title',
//        'video_alias',
//        'video_text',
        'video_category',
        'video_date',
        //'video_480p',
       // 'video_720p',
       // 'video_1080p',
        'video_published',
       // 'player_type',
//        'video_descriptions',
//        'video_keywords',
      //  'video_tags',
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
                    'url' => 'Yii::app()->createUrl("admin/videodelete/".$data->video_id)',
                ),
                'update' => array
                (
                    'label'=>'',
                    'options'=>array('class' => 'fa fa-pencil fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Edytuj'),
                    'imageUrl'=>'',
                    'url'=> 'Yii::app()->createUrl("admin/videoupdate/".$data->video_id)',
                ),
            ),
        ),
),
));
?>
<?php
//echo '<table class="table table-hover" id="lol">';
//echo '<tr class="active">';
//echo '<th>Thumb</th>';
//echo '<th>Tytuł</th>';
//echo '<th>Tagi</th>';
//echo '<th>Wyświetlenia</th>';
//echo '<th>Data dodania</th>';
//echo '<th>Public</th>';
//echo '<th>Usuń</th>';
//echo '<tr>'; 
//
//foreach ($DataCategory as $ModelCategoryShow)
//{
//    $Category[$ModelCategoryShow['category_id']] = $ModelCategoryShow['category_name'];
//}
//
//foreach($Data as $ModelVideosShow)
//{
//    if($Class == 0)
//    {
//        $Class = 1;
//        $RowClass = 'row1';
//    }
//    else 
//    {
//        $Class = 0;
//        $RowClass = 'row2';
//    }
//    echo '<tr>';
//    echo '<td class="'.$RowClass.'">'.CHtml::link('<img src="../'.$ModelVideosShow['video_thumb'].'" style="width: 60px; height: 60px;"/>',array('admin/videoupdate/'.$ModelVideosShow['video_id'])).'</td>';
//    echo '<td class="'.$RowClass.'">'.CHtml::link($ModelVideosShow['video_title'],array('admin/videoupdate/'.$ModelVideosShow['video_id'])).'<br />';
//    echo $Category[$ModelVideosShow['video_category']].'</td>';
//    echo '<td class="'.$RowClass.'"><center>';
//    if(!empty($ModelVideosShow['video_tags'])) {
//    foreach(unserialize($ModelVideosShow['video_tags']) as $Tag) {echo $Tag.' ';} }
//    echo '</center></td>';
//    echo '<td class="'.$RowClass.'"><center>'.$ModelVideosShow['video_views'].'</center></td>';
//    echo '<td class="'.$RowClass.'">'.$ModelVideosShow['video_date'].'</td>';
//    if ($ModelVideosShow['video_published'] == "1")
//    {
//        echo '<td class="glyphicon glyphicon-ok"><input type="hidden" class="form-control" placeholder="'.$ModelVideosShow['video_published'].'"></td>';
//    }  else {
//        echo '<td class="glyphicon glyphicon-remove"><input type="hidden" class="form-control" placeholder="'.$ModelVideosShow['video_published'].'"></td>';
//    }
//    echo '<td class="'.$RowClass.'">';
//    
//    echo CHtml::link(
//            'Usuń',
//            array('admin/videodelete/'.$ModelVideosShow['video_id']),
//            array('confirm' => 'Czy na pewno chcesz usunąć ten rekord?', 'class' => 'btn btn-danger btn-sm'));
//   // echo CHtml::ajaxLink(
//   // 'delete',
//   // array('admin/videodelete/', 'id' => $ModelVideosShow['video_id']), // Yii URL
//   // array('update' => '#lol') // jQuery selector
////);
//    echo '</td>';
//    echo '<tr>';
//}
//
//echo '</table>';
//echo '<br /><br />';
//
//$this->widget('CLinkPager', array(
//    'pages' => $Site,
//))
//        
?>

<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-video-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
  
    
    <div class="row">
        <?php //echo $form->errorSummary($ModelVideo); ?>
        <?php  
        if($VideoAdd)
        {
            echo '<div class="alert alert-success" role="alert">Nowe wideo zostało dodane!</div>';
        }

    if (($form->errorSummary($ModelVideo) == true))
    {
     echo '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
     echo $form->errorSummary($ModelVideo);
    echo '</div>';}
     ?>
        <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Dodaj nowe wideo</div>
            <div class="panel-body">
            <div class="row">
            <div class="col-lg-12">
            <div class="alert alert-warning" role="alert">
                <p class="note">Pola oznacone <span class="required">*</span> są wymagane.</p>
            </div>
            </div>
            <div class="col-lg-6">
                <?php
                 if (($form->error($ModelVideo, 'video_title') != true))
                 {
                ?>
                <div class="form-group">
            <?php echo $form->labelEx($ModelVideo, 'video_title'); ?>
            <?php echo $form->textField($ModelVideo, 'video_title', array('size' => 60, 'maxlength' => 65, 'class' => 'form-control', 'placeholder' => 'Tytuł')); ?>
                </div>
            <?php
                 } else {
            ?>
            <div class="form-group has-error has-feedback">
            <?php echo $form->labelEx($ModelVideo, 'video_title', array('class' => 'control-label', 'for' => 'inputError2')); ?>
            <?php echo $form->textField($ModelVideo, 'video_title', array('size' => 60, 'maxlength' => 65, 'class' => 'form-control', 'placeholder' => 'Tytuł', 'id' => 'inputError2')); ?>
            <?php echo $form->error($ModelVideo, 'video_title', array('class' => 'text-danger')); ?>
            </div>
            <?php   }?> 
                
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_text'); ?>
                <?php echo $form->textArea($ModelVideo, 'video_text'); ?>
                <?php echo $form->error($ModelVideo, 'video_text', array('class' => 'text-danger')); ?> 
            </div>
            </div>
           <div class="col-lg-6">
               <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_alias'); ?>
                <?php echo $form->textField($ModelVideo, 'video_alias', array('class' => 'form-control', 'placeholder' => 'Alias', 'readonly' => true)); ?>
                <?php echo $form->error($ModelVideo, 'video_alias'); ?>
               </div>
             <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_480p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_480p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 480p')); ?> 
                <?php echo $form->error($ModelVideo, 'video_480p', array('class' => 'text-danger')); ?> 
             </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_720p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_720p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 720p')); ?>
                <?php echo $form->error($ModelVideo, 'video_720p', array('class' => 'text-danger')); ?> 
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_1080p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_1080p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 1080p')); ?>
                <?php echo $form->error($ModelVideo, 'video_1080p', array('class' => 'text-danger')); ?> 
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_category'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'video_category', CHtml::listData(CmsvideoCategories::model()->findAll(), 'category_id', 'category_name'), array('class' => 'form-control')); ?>
                
                <?php echo $form->error($ModelVideo, 'video_category'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'player_type'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'player_type', array('video/mp4' => 'mp4', 'video/webm' => 'webm', 'video/ogg' => 'ogg', 'rtmp/mp4' => 'rtmp'),array('class' => 'form-control'));?>
                <?php echo $form->error($ModelVideo, 'player_type'); ?>
            </div>
            <div class="form-group">
                <?php if ($ImageAdd) {echo '<div>Plik został wgrany na serwer</div>';} ?>
                <?php echo $form->labelEx($ModelVideo, 'video_image'); ?>
                <?php echo $form->fileField($ModelVideo, 'video_image'); ?>
                <?php echo $form->error($ModelVideo, 'video_image', array('class' => 'text-danger')); ?> 
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_description'); ?>
                <?php echo $form->textField($ModelVideo, 'video_description', array('class' => 'form-control', 'placeholder' => 'Opis wideo')); ?>
                <?php echo $form->error($ModelVideo, 'video_description'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_keywords'); ?>
                <?php echo $form->textField($ModelVideo, 'video_keywords', array('class' => 'form-control', 'placeholder' => 'Słowa kluczowe')); ?>
                <?php echo $form->error($ModelVideo, 'video_keywords'); ?>
            </div>
             <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'tag_name'); ?>
                <?php echo $form->textField($ModelVideo, 'tag_name', array('class' => 'form-control', 'placeholder' => 'Tagi')); ?>
                <?php echo $form->error($ModelVideo, 'tag_name', array('class' => 'text-danger')); ?> 
             </div>
            <div class="form-group">
                <?php echo $form->dropDownList($ModelVideo, 'video_published',array('1' => 'Opublikowano', '0' => 'Nie opublikowano'),array('options' => array('1' => array('selected' => 'selected')), 'class' => 'form-control')); ?>            </div>
            <div class="form-group">
                <?php echo CHtml::submitButton('Dodaj', array('class' => 'btn btn-success')); ?>
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
 var title = $('#CmsvideoVideo_video_title'),
    slug = $('#CmsvideoVideo_video_alias');

title.on('keyup', function() {
  var val = $(this).val();
  val = val.toLowerCase()
    .replace(/ /g, '-');
  slug.val(val);
});
</script>
<script type="text/javascript">
 var tags = $('#CmsvideoVideo_tag_name'),
    keywords = $('#CmsvideoVideo_video_keywords');

tags.on('keyup', function() {
  var val = $(this).val();
  keywords.val(val);
});
</script>