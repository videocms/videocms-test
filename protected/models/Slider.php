<?php
class Slider extends CActiveRecord
{

    
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
            array('slider_published', 'required'),
            array('slider_idvideo', 'numerical', 'integerOnly'=>true),
            array('slider_title, slider_image, slider_thumb', 'length', 'max'=>255),
            array('slider_id, slider_idvideo, slider_title, slider_image, slider_published', 'safe', 'on'=>'search'),
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
            'slider_title' => 'Nagłówek',
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