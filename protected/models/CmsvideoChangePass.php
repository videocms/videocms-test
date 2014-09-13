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
    
    
}