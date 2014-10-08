<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<div class="container">
        <div class="col-lg-8 col-lg-offset-2 text-center">
	  <div class="logo">
	    <h1>OPPS, <?php echo $code; ?></h1>
          </div><br /><br />
            <div class="clearfix"></div>
            <br /><br />
            <div class="alert alert-danger" role="alert"><?php echo CHtml::encode($message); ?></div>
          <div class="clearfix"></div>
             <br /><br />
            <div class="clearfix"></div>
            <br />
                <div class="col-lg-6  col-lg-offset-3">
		  <div class="btn-group btn-group-justified">
		      <a href="javascript:history.back()" class="btn btn-primary">Cofnij</a>
                      <a href="/" class="btn btn-success">Strona główna</a> 
		  </div>
                        
                </div>
            
        </div>
              
</div>