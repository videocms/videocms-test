<?php

class CmsvideoKategorie extends CFormModel
{
    public $kategoria_id;
    public $kategoria_nazwa;
    
    public function rules()
    {
        return array(
            array('kategoria_nazwa', 'required'),
            array('kategoria_nazwa', 'length', 'max'=>50),
            );
        
    }
    
    public function attributeLabels() {
        return array(
            'kategoria_id' => 'ID',
            'kategoria_nazwa' => 'Nazwa',
        );
    }
    
    public function PobierzKategorie()
    {
        $WybierzKategorie = Yii::app()->db->createCommand('SELECT * FROM videocms_kategorie');
        $DaneKategorii = $WybierzKategorie->query();
        return $DaneKategorii;
    }
    
    public function PobierzJednaKategorie($id)
    {
        $WybierzKategorie = Yii::app()->db->createCommand('Select * FROM videocms_kategorie WHERE kategoria_id = :IdKategorii');
        $WybierzKategorie->bindValue(':IdKategorii', $id, PDO::PARAM_INT);
        $DaneKategorii = $WybierzKategorie->query();
        
        return $DaneKategorii;
    }
    
    public function DodajKategorie()
    {
        $DodajKategorie = Yii::app()->db->createCommand('INSERT INTO videocms_kategorie (kategoria_nazwa) VALUES (:KategoriaNazwa)');
        $DodajKategorie->bindValue(':KategoriaNazwa', $this->kategoria_nazwa, PDO::PARAM_STR);
        $DodajKategorie->execute();
    }
    
    public function UsunKategorie($id)
    {
        $UsunKategorie = Yii::app()->db->createCommand('DELETE FROM videocms_kategorie WHERE kategoria_id = :KategoriaId');
        $UsunKategorie->bindValue(':KategoriaId',$id, PDO::PARAM_INT);
        $UsunKategorie->execute();
    }
    
    public function ZapiszKategorie($id)
    {
        $AktualizujKategorie = Yii::app()->db->createCommand('UPDATE videocms_kategorie SET kategoria_nazwa = :KategoriaNazwa WHERE kategoria_id = :KategoriaId');
        $AktualizujKategorie->bindValue(':KategoriaId',$id,PDO::PARAM_INT);
        $AktualizujKategorie->execute();
    }
}
?>