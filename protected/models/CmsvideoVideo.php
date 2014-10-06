<?php
class CmsvideoVideo extends CActiveRecord
{
    public $tag_id;
    public $tag_name;
    public $tag_delete;
    public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

    public function tableName()
        {
             return 'videocms_video';
        }
        
        public function rules() {
        return array(
            array('video_title, video_text, video_category, video_image, video_thumb, video_published, player_type', 'required'),
            array('video_category', 'numerical', 'integerOnly'=>true),
            array('video_1080p, video_480p, video_720p', 'video_attribute'),
            array('video_title', 'length', 'max'=>65),
           // array('video_alias, video_description, video_keywords', 'length', 'max'=>255),
            array('video_alias, video_description, video_keywords, tag_delete, tag_name', 'length', 'max'=>255),
            array('video_image, video_thumb', 'file','types'=>'jpg, jpeg, gif, png', 'allowEmpty'=>true, 'on'=>'update', 'maxSize'=>'204800'),
            array('video_title, video_alias, video_text, video_category, video_image, video_thumb, video_published, video_description, video_keywords, player_type, video_1080p, video_480p, video_720p, video_image, video_thumb', 'safe', 'on'=>'search'),
        );
    }
    
    public function video_attribute($attribute_name){
     if((empty($this->video_1080p)) && (empty($this->video_480p)) && (empty($this->video_720p))){
               $this->addError($attribute_name,
                 'Proszę dodać przynajmniej jedno video!');
        }
    }
    
    public function relations()
        {
            return array(
            );
        }
    
    public function attributeLabels() {
        return array(
            'video_id' => 'ID',
            'video_title' => 'Tytuł',
            'video_alias' => 'Alias',
            'video_text' => 'Tekst',
            'video_category' => 'Kategoria',
            'video_date' => 'Data',
            'video_480p' => '480p',
            'video_720p' => '720p',
            'video_1080p' => '1080p',
            'video_image' => 'Obrazek',
            'video_thumb' => 'Miniaturka',
            'video_published' => 'Publikacja',
            'player_type' => 'Typ playera',
            'video_descriptions' => 'Opis',
            'video_keywords' => 'Słowa kluczowe',
            'tag_name' => 'Tagi'
        );
    }
   
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('video_id', $this->video_id);
            $criteria->compare('video_title', $this->video_title, true);
            $criteria->compare('video_alias', $this->video_alias, true);
            $criteria->compare('video_text', $this->video_text, true);
            $criteria->compare('video_category', $this->video_category);
            $criteria->compare('video_date', $this->video_date, true);
            $criteria->compare('video_480p', $this->video_480p, true);
            $criteria->compare('video_720p', $this->video_720p, true);
            $criteria->compare('video_1080p', $this->video_1080p, true);
            $criteria->compare('video_image', $this->video_image, true);
            $criteria->compare('video_thumb', $this->video_thumb, true);
            $criteria->compare('video_published', $this->video_published, true);
            $criteria->compare('player_type', $this->player_type, true);
            $criteria->compare('video_descriptions', $this->video_descriptions, true);
            $criteria->compare('video_keywords', $this->video_keywords, true);
            $criteria->compare('video_tags', $this->video_tags, true);
            return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
    			'defaultOrder'=>'video_id',
    			'sortVar'=>'sort',
    			'attributes'=>array(
    				'video_id',
    			),
    		),

		));
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
            $Data = CmsvideoVideo::model()->find('video_id=:id', array(':id'=> $id));
            $FileImage = $Data->video_image;
            $FileThumb = $Data->video_thumb;

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
  
}


