<?php

 
class CmsvideoVideo extends CFormModel
{
    public $video_title;
    public $video_text;
    public $video_category;
    public $video_date;
    public $video_480p;
    public $video_720p;
    public $video_1080p;
    public $video_image;
    public $video_thumb;
    public $video_published;
    public $player_type;
    public $video_description;
    public $video_keywords;
    public $tag_name;

    public function rules() {
        return array(
            array('video_title, video_text, video_category, video_image, video_thumb, video_published, player_type', 'required'),
            array('video_category', 'numerical', 'integerOnly'=>true),
            array('video_1080p, video_480p, video_720p', 'video_attribute'),
            array('video_title, tag_name', 'length', 'max'=>65),
            array('video_keywords', 'length', 'max'=>255),
            array('video_description', 'length', 'max'=>255),
            array('video_image, video_thumb', 'file','types'=>'jpg, jpeg, gif, png', 'allowEmpty'=>true, 'on'=>'update', 'maxSize'=>'204800'),
        );
    }
    
    
    public function video_attribute($attribute_name){
     if((empty($this->video_1080p)) && (empty($this->video_480p)) && (empty($this->video_720p))){
               $this->addError($attribute_name,
                 'Proszę dodać przynajmniej jedno video!');
        }
    }
    ////// WLASNA REGULA np: array('video_1080p',moja_regula),
   // public function moja_regula($attribute_name){
    // if(empty($this->video_1080p)){
               //$this->addError($attribute_name,
               //  'testowy blad sprawdzam');
    // }
//}
    
    public function attributeLabels() {
        return array(
            'video_id' => 'ID',
            'video_title' => 'Title',
            'video_text' => 'Text',
            'video_category' => 'Category',
            'video_date' => 'Date',
            'video_480p' => '480p',
            'video_720p' => '720p',
            'video_1080p' => '1080p',
            'video_image' => 'Image',
            'video_thumb' => 'Thumbnail',
            'video_published' => 'Published',
            'player_type' => 'Player Typ',
            'video_descriptions' => 'Descriptions',
            'video_keywords' => 'Keywords',
            'tag_name' => 'Tagi'
        );
    }
    
    public function ImageCreate($ImageUpload, $ImageUrl) 
    {
       $ImageUpload->saveAs($ImageUrl);
    }
    public function ImageThumbCreate($ImageUrl, $ThumbUrl) 
    {
        $ImageThumb = new EasyImage($ImageUrl);
        $ImageThumb->resize(346, 230);
        $ImageThumb->crop(320, 180);
        $ImageThumb->save($ThumbUrl);
    }
    
     public function DeleteVideoImage($id)
    {
        $SelectImage = Yii::app()->db->createCommand('SELECT video_image, video_thumb FROM videocms_video WHERE video_id = :VideoId');
        $SelectImage->bindValue(':VideoId', $id, PDO::PARAM_INT);
        $DataImage = $SelectImage->query();
        $Data = $DataImage->read();
        $FileImage = $Data['video_image'];
        $FileThumb = $Data['video_thumb'];

        if (file_exists($FileImage)) {
             unlink($FileImage);
        }
        else {
            echo 'Error deleting Image:'.$FileImage;
        }
        if (file_exists($FileThumb)) {
            unlink($FileThumb);
        }
        else {
            echo 'Error deleting Thumbnail: '.$FileThumb;
        }    
    }
    
    public function CountAllVideo()
    {
        $CountVideo = Yii::app()->db->createCommand('SELECT count(video_id) AS HowVideo FROM videocms_video');
        $AmountVideo = $CountVideo->queryScalar();
        
        return $AmountVideo;
    }
    
    public function SelectVideo($LimitOnSite = 10, $Site = 1)
    {
        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_published = "1" ORDER BY video_id DESC LIMIT :Start, :SetTheLimit');
        $SelectVideo->bindValue(':Start', ($Site * $LimitOnSite), PDO::PARAM_INT);
        $SelectVideo->bindValue(':SetTheLimit', $LimitOnSite, PDO::PARAM_INT);
        
        $DataVideo = $SelectVideo->queryAll();
        return $DataVideo;
    }
    
    public function SelectAdminVideo($LimitOnSite = 10, $Site = 1)
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
        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_category = :IdCategory AND video_published = "1" ORDER BY video_id DESC LIMIT :Start, :SetLimit');
        $SelectVideo->bindValue(':IdCategory', $id, PDO::PARAM_INT);
        $SelectVideo->bindValue(':Start', ($Site * $LimitOnSite), PDO::PARAM_INT);
        $SelectVideo->bindValue(':SetLimit', $LimitOnSite, PDO::PARAM_INT);
        
        $DataVideo = $SelectVideo->queryAll();
        
