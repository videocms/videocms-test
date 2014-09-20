<?php

class VastVideo extends CFormModel
{
    public $vast_id;
    public $vast_title;
    public $vast_source;
    public $vast_link;
    public $vast_source_vast;


    public function rules() {
        return array(
            array('vast_title, vast_source, vast_link', 'required'),
    
        );
    }
    public function attributeLabels()
    {
        return array(
            'vast_id' => 'ID',
            'vast_title' => 'Title',
            'vast_source' => 'Source',
            'vast_link' => 'Link',
            'vast_source_vast' => 'Source Vast',
        );
    }
    
     public function DownloadVast()
    {
        $SelectVast = Yii::app()->db->createCommand('SELECT * FROM videocms_vast');
        $InfVast = $SelectVast->query();
        return $InfVast;
    }
    
    public function DownloadOneVast($id)
    {
        $SelectVast = Yii::app()->db->createCommand('Select * FROM videocms_vast WHERE vast_id = :IdVast');
        $SelectVast->bindValue(':IdVast', $id, PDO::PARAM_INT);
        $InfVast = $SelectVast->query();
        
        return $InfVast;
    }
    
    public function AddVast()
    {
        $AddVast = Yii::app()->db->createCommand('INSERT INTO videocms_vast (vast_title, vast_source, vast_link, vast_source_vast) VALUES (:VastTitle, :VastSource, :VastLink, :VastSourcevast)');
        $AddVast->bindValue(':VastTitle', $this->vast_title, PDO::PARAM_STR);
        $AddVast->bindValue(':VastSource', $this->vast_source, PDO::PARAM_STR);
        $AddVast->bindValue(':VastLink', $this->vast_link, PDO::PARAM_STR);
        $AddVast->bindValue(':VastSourcevast', $this->vast_source_vast, PDO::PARAM_STR);
        $AddVast->execute();
    }
    
    public function DeleteVast($id)
    {
        $DeleteVast = Yii::app()->db->createCommand('DELETE FROM videocms_vast WHERE vast_id = :VastId');
        $DeleteVast->bindValue(':VastId',$id, PDO::PARAM_INT);
        $DeleteVast->execute();
    }
    
    public function SaveVast($id)
    {
        $UpdateVast = Yii::app()->db->createCommand('UPDATE videocms_vast SET vast_title = :VastTitle, vast_source = :VastSource, vast_link = :VastLink, vast_source_vast = :VastSourcevast WHERE vast_id = :VastId');
        
        $UpdateVast->bindValue(':VastTitle',$this->vast_title,PDO::PARAM_STR);
        $UpdateVast->bindValue(':VastSource',$this->vast_source,PDO::PARAM_STR);
        $UpdateVast->bindValue(':VastLink',$this->vast_link,PDO::PARAM_STR);
        $UpdateVast->bindValue(':VastSourcevast', $this->vast_source_vast, PDO::PARAM_STR);
        $UpdateVast->bindValue(':VastId',$id,PDO::PARAM_INT);
        $UpdateVast->execute();
    }
    
   
}
?>