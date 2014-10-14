<?php
//$dupa = Yii::app()->user->username;
//Yii::app()->session['var'] = Yii::app()->user->username;
//echo Yii::app()->session['var'];
//echo '<br>Id Twojej sesji to: '.Yii::app()->getSession()->getSessionId();
//Yii::app()->db->createCommand('UPDATE VideoCMS_sesja SET username="'.Yii::app()->user->username.'" where id="'.Yii::app()->getSession()->getSessionId().'"')->queryRow();
Yii::app()->db->createCommand()->update(
  'VideoCMS_sesja',
  array('username'=>Yii::app()->user->username, 'user_ip'=>Yii::app()->request->userHostAddress),
  'id = :id',
  array(':id'=>Yii::app()->getSession()->getSessionId())
);
//$users = Yii::app()->db->createCommand('select username from VideoCMS_sesja')->queryAll();

//echo $users;
//print_r($users);
//$new = $users;
//echo '<br>';
//$test = implode(",",$new);
//echo $test;


$wers = "0.3";
$url = 'http://www.alexie.pl/wersja.xml'; 
$xml = simpleXML_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA);
?>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'videocms-user-grid',
'htmlOptions'=>array('class'=>'table-responsive'),
'summaryCssClass' => 'dataTables_info',

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
    'columns'=>
     array(
       // 'class'=>'CCheckBoxColumn',
        //'selectableRows' => '10',
         array(
           'value' => '$data->user->lastname',

         ),


),
));
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pulpit</h1>
    </div>
</div> 
<div class="row">
<?php
if($xml ===  FALSE) 
{ 
   echo 'wystąpił problem z pobraniem danych!';
} 
else { 
     if ($xml->wer == $wers) {
?>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-check-circle-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $wers ?></div>
                        <div>Aktualna wersja!</div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <span class="pull-left">Brak aktualizacji systemu!</span>
                <span class="pull-right">
                    <i class=" fa fa-check-circle-o"></i>
                </span>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<?php
}
   else
        {
       echo '<div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-exclamation-triangle fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">'.$wers.'</div>
                        <div>Aktualna to: '.$xml->wer.'!</div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <span class="pull-left">Aktualizacja systemu!</span>
                <span class="pull-right">
                    <i class=" fa fa-arrow-circle-right"></i>
                </span>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>';
           // echo "<font color='red'>Najnowsza wersja to: <b>".$xml->wer."</font></b>";
    }  
        
} 


?>
    <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>New Tasks!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
</div>
<div class="row">
    <div class="col-lg-8">
         <div class="panel panel-primary">
            <div class="panel-heading">CZAT</div>
            <div class="panel-body"><p>
                <div id="disqus_thread"></div>
                <script type="text/javascript">
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = 'videocms-test'; // required: replace example with your forum shortname

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    </p>
            </div>
    </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i> Zalogowani użytkownicy
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?php 
                                $activeUsers = Session::model()->findAll();
                                foreach($activeUsers as $Data) {
                                echo '<a href="#" class="list-group-item">
                                    <i class="fa fa-user fa-fw"></i> '.$Data->username.'
                                    <span class="pull-right text-muted small"><em>'.$Data->user_ip.'</em>
                                    </span>
                                     </a>';
                                 }
                                ?>
                            </div>
                            <a href="admin/users" class="btn btn-default btn-block">Zarządzaj użytkownikami</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
    </div>
</div>
<?php echo 'Twój adres IP to: '.Yii::app()->request->userHostAddress;?> 