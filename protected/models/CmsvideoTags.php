<?php
class CmsvideoTags extends CFormModel
{
    public $tag_name;
    public $tag_id;

    public function rules() {
        return array(
            array('tag_id,tag_name', 'required'),
        );
    }
    
    public function SelectTags($TagValue) {
        $TagValue = strtolower($TagValue);
        $TagValue = trim($TagValue,'-'); 
        $TagValue = preg_replace('/[\-]+/', '-', $TagValue);
        $TagValue = preg_replace('/[^0-9a-z-]/', '', $TagValue);
        $SelectTags = Yii::app()->db->createCommand('SELECT * FROM videocms_tags WHERE tag_name = :TagName LIMIT 1');
        $SelectTags->bindValue(':TagName', $TagValue, PDO::PARAM_STR);
        $DataTags = $SelectTags->queryAll();
        return $DataTags;
    }
    
   public function AddTag($TagValue) {
        $TagValue = strtolower($TagValue);
        $TagValue = trim($TagValue,'-'); 
        $TagValue = preg_replace('/[\-]+/', '-', $TagValue);
        $TagValue = preg_replace('/[^0-9a-z-]/', '', $TagValue);
        $AddTag = Yii::app()->db->createCommand('INSERT INTO videocms_tags (tag_name) SELECT * FROM (SELECT :TagName) AS tmp WHERE NOT EXISTS (SELECT tag_name FROM videocms_tags WHERE tag_name = :TagName) LIMIT 1');
        $AddTag->bindValue(':TagName', $TagValue, PDO::PARAM_STR);
        $AddTag->execute();   
    }
    
    public function AddVideoTag($Tag, $Vid) {
        
        $Tag = strtolower($Tag);
        $Tag = trim($Tag,'-'); 
        $Tag = preg_replace('/[\-]+/', '-', $Tag);
        $Tag = preg_replace('/[^0-9a-z-]/', '', $Tag);
        $SelectTags = Yii::app()->db->createCommand('SELECT * FROM videocms_tags WHERE tag_name = :TagName LIMIT 1');
        $SelectTags->bindValue(':TagName', $Tag, PDO::PARAM_STR);
        $Data = $SelectTags->queryRow();
        
        $rows = $Data['tag_idvideo'];
        if(empty($rows)) {
        $row2[] = $Vid; 
        }
        else {
        $row2 = unserialize($rows);
        }
        if (!in_array($Vid,$row2) && !empty($rows)) {
        array_push($row2, $Vid);
        }
        
        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_tags SET tag_idvideo = :VideoTag WHERE tag_name = :TagName');
        $UpdateTag->bindValue(':TagName', $Tag, PDO::PARAM_STR);
        $UpdateTag->bindValue(':VideoTag', serialize($row2), PDO::PARAM_STR);
        $UpdateTag->execute();   
    }
}
?>

