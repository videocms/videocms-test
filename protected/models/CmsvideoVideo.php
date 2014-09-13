<?php


class CmsvideoVideo extends CFormModel
{
    public $video_title;
    public $video_text;
    public $video_category;
    public $video_date;
    public $video_480p;
    public $video_720p;


    public function rules() {
        return array(
            array('video_title, video_text, video_category', 'required'),
            array('video_category', 'numerical', 'integerOnly'=>true),
            array('video_title', 'length', 'max'=>65),
        );
    }
    
    public function attributeLabels() {
        return array(
            'video_id' => 'ID',
            'video_title' => 'Tytuł',
            'video_text' => 'Treść',
            'video_category' => 'Kategoria',
            'video_date' => 'Data',
            'video_480p' => '480p',
            'video_720p' => '720p',
        );
    }
    
    public function CountAllVideo()
    {
        $CountVideo = Yii::app()->db->createCommand('SELECT count(video_id) AS HowVideo FROM videocms_video');
        $AmountVideo = $CountVideo->queryScalar();
        
        return $AmountVideo;
    }
    
    public function SelectVideo($LimitOnSite = 10, $Site = 1)
    {
        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video ORDER BY video_id DESC LIMIT :Start, :SetTheLimit');
        $SelectVideo->bindValue(':Start', ($Site * $LimitOnSite), PDO::PARAM_INT);
        $SelectVideo->bindValue(':SetTheLimit', $LimitOnSite, PDO::PARAM_INT);
        
        $DataVideo = $SelectVideo->queryAll();
        return $DataVideo;
    }
    
    public function CountVideoCategory($id)
    {
        $CountVideo = Yii::app()->db->createCommand('SELECT count(video_id) AS WhileVideo FROM videocms_video WHERE video_category = :IdCategory');
        $CountVideo->bindValue(':IdCategory', $id, PDO::PARAM_INT);
        $AmountVideo = $CountVideo->queryScalar();
        
        return $AmountVideo;
    }
    
    public function SelectVideoCategory($id,$LimitOnSite,$Site)
    {
        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_category = :IdCategory ORDER BY video_id DESC LIMIT :Start, :SetLimit');
        $SelectVideo->bindValue(':IdCategory', $id, PDO::PARAM_INT);
        $SelectVideo->bindValue(':Start', ($Site * $LimitOnSite), PDO::PARAM_INT);
        $SelectVideo->bindValue(':SetLimit', $LimitOnSite, PDO::PARAM_INT);
        
        $DataVideo = $SelectVideo->queryAll();
        
        return $DataVideo;
    }
    
    public function DownloadVideo($id)
    {
        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_id = :IdVideo');
        $SelectVideo->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $DataVideo = $SelectVideo->queryAll();
        
        return $DataVideo;
    }
    
    public function AddNewVideo()
    {
        $AddVideo = Yii::app()->db->createCommand('INSERT INTO videocms_video (video_title,video_text,video_category,video_date,video_480p,video_720p) VALUES (:VideoTitle, :VideoText, :VideoCategory, :VideoDate, :Video480p, :Video720p)');
        $AddVideo->bindValue(':VideoTitle', $this->video_title, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoText', $this->video_text, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoCategory', $this->video_category, PDO::PARAM_INT);
        $AddVideo->bindValue(':VideoDate', $this->video_date, PDO::PARAM_STR);
        $AddVideo->bindValue(':Video480p', $this->video_480p, PDO::PARAM_STR);
        $AddVideo->bindValue(':Video720p', $this->video_720p, PDO::PARAM_STR);
        $AddVideo->execute();
    }
    
    public function DeleteVideo($id)
    {
        $DeleteVideo = Yii::app()->db->createCommand('DELETE FROM videocms_video WHERE video_id = :IdVideo');
        $DeleteVideo->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $DeleteVideo->execute();
    }
    
    public function UpdateVideo($id)
    {
        $AddVideo = Yii::app()->db->createCommand('UPDATE videocms_video SET video_title = :VideoTitle, video_text = :VideoText, video_category = :VideoCategory, video_480p = :Video480p, video_720p = :Video720p WHERE video_id = :VideoId');
        $AddVideo->bindValue(':VideoTitle', $this->video_title, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoText', $this->video_text, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoCategory', $this->video_category, PDO::PARAM_INT);
        $AddVideo->bindValue(':Video480p', $this->video_480p, PDO::PARAM_INT);
        $AddVideo->bindValue(':Video720p', $this->video_720p, PDO::PARAM_INT);
        $AddVideo->bindValue(':VideoId', $id, PDO::PARAM_INT);
        $AddVideo->execute();
        
        
    }
}
?>