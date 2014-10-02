<?php
 
class AdminController extends Controller
{
    public $slider_duration;
    public $slider_arrow;
   
    //Testowanie przypisanych reklam
    public function actionDownloadVast($id) {
        $SelectVast = Yii::app()->db->createCommand('SELECT v.video_id, v.video_category, c.category_name, r.vast_id, r.vast_video_cat FROM videocms_video AS v INNER JOIN videocms_category AS c ON v.video_category = c.category_id INNER JOIN videocms_vast AS r ON FIND_IN_SET(c.category_id, r.vast_video_cat) WHERE v.video_id = :IdVideo');
        $SelectVast->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $DataVast = $SelectVast->queryAll();
        echo '<pre>';
        foreach($DataVast as $vast) {
            print_r($vast);
        }
        echo '</pre>';
    }
    
    
    public function actionVideos()
    {
        $this->pageTitle = 'Videos';
        
        if (Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        $VideoAdd = false;
        
        $ModelCategories = new CmsvideoCategories;
        $ModelTags = new CmsvideoTags;
        $DataCategory = $ModelCategories->DownloadCategories();
        $ModelVideo = new CmsvideoVideo;
        //$ModelVast = new VastVideo();
        

        if(isset($_POST['CmsvideoVideo']))
        {
            $ModelVideo->attributes=$_POST['CmsvideoVideo'];
            $ImageUpload = CUploadedFile::getInstance($ModelVideo,'video_image');
            $Tags = explode(',',$ModelVideo->tag_name);
            if ($ImageUpload !== NULL) {
            $ImageNewName = date("d-m-Y-H-i-s", time())."-".$ImageUpload->getName();
            $ModelVideo->video_image = 'images/orginal/'.$ImageNewName;
            $ModelVideo->video_thumb = 'images/thumbs/'.$ImageNewName;
            }
            
            if($ModelVideo->validate())
            {   
                $ModelVideo->AddNewVideo();
                $id = Yii::app()->db->getLastInsertID();
                if ($Tags !== NULL) {
                    foreach($Tags as $TagValue) {
                            $ModelTags->AddTag($TagValue);
                            $ModelTags->AddVideoTag($TagValue, $id);
                    }
                }
                if ($ImageUpload !== NULL) {
                $ModelVideo->ImageCreate($ImageUpload, $ModelVideo->video_image);
                $ModelVideo->ImageThumbCreate($ModelVideo->video_image, $ModelVideo->video_thumb);
                }
                $VideoAdd = true;
                $ModelVideo->video_title = '';
                $ModelVideo->video_text = '';
                $ModelVideo->video_category = '';
                $ModelVideo->video_480p = '';
                $ModelVideo->video_720p = '';
                $ModelVideo->video_1080p = '';
                $ModelVideo->video_image = '';
                $ModelVideo->video_thumb = '';
                $ModelVideo->player_type = '';
                $ModelVideo->video_description = '';
                $ModelVideo->video_keywords = '';
            }
        }
        
        $AmountVideo = $ModelVideo->CountAllVideo();
        $Site = new CPagination(intval($AmountVideo));
        $Site->pageSize = 10;
        
        $Data = $ModelVideo->SelectAdminVideo($Site->pageSize, $Site->currentPage);

        $this->render('videos', array(
            'Data' => $Data,
            'Site' => $Site,
            'VideoAdd' => $VideoAdd,
            'ModelVideo' => $ModelVideo,
            'DataCategory' =>$DataCategory,
            'ModelCategories' =>$ModelCategories,
        ));
    }
    
    public function actionVideoDelete($id)
    {
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $ModelVideo = new CmsvideoVideo;
        $ModelTags = new CmsvideoTags;
        $ModelVideo->DeleteVideoImage($id);
        
       // $SelectVideo = $ModelVideo->DownloadOneVideo($id);
        $TagDelete = $ModelTags->DownloadTag($id);
        foreach($TagDelete as $DataTag) {
             $ModelTags->DeleteIdVideo($id, $DataTag);
             $ModelTags->DeleteTag($DataTag['tag_name']);
        }
        
        $ModelVideo->DeleteVideo($id);
        
        
        
        $this->redirect(array('admin/videos'));
    }
    
    public function actionTest2($TagValue) {
        $ModelTags = new CmsvideoTags;
        $Tag = $ModelTags->SelectTags($TagValue);
        $array = unserialize($Tag['tag_idvideo']);
        if(empty($array)) {
           echo 'Tablica pusta';
        }
        else {
             echo '<pre>';
                print_r(unserialize($Tag['tag_idvideo']));
            echo '</pre>';
        }
    }
    
    public function actionVideoUpdate($id)
    {
        $this->pageTitle = 'Edit Video';
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $VideoUpdate = false;
        $ModelVideo = new CmsvideoVideo;
        $ModelTags = new CmsvideoTags;
        $ModelCategories = new CmsvideoCategories;

        if(isset($_POST['CmsvideoVideo']))
        {
            $ModelVideo->attributes = $_POST['CmsvideoVideo'];
            $Tags = explode(',',$ModelVideo->tag_name);
            $ImageUpload = CUploadedFile::getInstance($ModelVideo,'video_image');
            if($ImageUpload !== NULL) {
            $ModelVideo->DeleteVideoImage($id);
            $ImageNewName = date("d-m-Y-H-i-s", time())."-".$ImageUpload->getName();
            $ModelVideo->video_image = 'images/orginal/'.$ImageNewName;
            $ModelVideo->video_thumb = 'images/thumbs/'.$ImageNewName;
            }
            
            if ($ModelVideo->validate())
            {
                foreach($Tags as $TagValue) {
                    if ($TagValue != NULL) {
                    $ModelTags->AddTag($TagValue);
                    $ModelTags->AddVideoTag($TagValue, $id);
                    }
                }
                $ModelVideo->UpdateVideo($id);
                
                if ($ImageUpload !== NULL) {
                    $ModelVideo->ImageCreate($ImageUpload, $ModelVideo->video_image);
                  $ModelVideo->ImageThumbCreate($ModelVideo->video_image, $ModelVideo->video_thumb);
                }
               
                if($ModelVideo->tag_delete) {
                    $TagDelete = explode(',',$ModelVideo->tag_delete);
                    foreach($TagDelete as $Tag) {
                        $DataTag = $ModelTags->SelectTags($Tag);
                        $ModelTags->DeleteVideoTag($id, $DataTag);
                        $ModelTags->DeleteIdVideo($id, $DataTag);
                        $ModelTags->DeleteTag($DataTag['tag_name']);
                    }
                }
                $VideoUpdate = true;
            }
           // $this->redirect(array('admin/videos'));
        }
        else
        {
            $Data = $ModelVideo->DownloadVideoAdmin($id);
           
            foreach($Data as $DataVideo)
            {
                $ModelVideo->video_id = $DataVideo['video_id'];
                $ModelVideo->video_title = $DataVideo['video_title'];
                $ModelVideo->video_text = $DataVideo['video_text'];
                $ModelVideo->video_category = $DataVideo['video_category'];
                $ModelVideo->video_480p = $DataVideo['video_480p'];
                $ModelVideo->video_720p = $DataVideo['video_720p'];
                $ModelVideo->video_1080p = $DataVideo['video_1080p'];
                $ModelVideo->video_image = $DataVideo['video_image'];
                $ModelVideo->video_thumb = $DataVideo['video_thumb'];
                $ModelVideo->video_published = $DataVideo['video_published'];
                $ModelVideo->player_type = $DataVideo['player_type'];
                $ModelVideo->video_description = $DataVideo['video_description'];
                $ModelVideo->video_keywords = $DataVideo['video_keywords'];
            }
        }    
        
        $this->render('videoupdate', array(
            'ModelTags' => $ModelTags,
            'ModelVideo' => $ModelVideo,
            'VideoUpdate' => $VideoUpdate,
            'ModelCategories' => $ModelCategories,
        ));
    }
    
    public function actionCategory()
    {
        $this->pageTitle = 'Category';
        if(Yii::app()->session['zalogowany'] != 'tak') 
        {
            $this->redirect(array('login/index'));
        }
        
        $CategotyAdd = false;
        
        $ModelCategories = new CmsvideoCategories;
        
        if(isset($_POST['CmsvideoCategories']))
        {
            $ModelCategories->attributes=$_POST['CmsvideoCategories'];
            
            if($ModelCategories->validate())
            {
                $ModelCategories->AddCategory();
                $CategotyAdd = true;
                $ModelCategories->category_name = '';
            }
        }
        
        $DataCategory = $ModelCategories->DownloadCategories();
        
        $this->render('category', array(
            'Data' => $DataCategory,
            'CategoryAdd' => $CategotyAdd,
            'ModelCategory' => $ModelCategories,
        ));
    }
    public function actionCategoryDelete($id)
    {
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $ModelCategory = new CmsvideoCategories;
        $ModelCategory->DeleteCategory($id);
        $this->redirect(array('admin/category'));
    }
    
    public function actionCategoryUpdate($id)
    {
        $this->pageTitle = 'Edit Category';
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $CategoryUpdate = false;
        $ModelCategory = new CmsvideoCategories;
        
        if(isset($_POST['CmsvideoCategories']))
        {
            $ModelCategory->attributes = $_POST['CmsvideoCategories'];
            if($ModelCategory->validate())
            {
                $ModelCategory->SaveCategory($id);
                $CategoryUpdate = true;
            }
            $this->redirect(array('/admin/category'));
        }
        else
        {
            $Data = $ModelCategory->DownloadOneCategory($id);
            foreach ($Data as $DataForm)
            {
                $ModelCategory->category_name = $DataForm['category_name'];
            }
        }
        
        $this->render('categoryupdate', array(
            'ModelCategory' => $ModelCategory,
            'CategoryUpdate' => $CategoryUpdate,
        ));
    }
    
    public function actionPass()
    {
        $this->pageTitle = 'Change Pass';
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        $ErrorChangePass = false;
        $ModelPass = new CmsvideoChangePass;
        
        if(isset($_POST['CmsvideoChangePass']))
        {
            $ModelPass->attributes=$_POST['CmsvideoChangePass'];
            
            if($ModelPass->validate())
            {
                $SelectPass = $ModelPass->SelectUser(Yii::app()->session['root']);
                
                foreach ($SelectPass as $ResultLine)
                {
                    $OldPass = $ResultLine['user_pass'];
                }
                
                if($OldPass == md5($ModelPass->user_pass))
                {
                    if($ModelPass->user_newpass == $ModelPass->user_newpass2)
                    {
                        $ModelPass->UpdatePass(Yii::app()->session['root']);
                        $ModelPass->user_pass = '';
                        $ModelPass->user_newpass = '';
                        $ModelPass->user_newpass2 = '';
                        
                        $ErrorChangePass = 'no_error';
                    }
                    else {
                        $ErrorChangePass = 'pass_no_match';
                    }
                    }
                    else
                    {
                        $ErrorChangePass = 'wrong_pass';
                }
            }
        }
        $this->render('pass', array(
            'ModelPass'=>$ModelPass,
            'ErrorChangePass'=>$ErrorChangePass
        ));
    }
    
    //VAST admin
    public function actionVast()
    {
        $this->pageTitle = 'Vast';
        if(Yii::app()->session['zalogowany'] != 'tak') 
        {
            $this->redirect(array('login/index'));
        }
        
        $VastAdd = false;
        $ModelVast = new VastVideo;
        $ModelCategories = new CmsvideoCategories;
        
        if(isset($_POST['VastVideo']))
        {
            $ModelVast->attributes=$_POST['VastVideo'];
            //$ModelVast->vast_source_vast ='/vast/'.$ModelVast->vast_title.'.xml'; <-- create vast .xml
             if($ModelVast->validate())
            {
                $ModelVast->AddVast();
                //$ModelVast->VastXml();  // create file .xml
                $VastAdd = true;
                $ModelVast->vast_title = '';
                $ModelVast->vast_source = '';
                $ModelVast->vast_link = '';     
            }
        }
        $DataVast = $ModelVast->DownloadVast();

        $this->render('vast', array(
            'Data' => $DataVast,
            'VastAdd' => $VastAdd,
            'ModelVast' => $ModelVast,
            'ModelCategories' => $ModelCategories,
        ));
    }
    
    public function actionVastDelete($id)
    {
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $ModelVast = new VastVideo();
        $ModelVast->DeleteVast($id);
        $this->redirect(array('admin/vast'));
    }
    
    public function actionVastUpdate($id)
    {
        $this->pageTitle = 'Edit Vast';
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $VastUpdate = false;
        $ModelVast = new VastVideo();
        $ModelCategories = new CmsvideoCategories;
        
        if(isset($_POST['VastVideo']))
        {
            $ModelVast->attributes = $_POST['VastVideo'];
            if($ModelVast->validate())
            {
                $ModelVast->SaveVast($id);
                $VastUpdate = true;
            }
            //$this->redirect(array('/admin/vast'));
        }
        else
        {
            $Data = $ModelVast->DownloadOneVast($id);
            foreach ($Data as $DataVast)
            {
                $ModelVast->vast_title = $DataVast['vast_title'];
                $ModelVast->vast_source = $DataVast['vast_source'];
                $ModelVast->vast_link = $DataVast['vast_link'];
                $ModelVast->vast_video_cat = $DataVast['vast_video_cat'];
            }
        }
        
        $this->render('vastupdate', array(
            'ModelVast' => $ModelVast,
            'VastUpdate' => $VastUpdate,
            'ModelCategories' => $ModelCategories,
        ));
    }
    // KONIEC VAST 
    
    // player
    public function actionSettings()
    {
        $this->pageTitle = 'Edycja';
        if(Yii::app()->session['zalogowany'] != 'tak') 
        {
            $this->redirect(array('login/index'));
        }
        
        $ModelPlayer = new CmsvideoPlayer;

        $DataPlayer = $ModelPlayer->DownloadPlayer();
        
        $this->render('settings', array(
            'Data' => $DataPlayer,
            'ModelPlayer' => $ModelPlayer,
        ));
    }
    
    public function actionSettingsPlayer($id)
    {
        $this->pageTitle = 'Edycja';
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $PlayerUpdate = false;
        $ModelPlayer = new CmsvideoPlayer;
        
        if(isset($_POST['CmsvideoPlayer']))
        {
            $ModelPlayer->attributes = $_POST['CmsvideoPlayer'];
            if($ModelPlayer->validate())
            {
                $ModelPlayer->SavePlayer($id);
                $PlayerUpdate = true;
            }
            $this->redirect(array('/admin/settings'));
        }
        else
        {
            $Data = $ModelPlayer->DownloadOnePlayer($id);
            foreach ($Data as $DataForm)
            {
                $ModelPlayer->player_type = $DataForm['player_type'];
                $ModelPlayer->player_autoplay = $DataForm['player_autoplay'];
            }
        }
        
        $this->render('settingsplayer', array(
            'ModelPlayer' => $ModelPlayer,
            'PlayerUpdate' => $PlayerUpdate,
        ));
    }
    
    // koniec player 
    
    // SEO
    public function actionSeo()
    {
        $this->pageTitle = 'Seo';
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }

        $SettingsUpdate = false;
        $ModelSettings = new CmsvideoSettings;
        
        if(isset($_POST['CmsvideoSettings']))
        {
            $ModelSettings->attributes = $_POST['CmsvideoSettings'];
            if($ModelSettings->validate())
            {
                $ModelSettings->SaveSettings();
                $SettingsUpdate = true;
            }
            $this->redirect(array('/admin/seo/'));
        }
        else
        {
            $Data = $ModelSettings->DownloadOneSettings();
            foreach ($Data as $DataForm)
            {
                $ModelSettings->settings_keywords = $DataForm['settings_keywords'];
                $ModelSettings->settings_description = $DataForm['settings_description'];
                $ModelSettings->settings_robots = $DataForm['settings_robots'];
                $ModelSettings->settings_ogimage = $DataForm['settings_ogimage'];
                $ModelSettings->settings_ogtitle = $DataForm['settings_ogtitle']; 
                $ModelSettings->slider_duration = $DataForm['slider_duration']; 
                $ModelSettings->slider_arrow = $DataForm['slider_arrow']; 
            }
        }
        
        $this->render('seo', array(
            'ModelSettings' => $ModelSettings,
            'SettingsUpdate' => $SettingsUpdate,
        ));
    }
    // end SEO
    //start Slider
    public function actionSlider()
    {
        $this->pageTitle = 'Slider';
        if(Yii::app()->session['zalogowany'] != 'tak') 
        {
            $this->redirect(array('login/index'));
        }
        
        $SliderAdd = false;
        
        $ModelSlider = new CmsvideoSlider;
        
        if(isset($_POST['CmsvideoSlider']))
        {
            $ModelSlider->attributes=$_POST['CmsvideoSlider'];
            
            if($ModelSlider->validate())
            {
                $ModelSlider->AddSlider();
                $SliderAdd = true;
                $ModelSlider->slider_image = '';
                $ModelSlider->slider_text = '';
            }
        }
        
        $DataSlider = $ModelSlider->DownloadSlider();
        
        $this->render('slider', array(
            'Data' => $DataSlider,
            'SliderAdd' => $SliderAdd,
            'ModelSlider' => $ModelSlider,
        ));
    }
    public function actionSliderDelete($id)
    {
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $ModelSlider = new CmsvideoSlider();
        $ModelSlider->DeleteSlider($id);
        $this->redirect(array('admin/slider'));
    }
    
    public function actionSliderUpdate($id)
    {
        $this->pageTitle = 'Edit Slider';
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $SliderUpdate = false;
        $ModelSlider = new CmsvideoSlider;
        
        if(isset($_POST['CmsvideoSlider']))
        {
            $ModelSlider->attributes = $_POST['CmsvideoSlider'];
            if($ModelSlider->validate())
            {
                $ModelSlider->SaveSlider($id);
                $SliderUpdate = true;
            }
            $this->redirect(array('/admin/slider'));
        }
        else
        {
            $Data = $ModelSlider->DownloadOneSlider($id);
            foreach ($Data as $DataForm)
            {
                $ModelSlider->slider_image = $DataForm['slider_image'];
                $ModelSlider->slider_text = $DataForm['slider_text'];
            }
        }
        
        $this->render('sliderupdate', array(
            'ModelSlider' => $ModelSlider,
            'SliderUpdate' => $SliderUpdate,
        ));
    }
    // end Slider
}

?>