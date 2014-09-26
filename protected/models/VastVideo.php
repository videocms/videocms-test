<?php
 
class VastVideo extends CFormModel
{
    public $vast_id;
    public $vast_title;
    public $vast_source;
    public $vast_link;
    public $vast_video_cat;
    public $video_category;


    public function rules() {
        return array(
            array('vast_title, vast_source, vast_link, video_category', 'required'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'vast_id' => 'ID',
            'vast_title' => 'Title',
            'vast_source' => 'Source',
            'vast_link' => 'Link',
            'video_category' => 'KategoriaWideo',
        );
    }
    /**             Create file .xml
     public function VastXml()
    {
        $SelectVast = Yii::app()->db->createCommand('SELECT * FROM videocms_vast WHERE vast_title = :VastTitle');
       // $SelectVast = Yii::app()->db->createCommand('SELECT * FROM videocms_vast');
        $SelectVast->bindValue(':VastTitle', $this->vast_title, PDO::PARAM_STR);
        $InfVast = $SelectVast->query();
        $xmldata = '<?xml version="1.0" encoding="utf-8"?>';
        $xmldata .= '<VAST version="2.0">';
        while(($Rekord=$InfVast->read()) !== false)
        {
            $xmldata .= '<Ad id="'.$Rekord['vast_id'].'">';
            $xmldata .= '<InLine>';
            $xmldata .= '<Creatives>';
            $xmldata .= '<Creative sequence="1" id="7969">';
            $xmldata .= '<Linear>';
            $xmldata .= '<Duration>00:00:31</Duration>';
            $xmldata .= ' <VideoClicks>';
            $xmldata .= '<ClickThrough><![CDATA[http://'.$Rekord['vast_link'].']]></ClickThrough>';
            $xmldata .= '</VideoClicks>';
            $xmldata .= '<MediaFiles>';
            $xmldata .= '<MediaFile delivery="progressive" bitrate="400" width="320" height="180" type="video/mp4"><![CDATA['.$Rekord['vast_source'].']]>';
            //$xmldata .= '<test>'.$model->test.'</test>';
            $xmldata .= '</MediaFile>';
            $xmldata .= '</MediaFiles>';
            $xmldata .= '</Linear>';
            $xmldata .= '</Creative>';
            $xmldata .= '</Creatives>';
            $xmldata .= '</InLine>';
            $xmldata .= '</Ad>';
        }
        $xmldata .= '</VAST>';
        $sxe = new SimpleXMLElement($xmldata);
        $sxe->asXML("vast/$this->vast_title.xml");
       // $sxe->asXML("vast/vast.xml");
    }
   **/
    public function DownloadVast()
    {
        $SelectVast = Yii::app()->db->createCommand('SELECT * FROM videocms_vast');
        $InfVast = $SelectVast->query();
        return $InfVast;
    }
    
    public function DownloadOneVast($id)
    {
        $SelectVast = Yii::app()->db->createCommand('Select * FROM videocms_vast WHERE vast_id = :IdVast');
        $SelectVast->bindValue(':IdVast', $id, PDO::PARAM_INT);
        $InfVast = $SelectVast->query();
        
        return $InfVast;
    }
    
    public function DownloadVideoVast($id) {
        $SelectVast = Yii::app()->db->createCommand('SELECT r.vast_id, r.vast_link, r.vast_source FROM videocms_video AS v INNER JOIN videocms_category AS c ON v.video_category = c.category_id INNER JOIN videocms_vast AS r ON FIND_IN_SET(c.category_id, r.vast_video_cat) WHERE v.video_id = :IdVideo');
        $SelectVast->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $InfVast = $SelectVast->query();
        return $InfVast;
    }
    
    public function AddVast()
    {
        $AddVast = Yii::app()->db->createCommand('INSERT INTO videocms_vast (vast_title, vast_source, vast_link, vast_video_cat) VALUES (:VastTitle, :VastSource, :VastLink, :VastVideoCategory)');
        $AddVast->bindValue(':VastTitle', $this->vast_title, PDO::PARAM_STR);
        $AddVast->bindValue(':VastSource', $this->vast_source, PDO::PARAM_STR);
        $AddVast->bindValue(':VastLink', $this->vast_link, PDO::PARAM_STR);
        $AddVast->bindValue(':VastVideoCategory', implode(',', $this->video_category), PDO::PARAM_STR);
        $AddVast->execute();
    }
    
    public function DeleteVast($id)
    {
        $DeleteVast = Yii::app()->db->createCommand('DELETE FROM videocms_vast WHERE vast_id = :VastId');
        $DeleteVast->bindValue(':VastId',$id, PDO::PARAM_INT);
        $DeleteVast->execute();
    }
    
    public function SaveVast($id)
    {
        $UpdateVast = Yii::app()->db->createCommand('UPDATE videocms_vast SET vast_title = :VastTitle, vast_source = :VastSource, vast_link = :VastLink, vast_video_cat = :VastVideoCategory WHERE vast_id = :VastId');
        $UpdateVast->bindValue(':VastTitle',$this->vast_title,PDO::PARAM_STR);
        $UpdateVast->bindValue(':VastSource',$this->vast_source,PDO::PARAM_STR);
        $UpdateVast->bindValue(':VastLink',$this->vast_link,PDO::PARAM_STR);
        $UpdateVast->bindValue(':VastVideoCategory', implode(',', $this->video_category), PDO::PARAM_STR);
        $UpdateVast->bindValue(':VastId',$id,PDO::PARAM_INT);
        $UpdateVast->execute();
    }
}
?>