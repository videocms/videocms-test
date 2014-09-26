<?php
 
class CmsvideoController extends Controller
{
    public $pageMetaDescription;
    public $pageMetaRobots;
    public $pageMetaKeywords;
    public $pageMetaOgDescription;
    public $pageMetaOgImage;
    public $pageMetaOgUrl;
    public $pageMetaOgTitle;
    public $pageMetaFB;
    
    public function actionIndex()
    {
        $ModelSeo = new CmsvideoSettings;
        $DataSeo = $ModelSeo->DownloadSettings();
        
        foreach ($DataSeo as $Seoo)
        {
        $this->pageMetaRobots = $Seoo['settings_robots'];
        $this->pageMetaKeywords = $Seoo['settings_keywords'];
        $this->pageMetaDescription = $Seoo['settings_description'];
        }
        $this->pageTitle='Strona główna';
         
        $ModelCategories = new CmsvideoCategories;
        $DataCategory = $ModelCategories->DownloadCategories();
        
        $ModelVideo = new CmsvideoVideo;
        $AmountVideo = $ModelVideo->CountAllVideo();
        
        $Site = new CPagination(intval($AmountVideo));
        $Site->pageSize = 10;
        
        $DataVideo = $ModelVideo->SelectVideo($Site->pageSize, $Site->currentPage);
       
        $this->render('index',
                array(
                        'DataCategory' => $DataCategory,
                        'DataSeo' => $DataSeo,
                        'DataVideo' => $DataVideo,
                        'Site' => $Site,
                        )
                );
    }
        
    public function actionCategory($id)
    {
        if(!is_numeric($id))
        {
            exit;
        }
        
        $ModalSeo = new CmsvideoSettings;
        $DataSeo = $ModalSeo->DownloadSettings();
        
        foreach ($DataSeo as $Seoo)
        {
        $this->pageMetaRobots = $Seoo['settings_robots'];
        $this->pageMetaKeywords = $Seoo['settings_keywords'];
        $this->pageMetaDescription = $Seoo['settings_description'];
        }
        
        $ModelCategory = new CmsvideoCategories;
        
        $DataCategory = $ModelCategory->DownloadOneCategory($id);
        
        foreach ($DataCategory as $Category)
        {
            $this->pageTitle = 'Category: '.$Category['category_name'];
        }
        
        $ModelVideo = new CmsvideoVideo;
        
        $AmountVideo = $ModelVideo->CountVideoCategory($id);
        $Site = new CPagination(intval($AmountVideo));
        $Site->pageSize=10;
        
        $DataVideo = $ModelVideo->SelectVideoCategory($id, $Site->pageSize, $Site->currentPage);
        $this->render('category', array(
                    'DataVideo' => $DataVideo,
                    'Site' => $Site,
                      ));
    }
    
    public function actionVideo($id)
    {
        if(!is_numeric($id))
        {
            exit;
        }
       
        $ModalSeo = new CmsvideoSettings;
        $DataSeo = $ModalSeo->DownloadSettings();
        
        foreach ($DataSeo as $Seoo)
        {
        $this->pageMetaRobots = $Seoo['settings_robots'];
        }
        
        $ModelCategory = new CmsvideoCategories;
        $DataCategory = $ModelCategory->DownloadCategories();
        //$ModelVast = new VastVideo;
        //$DataVast = $ModelVast->DownloadVast();
        $ModelVideo = new CmsvideoVideo;
        $DataVideo = $ModelVideo->DownloadVideo($id);
        $DataViews = $ModelVideo->UpdateViews($id);
        
        foreach($DataVideo as $Video)
        {
            $this->pageTitle = $Video['video_title'];
            $this->pageMetaKeywords = $Video['video_keywords'];
            $this->pageMetaDescription = $Video['video_description'];
        }
        
        $this->render('video', array(
            'DataCategory' => $DataCategory,
            'DataVideo' => $DataVideo,
            'DataViews' => $DataViews,
        ));
        
    }
    
    //VAST
  
    //Wywołanie funkcji generującej dynamicznie XML - http://videocms-test.pl/cmsvideo/vastxml/?id=34
    public function actionVastXml($vid)
    {
        $ModelVast = new VastVideo;
        $DataVast = $ModelVast->DownloadVideoVast($vid);
        header('Content-Type: application/xml');
        echo '<?xml version="1.0" encoding="UTF-8"?>
              <VAST version="2.0">';
        foreach ($DataVast as $Data)
            {
            echo '<Ad id="'.$Data['vast_id'].'">
            <InLine>
            <Creatives>
            <Creative sequence="1" id="7969">
            <Linear>
            <Duration>00:00:31</Duration>
            <VideoClicks>
            <ClickThrough><![CDATA[http://'.$Data['vast_link'].']]></ClickThrough>
            </VideoClicks>
            <MediaFiles>
            <MediaFile delivery="progressive" bitrate="400" width="320" height="180" type="video/mp4"><![CDATA['. $Data['vast_source'].']]>
            </MediaFile>
            </MediaFiles>
            </Linear>
            </Creative>
            </Creatives>
            </InLine>
            </Ad>';
            }
            echo '</VAST>';
        }
    /// end VAST
}

?>