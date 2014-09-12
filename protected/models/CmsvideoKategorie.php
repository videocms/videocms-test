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
}
?>