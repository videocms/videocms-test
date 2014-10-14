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
                array('username, user_ip', 'length', 'max'=>150),
               );
        }
        
    public function relations()
        {
          return array(
                'user' => array(self::BELONGS_TO, 'User', 'username'),
            );
        }
        
    public function attributeLabels() 
        {
            return array(
            'username' => 'Zalogowani użytkownicy:',
            'user_ip' => 'IP',  
            );
        }
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('id', $this->id);
            $criteria->compare('username', $this->username, true);
            $criteria->compare('user_ip', $this->user_ip, true);
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