<?php

class CmsvideoMenu extends CActiveRecord
{
    public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

    public function tableName()
        {
             return 'videocms_menu';
        }
    
    public function rules()
        { 
            return array(
                array('menu_name, menu_text, menu_link', 'length', 'max'=>150),
               );
        }
        
    public function attributeLabels() 
        {
            return array(
            'id' => 'ID',
            'menu_name' => 'Nazwa',  
            'menu_text' => 'Treść',
            'menu_link' => 'link',
            );
        }
    public function search()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('id', $this->id);
            $criteria->compare('menu_name', $this->menu_name, true);
            $criteria->compare('menu_text', $this->menu_text, true);
            $criteria->compare('menu_link', $this->menu_link, true);
            return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),

		));
        }
}
?>