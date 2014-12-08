<?php
class Slider extends CActiveRecord
{
    public $slider_updateimg;

    
    public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

    public function tableName()
        {
             return 'videocms_slider';
        }
        
    public function rules() {
        return array(
            array('slider_title, slider_idvideo, slider_image, slider_published', 'required'),
            array('slider_idvideo', 'numerical', 'integerOnly'=>true),
            array('slider_title, slider_text, slider_image, slider_thumb, slider_updateimg', 'length', 'max'=>255),
            array('slider_id, slider_idvideo, slider_title, slider_text, slider_image, slider_published', 'safe', 'on'=>'search'),
        );
    }
   
    
    public function relations()
        {
           return array(
            'video' => array(self::BELONGS_TO, 'CmsvideoVideo', 'slider_idvideo'),    
             );
        }
    
    public function attributeLabels() {
        return array(
            'slider_id' => 'ID',
            'slider_title' => 'Nagłówek',
            'slider_text' => 'Tekst',
            'slider_idvideo' => 'Video',
            'slider_thumb' => 'Miniaturka',
            'slider_image' => 'Zdjęcie',
            'slider_published' => 'Stan'
        );
    }
   
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('slider_id', $this->slider_id);
            $criteria->compare('slider_idvideo', $this->slider_idvideo, true);
            $criteria->compare('slider_image', $this->slider_image, true);
            $criteria->compare('slider_thumb', $this->slider_thumb, true);
            $criteria->compare('slider_title', $this->slider_title, true);
            $criteria->compare('slider_text', $this->slider_text, true);
            $criteria->compare('slider_published', $this->slider_published, true);

            return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
            'sort'=>array(
    			'defaultOrder'=>'slider_id',
    			'sortVar'=>'sort',
    			'attributes'=>array(
    				'slider_id',
    			),
    		),

		));
        }
        
    public function ImageCopy($ImageUpload, $ImageUrl) 
        {
             copy($ImageUpload, $ImageUrl);
        }
    
    public function ImageThumbCreate($ImageUrl, $ThumbUrl) 
        {
            $ImageThumb = new EasyImage($ImageUrl);
            $ImageThumb->resize(346, 230);
            $ImageThumb->crop(320, 180);
            $ImageThumb->save($ThumbUrl);
        }
    public function DeleteSliderImage($id)
        {
            $Data = Slider::model()->find('slider_id=:id', array(':id'=> $id));
            $FileImage = $Data->slider_image;
            $FileThumb = $Data->slider_thumb;

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

?>