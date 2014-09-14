<?php

foreach ($DataCategory as $ModelCategoryShow)
{
    $Category[$ModelCategoryShow['category_id']] = $ModelCategoryShow['category_name'];
}

foreach ($DataVideo as $ModelSite)
{
    echo '<h1>'.$ModelSite['video_title'].'</h1>';
    echo '<p class="data">Data publikacji: '.$ModelSite['video_date'].'</p>';
    echo '<p class="tresc">'.$ModelSite['video_text'].'</p>';
    if ($Category[$ModelSite['video_category']] != '')
    {
        echo '<p class="kategoria"> Kategoria: '.CHtml::link($Category[$ModelSite['video_category']], array('cmsvideo/category/'.$ModelSite['video_category'])).'</p>';
    }
}

?>
