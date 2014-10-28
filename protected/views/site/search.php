<div class="container">
    <div class="row column">
        <div class="container">
<?php 

//    $this->widget('zii.widgets.grid.CGridView', array(
//    'id'=>'video_title-grid',
//    'dataProvider'=>$model->search_model(),
//    //'filter'=>$model,
//    'columns'=>array(
//        'video_title',
//        array(
//            'class'=>'CButtonColumn',
//        ),
//    ),
//)); 
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$model->search_model(),
    'htmlOptions'=>array('class'=>''),
    'summaryCssClass' => '',
    'emptyText' => 'Nic nie znaleziono.',
    'itemView'=>'_search',   // refers to the partial view named '_post'
    'pager'=>array( 
    'cssFile'=>false,   
    'header'=>'',           
    'maxButtonCount'=>'7',
    'selectedPageCssClass'=>'active',
    'htmlOptions'=>array(
            'class'=>'pagination'
        ),
        ),
    'template' => '<div class="alert alert-info fade in" role="alert">{summary}</div>{items}<div class="row"><div class="col-md-4"></div> {sorter}<div class="col-md-8">{pager}<br /></div></div>',
    'template'=>'{items}<div class="col-sm-4">{summary}</div>{sorter}<div class="col-sm-8">{pager}</div>',
    'pagerCssClass'=>'dataTables_paginate paging_simple_numbers',
    'itemsCssClass'=>'table table-striped table-hover dataTable no-footer',
    'sortableAttributes'=>array(
        'video_title',
    ),
));
    ?>
        </div>
    </div>
</div>