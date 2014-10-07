<?php
echo Yii::app()->user->id;
$wers = "0.3";
$url = 'http://www.alexie.pl/wersja.xml'; 
$xml = simpleXML_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pulpit</h1>
    </div>
</div>   
<?php
if($xml ===  FALSE) 
{ 
   echo 'wystąpił problem z pobraniem danych!';
} 
else { 
     if ($xml->wer == $wers) {
?>
<div class="row">
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
</div>
<?php
}
   else
        {
       echo '<div class="row">
    <div class="col-lg-3 col-md-6">
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
    </div>
</div>';
           // echo "<font color='red'>Najnowsza wersja to: <b>".$xml->wer."</font></b>";
    }  
        
} 


?>
