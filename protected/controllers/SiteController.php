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
    public $disqus_shortname;
    public $player_autoplay;
    public $player_preload;
    public $player_loop;
    public $player_controls;
    public $ogtype;
    public $videoID;
    public $layout='site/index';
    //public $defaultAction = 'cmsvideo';
    
    public function actionIndex()
    {
        $ModelSeo = new CmsvideoSettings;
        $DataSeo = $ModelSeo->DownloadSettings();
        $ModelCategories = CmsvideoCategories::model()->findAll();
        
        $ModelSlider = Slider::model()->findAll(array(
            'order' => 'slider_id DESC',
        ));
        
        $VideoLatest = CmsvideoVideo::model()->findAll(array(
            'select'=>'video_id, video_title, video_thumb, video_views',
            'order' => 'video_id DESC',
            'limit' => '12',
        ));
        
        $VideoPopular = CmsvideoVideo::model()->findAll(array(
            'select'=>'video_id, video_title, video_thumb, video_views',
            'order' => 'video_views DESC',
            'limit' => '6',
        ));
        
        
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
        
        
        $this->render('index',
                    array(
                          'ModelCategories' => $ModelCategories,
                          'VideoLatest' => $VideoLatest,
                          'VideoPopular' => $VideoPopular,
                          'DataSlider' => $ModelSlider,
                          'DataSeo' => $DataSeo,
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
                        'condition' => 'id = :IdCategory',
                        'params' => array(':IdCategory' => $id),
                    )
                    );
        $ModelCategories = CmsvideoCategories::model()->findAll($Criteria);
        foreach ($ModelCategories as $Category)
        {
            $this->pageTitle = 'Kategoria: '.$Category->name;
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
        $this->ogtype = "yes";
        $this->videoID = $id;
        $ModalSeo = new CmsvideoSettings;
        $DataSeo = $ModalSeo->DownloadSettings();
        $ModelCategories = CmsvideoCategories::model()->findAll();
        $Model = CmsvideoVideo::model()->find('video_id=:IdVideo', array(':IdVideo'=>$id));
           
      
        $criteria = new CDbCriteria(
                    array(
                        'select'=>'video_id, video_title, video_thumb, video_views',
                        'condition'=>'video_views >= 0 AND video_id != :IdVideo',
                        'order' => 'video_views DESC',
                        //'limit' => '10',
                        'params'=> array(':IdVideo'=>$id),
                    ));
        
        
        $total = CmsvideoVideo::model()->count();
        $pages = new CPagination($total);
        $pages->pageSize = 7;
        $pages->applyLimit($criteria);
        $VideoList = CmsvideoVideo::model()->findAll($criteria);  
        
        $TagsId = unserialize($Model->video_tags);
        $ModelTags = array();
        if (is_array($TagsId) && !empty($TagsId)) {
        $TagsIdArr = join(',',$TagsId);  
            $ModelTags = Tags::model()->findAllBySQL('SELECT tag_name FROM videocms_tags WHERE tag_id IN (' .$TagsIdArr. ')');
        }
                   
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
            $this->disqus_shortname = $Seoo['disqus_shortname'];
            $this->player_autoplay = $Seoo['player_autoplay'];
            $this->player_preload = $Seoo['player_preload'];
            $this->player_loop = $Seoo['player_loop'];
            $this->player_controls = $Seoo['player_controls'];
        }
      
        
       // foreach ($Model as $Video)
      //  {
            $this->pageTitle = $Model->video_title;
            $this->pageMetaKeywords = $Model->video_keywords;
            $this->pageMetaDescription = $Model->video_description;
            $this->pageMetaOgImage = $Model->video_image;
           // $this->pageMetaDescription = $Video['video_description'];
        //}
       
        
        $this->render('video', array(
            'ModelCategories' => $ModelCategories,
            'ModelTags' => $ModelTags,
            'Model' => $Model,
            'VideoList' => $VideoList,
            'pages' => $pages,
            //'DataVast' => $Datavast,
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
                . 'SELECT r.vast_id, r.vast_title, r.vast_link, r.vast_source, r.vast_views '
                . 'FROM videocms_video AS v '
                . 'INNER JOIN videocms_category AS c '
                . 'ON v.video_category = c.id '
                . 'INNER JOIN videocms_vast AS r '
                . 'ON FIND_IN_SET(c.id, r.vast_video_cat) '
                . 'WHERE r.vast_start < NOW() '
                . 'AND r.vast_end > NOW() '
                . 'AND r.vast_published = "1" '
                . 'AND v.video_id = :IdVideo '
                . 'ORDER BY RAND() '
                . 'LIMIT 1',
                array(':IdVideo'=>$vid));
        
        VastVideo::model()->updateByPk($Data->vast_id, array('vast_views' => $Data->vast_views + 1));
        if (!$Data->vast_id == NULL)
        {
            $xmlok = '<MediaFile delivery="progressive" bitrate="400" width="320" height="180" type="video/mp4"><![CDATA['. $Data->vast_source.']]></MediaFile>';
        }
        
        $xml .= '<Ad id="'.$Data->vast_id.'">
                <id>'.$Data->vast_id.'</id>
                <InLine>
                <Creatives>
                <Creative sequence="'.$Data->vast_title.'" id="">
                <Linear>
                <Duration>00:00:31</Duration>
                <VideoClicks>
                <ClickThrough><![CDATA[http://'.$Data->vast_link.']]></ClickThrough>
                </VideoClicks>
                <MediaFiles>
                '.$xmlok.'
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
       // $ModelCategories = CmsvideoCategories::model()->findAll();
        $Model = CmsvideoVideo::model()->find('video_id=:IdVideo', array(':IdVideo'=>$id));
        
        
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
            //$this->disqus_shortname = $Seoo['disqus_shortname'];
            $this->player_controls = $Seoo['player_controls'];
        }
      
        
       // foreach ($Model as $Video)
      //  {
            $this->pageTitle = $Model->video_title;
            $this->pageMetaKeywords = $Model->video_keywords;
            $this->pageMetaDescription = $Model->video_description;
            $this->pageMetaOgImage = $Model->video_image;
           // $this->pageMetaDescription = $Video['video_description'];
        //}
        $this->pageTitle='embed-video-site';
        
            
           // $this->pageMetaKeywords = $Model->video_keywords;
           // $this->pageMetaDescription = $Model->video_description;
          //  $this->pageMetaOgImage = $Model->video_thumb;
           // $this->pageMetaDescription = $Video['video_description'];
       
        
        $this->render('embed', array(
            //'DataCategory' => $DataCategory,
            'Model' => $Model,
            //'DataViews' => $DataViews,
        ));
             
    }
    //embed koniec
}
?>