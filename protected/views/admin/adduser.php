<div class="row">
    <a href="createuser" class="btn btn-primary btn-lg active" role="button">Dodaj nowego użytkownika</a>
    <div class="col-lg-12">
        <h1 class="page-header">Zarządzanie użytkownikami</h1>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-adduser-grid',
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
        'id',
        'username',
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
                    'url' => 'Yii::app()->createUrl("admin/adduserdelete/".$data->id)',
                ),
                'update' => array
                (
                    'label'=>'',
                    'options'=>array('class' => 'fa fa-pencil fa-lg', 'data-toggle'=>'tooltip', 'title'=>'Edytuj'),
                    'imageUrl'=>'',
                    'url'=> 'Yii::app()->createUrl("admin/userupdate/".$data->id)',
                ),
            ),
        ),
    ),
));
?>

