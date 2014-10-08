<?php
 
class SiteController extends Controller
{
    public $pageMetaDescription;
    public $pageMetaRobots;
    public $pageMetaKeywords;
    public $pageMetaOgDescription;
    public $pageMetaOgImage;
    public $pageMetaOgUrl;
    public $pageMetaOgTitle;
    public $pageMetaFB;
    public $slider_duration;
    public $slider_arrow;
    public $slider_dragorientation;
    public $slider_slidespacing;
    public $slider_mindragoffsettoslide;
    public $slider_loop; 
    public $slider_hwa;
    public $slider_arrowkeynavigation;
    public $slider_lazyloading;
    public $layout='site/index';
    //public $defaultAction = 'cmsvideo';
    
    public function actionIndex()
    {
        $ModelSeo = new CmsvideoSettings;
        $DataSeo = $ModelSeo->DownloadSettings();
        $ModelSlider = new CmsvideoSlider;
        foreach ($DataSeo as $Seoo)
        {
            $this->pageMetaRobots = $Seoo['settings_robots'];
            $this->pageMetaKeywords = $Seoo['settings_keywords'];
            $this->pageMetaDescription = $Seoo['settings_description'];
            $this->pageMetaOgTitle = $Seoo['settings_ogtitle']; 
            $this->pageTitle=$Seoo['settings_ogtitle']; 
            $this->pageMetaOgImage = $Seoo['settings_ogimage'];
            $this->slider_duration = $Seoo['slider_duration'];
            $this->slider_arrow = $Seoo['slider_arrow'];
            $this->slider_dragorientation = $Seoo['slider_dragorientation'];
            $this->slider_slidespacing = $Seoo['slider_slidespacing'];
            $this->slider_mindragoffsettoslide = $Seoo['slider_mindragoffsettoslide'];
            $this->slider_loop = $Seoo['slider_loop'];
            $this->slider_hwa = $Seoo['slider_hwa'];
            $this->slider_arrowkeynavigation = $Seoo['slider_arrowkeynavigation'];
            $this->slider_lazyloading = $Seoo['slider_lazyloading'];
        }
        //$this->pageTitle='Strona główna';
         
//        $ModelCategories = new CmsvideoCategories;
//        $DataCategory = $ModelCategories->DownloadCategories();
        
//        $ModelVideo = new CmsvideoVideo;
//        $AmountVideo = $ModelVideo->CountAllVideo();
        
        //$AmountSlider = $ModelSlider->CountAllSlider();
        
//        $Site = new CPagination(intval($AmountVideo));
//        $Site->pageSize = 10;
        
        //$SiteSlider = new CPagination(intval($AmountSlider));
        //$SiteSlider->pageSize = 10;
        
//        $DataVideo = $ModelVideo->SelectVideo($Site->pageSize, $Site->currentPage);
        $ModelCategories = CmsvideoCategories::model()->findAll();
        $Criteria = new CDbCriteria(
                    array(
                        'order' => 'video_id DESC'
                    )
                    );
        $Count = CmsvideoVideo::model()->count($Criteria);
        $Site = new CPagination($Count);
        $Site->pageSize = 10;
        $Site->applyLimit($Criteria);
        
        $Model = CmsvideoVideo::model()->findAll($Criteria);
        
        $DataSlider = $ModelSlider->DownloadSlider();
       
        $this->render('index',
                    array(
                          'ModelCategories' => $ModelCategories,
                          'Model' => $Model,
                         // 'DataCategory' => $DataCategory,
                          'DataSlider' => $DataSlider,
                          'DataSeo' => $DataSeo,
                       //   'DataVideo' => $DataVideo,
                          'Site' => $Site,
                          )
                  );
    }
    
