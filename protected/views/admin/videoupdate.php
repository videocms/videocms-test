<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edytuj wideo</h1>
    </div>
</div>
<div class="form">
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'videocms-videos-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <div class="row">
        <div class="col-lg-12">
             <div class="panel panel-default">
                 <div class="panel-heading">Formularz edycji</div>
                 <div class="panel-body">
                 <div class="row">
                     <div class="col-lg-12">
                            <?php 
                                if($VideoUpdate)
                                {
                                    echo '<div class="alert alert-success" role="alert"><p class="note">';
                                    echo 'Wideo zostało zaktualizowane!';
                                    echo '</p></div>';
                                }
                                else {
                                    echo '<div class="alert alert-warning" role="alert"><p class="note">';
                                    echo 'Pola oznaczone <span class="required">*</span> są wymagane.';
                                    echo '</p></div>';
                                }
                                if($form->errorSummary($ModelVideo)) {
                                    echo '<div class="alert alert-danger" role="alert"><p class="note">';
                                    echo $form->errorSummary($ModelVideo);
                                    echo '</p></div>';
                                    $fieldStat = 'has-error';
                                    $iconStat = 'glyphicon-remove';
                                }
                            ?>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_title'); ?>
                <?php echo $form->textField($ModelVideo, 'video_title', array('size' => 60, 'maxlength' => 65, 'class' => 'form-control', 'placeholder' => 'Tytuł')); ?>
                <?php echo $form->error($ModelVideo, 'video_title'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($ModelVideo, 'video_text'); ?>
                    <?php echo $form->textArea($ModelVideo, 'video_text'); ?>
                    <?php echo $form->error($ModelVideo, 'video_text'); ?>
                </div>
            </div>
      <div class="col-lg-6">
          <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_alias'); ?>
                <?php echo $form->textField($ModelVideo, 'video_alias', array('class' => 'form-control', 'placeholder' => 'Alias', 'readonly' => true)); ?>
                <?php echo $form->error($ModelVideo, 'video_alias'); ?>
          </div>
          <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_image'); ?>
                <div id="upload">
                    <div class='col-lg-4'>
                       <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $ModelVideo->video_thumb; ?>" class="img-thumbnail" style="height: 80px;"/>
                    </div>
                 <div class='col-lg-8'>
                    <?php echo $form->textField($ModelVideo, 'video_image',array('readonly'=>true, 'class' => 'form-control')); ?>
                    <input class="btn btn-default btn-sm" style="margin-top:14px;" name="upload1" type="button" value="zmien" onclick="changeMode()" />     
                 </div>
                </div>  
                 <?php echo $form->error($ModelVideo, 'video_image'); ?>
              <div class='clearfix'></div>
            </div>
           
            <div class="form-group">
                <?php echo $form->textField($ModelVideo, 'video_thumb',array('hidden'=>true)); ?>
                <?php echo $form->error($ModelVideo, 'video_thumb'); ?>
            </div>
           <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_type'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'video_type', array('url' => 'Direct Url', 'upload' => 'General Upload'),array('class' => 'form-control', 'onchange'=>'javascript:changeType(this.options[this.selectedIndex].value);'));?>
                <?php echo $form->error($ModelVideo, 'video_type'); ?>
               </div>
             <div id="url_video_480p" class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_480p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_480p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 480p')); ?> 
                <?php echo $form->error($ModelVideo, 'video_480p', array('class' => 'text-danger')); ?>
             </div>
            <div id="url_video_720p" class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_720p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_720p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 720p')); ?>
                <?php echo $form->error($ModelVideo, 'video_720p', array('class' => 'text-danger')); ?>
            </div>
            <div id="url_video_1080p" class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_1080p'); ?>
                <?php echo $form->textField($ModelVideo, 'video_1080p', array('class' => 'form-control', 'placeholder' => 'Link do rozdzielczości 1080p')); ?>
                <?php echo $form->error($ModelVideo, 'video_1080p', array('class' => 'text-danger')); ?> 
            </div>
            <div class="form-group">
                <?php   $parents = CmsvideoCategories::model()->findAll('parent_id = 1');
                        $cm = new CommonMethods();
                        $data = $cm->makeDropDown($parents);
                ?>
                <?php echo $form->labelEx($ModelVideo, 'video_category'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'video_category',$data, array('class' => 'form-control')); ?>
                <?php echo $form->error($ModelVideo, 'video_category'); ?>
            </div> 
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'player_type'); ?>
                <?php echo $form->dropDownList($ModelVideo, 'player_type', array('video/mp4' => 'mp4', 'video/webm' => 'webm', 'video/ogg' => 'ogg', 'rtmp/mp4' => 'rtmp'),array('class' => 'form-control'));?>
                <?php echo $form->error($ModelVideo, 'player_type'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'tag_slug'); ?>
                <?php
                $tagi = Tags::model()->findAll(
                    'tag_idvideo LIKE :Id',
                    array(':Id' => '%"'.$ModelVideo->video_id.'"%')
                );
                ?>

                <div class="panel panel-default">
                        <div class="panel-body">
                        <?php foreach($tagi as $data) { ?>
                    
                        <div class="checkbox-inline checkbox-tag" id="<?php echo $data->tag_slug;?>">
                        <input type="checkbox" name="c" class="checkbox checkbox-tag-delete" onclick="showMe('<?php echo $data->tag_slug;?>'), deleteTag(), tagname()"/>
                        <span><?php echo $data->tag_name;?></span>
                        </div>
                   
                <?php } ?>
                           <?php echo CHtml::script("
                    function split(val) { return val.split(/,\s*/); }
                    function extractLast(term) { return split(term).pop(); } 
                    ")?>
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                  'model'=>$ModelVideo,
                  'attribute'=>'tag_slug',
                  'source'=>"js:function(request, response) {
                     $.getJSON('".$this->createUrl('admin/autocompletetag')."', {
                       term: extractLast(request.term)
                     }, response);
                     }",
                  'options'=>array(
                    'delay'=>300,
                    'minLength'=>2,
                    'showAnim'=>'fold',
                    'select'=>"js:function(event, ui) {
                        var terms = split(this.value);
                        terms.pop();
                        terms.push( ui.item.value );
                        terms.push('');
                        this.value = terms.join(',');
                        return false;
                      }"
                  ),
                  'htmlOptions'=>array('size'=>'40', 'class' => 'checkbox-tag-input', 'placeholder' => 'Wpisz odpowiednie tagi, oddzielając je przecinkami.'),
                 ));?>
                        </div>
                    </div>   
            </div>           
            <div class="form-group">      
                <?php echo $form->hiddenField($ModelVideo, 'tag_delete', array('type'=>"hidden")); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ModelVideo, 'video_description'); ?>
                <?php echo $form->textField($ModelVideo, 'video_description', array('class' => 'form-control', 'placeholder' => 'Wpisz odpowiedni opis dla wideo (do 160 znaków).', 'maxlength'=>160)); ?>
                <?php echo $form->error($ModelVideo, 'video_description'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($ModelVideo, 'video_keywords'); ?>
                    <?php echo $form->textField($ModelVideo, 'video_keywords', array('class' => 'form-control', 'placeholder' => 'Wpisz odpowiednie słowa kluczowe, oddzielając je przecinkami')); ?>
                    <?php echo $form->error($ModelVideo, 'video_keywords'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($ModelVideo, 'video_published'); ?>
                    <?php echo $form->dropDownList($ModelVideo, 'video_published',array('1' => 'Opublikowano', '0' => 'Nie opublikowano'),array('options' => array('1' => array('selected' => 'selected')), 'class' => 'form-control')); ?>                      
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                        <?php echo $form->checkBox($ModelVideo,'video_slider', array('value'=>1, 'uncheckValue'=>0)); ?>
                        <?php echo 'Dodaj video do slidera'; ?>
                        </label>
                    </div>
                    <?php echo $form->error($ModelVideo,'video_slider'); ?>              
                </div>
                <div class="form-group">
                    <?php echo CHtml::submitButton('Aktualizuj', array('class' => 'btn btn-success')); ?>
                    <?php echo CHtml::link('Anuluj',array('admin/videos'),array('class'=>'btn btn-danger')); ?>
                </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</div>
    
    <?php $this->endWidget(); ?>
</div>
   <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
     $.noConflict();
function changeMode() {
    var mode;
    mode='<?php echo $form->fileField($ModelVideo, 'video_image'); ?><?php echo '<br />'.$form->labelEx($ModelVideo, 'video_imageurl').$form->textField($ModelVideo, 'video_imageurl', array('class' => 'form-control', 'placeholder' => 'Url obrazka')); ?>';
	document.getElementById('upload').innerHTML = mode;
}
 </script>
<script type="text/javascript">
function deleteTag(check) {
    var checked = [];
    $('input:checkbox:checked').each(function() {
        checked.push( $(this).next('span').text() );
    });
        $('#CmsvideoVideo_tag_delete').val(checked.join(","));
}
function tagname(check) {
    var checked = [];
    $('input:checkbox:not(:checked)').each(function() {
        checked.push( $(this).next('span').text() );
    });
        $('#CmsvideoVideo_tag_slug').val(checked.join(","));
}
function showMe(box) {
    var chboxs = document.getElementsByName("c");
    var vis = "block";
    for(var i=0;i<chboxs.length;i++) { 
        if(chboxs[i].checked){
         vis = "none";
            break;
        }
    }
    document.getElementById(box).style.display = vis;
}
 </script>
 
<script>tinymce.init({
         selector: "textarea",theme: "modern",width: '100%',height: 380,
             });
</script>

<script type="text/javascript">
var type            = document.getElementById("CmsvideoVideo_video_type");
changeType('url');

function changeType(typ) {
	document.getElementById('url_video_480p').style.display              = "none";
	document.getElementById('url_video_720p').style.display                 = "none";
	document.getElementById('url_video_1080p').style.display              = "none";
    switch(typ) {
		case 'url' :
			document.getElementById('url_video_480p').style.display      = "";
			document.getElementById('url_video_720p').style.display         = "";
			document.getElementById('url_video_1080p').style.display      = "";
			break;
		case 'upload':
//			document.getElementById('url_video_480p').style.display      = "";
//			document.getElementById('url_video_720p').style.display         = "";
//			document.getElementById('url_video_1080p').style.display      = "";
			break;
	}	
}
</script>