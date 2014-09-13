<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CmsvideoChangePass extends CFormModel
{
    public $uzytkownik_haslo;
    public $uzytkownik_nowehaslo;
    public $uzytkownik_nowehaslo2;
    
    public function rules()
    {
        return array(
            array('uzytkownik_haslo, uzytkownik_nowehaslo, uzytkownik_nowehaslo2', 'required'),
        );
    }
    
    public function attributeLabels() {
        return array(
            'uzytkownik_haslo' => 'Stare Hasło',
            'uzytkownik_nowehaslo' => 'Nowe hasło',
            'uzytkownik_nowehaslo2' => 'Powtorz nowe hasło',
        );
    }
    
    public function WybierzUzytkownika($Id)
    {
        $WybierzUzytkownikow = Yii::app()->db->createCommand('SELECT * FROM videocms_users WHERE uzytkownik_id =:UzytkownikId');
        $WybierzUzytkownikow->bindValue(':UzytkownikId', $Id, PDO::PARAM_INT);
        $DaneUzytkownicy = $WybierzUzytkownikow->queryAll();
        
        return $DaneUzytkownicy;
    }
    
    public function AktualizujHaslo($Id)
    {
        $AktualizujHaslo = Yii::app()->db->createCommand('UPDATE vidocms_users SET uzytkownik_haslo = :UzytkownikHaslo WHERE uzytkownik_id = :UzytkownikId');
        $AktualizujHaslo->bindValue(':UzytkownikHaslo', md5($this->uzytkownik_nowehaslo), PDO::PARAM_STR);
        $AktualizujHaslo->bindValue(':UzytkownikId', $Id, PDO::PARAM_INT);
        $AktualizujHaslo->execute();
    }
}