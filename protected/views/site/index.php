<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px;">
    <!-- Slides Container -->
    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 300px;
            overflow: hidden;">
        <?php
foreach($DataSlider as $ModelSite1)
{
    echo '<div>
                <img u="image" src="'.$ModelSite1['slider_image'].'" />
                <div u="caption" t="MCLIP|B" style="position: absolute; top: 250px; left: 0px;
                    width: 600px; height: 50px;">
                    <div style="position: absolute; top: 0px; left: 0px; width: 600px; height: 50px;
                        background-color: Black; opacity: 0.5; filter: alpha(opacity=50);">
                    </div>
                    <div style="position: absolute; top: 0px; left: 0px; width: 600px; height: 50px;
                        color: White; font-size: 16px; font-weight: bold; line-height: 50px; text-align: center;">
                        '.$ModelSite1['slider_text'].'
                    </div>
                </div>
            </div>';
     
}?>      
    </div>
     <style>
            /* jssor slider arrow navigator skin 03 css */
            /*
            .jssora03l              (normal)
            .jssora03r              (normal)
            .jssora03l:hover        (normal mouseover)
            .jssora03r:hover        (normal mouseover)
            .jssora03ldn            (mousedown)
            .jssora03rdn            (mousedown)
            */
            .jssora14l, .jssora14r, .jssora14ldn, .jssora14rdn
            {
            	position: absolute;
            	cursor: pointer;
            	display: block;
                background: url(<?php echo Yii::app()->request->baseUrl; ?>/js/slider-jquery/img/a14.png) no-repeat;
                overflow:hidden;
            }
            .jssora14l { background-position: -15px -35px; }
            .jssora14r { background-position: -75px -35px; }
            .jssora14l:hover { background-position: -135px -35px; }
            .jssora14r:hover { background-position: -195px -35px; }
            .jssora14ldn { background-position: -255px -35px; }
            .jssora14rdn { background-position: -315px -35px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora14l" style="width: 30px; height: 50px; top: 123px; left: 0px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora14r" style="width: 30px; height: 50px; top: 123px; right: 0px">
        </span>
        <!-- Arrow Navigator Skin End -->
</div>

<?php

foreach ($DataCategory as $ModelCategoryShow)
{
  $Category[$ModelCategoryShow[category_id]] = $ModelCategoryShow['category_name'];  
}

foreach($DataVideo as $ModelSite)
{
    echo '<h2>'.CHtml::link($ModelSite['video_title'], array('video/'.$ModelSite['video_id'])).'</h2>';
    echo '<p class="data">Data publikacji: '.$ModelSite['video_date'].'</p>';
    echo '<img src="/'.$ModelSite['video_thumb'].'">';
    echo '<p class="tresc">'.substr($ModelSite['video_text'], 0, 400).'...</p>';
   ?> <!--echo '<p class="data">video: '.$ModelSite['video_480p'].'</p>'; -->
  
   
   <?php
    if($Category[$ModelSite['video_category']] != '')
    {
        echo '<p class="category">Kategoria: '.CHtml::link($Category[$ModelSite['video_category']], array('category/'.$ModelSite['video_category'])).'</p>';
    }
}

echo '<br /><br />';

$this->widget('CLinkPager', array(
    'pages' => $Site,
))
        
        
?>