    public function actionError()
    {
		if($error=Yii::app()->errorHandler->error)
		{
                    if(Yii::app()->request->isAjaxRequest)
			echo $error['message'];
                            else
                            $this->render('error', $error);
		}
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
        
       // $ModelCategory = new CmsvideoCategories;
        //$DataCategory = $ModelCategory->DownloadOneCategory($id);
        
        $Criteria = new CDbCriteria(
                    array(
                        'condition' => 'category_id = :IdCategory',
                        'params' => array(':IdCategory' => $id),
                    )
                    );
        $ModelCategories = CmsvideoCategories::model()->findAll($Criteria);
        foreach ($ModelCategories as $Category)
        {
            $this->pageTitle = 'Kategoria: '.$Category->category_name;
        }
        $Criteria = new CDbCriteria(
                    array(
                        'condition' => 'video_category = :IdCategory',
                        'params' => array(':IdCategory' => $id),
                        'order' => 'video_id DESC'
                    )
                    );
        $Count = CmsvideoVideo::model()->count($Criteria);
        $Site = new CPagination($Count);
        $Site->pageSize = 10;
        $Site->applyLimit($Criteria);
        $Model = CmsvideoVideo::model()->findAll($Criteria);
        
//        $ModelVideo = new CmsvideoVideo;
//        
//        $AmountVideo = $ModelVideo->CountVideoCategory($id);
//        $Site = new CPagination(intval($AmountVideo));
//        $Site->pageSize=10;
//        
//        $DataVideo = $ModelVideo->SelectVideoCategory($id, $Site->pageSize, $Site->currentPage);
        $this->render('category', array(
                                    'Model' => $Model,
                                    //'DataVideo' => $DataVideo,
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
        $ModelCategories = CmsvideoCategories::model()->findAll();
        $Model = CmsvideoVideo::model()->findAll('video_id=:IdVideo', array(':IdVideo'=>$id));
        
        $session = Yii::app()->getSession();
        $video_arr = array();
        $ses_arr = array();

         if($session['video_arr']) {
            $ses_arr=$session['video_arr']; 
            }
            if(!in_array($id, $ses_arr)) {
                $video_arr = $ses_arr;
                $video_arr[] = $id;
                $Views = CmsvideoVideo::model()->find('video_id=:id', array(':id'=> $id));
                if($Views->video_views) {
                   $Views->video_views = $Views->video_views + 1;
                }
                else {
                   $Views->video_views = 1;
                }
                $Views->save();
                $session['video_arr']=$video_arr;
            }
        
        foreach ($DataSeo as $Seoo)
        {
            $this->pageMetaRobots = $Seoo['settings_robots'];
        }
        
        //$ModelCategory = new CmsvideoCategories;
       // $DataCategory = $ModelCategory->DownloadCategories();
        //$ModelVast = new VastVideo;
        //$DataVast = $ModelVast->DownloadVast();
       // $ModelVideo = new CmsvideoVideo;
        //$DataVideo = $ModelVideo->DownloadVideo($id);
        //$DataViews = $ModelVideo->UpdateViews($id);
        
        
        foreach ($Model as $Video)
        {
            $this->pageTitle = $Video->video_title;
            $this->pageMetaKeywords = $Video['video_keywords'];
            $this->pageMetaDescription = $Video['video_description'];
            $this->pageMetaOgImage = $Video['video_thumb'];
           // $this->pageMetaDescription = $Video['video_description'];
        }
        
        $this->render('video', array(
            'ModelCategories' => $ModelCategories,
            'Model' => $Model,
          //  'DataViews' => $DataViews,
        )); 
    }
    
    //VAST
  
    //Wywołanie funkcji generującej dynamicznie XML - http://videocms-test.pl/cmsvideo/vastxml/?id=34
    public function actionVastXml($vid)
    {   
        echo header('Content-Type: application/xml');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<VAST version="2.0">';
        $Data = VastVideo::model()->findBySQL(''
                . 'SELECT r.vast_id, r.vast_title, r.vast_link, r.vast_source '
                . 'FROM videocms_video AS v '
                . 'INNER JOIN videocms_category AS c '
                . 'ON v.video_category = c.category_id '
                . 'INNER JOIN videocms_vast AS r '
                . 'ON FIND_IN_SET(c.category_id, r.vast_video_cat) '
                . 'WHERE v.video_id = :IdVideo '
                . 'ORDER BY RAND() '
                . 'LIMIT 1',
                array(':IdVideo'=>$vid));  

                $xml .= '<Ad id="'.$Data->vast_id.'">
                <InLine>
                <Creatives>
                <Creative sequence="'.$Data->vast_title.'" id="">
                <Linear>
                <Duration>00:00:31</Duration>
                <VideoClicks>
                <ClickThrough><![CDATA[http://'.$Data->vast_link.']]></ClickThrough>
                </VideoClicks>
                <MediaFiles>
                <MediaFile delivery="progressive" bitrate="400" width="320" height="180" type="video/mp4"><![CDATA['. $Data->vast_source.']]>
                </MediaFile>
                </MediaFiles>
                </Linear>
                </Creative>
                </Creatives>
                </InLine>
                </Ad>';
                $xml .= '</VAST>';

            echo $xml;
        }
    /// end VAST
        //embed start
    public function actionEmbed($id)
    {
        if(!is_numeric($id))
        {
            exit;
        }
        $this->layout='site/embed';
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
        
        $this->pageTitle='embed-video-site';
        foreach($DataVideo as $Video)
        {
            
            $this->pageMetaKeywords = $Video['video_keywords'];
            $this->pageMetaDescription = $Video['video_description'];
            $this->pageMetaOgImage = $Video['video_thumb'];
           // $this->pageMetaDescription = $Video['video_description'];
        }
        
        $this->render('embed', array(
            'DataCategory' => $DataCategory,
            'DataVideo' => $DataVideo,
            'DataViews' => $DataViews,
        ));
        
    }
    //embed koniec
}
?>