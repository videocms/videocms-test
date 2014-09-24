<?php

class CmsvideoCategories extends CFormModel
{
    public $category_id;
    public $category_vast;
    public $category_name;
    
    public function rules()
    { 
        return array(
            array('category_name, category_vast', 'required'),
            array('category_vast', 'length', 'max'=>60),
            array('category_name', 'length', 'max'=>50),
            );
        
    }
    
    public function attributeLabels() {
        return array(
            'category_id' => 'ID',
            'category_vast' => 'Vast',
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
        $AddCategory = Yii::app()->db->createCommand('INSERT INTO videocms_category (category_name, category_vast) VALUES (:CategoryName, :CategoryVast)');
        $AddCategory->bindValue(':CategoryName', $this->category_name, PDO::PARAM_STR);
        $AddCategory->bindValue(':CategoryVast', $this->category_vast, PDO::PARAM_STR);
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
        $UpdateCategory = Yii::app()->db->createCommand('UPDATE videocms_category SET category_name = :CategoryName, category_vast = :CategoryVast WHERE category_id = :CategoryId');
        
        $UpdateCategory->bindValue(':CategoryName',$this->category_name,PDO::PARAM_STR);
        $UpdateCategory->bindValue(':CategoryVast', $this->category_vast, PDO::PARAM_STR);
        $UpdateCategory->bindValue(':CategoryId',$id,PDO::PARAM_INT);
        $UpdateCategory->execute();
    }
    
    public function CountVastCategory($id)
    {
        $CountVast = Yii::app()->db->createCommand('SELECT count(category_id) AS WhileCategory FROM videocms_category WHERE category_vast = :CategoryVast');
        $CountVast->bindValue(':CategoryVast', $id, PDO::PARAM_INT);
        $AmountVast = $CountVast->queryScalar();
        
        return $AmountVast;
    }
    
    public function SelectVastCategory($id,$LimitOnSite,$Site)
    {
        $SelectVast = Yii::app()->db->createCommand('SELECT * FROM videocms_category WHERE category_vast = :CategoryVast ORDER BY category_id DESC LIMIT :Start, :SetLimit');
        $SelectVast->bindValue(':CategoryVast', $id, PDO::PARAM_INT);
        $SelectVast->bindValue(':Start', ($Site * $LimitOnSite), PDO::PARAM_INT);
        $SelectVast->bindValue(':SetLimit', $LimitOnSite, PDO::PARAM_INT);
        
        $DataVast = $SelectVast->queryAll();
        
        return $DataVast;
    }
}
?>