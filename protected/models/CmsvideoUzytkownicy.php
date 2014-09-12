<?php

class CmsvideoUzytkownicy extends CFormModel
{
    public $uzytkownik_login;
    public $uzytkownik_haslo;


    public function rules()
    {
        return array (
            array('uzytkownik_login, uzytkownik_haslo', 'required'),
            array('uzytkownik_login', 'length', 'max'=>150),
            array('uzytkownik_haslo', 'length', 'max'=>50),
        );
    }

    public function attributeLabels()
    {
        return array(
            'uzytkownik_id' => 'ID',
            'uzytkownik_login' => 'Login',
            'uzytkownik_haslo' => 'Hasło',
        );
    }

    public function LiczIleUzytkownikow()
    {
        $WybierzUzytkownikow = Yii::app()->db->createCommand('SELECT count(user_id) FROM videocms_users WHERE user_login = :UzytkownikLogin AND user_pass = :UzytkownikHaslo');
        $WybierzUzytkownikow->bindValue(':UzytkownikLogin', $this->uzytkownik_login, PDO::PARAM_STR);
        $WybierzUzytkownikow->bindValue(':UzytkownikHaslo', md5($this->uzytkownik_haslo), PDO::PARAM_STR);
        $DaneUzytkownicy = $WybierzUzytkownikow->queryScalar();

        return $DaneUzytkownicy;
    }

    public function WybierzUzytkownika()
    {
        $WybierzUzytkownikow = Yii::app()->db->createCommand('SELECT * FROM videocms_users WHERE user_login = :UzytkownikLogin AND user_pass = :UzytkownikHaslo');
        $WybierzUzytkownikow->bindValue(':UzytkownikLogin', $this->uzytkownik_login, PDO::PARAM_STR);
        $WybierzUzytkownikow->bindValue(':UzytkownikHaslo', md5($this->uzytkownik_haslo), PDO::PARAM_STR);
        $DaneUzytkownicy = $WybierzUzytkownikow->queryAll();

        return $DaneUzytkownicy;
    }
}

?>