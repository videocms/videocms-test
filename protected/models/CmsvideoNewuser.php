<?php

class CmsvideoNewuser extends CActiveRecord
{
   // public $user_id;
   // public $user_login;
   // public $user_pass;
   public $user_newpass;
    
    public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

    public function tableName()
        {
             return 'videocms_users';
        }
    
    public function rules()
        { 
            return array(
                    array('user_login, user_pass, user_newpass', 'required'),
                    array('user_id, user_login, user_pass, user_newpass', 'safe', 'on'=>'search'),
                    array('user_login, user_pass, user_newpass', 'match' , 'pattern'=> '/^[A-Za-z0-9_]+$/u', 'message'=> 'Username can contain only [a-zA-Z0-9_].'),
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
            'user_id' => 'ID',
            'user_login' => 'Login',
            'user_pass' => 'Hasło',
            'user_newpass' => 'Powtórz hasło',
            );
        }
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('user_id', $this->user_id);
            $criteria->compare('user_login', $this->user_login, true);
            //$criteria->compare('user_pass', $this->user_pass, true);
            return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
            'sort'=>array(
    			'defaultOrder'=>'user_id',
    			'sortVar'=>'sort',
    			'attributes'=>array(
    				'user_id',
    			),
    		),

		));
        }
}




//class CmsvideoNewuser extends CFormModel
//{
//    public $user_id;
//    public $user_login;
//    public $user_pass;
//    public $user_newpass;
//    //public $user_newpass2;
//    
//    public function rules()
//    {
//        return array(
//            array('user_login, user_pass, user_newpass', 'required'),
//        );
//    }
//    
//    public function attributeLabels() {
//        return array(
//            'user_id' => 'ID',
//            'user_login' => 'Login',
//            'user_pass' => 'Hasło',
//            'user_newpass' => 'Powtórz hasło',
//        );
//    }
//    
//    public function SelectUser($Id)
//    {
//        $SelectUsers = Yii::app()->db->createCommand('SELECT * FROM videocms_users WHERE user_id =:UserId');
//        $SelectUsers->bindValue(':UserId', $Id, PDO::PARAM_INT);
//        $DataUsers = $SelectUsers->queryAll();
//        
//        return $DataUsers;
//    }
//    
//    public function UpdatePass($Id)
//    {
//        $UpdatePass = Yii::app()->db->createCommand('UPDATE videocms_users SET user_pass = :UserPass WHERE user_id = :UserId');
//        $UpdatePass->bindValue(':UserPass', md5($this->user_newpass), PDO::PARAM_STR);
//        $UpdatePass->bindValue(':UserId', $Id, PDO::PARAM_INT);
//        $UpdatePass->execute();
//    }
//}
?>