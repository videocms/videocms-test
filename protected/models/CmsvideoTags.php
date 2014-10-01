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
        $DataTags = $SelectTags->queryRow();
        return $DataTags;
    }
    
    public function DownloadTag($id)
    {
        $SelectVideo = Yii::app()->db->createCommand('SELECT tag_id, tag_name FROM videocms_tags WHERE tag_idvideo LIKE :TagidVideo');
        $SelectVideo->bindValue(':TagidVideo', '%"'.$id.'"%', PDO::PARAM_INT);
        $DataVideo = $SelectVideo->queryAll();
        return $DataVideo;
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
    
    public function DeleteIdVideo($TagValue, $newTag) {
        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_tags SET tag_idvideo = :VideoTag WHERE tag_name = :TagName');
        $UpdateTag->bindValue(':TagName', $TagValue, PDO::PARAM_STR);
        $UpdateTag->bindValue(':VideoTag', $newTag, PDO::PARAM_STR);
        $UpdateTag->execute(); 
    }
    
    public function DeleteVideoTag($Vid, $newTag) {
        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_video SET video_tags = :VideoTagId WHERE video_id = :IdVideo');
        $UpdateTag->bindValue(':IdVideo', $Vid, PDO::PARAM_INT);
        $UpdateTag->bindValue(':VideoTagId', $newTag, PDO::PARAM_STR);
        $UpdateTag->execute(); 
    }
    
    public function AddVideoTag($Tag, $Vid) {
        $Tag = strtolower($Tag);
        $Tag = trim($Tag,'-'); 
        $Tag = preg_replace('/[\-]+/', '-', $Tag);
        $Tag = preg_replace('/[^0-9a-z-]/', '', $Tag);
        $SelectTags = Yii::app()->db->createCommand('SELECT tag_name, tag_idvideo FROM videocms_tags WHERE tag_name = :TagName LIMIT 1');
        $SelectTags->bindValue(':TagName', $Tag, PDO::PARAM_STR);
        $Data = $SelectTags->queryRow();
        
        $SelectVideo = Yii::app()->db->createCommand('SELECT video_tags FROM videocms_video WHERE video_id = :IdVideo LIMIT 1');
        $SelectVideo->bindValue(':IdVideo', $Vid, PDO::PARAM_STR);
        $Data2 = $SelectVideo->queryRow();
       
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
        
        $rows2 = $Data2['video_tags'];
        if(empty($rows2)) {
        $row[] = $Data['tag_name'];
        }
        else {
        $row = unserialize($rows2);
        }
        if (!in_array($Data['tag_name'],$row) && !empty($rows2)) {
        array_push($row, $Data['tag_name']);
        }
        
        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_tags, videocms_video SET videocms_tags.tag_idvideo = :VideoTag, videocms_video.video_tags = :VideoTagId WHERE videocms_tags.tag_name = :TagName AND videocms_video.video_id = :IdVideo');
        $UpdateTag->bindValue(':TagName', $Tag, PDO::PARAM_STR);
        $UpdateTag->bindValue(':VideoTag', serialize($row2), PDO::PARAM_STR);
        $UpdateTag->bindValue(':IdVideo', $Vid, PDO::PARAM_INT);
        $UpdateTag->bindValue(':VideoTagId', serialize($row), PDO::PARAM_STR);
        $UpdateTag->execute();   
    }
}
?>

