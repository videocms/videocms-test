<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username,
);
?>

<h1>Witaj <?php echo $model->firstname; ?></h1>

<?php 
    if ($status=='success') {
		echo "<p>Twoje konto zostało aktywowane!</p>";
	} else 
        {echo "<p>Twoje konto jest już aktywne! Proszę się zalogować!</p>";}
?>