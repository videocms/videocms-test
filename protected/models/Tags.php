<?php

class Tags extends CActiveRecord
{
    public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

    public function tableName()
        {
             return 'videocms_tags';
        }
    
    public function rules()
        { 
            return array(
                array('tag_name, tag_idvideo', 'required'),
                array('tag_id, tag_idvideo, tag_name', 'safe', 'on'=>'search'),
                );
        }
        
    public function relations()
        {
          return array(
            );
        }
        
    public function attributeLabels() 
        {
            return array(
            'tag_id' => 'Id',
            'tag_name' => 'Nazwa',
            'tag_idvideo' => 'Id tag video',
            );
        }
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('tag_id', $this->tag_id);
            $criteria->compare('tag_name', $this->tag_name, true);
            $criteria->compare('tag_idvideo', $this->tag_idvideo, true);
            return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
            'sort'=>array(
    			'defaultOrder'=>'tag_id',
    			'sortVar'=>'sort',
    			'attributes'=>array(
    				'tag_id',
    			),
    		),

		));
        }
}
?>