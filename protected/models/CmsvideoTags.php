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
    
    //Pobieranie wpisu dla danego tagu
    public function SelectTags($TagValue) {

        
        // replace non letter or digits by -
        $TagValue = preg_replace('~[^\\pL\d]+~u', '-', $TagValue);

        // trim
        $TagValue = trim($TagValue, '-');

        // transliterate
        setlocale(LC_CTYPE, 'pl_PL');
        $TagValue = iconv("UTF-8","UTF-8", $TagValue);

        // lowercase
        $TagValue = strtolower($TagValue);

        // remove unwanted characters
       // $TagValue = preg_replace('~[^-\w]+~', '', $TagValue);
        
        
        
        $SelectTags = Yii::app()->db->createCommand('SELECT * FROM videocms_tags WHERE tag_name = :TagName LIMIT 1');
        $SelectTags->bindValue(':TagName', $TagValue, PDO::PARAM_STR);
        $DataTags = $SelectTags->queryRow();
        return $DataTags;
    }
    
    //Pobieranie tagów dla danego video
    public function DownloadTag($id)
    {
        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_tags WHERE tag_idvideo LIKE :TagidVideo');
        $SelectVideo->bindValue(':TagidVideo', '%"'.$id.'"%', PDO::PARAM_INT);
        $DataVideo = $SelectVideo->queryAll();
        return $DataVideo;
    }
    
    //Dododawanie do kolumny tag_name nazwy tagu w tabeli videocms_tags
    public function AddTag($TagValue) {
         
        // replace non letter or digits by -
        $TagValue = preg_replace('~[^\\pL\d]+~u', '-', $TagValue);

        // trim
        $TagValue = trim($TagValue, '-');

        // transliterate
        setlocale(LC_CTYPE, 'pl_PL');
        $TagValue = iconv("UTF-8","UTF-8", $TagValue);
       

        // lowercase
        $TagValue = strtolower($TagValue);

        // remove unwanted characters
       // $TagValue = preg_replace('~[^-\w]+~', '', $TagValue);
        $AddTag = Yii::app()->db->createCommand('INSERT INTO videocms_tags (tag_name) SELECT * FROM (SELECT :TagName) AS tmp WHERE NOT EXISTS (SELECT tag_name FROM videocms_tags WHERE tag_name = :TagName) LIMIT 1');
        $AddTag->bindValue(':TagName', $TagValue, PDO::PARAM_STR);
        $AddTag->execute();   
    }
    
    public function DeleteTag($DataTag)
    {
        $SelectTag = $this->SelectTags($DataTag);
        $DeleteTag = unserialize($SelectTag['tag_idvideo']);
        if(empty($DeleteTag)) {
            $DeleteTag = Yii::app()->db->createCommand('DELETE FROM videocms_tags WHERE tag_id = :TagId');
            $DeleteTag->bindValue(':TagId', $SelectTag['tag_id'], PDO::PARAM_INT);
            $DeleteTag->execute();
        }
    }
    
    //Usuwanie z kolumny tags_idvideo id video w tabeli videocms_tags
    public function DeleteIdVideo($id, $DataTag) {
        $array1 = unserialize($DataTag['tag_idvideo']);
        $array2[] = $id;
        $string =  array_diff($array1, $array2);
        $newTag = serialize($string);
        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_tags SET tag_idvideo = :VideoTag WHERE tag_name = :TagName');
        $UpdateTag->bindValue(':TagName', $DataTag['tag_name'], PDO::PARAM_STR);
        $UpdateTag->bindValue(':VideoTag', $newTag, PDO::PARAM_STR);
        $UpdateTag->execute();
    }
 
    //Usuwanie z kolumny video_tags nazwy tagu w tabeli videocms_video
    public function DeleteVideoTag($id, $DataTag) {
        $ModelVideo = new CmsvideoVideo;
        $DataVideo = $ModelVideo->DownloadOneVideo($id);
        $array1[] = $DataTag['tag_name'];
        $array2 = unserialize($DataVideo['video_tags']);
        $string =  array_diff($array2, $array1);
        $newTag = serialize($string);
        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_video SET video_tags = :VideoTagId WHERE video_id = :IdVideo');
        $UpdateTag->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $UpdateTag->bindValue(':VideoTagId', $newTag, PDO::PARAM_STR);
        $UpdateTag->execute(); 
    }
    
    //Dodawanie do kolumny tag_idvideo id video w tabeli videocms_tags i do kolumny video_tags nazwy tagu w tabeli videocms_video
    public function AddVideoTag($TagValue, $id) {
        $ModelVideo = new CmsvideoVideo;
        $Data = $this->SelectTags($TagValue);
        $Data2 = $ModelVideo->DownloadOneVideo($id);
       
        $rows = $Data['tag_idvideo'];
        if(empty($rows)) {
        $row2[] = $id;
        }
        else {
        $row2 = unserialize($rows);
        }
        if (!in_array($id,$row2) && !empty($rows)) {
        array_push($row2, $id);
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
        
        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_tags, videocms_video SET videocms_tags.tag_idvideo = :VideoTag, videocms_video.video_tags = :VideoTagName WHERE videocms_tags.tag_name = :TagName AND videocms_video.video_id = :IdVideo');
        $UpdateTag->bindValue(':VideoTag', serialize($row2), PDO::PARAM_STR);
        $UpdateTag->bindValue(':VideoTagName', serialize($row), PDO::PARAM_STR);
        $UpdateTag->bindValue(':TagName', $Data['tag_name'], PDO::PARAM_STR);
        $UpdateTag->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $UpdateTag->execute();   
    }
}
?>

