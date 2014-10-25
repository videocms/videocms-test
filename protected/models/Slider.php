<?php
class Slider extends CActiveRecord
{
    public $slider_id;
    public $slider_image;
    public $slider_text;
    
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
            array('slider_image, slider_published', 'required'),
          //  array('video_category', 'numerical', 'integerOnly'=>true),
       
            array('slider_text', 'length', 'max'=>255),

            array('slider_id, slider_text, slider_image, slider_published', 'safe', 'on'=>'search'),
        );
    }
   
    
    public function relations()
        {
           return array(
             );
        }
    
    public function attributeLabels() {
        return array(
            'slider_id' => 'ID',
            'slider_text' => 'Opis',
            'slider_image' => 'Zdjęcie',
            'slider_published' => 'Stan'
        );
    }
   
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('slider_id', $this->slider_id);
            $criteria->compare('slider_image', $this->slider_image, true);
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
  
}

?>