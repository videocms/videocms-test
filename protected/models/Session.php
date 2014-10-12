<?php

class Session extends CActiveRecord
{
    public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

    public function tableName()
        {
             return 'VideoCMS_sesja';
        }
    
    public function rules()
        { 
            return array(
                array('username', 'length', 'max'=>150),
               );
        }
        
    public function attributeLabels() 
        {
            return array(
            'username' => 'Zalogowani użytkownicy:',
            );
        }
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('id', $this->id);
            $criteria->compare('username', $this->username, true);
            return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),

		));
        }
}
?>