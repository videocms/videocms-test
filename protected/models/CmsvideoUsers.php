<?php
class CmsVideoUsers extends CActiveRecord
{
    public static function model($className = __CLASS__) {
        parent::model($className);
    }
    public function tableName() {
        return 'videocms_activityusers';
    }
    public function rules()
    {
        return array(
            array('username', 'length', 'max'=>255),
        );
    }
    public function relations() {
        return array();
    }
    public function attributeLabel()
    {
        return array(
            'id' => 'ID',
            'username' => 'Użytkownik',
        );
    }
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
//class CmsvideoUsers extends CFormModel
//{
//    public $user_login;
//    public $user_pass;
//
//
//    public function rules()
//    {
//        return array (
//            array('user_login, user_pass', 'required'),
//            array('user_login', 'length', 'max'=>150),
//            array('user_pass', 'length', 'max'=>50),
//            array('user_login, user_pass', 'match' ,'pattern'=>'/^[A-Za-z0-9_]+$/u','message'=> 'Proszę wpisać dane poprawnie!.'),
//        );
//    }
//
//    public function attributeLabels()
//    {
//        return array(
//            'user_id' => 'ID',
//            'user_login' => 'Login',
//            'user_pass' => 'Hasło',
//        );
//    }
//#LiczIleUzytkownikow
//    public function CountHowManyUsers()
//    {
//        $SelectUsers = Yii::app()->db->createCommand('SELECT count(user_id) FROM videocms_users WHERE user_login = :UserLogin AND user_pass = :UserPass');
//        $SelectUsers->bindValue(':UserLogin', $this->user_login, PDO::PARAM_STR);
//        $SelectUsers->bindValue(':UserPass', md5($this->user_pass), PDO::PARAM_STR);
//        $DataUsers = $SelectUsers->queryScalar();
//
//        return $DataUsers;
//    }
//
//    public function SelectUser()
//    {
//        $SelectUsers = Yii::app()->db->createCommand('SELECT * FROM videocms_users WHERE user_login = :UserLogin AND user_pass = :UserPass');
//        $SelectUsers->bindValue(':UserLogin', $this->user_login, PDO::PARAM_STR);
//        $SelectUsers->bindValue(':UserPass', md5($this->user_pass), PDO::PARAM_STR);
//        $DataUsers = $SelectUsers->queryAll();
//
//        return $DataUsers;
//    }
//}


?>