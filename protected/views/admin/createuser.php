<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
?>
<div class="row">
    <div class="col-lg-12">
<h1 class="page-header">Tworzenie konta</h1>
    </div>
</div>
<?php 
if (Yii::app()->user->isAdmin() == TRUE)
{echo $this->renderPartial('_form', array('model'=>$model)); }
?>
