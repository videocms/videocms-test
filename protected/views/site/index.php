<div class="jumbotron">
<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 980px; height: 380px;">
    <!-- Slides Container -->
    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 980px; height: 380px; overflow: hidden;">
    <?php
        foreach($DataSlider as $ModelSite1)
            {
                echo '<div>
                            <img u="image" src="'.$ModelSite1['slider_image'].'" />
                            <div u="caption" t="MCLIP|B" style="position: absolute; top: 330px; left: 0px;
                                width: 980px; height: 50px; transform: perspective(2000px);">
                                <div style="position: absolute; top: 0px; left: 0px; width: 980px; height: 50px;
                                    background-color: Black; opacity: 0.5; filter: alpha(opacity=50); transform: perspective(2000px);">
                                </div>
                                <div style="position: absolute; top: 0px; left: 0px; width: 980px; height: 50px;
                                    color: White; font-size: 16px; font-weight: bold; line-height: 50px; text-align: center; transform: perspective(2000px);">
                                    '.$ModelSite1['slider_text'].'
                                </div>
                            </div>
                      </div>';
            }
    ?>      
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
</div>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Najnowsze</h3>
    </div>
<?php
    foreach ($ModelCategories as $ModelCategoryShow)
        {
          $Category[$ModelCategoryShow->id] = $ModelCategoryShow->name;  
        }

    foreach($Model as $ModelSite)
        {
            echo '<div class="col-sm-3 col-xs-6 col-md-3">';
            echo CHtml::link('<img id="image" src="/'.$ModelSite->video_thumb.'" class="img-rounded" alt="'.$ModelSite->video_title.'" style="width:100%; height: 150px;">', array('video/'.$ModelSite->video_id));
            echo '<h3>'.CHtml::link($ModelSite->video_title, array('video/'.$ModelSite->video_id)).'</h3>';
            echo '<h5 style="padding-bottom: 5px;"><small>';
            echo substr($ModelSite->video_text, 0, 400);
            echo '<p class="data">Data publikacji: '.$ModelSite->video_date.'</p>';
            

        if($Category[$ModelSite->video_category] != '')
            {
                    echo '<p class="category">Kategoria: '.CHtml::link($Category[$ModelSite->video_category], 
                            array('category/'.$ModelSite->video_category)).'</p>';
            }
            echo '</small></h5>';
            echo '</div>';
        }

        echo '<br /><br />';
        $this->widget('CLinkPager', array('pages' => $Site,)) 
?>
</div>