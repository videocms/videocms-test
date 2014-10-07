<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<div class="row">
    <div class="col-lg-12">
<h1 class="page-header">Edycja konta: <?php echo $model->username; ?></h1>
    </div>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>