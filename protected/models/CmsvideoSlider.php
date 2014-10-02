<?php

class CmsvideoSlider extends CFormModel
{
    public $slider_id;
    public $slider_image;
    public $slider_text;

    public function rules()
    { 
        return array(
            array('slider_image', 'required'),
            array('slider_text', 'length', 'max'=>255),
            );
        
    }
    
    public function attributeLabels() {
        return array(
            'slider_id' => 'ID',
            'slider_image' => 'Zdjęcie',
            'slider_text' => 'Opis',
            
        );
    }
    public function DownloadSlider()
    {
        $SelectSlider = Yii::app()->db->createCommand('SELECT * FROM videocms_slider');
        $InfSlider = $SelectSlider->query();
        return $InfSlider;
    }
    
    public function DownloadOneSlider($id)
    {
        $SelectSlider = Yii::app()->db->createCommand('Select * FROM videocms_slider WHERE slider_id = :IdSlider');
        $SelectSlider->bindValue(':IdSlider', $id, PDO::PARAM_INT);
        $InfSlider = $SelectSlider->query();
        
        return $InfSlider;
    }
    
    public function AddSlider()
    {
        $AddSlider = Yii::app()->db->createCommand('INSERT INTO videocms_slider (slider_image, slider_text) VALUES (:SliderImage, :SliderText)');
        $AddSlider->bindValue(':SliderImage', $this->slider_image, PDO::PARAM_STR);
        $AddSlider->bindValue(':SliderText', $this->slider_text, PDO::PARAM_STR);
        $AddSlider->execute();
    }
    
    public function DeleteSlider($id)
    {
        $DeleteSlider = Yii::app()->db->createCommand('DELETE FROM videocms_slider WHERE slider_id = :SliderId');
        $DeleteSlider->bindValue(':SliderId',$id, PDO::PARAM_INT);
        $DeleteSlider->execute();
    }
    
    public function SaveSlider($id)
    {
        $UpdateSlider = Yii::app()->db->createCommand('UPDATE videocms_slider SET slider_image = :SliderImage, slider_text = :SliderText WHERE slider_id = :SliderId');  
        $UpdateSlider->bindValue(':SliderImage',$this->slider_image,PDO::PARAM_STR);
        $UpdateSlider->bindValue(':SliderText',$this->slider_text,PDO::PARAM_STR);
        $UpdateSlider->bindValue(':SliderId',$id,PDO::PARAM_INT);
        $UpdateSlider->execute();
    }
     public function CountAllSlider()
    {
        $CountSlider = Yii::app()->db->createCommand('SELECT count(slider_id) AS HowSlider FROM videocms_slider');
        $AmountSlider = $CountSlider->queryScalar();
        
        return $AmountSlider;
    }   
}
?>