<?php

class log extends CActiveRecord
{
    public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

    public function tableName()
        {
             return 'YiiLog';
        }
    
    public function rules()
        { 
            return array(
                array('user_name', 'length', 'max'=>50),
                array('id level, category, logtime, IP_User, name', 'safe', 'on'=>'search'),
                );
        }
        
    public function attributeLabels() 
        {
            return array(
            'id' => 'Id',
            'level' => 'Level',
            'category' => 'Kategoria',
            'logtime' => 'logtime',
            'IP_User' => 'IP',
            'user_name' => 'Username',
            'request_URL' => 'URL',
            'message' => 'Message',
            );
        }
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('id', $this->id);
            $criteria->compare('level', $this->level, true);
            $criteria->compare('category', $this->category, true);
            $criteria->compare('logtime', $this->logtime, true);
            $criteria->compare('IP_User', $this->IP_User, true);
            $criteria->compare('user_name', $this->user_name, true);
            $criteria->compare('request_URL', $this->request_URL, true);
            $criteria->compare('message', $this->message, true);
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