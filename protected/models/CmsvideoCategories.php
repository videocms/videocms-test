<?php

class CmsvideoCategories extends CFormModel
{
    public $category_id;
    public $category_name;
    
    public function rules()
    {
        return array(
            array('category_name', 'required'),
            array('category_name', 'length', 'max'=>50),
            );
        
    }
    
    public function attributeLabels() {
        return array(
            'category_id' => 'ID',
            'category_name' => 'Name',
        );
    }
    
    public function DownloadCategories()
    {
        $SelectCategory = Yii::app()->db->createCommand('SELECT * FROM videocms_category');
        $InfCategory = $SelectCategory->query();
        return $InfCategory;
    }
    
    public function DownloadOneCategory($id)
    {
        $SelectCategory = Yii::app()->db->createCommand('Select * FROM videocms_category WHERE category_id = :IdCategory');
        $SelectCategory->bindValue(':IdCategory', $id, PDO::PARAM_INT);
        $InfCategory = $SelectCategory->query();
        
        return $InfCategory;
    }
    
    public function AddCategory()
    {
        $AddCategory = Yii::app()->db->createCommand('INSERT INTO videocms_category (category_name) VALUES (:CategoryName)');
        $AddCategory->bindValue(':CategoryName', $this->category_name, PDO::PARAM_STR);
        $AddCategory->execute();
    }
    
    public function DeleteCategory($id)
    {
        $DeleteCategory = Yii::app()->db->createCommand('DELETE FROM videocms_category WHERE category_id = :CategoryId');
        $DeleteCategory->bindValue(':CategoryId',$id, PDO::PARAM_INT);
        $DeleteCategory->execute();
    }
    
    public function SaveCategory($id)
    {
        $UpdateCategory = Yii::app()->db->createCommand('UPDATE videocms_category SET category_name = :CategoryName WHERE category_id = :CategoryId');
        $UpdateCategory->bindValue(':CategoryId',$id,PDO::PARAM_INT);
        $UpdateCategory->execute();
    }
}
?>