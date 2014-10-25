<?php

class CmsvideoSettings extends CFormModel
{
    public $settings_id;
    public $settings_keywords;
    public $settings_description;
    public $settings_robots;
    public $settings_ogdescription;
    public $settings_ogimage;
    public $settings_ogurl;
    public $settings_ogtitle;
    public $settings_fb;
    public $slider_duration;
    public $slider_arrow;
    public $slider_dragorientation;
    public $slider_slidespacing;
    public $slider_mindragoffsettoslide;
    public $slider_loop;
    public $slider_hwa;
    public $slider_arrowkeynavigation;
    public $slider_lazyloading;
    public $disqus_shortname;
    public $player_autoplay;
    public $player_preload;
    public $player_loop;


    public function rules() {
        return array(
            array('settings_keywords, settings_description, settings_robots, settings_ogdescription, settings_ogimage, settings_ogurl, settings_ogtitle, settings_fb, slider_duration, slider_arrow, slider_dragorientation, slider_slidespacing, slider_mindragoffsettoslide, slider_loop, slider_hwa, slider_arrowkeynavigation, slider_lazyloading, disqus_shortname, player_autoplay, player_preload, player_loop', 'length', 'max'=>255),
        );
    }
    public function attributeLabels()
    {
        return array(
            'settings_id' => 'ID',
            'settings_keywords' => 'Meta Keywords',
            'settings_description' => 'Meta Descriptions',
            'settings_robots' => 'Meta robots',
            'settings_ogdescription' => 'OgDescription',
            'settings_ogimage' => 'OgImage',
            'settings_ogurl' => 'OgUrl',
            'settings_ogtitle' => 'OgTitle',
            'settings_fb' => 'FB',
            'slider_duration' => 'speed',
            'slider_dragorientation' => 'Drag orientacja',
            'slider_slidespacing' => 'Odstępy miedzy zdjęciami',
            'slider_mindragoffsettoslide' => 'czułość slide',
            'slider_loop' => 'powtarzanie',
            'slider_hwa' => 'HWA',
            'slider_arrowkeynavigation' => 'Działanie klawiatury',
            'slider_lazyloading' => 'Lazy Load',
            'slider_arrow' => 'szczalki',
            'disqus_shortname' => 'name disqus',
            'player_autoplay' => 'Player autoplay?',
            'player_preload' => 'Player preload',
            'player_loop' => 'player loop'
        );
    }
    
     public function DownloadSettings()
    {
        $SelectSettings = Yii::app()->db->createCommand('SELECT * FROM videocms_settings');
        $InfSettings = $SelectSettings->query();
        return $InfSettings;
    }
    
    public function DownloadOneSettings()
    {
        $SelectSettings = Yii::app()->db->createCommand('Select * FROM videocms_settings WHERE settings_id = :IdSettings');
        $SelectSettings->bindValue(':IdSettings', '1', PDO::PARAM_INT);
        $InfSettings = $SelectSettings->query();
        
        return $InfSettings;
    }
    public function SaveSettings()
    {
        $UpdateSettings = Yii::app()->db->createCommand('UPDATE videocms_settings SET settings_keywords = :SettingsKeywords, settings_description = :SettingsDescription, settings_robots = :SettingsRobots, settings_ogdescription = :OgDescription, settings_ogimage = :OgImage, settings_ogurl = :OgUrl, settings_ogtitle = :OgTitle, settings_fb = :Fb, slider_duration = :SliderDuration, slider_arrow = :SliderArrow, slider_dragorientation = :SliderDragorien, slider_slidespacing = :SliderSlidespacing, slider_mindragoffsettoslide = :SliderMindragoff, slider_loop = :SliderLoop, slider_hwa = :SliderHwa, slider_arrowkeynavigation = :SliderArrowkey, slider_lazyloading = :SliderLazyload, disqus_shortname = :DisqusShortname, player_autoplay = :PlayerAutoplay, player_preload = :PlayerPreload, player_loop = :PlayerLoop WHERE settings_id = :SettingsId');
        $UpdateSettings->bindValue(':SettingsKeywords',$this->settings_keywords,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SettingsDescription',$this->settings_description,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SettingsRobots',$this->settings_robots,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':OgDescription',$this->settings_ogdescription,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':OgImage',$this->settings_ogimage,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':OgUrl',$this->settings_ogurl,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':OgTitle',$this->settings_ogtitle,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':Fb',$this->settings_fb,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SliderDuration',$this->slider_duration,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SliderArrow',$this->slider_arrow,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SliderDragorien',$this->slider_dragorientation,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SliderSlidespacing',$this->slider_slidespacing,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SliderMindragoff',$this->slider_mindragoffsettoslide,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SliderLoop',$this->slider_loop,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SliderHwa',$this->slider_hwa,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SliderArrowkey',$this->slider_arrowkeynavigation,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SliderLazyload',$this->slider_lazyloading,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':DisqusShortname', $this->disqus_shortname,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':PlayerAutoplay', $this->player_autoplay,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':PlayerPreload', $this->player_preload, PDO::PARAM_STR);
        $UpdateSettings->bindValue(':PlayerLoop', $this->player_loop, PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SettingsId','1',PDO::PARAM_INT);
        $UpdateSettings->execute();
    }
}

?>