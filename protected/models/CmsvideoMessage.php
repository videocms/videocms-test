<?php

class CmsvideoMessage extends CActiveRecord
{
    public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

    public function tableName()
        {
             return 'videocms_message';
        }
    
    public function rules()
        { 
            return array(
                array('recipient, text, sender', 'required'),
                array('id', 'safe', 'on'=>'search'),
                );
        }
        
        
    public function attributeLabels() 
        {
            return array(
            'id' => 'Id',
            'sender' => 'Nadawca',
            'recipient' => 'Odbioraca',
            'text' => 'Treść',
            );
        }
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('id', $this->id);
            $criteria->compare('sender', $this->sender, true);
            $criteria->compare('recipient', $this->recipient, true);
            $criteria->compare('text', $this->text, true);
            return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
            'sort'=>array(
    			'defaultOrder'=>'id',
    			'sortVar'=>'sort',
    			'attributes'=>array(
    				'id',
    			),
    		),

		));
        }
}
?>