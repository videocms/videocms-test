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
    
     public function DownloadOneVideo($id)
    {
        $SelectVideo = Yii::app()->db->createCommand('SELECT * FROM videocms_video WHERE video_id = :IdVideo LIMIT 1');
        $SelectVideo->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $DataVideo = $SelectVideo->queryRow();
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
        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_tags SET tag_idvideo = :VideoTag WHERE tag_id = :TagId');
        $UpdateTag->bindValue(':TagId', $DataTag['tag_id'], PDO::PARAM_STR);
        $UpdateTag->bindValue(':VideoTag', $newTag, PDO::PARAM_STR);
        $UpdateTag->execute();
    }
 
    //Usuwanie z kolumny video_tags nazwy tagu w tabeli videocms_video
    public function DeleteVideoTag($id, $DataTag) {
        $ModelVideo = new CmsvideoVideo;
        $DataVideo = $this->DownloadOneVideo($id);
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
    //    $Data = $this->SelectTags($TagValue);
    //    $Data2 = $this->DownloadOneVideo($id);
       
        $rows = $TagValue['tag_idvideo'];
        if(empty($rows)) {
        $row2[] = $id;
        }
        else {
        $row2 = unserialize($rows);
        }
        if (!in_array($id,$row2) && !empty($rows)) {
        array_push($row2, $id);
        }

        $UpdateTag = Yii::app()->db->createCommand('UPDATE videocms_tags SET tag_idvideo = :VideoTag WHERE tag_name = :TagName');
        $UpdateTag->bindValue(':VideoTag', serialize($row2), PDO::PARAM_STR);
        $UpdateTag->bindValue(':TagName', $TagValue['tag_name'], PDO::PARAM_STR);
        $UpdateTag->execute();   
    }
}
?>

