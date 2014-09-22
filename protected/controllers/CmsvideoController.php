<?php

class CmsvideoController extends Controller
{
    public function actionIndex()
    {
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
       
        $ModelCategory = new CmsvideoCategories;
        $DataCategory = $ModelCategory->DownloadCategories();
        
        $ModelVideo = new CmsvideoVideo;
        $DataVideo = $ModelVideo->DownloadVideo($id);
        
        foreach($DataVideo as $Video)
        {
            $this->pageTitle = $Video['video_title'];
        }
        
        $this->render('video', array(
            'DataCategory' => $DataCategory,
            'DataVideo' => $DataVideo,
            
        ));
        
    }
    
    //VAST
    
    
    //Wywołanie funkcji generującej dynamicznie XML - http://videocms-test.pl/cmsvideo/vastxml/?id=34
    public function actionVastXml($id)
    {
        $ModelVast = new VastVideo;
        $DataVast = $ModelVast->DownloadOneVast($id);
        foreach ($DataVast as $Data)
            {
            header('Content-Type: application/xml');
            echo '<?xml version="1.0" encoding="UTF-8"?>
            <VAST version="2.0">
            <Ad id="'.$Data['vast_id'].'">
            <InLine>
            <Creatives>
            <Creative sequence="1" id="7969">
            <Linear>
            <Duration>00:00:31</Duration>
            <VideoClicks>
            <ClickThrough><![CDATA['.$Data['vast_link'].']]></ClickThrough>
            </VideoClicks>
            <MediaFiles>
            <MediaFile delivery="progressive" bitrate="400" width="320" height="180" type="video/mp4"><![CDATA['. $Data['vast_source'].']]>
            </MediaFile>
            </MediaFiles>
            </Linear>
            </Creative>
            </Creatives>
            </InLine>
            </Ad>
            </VAST>';
            }
        }
    /// end VAST
}


?>