        return $DataVideo;
    }
    
    public function DownloadVideo($id)
    {
        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_id = :IdVideo AND video_published = "1"');
        $SelectVideo->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $DataVideo = $SelectVideo->queryAll();
        return $DataVideo;
    }
    
    public function DownloadVideoAdmin($id)
    {
        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video AS v INNER JOIN videocms_category AS c ON v.video_category = c.category_id WHERE video_id = :IdVideo');
        $SelectVideo->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $DataVideo = $SelectVideo->queryAll();
        return $DataVideo;
    }
   
    public function AddNewVideo()
    {
        $AddVideo = Yii::app()->db->createCommand('INSERT INTO videocms_video (video_title, video_text, video_category, video_date, video_480p, video_720p, video_1080p, video_thumb, video_image, video_published, player_type, video_description, video_keywords) VALUES (:VideoTitle, :VideoText, :VideoCategory, :VideoDate, :Video480p, :Video720p, :Video1080p, :VideoThumb, :VideoImage, :VideoPublished, :PlayerType, :VideoDescription, :VideoKeywords)');
        $AddVideo->bindValue(':VideoTitle', $this->video_title, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoText', $this->video_text, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoCategory', $this->video_category, PDO::PARAM_INT);
        $AddVideo->bindValue(':VideoDate', NULL, PDO::PARAM_STR);
        $AddVideo->bindValue(':Video480p', $this->video_480p, PDO::PARAM_STR);
        $AddVideo->bindValue(':Video720p', $this->video_720p, PDO::PARAM_STR);
        $AddVideo->bindValue(':Video1080p', $this->video_1080p, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoThumb', $this->video_thumb, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoImage', $this->video_image, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoPublished', $this->video_published, PDO::PARAM_STR);
        $AddVideo->bindValue(':PlayerType', $this->player_type, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoDescription', $this->video_description, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoKeywords', $this->video_keywords, PDO::PARAM_STR);
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
        $AddVideo = Yii::app()->db->createCommand('UPDATE videocms_video SET video_title = :VideoTitle, video_text = :VideoText, video_category = :VideoCategory, video_480p = :Video480p, video_720p = :Video720p, video_1080p = :Video1080p, video_image = :VideoImage, video_thumb = :VideoThumb, video_published = :VideoPublished, player_type = :PlayerType, video_description = :VideoDescription, video_keywords = :VideoKeywords WHERE video_id = :VideoId');
        $AddVideo->bindValue(':VideoTitle', $this->video_title, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoText', $this->video_text, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoCategory', $this->video_category, PDO::PARAM_INT);
        $AddVideo->bindValue(':Video480p', $this->video_480p, PDO::PARAM_STR);
        $AddVideo->bindValue(':Video720p', $this->video_720p, PDO::PARAM_STR);
        $AddVideo->bindValue(':Video1080p', $this->video_1080p, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoThumb', $this->video_thumb, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoImage', $this->video_image, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoPublished', $this->video_published, PDO::PARAM_STR);
        $AddVideo->bindValue(':PlayerType', $this->player_type, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoDescription', $this->video_description, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoKeywords', $this->video_keywords, PDO::PARAM_STR);
        $AddVideo->bindValue(':VideoId', $id, PDO::PARAM_INT);
        $AddVideo->execute();
      }
    
    public function UpdateViews($id)
    {
     $session = Yii::app()->getSession();
     $video_arr = array();
     $ses_arr = array();
     
     if($session['video_arr']) {
        $ses_arr=$session['video_arr']; 
	}
                
        if(!in_array($id, $ses_arr)) {
	    $video_arr = $ses_arr;
            $video_arr[] = $id;
                    
            $SelectViews = Yii::app()->db->createCommand('SELECT video_views FROM videocms_video WHERE video_id = :IdVideo');
            $SelectViews->bindValue(':IdVideo', $id, PDO::PARAM_INT);
            $DataViews = $SelectViews->query();
            $Data = $DataViews->read();
            $Views = $Data['video_views'];

            if($Data) {
               $count = $Views + 1;
            }
            else {
               $count = 1;
            }

            $AddViews = Yii::app()->db->createCommand('UPDATE videocms_video SET video_views = :VideoViews WHERE video_id = :IdVideo');
            $AddViews->bindValue(':IdVideo', $id, PDO::PARAM_INT);
            $AddViews->bindValue(':VideoViews', $count, PDO::PARAM_INT);
            $AddViews->execute();
        
            $session['video_arr']=$video_arr;
        }
    }
    
    public function AddTag($Tag) {
        $AddTag = Yii::app()->db->createCommand('INSERT INTO videocms_tags (tag_name) SELECT * FROM (SELECT :TagName) AS tmp WHERE NOT EXISTS (SELECT tag_name FROM videocms_tags WHERE tag_name = :TagName) LIMIT 1');
        $AddTag->bindValue(':TagName', $Tag, PDO::PARAM_STR);
        $AddTag->execute();   
    }
    
    
    public function UpdateVideoTag($Tag, $Vid) { 
    
        $row = explode(',',$Vid);
        $optionsCategory = array();
        foreach ($row as $optionCatgory) {
      
           $optionsCategory[$optionCatgory] = 'idVideo';
           
        }
            
            
        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_tags SET tag_idvideo = :VideoTag WHERE tag_name = :TagName');
        $UpdateTag->bindValue(':TagName', $Tag, PDO::PARAM_STR);
        $UpdateTag->bindValue(':VideoTag', serialize($optionsCategory), PDO::PARAM_STR);
        $UpdateTag->execute(); 
    }
}
?>