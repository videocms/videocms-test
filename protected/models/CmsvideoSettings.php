<?php

class CmsvideoSettings extends CFormModel
{
    public $settings_id;
    public $settings_keywords;
    public $settings_description;
    public $settings_robots;


    public function rules() {
        return array(
            array('settings_keywords, settings_description, settings_robots', 'length', 'max'=>255),
        );
    }
    public function attributeLabels()
    {
        return array(
            'settings_id' => 'ID',
            'settings_keywords' => 'Meta Keywords',
            'settings_description' => 'Meta Descriptions',
            'settings_robots' => 'Meta robots'
        );
    }
    
     public function DownloadSettings()
    {
        $SelectSettings = Yii::app()->db->createCommand('SELECT * FROM videocms_settings');
        $InfSettings = $SelectSettings->query();
        return $InfSettings;
    }
    
    public function DownloadOneSettings($id)
    {
        $SelectSettings = Yii::app()->db->createCommand('Select * FROM videocms_settings WHERE settings_id = :IdSettings');
        $SelectSettings->bindValue(':IdSettings', $id, PDO::PARAM_INT);
        $InfSettings = $SelectSettings->query();
        
        return $InfSettings;
    }
    public function SaveSettings($id)
    {
        $UpdateSettings = Yii::app()->db->createCommand('UPDATE videocms_settings SET settings_keywords = :SettingsKeywords, settings_description = :SettingsDescription, settings_robots = :SettingsRobots WHERE settings_id = :SettingsId');
        $UpdateSettings->bindValue(':SettingsKeywords',$this->settings_keywords,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SettingsDescription',$this->settings_description,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SettingsRobots',$this->settings_robots,PDO::PARAM_STR);
        $UpdateSettings->bindValue(':SettingsId',$id,PDO::PARAM_INT);
        $UpdateSettings->execute();
    }
}

?>