//
//class CmsvideoVideo extends CFormModel
//{
//    public $video_id;
//    public $video_title;
//    public $video_alias;
//    public $video_text;
//    public $video_category;
//    public $video_date;
//    public $video_480p;
//    public $video_720p;
//    public $video_1080p;
//    public $video_image;
//    public $video_thumb;
//    public $video_published;
//    public $player_type;
//    public $video_description;
//    public $video_keywords;
//    public $video_tags;
//    public $tag_id;
//    public $tag_name;
//    public $tag_delete;
//
//    public function rules() {
//        return array(
//            array('video_title, video_text, video_category, video_image, video_thumb, video_published, player_type', 'required'),
//            array('video_category', 'numerical', 'integerOnly'=>true),
//            array('video_1080p, video_480p, video_720p', 'video_attribute'),
//            array('video_title', 'length', 'max'=>65),
//            array('video_alias, video_description, video_keywords, tag_delete, tag_name', 'length', 'max'=>255),
//            array('video_image, video_thumb', 'file','types'=>'jpg, jpeg, gif, png', 'allowEmpty'=>true, 'on'=>'update', 'maxSize'=>'204800'),
//        );
//    }
//    
//    
//    public function video_attribute($attribute_name){
//     if((empty($this->video_1080p)) && (empty($this->video_480p)) && (empty($this->video_720p))){
//               $this->addError($attribute_name,
//                 'Proszę dodać przynajmniej jedno video!');
//        }
//    }
//    ////// WLASNA REGULA np: array('video_1080p',moja_regula),
//   // public function moja_regula($attribute_name){
//    // if(empty($this->video_1080p)){
//               //$this->addError($attribute_name,
//               //  'testowy blad sprawdzam');
//    // }
////}
//    
//    public function attributeLabels() {
//        return array(
//            'video_id' => 'ID',
//            'video_title' => 'Tytuł',
//            'video_alias' => 'Alias',
//            'video_text' => 'Tekst',
//            'video_category' => 'Kategoria',
//            'video_date' => 'Data',
//            'video_480p' => '480p',
//            'video_720p' => '720p',
//            'video_1080p' => '1080p',
//            'video_image' => 'Obrazek',
//            'video_thumb' => 'Miniaturka',
//            'video_published' => 'Publikacja',
//            'player_type' => 'Typ playera',
//            'video_descriptions' => 'Opis',
//            'video_keywords' => 'Słowa kluczowe',
//            'tag_name' => 'Tagi'
//        );
//    }
//    
//    public function ImageCreate($ImageUpload, $ImageUrl) 
//    {
//       $ImageUpload->saveAs($ImageUrl);
//    }
//    public function ImageThumbCreate($ImageUrl, $ThumbUrl) 
//    {
//        $ImageThumb = new EasyImage($ImageUrl);
//        $ImageThumb->resize(346, 230);
//        $ImageThumb->crop(320, 180);
//        $ImageThumb->save($ThumbUrl);
//    }
//    
//     public function DeleteVideoImage($id)
//    {
//        $SelectImage = Yii::app()->db->createCommand('SELECT video_image, video_thumb FROM videocms_video WHERE video_id = :VideoId');
//        $SelectImage->bindValue(':VideoId', $id, PDO::PARAM_INT);
//        $DataImage = $SelectImage->query();
//        $Data = $DataImage->read();
//        $FileImage = $Data['video_image'];
//        $FileThumb = $Data['video_thumb'];
//
//        if (file_exists($FileImage)) {
//             unlink($FileImage);
//        }
//        else {
//            echo 'Error deleting Image:'.$FileImage;
//        }
//        if (file_exists($FileThumb)) {
//            unlink($FileThumb);
//        }
//        else {
//            echo 'Error deleting Thumbnail: '.$FileThumb;
//        }    
//    }
//    
//    public function CountAllVideo()
//    {
//        $CountVideo = Yii::app()->db->createCommand('SELECT count(video_id) AS HowVideo FROM videocms_video');
//        $AmountVideo = $CountVideo->queryScalar();
//        
//        return $AmountVideo;
//    }
//    
//    public function SelectVideo($LimitOnSite = 10, $Site = 1)
//    {
//        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_published = "1" ORDER BY video_id DESC LIMIT :Start, :SetTheLimit');
//        $SelectVideo->bindValue(':Start', ($Site * $LimitOnSite), PDO::PARAM_INT);
//        $SelectVideo->bindValue(':SetTheLimit', $LimitOnSite, PDO::PARAM_INT);
//        
//        $DataVideo = $SelectVideo->queryAll();
//        return $DataVideo;
//    }
//    
//    public function SelectAdminVideo($LimitOnSite = 10, $Site = 1)
//    {
//        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video ORDER BY video_id DESC LIMIT :Start, :SetTheLimit');
//        $SelectVideo->bindValue(':Start', ($Site * $LimitOnSite), PDO::PARAM_INT);
//        $SelectVideo->bindValue(':SetTheLimit', $LimitOnSite, PDO::PARAM_INT);
//        
//        $DataVideo = $SelectVideo->queryAll();
//        return $DataVideo;
//    }
//    
//    public function CountVideoCategory($id)
//    {
//        $CountVideo = Yii::app()->db->createCommand('SELECT count(video_id) AS WhileVideo FROM videocms_video WHERE video_category = :IdCategory');
//        $CountVideo->bindValue(':IdCategory', $id, PDO::PARAM_INT);
//        $AmountVideo = $CountVideo->queryScalar();
//        
//        return $AmountVideo;
//    }
//    
//    public function SelectVideoCategory($id,$LimitOnSite,$Site)
//    {
//        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_category = :IdCategory AND video_published = "1" ORDER BY video_id DESC LIMIT :Start, :SetLimit');
//        $SelectVideo->bindValue(':IdCategory', $id, PDO::PARAM_INT);
//        $SelectVideo->bindValue(':Start', ($Site * $LimitOnSite), PDO::PARAM_INT);
//        $SelectVideo->bindValue(':SetLimit', $LimitOnSite, PDO::PARAM_INT);
//        $DataVideo = $SelectVideo->queryAll();  
//        return $DataVideo;
//    }
//    
//    public function DownloadVideo($id)
//    {
//        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_id = :IdVideo AND video_published = "1"');
//        $SelectVideo->bindValue(':IdVideo', $id, PDO::PARAM_INT);
//        $DataVideo = $SelectVideo->queryAll();
//        return $DataVideo;
//    }
//    
//    public function DownloadOneVideo($id)
//    {
//        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_id = :IdVideo LIMIT 1');
//        $SelectVideo->bindValue(':IdVideo', $id, PDO::PARAM_INT);
//        $DataVideo = $SelectVideo->queryRow();
//        return $DataVideo;
//    }
//    
//    public function DownloadVideoAdmin($id)
//    {
//        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video AS v INNER JOIN videocms_category AS c ON v.video_category = c.category_id WHERE video_id = :IdVideo');
//        $SelectVideo->bindValue(':IdVideo', $id, PDO::PARAM_INT);
//        $DataVideo = $SelectVideo->queryAll();
//        return $DataVideo;
//    }
//   
//    public function AddNewVideo()
//    {   
//        $Alias = $this->video_alias;
//        $Alias = strtolower($Alias);
//        $Alias = str_replace(array('ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż'), array('a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z'), $Alias);
//        $Alias = trim($Alias,'-'); 
//        $Alias = preg_replace('/[\-]+/', '-', $Alias);
//        $Alias = preg_replace('/[^0-9a-z-]/', '', $Alias);
//        
//        $AddVideo = Yii::app()->db->createCommand('INSERT INTO videocms_video (video_title, video_alias, video_text, video_category, video_date, video_480p, video_720p, video_1080p, video_thumb, video_image, video_published, player_type, video_description, video_keywords) VALUES (:VideoTitle, :VideoAlias, :VideoText, :VideoCategory, :VideoDate, :Video480p, :Video720p, :Video1080p, :VideoThumb, :VideoImage, :VideoPublished, :PlayerType, :VideoDescription, :VideoKeywords)');
//        $AddVideo->bindValue(':VideoTitle', $this->video_title, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoAlias', $Alias, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoText', $this->video_text, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoCategory', $this->video_category, PDO::PARAM_INT);
//        $AddVideo->bindValue(':VideoDate', NULL, PDO::PARAM_STR);
//        $AddVideo->bindValue(':Video480p', $this->video_480p, PDO::PARAM_STR);
//        $AddVideo->bindValue(':Video720p', $this->video_720p, PDO::PARAM_STR);
//        $AddVideo->bindValue(':Video1080p', $this->video_1080p, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoThumb', $this->video_thumb, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoImage', $this->video_image, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoPublished', $this->video_published, PDO::PARAM_STR);
//        $AddVideo->bindValue(':PlayerType', $this->player_type, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoDescription', $this->video_description, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoKeywords', $this->video_keywords, PDO::PARAM_STR);
//       /* if (empty($this->tag_name) )
//        { $AddVideo->bindValue(':TagName', serialize(array()), PDO::PARAM_STR);}
//        * 
//        */
//        $AddVideo->execute();
//    
//    }
//    public function DeleteVideo($id)
//    {
//        $DeleteVideo = Yii::app()->db->createCommand('DELETE FROM videocms_video WHERE video_id = :IdVideo');
//        $DeleteVideo->bindValue(':IdVideo', $id, PDO::PARAM_INT);
//        $DeleteVideo->execute();
//    }
//    
//    public function UpdateVideo($id)
//    {
//        $AddVideo = Yii::app()->db->createCommand('UPDATE videocms_video SET video_title = :VideoTitle, video_text = :VideoText, video_category = :VideoCategory, video_480p = :Video480p, video_720p = :Video720p, video_1080p = :Video1080p, video_image = :VideoImage, video_thumb = :VideoThumb, video_published = :VideoPublished, player_type = :PlayerType, video_description = :VideoDescription, video_keywords = :VideoKeywords WHERE video_id = :VideoId');
//        $AddVideo->bindValue(':VideoTitle', $this->video_title, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoText', $this->video_text, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoCategory', $this->video_category, PDO::PARAM_INT);
//        $AddVideo->bindValue(':Video480p', $this->video_480p, PDO::PARAM_STR);
//        $AddVideo->bindValue(':Video720p', $this->video_720p, PDO::PARAM_STR);
//        $AddVideo->bindValue(':Video1080p', $this->video_1080p, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoThumb', $this->video_thumb, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoImage', $this->video_image, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoPublished', $this->video_published, PDO::PARAM_STR);
//        $AddVideo->bindValue(':PlayerType', $this->player_type, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoDescription', $this->video_description, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoKeywords', $this->video_keywords, PDO::PARAM_STR);
//        $AddVideo->bindValue(':VideoId', $id, PDO::PARAM_INT);
//        $AddVideo->execute();
//      }
//    
//    public function UpdateViews($id)
//    {
//     $session = Yii::app()->getSession();
//     $video_arr = array();
//     $ses_arr = array();
//     
//     if($session['video_arr']) {
//        $ses_arr=$session['video_arr']; 
//	}
//                
//        if(!in_array($id, $ses_arr)) {
//	    $video_arr = $ses_arr;
//            $video_arr[] = $id;
//                    
//            $SelectViews = Yii::app()->db->createCommand('SELECT video_views FROM videocms_video WHERE video_id = :IdVideo');
//            $SelectViews->bindValue(':IdVideo', $id, PDO::PARAM_INT);
//            $DataViews = $SelectViews->query();
//            $Data = $DataViews->read();
//            $Views = $Data['video_views'];
//
//            if($Data) {
//               $count = $Views + 1;
//            }
//            else {
//               $count = 1;
//            }
//
//            $AddViews = Yii::app()->db->createCommand('UPDATE videocms_video SET video_views = :VideoViews WHERE video_id = :IdVideo');
//            $AddViews->bindValue(':IdVideo', $id, PDO::PARAM_INT);
//            $AddViews->bindValue(':VideoViews', $count, PDO::PARAM_INT);
//            $AddViews->execute();
//        
//            $session['video_arr']=$video_arr;
//        }
//    }
//}
?>