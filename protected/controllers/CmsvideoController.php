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
}


?>