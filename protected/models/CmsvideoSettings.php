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


    public function rules() {
        return array(
            array('settings_keywords, settings_description, settings_robots, settings_ogdescription, settings_ogimage, settings_ogurl, settings_ogtitle, settings_fb', 'length', 'max'=>255),
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
            'settings_fb' => 'FB'
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
        $UpdateSettings = Yii::app()->db->createCommand('UPDATE videocms_settings SET settings_keywords = :SettingsKeywords, settings_description = :SettingsDescription, settings_robots = :SettingsRobots, settings_ogdescription = :OgDescription, settings_ogimage = :OgImage, settings_ogurl = :OgUrl, settings_ogtitle = :OgTitle, settings_fb = :Fb WHERE settings_id = :SettingsId');
        $UpdateSettings->bindValue(':SettingsKeywords',$this->settings_keywords,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SettingsDescription',$this->settings_description,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SettingsRobots',$this->settings_robots,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':OgDescription',$this->settings_ogdescription,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':OgImage',$this->settings_ogimage,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':OgUrl',$this->settings_ogurl,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':OgTitle',$this->settings_ogtitle,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':Fb',$this->settings_fb,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SettingsId','1',PDO::PARAM_INT);
        $UpdateSettings->execute();
    }
}

?>