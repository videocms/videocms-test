<?php
/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $pagination
 * @property integer $createtime
 * @property integer $last_login_time
 * @property integer $role
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Customer[] $customers
 * @property Issues[] $issues
 * @property Issues[] $issues1
 */
class Users extends CActiveRecord
{
 const ROLE_AUTHOR=1;
 const ROLE_MODERATOR=3;
 const ROLE_ADMIN=5;
 const PASSWORD_EXPIRY=90;
 public $passwordSave;
 public $repeatPassword;
 /**
  * Returns the static model of the specified AR class.
  * @param string $className active record class name.
  * @return Users the static model class
  */
 public static function model($className=__CLASS__)
 {
 return parent::model($className);
 }
 /**
  * @return string the associated database table name
  */
 public function tableName()
 {
 return 'users';
 }
 public function fullName() {
            $fullName=(!empty($this->firstname))? $this->firstname : '';
            $fullName.=(!empty($this->lastname))?( (!empty($fullName))? " ".$this->lastname : $this->lastname ) : '';
            return $fullName;
        }
 /**
  * @return array validation rules for model attributes.
  */
 public function rules()
 {
 // NOTE: you should only define rules for those attributes that
 // will receive user inputs.
 return array(
  array('passwordSave, repeatPassword', 'required', 'on'=>'insert'),
  array('passwordSave, repeatPassword', 'length', 'min'=>6, 'max'=>40),
  array('passwordSave','checkStrength','score'=>20),
  array('passwordSave', 'compare', 'compareAttribute'=>'repeatPassword'),
  array('email','email'),
  array('username, password, email', 'required'),
  array('role, status, pagination', 'numerical', 'integerOnly'=>true),
  array('username, firstname, lastname', 'length', 'max'=>128),
  array('password, email', 'length', 'max'=>128),
  array('last_login_time, create_date', 'safe'),
  // The following rule is used by search().
  // Please remove those attributes that should not be searched.
  array('id, username, password, email, pagination, createtime, last_login_time, role, status', 'safe', 'on'=>'search'),
  );
 }
 /** score password strength
  * where score is increased based on
  * - password length
  * - number of unqiue chars
  * - number of special chars
  * - number of numbers
  * 
  * A medium score is around 20
  * 
  * @param type $attribute
  * @param type $params
  * @return boolean 
  */
 function CheckStrength($attribute,$params) 
 {
 if (!empty($this->$attribute)) {  // Edit 2013-06-01
  $password=$this->$attribute;
  if ( strlen( $password ) == 0 )
  $strength=-10;
  else
  $strength = 0;
  /*** get the length of the password ***/
  $length = strlen($password);
  /*** check if password is not all lower case ***/
  if(strtolower($password) != $password)
  {
  $strength += 1;
  }
  /*** check if password is not all upper case ***/
  if(strtoupper($password) == $password)
  {
  $strength += 1;
  }
  /*** check string length is 8 -15 chars ***/
  if($length >= 8 && $length <= 15)
  {
  $strength += 2;
  }
  /*** check if lenth is 16 - 35 chars ***/
  if($length >= 16 && $length <=35)
  {
  $strength += 2;
  }
  /*** check if length greater than 35 chars ***/
  if($length > 35)
  {
  $strength += 3;
  }
  /*** get the numbers in the password ***/
  preg_match_all('/[0-9]/', $password, $numbers);
  $strength += count($numbers[0]);
  /*** check for special chars ***/
  preg_match_all('/[|!@#$%&*\/=?,;.:\-_+~^\\\]/', $password, $specialchars);
  $strength += sizeof($specialchars[0]);
  /*** get the number of unique chars ***/
  $chars = str_split($password);
  $num_unique_chars = sizeof( array_unique($chars) );
  $strength += $num_unique_chars * 2;
  /*** strength is a number 1-100; ***/
  $strength = $strength > 99 ? 99 : $strength;
  //$strength = floor($strength / 10 + 1);
  if ($strength<$params['score']) 
  $this->addError($attribute,"Password is too weak - try using CAPITALS, Num8er5, AND sp€c!al characters. Your score was ".$strength."/".$params['score']); 
  else
  return true;
  }
}
 public function beforeSave() {
 parent::beforeSave();
 //add the password hash if it's a new record
 if ($this->isNewRecord) {
     $this->password = md5($this->passwordSave); 
     $this->create_date=new CDbExpression("NOW()");
     $this->password_expiry_date=new CDbExpression("DATE_ADD(NOW(), INTERVAL ".self::PASSWORD_EXPIRY." DAY) ");
 }       
 else if (!empty($this->passwordSave)&&!empty($this->repeatPassword)&&($this->passwordSave===$this->repeatPassword)) 
 //if it's not a new password, save the password only if it not empty and the two passwords match
 {
     $this->password = md5($this->passwordSave);
     $this->password_expiry_date=new CDbExpression("DATE_ADD(NOW(), INTERVAL ".self::PASSWORD_EXPIRY." DAY) ");
 }
 return true;
 }
 /**
  * Compare Expiry date and today's date
  * @return type - positive number equals valid user
  */
 public function checkExpiryDate() {
 $expDate=DateTime::createFromFormat('Y-m-d H:i:s',$this->password_expiry_date);
 $today=new DateTime("now");
 fb($today->diff($expDate)->format('%a'),"PASSWORD EXPIRY");
 return ($today->diff($expDate)->format('%a'));
 }
 /**
  * @return array relational rules.
  */
 public function relations()
 {
 // NOTE: you may need to adjust the relation name and the related
 // class name for the relations automatically generated below.
 return array(
 );
 }
 /**
  * @return array customized attribute labels (name=>label)
  */
 public function attributeLabels()
 {
 return array(
 'id' => 'ID',
 'username' => 'Username',
 'password' => 'Password',
 'email' => 'Email',
 'pagination' => 'pagination',
 'role' => 'role',
 'status' => 'Status',
 'create_date' => 'Createtime',
 'last_login_time' => 'last_login_time',
 'passwordSave' => 'Password', 
 'passwordRepeat' => 'Repeat Password', 
 );
 }
 /**
  * Retrieves a list of models based on the current search/filter conditions.
  * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
  */
 public function search()
 {
 // Warning: Please modify the following code to remove attributes that
 // should not be searched.
 $criteria=new CDbCriteria;
 $criteria->compare('id',$this->id);
 $criteria->compare('username',$this->username,true);
 $criteria->compare('password',$this->password,true);
 $criteria->compare('email',$this->email,true);
 $criteria->compare('pagination',$this->pagination,true);
 $criteria->compare('create_date',$this->create_date);     // Edit 2013-06-01
 $criteria->compare('last_login_time',$this->last_login_time);
 $criteria->compare('role',$this->role);
 $criteria->compare('status',$this->status);
 return new CActiveDataProvider($this, array(
 'criteria'=>$criteria,
 ));
 }
}