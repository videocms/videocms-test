<?php

echo '<h1>'.$this->pageTitle.'</h1>';

foreach($DataVideo as $ModelSite)
{
    echo '<h2>'.CHtml::link($ModelSite['video_title'],array('cmsvideo/video/'.$ModelSite['video_id'])).'</h2>';
    echo '<p class="data"> Data publikacji: '.$ModelSite['video_date'].'</p>';
    echo '<p class="tresc">'.substr($ModelSite['video_text'], 0, 400).'...</p>';
    if($Category[$ModelSite['video_category']] != '')
    {
        echo '<p class="kategoria"> Kategoria: '. CHtml::link($Category[$ModelSite['video_category']], array('cmsvideo/category/'.$ModelSite['video_category'])).'</p>';
        
    }
}

echo '<br /><br />';
$this->widget('CLinkPager', array(
    'pages' => $Site,
))
?>
