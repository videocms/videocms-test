<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CmsvideoChangePass extends CFormModel
{
    public $user_pass;
    public $user_newpass;
    public $user_newpass2;
    
    public function rules()
    {
        return array(
            array('user_pass, user_newpass, user_newpass2', 'required'),
        );
    }
    
    public function attributeLabels() {
        return array(
            'user_pass' => 'Stare Hasło',
            'user_newpass' => 'Nowe hasło',
            'user_newpass2' => 'Powtorz nowe hasło',
        );
    }
    
    public function SelectUser($Id)
    {
        $SelectUsers = Yii::app()->db->createCommand('SELECT * FROM videocms_users WHERE user_id =:UserId');
        $SelectUsers->bindValue(':UserId', $Id, PDO::PARAM_INT);
        $DataUsers = $SelectUsers->queryAll();
        
        return $DataUsers;
    }
    
    public function UpdatePass($Id)
    {
        $UpdatePass = Yii::app()->db->createCommand('UPDATE videocms_users SET user_pass = :UserPass WHERE user_id = :UserId');
        $UpdatePass->bindValue(':UserPass', md5($this->user_newpass), PDO::PARAM_STR);
        $UpdatePass->bindValue(':UserId', $Id, PDO::PARAM_INT);
        $UpdatePass->execute();
    }
}