<?php
 
class AdminController extends Controller
{
    public $layout='admin/index';
    public $returnLogoutUrl='/admin/login';
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        public function accessRules()
	{
		return array(
                        array('allow', // allow all users to perform 'index' and 'view' actions
                       'actions' => array('login','thankyou','activate'),
                       'users' => array('*'),
                            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','user','Logout','Videos','VideoDelete','VideoUpdate','AutocompleteTag','Category','CategoryDelete','CategoryUpdate','Pass','Vast','VastDelete','VastUpdate','Settings','Seo','Slider','SliderDelete','SliderUpdate','Users','AdduserDelete','UserUpdate','test','log','LogDelete','menu','MenuUpdate','MenuDelete','createuser','MessageDelete','Message'),
				'expression'=>'Yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    //Testowanie przypisanych reklam
    public function actionDownloadVast($id) {
        $SelectVast = Yii::app()->db->createCommand('SELECT v.video_id, v.video_category, c.name, r.vast_id, r.vast_title, r.vast_source, r.vast_video_cat FROM videocms_video AS v INNER JOIN videocms_category AS c ON v.video_category = c.id INNER JOIN videocms_vast AS r ON FIND_IN_SET(c.id, r.vast_video_cat) WHERE v.video_id = :IdVideo');
        $SelectVast->bindValue(':IdVideo', $id, PDO::PARAM_INT);
        $DataVast = $SelectVast->queryAll();
        echo '<pre>';
        foreach($DataVast as $vast) {
            print_r($vast);
        }
        echo '</pre>';
    }
    
    public function actionTest() {
         $Model = CmsvideoVideo::model()->find('video_id=:IdVideo', array(':IdVideo'=>'4649'));
       
          $TagsId = unserialize($Model->video_tags);
          print_r($TagsId);
          

//            $ModelTags = Tags::model()->findAllBySQL('SELECT tag_name FROM videocms_tags WHERE tag_id IN (' . implode(',', array_map('intval', $TagsId)) . ')');
//            foreach($ModelTags as $Data) {
//                echo $Data->tag_name;
//            }
    }
    
    public function actionIndex() {
        $this->pageTitle = 'Panel';
        
        $ModelSess = new Session;
        
        $DataSess = new CActiveDataProvider('Session', array(
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
              )
            );
        
        
            $dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'Data' => $DataSess,
                        'ModelSess' => $ModelSess
		));
}
//public function actionAdmin() {
//    $this->pageTitle = 'Panel';
//    $dataProvider=new CActiveDataProvider('User');
//        $this->render('admin',array(
//			'dataProvider'=>$dataProvider,
//		));
//}
    public function actionVideos()
    {
        $this->pageTitle = 'Videos';
        $VideoAdd = false;
        $ModelVideo = new CmsvideoVideo;
        $ModelCategories = new CmsvideoCategories;
        $ModelTags = new Tags;
        //$DataCategory = $ModelCategories->DownloadCategories();

        if(isset($_POST['CmsvideoVideo']))
        {
            $ModelVideo->attributes=$_POST['CmsvideoVideo'];
            $ImageUpload = CUploadedFile::getInstance($ModelVideo,'video_image');
            $Tags = explode(',',$ModelVideo->tag_slug);
           // if($ImageUpload != NULL || !empty($ModelVideo->video_imageurl) ) {
                $ImageNewName = date("d-m-Y-H-i-s", time())."-".$ModelVideo->video_alias.'.jpg';
                $ModelVideo->video_image = 'images/orginal/'.$ImageNewName;
                $ModelVideo->video_thumb = 'images/thumbs/'.$ImageNewName;
            //}
            
            if($ModelVideo->validate())
            {  
                if ($ImageUpload !== NULL) {
                    $ModelVideo->ImageCreate($ImageUpload, $ModelVideo->video_image);         
                }
                elseif (!empty($ModelVideo->video_imageurl)) {
                    $ModelVideo->ImageCopy($ModelVideo->video_imageurl, $ModelVideo->video_image);
                }
                else {
                    $ModelVideo->ImageCopy('images/orginal/no-image-available.jpg', $ModelVideo->video_image);
                }
                $ModelVideo->ImageThumbCreate($ModelVideo->video_image, $ModelVideo->video_thumb);
  
                if($ModelVideo->save()) {
                    $id = $ModelVideo->primaryKey;
                    if (!empty($ModelVideo->tag_slug)) {
                    $Tags = explode(',',$ModelVideo->tag_slug);
                    foreach($Tags as $TagValue) {
                       
                        $TagName = $ModelTags->ReplaceTagName($TagValue);
                        if(!empty($TagName)) {  
                            if(Tags::model()->exists('tag_slug = :TagName', array(":TagName"=>$TagName))) {
                                }
                                else {
                                    $ModelTags = new Tags;
                                    $ModelTags->tag_name = $TagValue;
                                    $ModelTags->tag_slug = $TagName;
                                    $ModelTags->save();
                                    }
                                
                        $SelectTag = $ModelTags::model()->findByAttributes(array('tag_slug'=>$TagName));
                        if(empty($SelectTag->tag_idvideo)) {
                            $TagIdVideo = array();
                            array_push($TagIdVideo, $id);
                            $NewTagIdVideo = serialize($TagIdVideo);
                            $ModelTags::model()->updateByPk($SelectTag->tag_id, array('tag_idvideo' => $NewTagIdVideo));
                            }
                            else {
                                    $TagIdVideo = unserialize($SelectTag->tag_idvideo);
                                    if(is_array($TagIdVideo)) {
                                        if(!in_array($id, $TagIdVideo)) {
                                            array_push($TagIdVideo, $id);
                                            $NewTagIdVideo = serialize($TagIdVideo);
                                            $ModelTags::model()->updateByPk($SelectTag->tag_id, array('tag_idvideo' => $NewTagIdVideo));
                                        }
                                    }
                                }
                        
                        $SelectVideo = CmsvideoVideo::model()->findByPk($id);
                        if(empty($SelectVideo->video_tags)) {
                            $TagsVideo = array();
                            array_push($TagsVideo, $SelectTag->tag_id);
                            $NewTagsVideo = serialize($TagsVideo);
                            $ModelVideo::model()->updateByPk($id, array('video_tags' => $NewTagsVideo));
                            }
                            else {
                                    $TagsVideo = unserialize($SelectVideo->video_tags);
                                    if(is_array($TagsVideo)) {
                                        if(!in_array($SelectTag->tag_id, $TagsVideo)) {
                                            array_push($TagsVideo, $SelectTag->tag_id);
                                            $NewTagsVideo = serialize($TagsVideo);
                                            $ModelVideo::model()->updateByPk($id, array('video_tags' => $NewTagsVideo));
                                        }
                                    }
                                } 
                            } 
                        }                        
                    }     
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
        
        $Data = new CActiveDataProvider('CmsvideoVideo', array(
            'sort'=>array(
            'defaultOrder'=>'video_id DESC',
			),
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
              )
            );

        $this->render('videos', array(
            'Data' => $Data,
            'VideoAdd' => $VideoAdd,
            'ModelVideo' => $ModelVideo,
            'ModelCategories' =>$ModelCategories,
        ));
    }
    
    public function actionVideoDelete($id)
    {
        
        if(!is_numeric($id))
        {
            exit;
        } 
        
        $ModelVideo = CmsvideoVideo::model()->findByPk($id);
        $ModelTags = new Tags;
        if(!empty($ModelVideo->video_image) || !empty($ModelVideo->video_thumb)) {
        $ModelVideo->DeleteVideoImage($id);
        }
        
        $TagDelete = $ModelTags::model()->findAll(
                    'tag_idvideo LIKE :Id',
                    array(':Id' => '%"'.$id.'"%')
                ); 
         
        foreach($TagDelete as $TagValue) {
                        $TagName = $ModelTags->ReplaceTagName($TagValue->tag_slug); 
                        if(Tags::model()->exists('tag_slug = :TagName', array(":TagName"=>$TagName))) {
                            $SelectTag = $ModelTags::model()->findByAttributes(array('tag_slug'=>$TagName));
                            $TagArr1 = unserialize($SelectTag->tag_idvideo);
                                if(count(array_keys($TagArr1)) <= 1) {
                                    $ModelTags::model()->deleteByPk($SelectTag->tag_id);
                                }
                                else {
                                    $TagArr2[] = $id;
                                    $TagDelDiff =  array_diff($TagArr1, $TagArr2);
                                    $NewTag = serialize($TagDelDiff);
                                    $ModelTags::model()->updateByPk($SelectTag->tag_id, array('tag_idvideo' => $NewTag));
                                    }
                        }
                }
 
        CmsvideoVideo::model()->deleteByPk($id);
        Likedislikedis::model()->deleteAll('field_id = :IdVideo' , array(':IdVideo'=>$id));
       // $this->redirect(array('admin/videos'));
        $this->redirect(Yii::app()->request->urlReferrer);
    }
    
    public function actionVideoUpdate($id)
    {
        $this->pageTitle = 'Edit Video';
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $VideoUpdate = false;
        $ModelVideo = CmsvideoVideo::model()->findByPk($id);
        $ModelTags = new Tags;


        if(isset($_POST['CmsvideoVideo']))
        {
            $ModelVideo->attributes = $_POST['CmsvideoVideo'];
            $ImageUpload = CUploadedFile::getInstance($ModelVideo,'video_image');
            if($ImageUpload !== NULL || !empty($ModelVideo->video_imageurl) ) {
               $ModelVideo->DeleteVideoImage($id);
               $ImageNewName = date("d-m-Y-H-i-s", time())."-".$ModelVideo->video_alias.'.jpg';
               $ModelVideo->video_image = 'images/orginal/'.$ImageNewName;
               $ModelVideo->video_thumb = 'images/thumbs/'.$ImageNewName;
            }
         
            if ($ModelVideo->validate())
            {
                if ($ImageUpload !== NULL) {
                    $ModelVideo->ImageCreate($ImageUpload, $ModelVideo->video_image);         
                }
                elseif (!empty($ModelVideo->video_imageurl)) {
                    $ModelVideo->ImageCopy($ModelVideo->video_imageurl, $ModelVideo->video_image);
                }
                $ModelVideo->ImageThumbCreate($ModelVideo->video_image, $ModelVideo->video_thumb);
                
                if (!empty($ModelVideo->tag_slug)) {
                    $Tags = explode(',',$ModelVideo->tag_slug);
                    foreach($Tags as $TagValue) {
                       
                        $TagName = $ModelTags->ReplaceTagName($TagValue);
                        if(!empty($TagName)) {  
                            if(Tags::model()->exists('tag_slug = :TagName', array(":TagName"=>$TagName))) {
                                }
                                else {
                                    $ModelTags = new Tags;
                                    $ModelTags->tag_slug = $TagName;
                                    $ModelTags->tag_name = $TagValue;
                                    $ModelTags->save();
                                    }
                                
                        $SelectTag = $ModelTags::model()->findByAttributes(array('tag_slug'=>$TagName));
                        if(empty($SelectTag->tag_idvideo)) {
                            $TagIdVideo = array();
                            array_push($TagIdVideo, $id);
                            $NewTagIdVideo = serialize($TagIdVideo);
                            $ModelTags::model()->updateByPk($SelectTag->tag_id, array('tag_idvideo' => $NewTagIdVideo));
                            }
                            else {
                                    $TagIdVideo = unserialize($SelectTag->tag_idvideo);
                                    if(is_array($TagIdVideo)) {
                                        if(!in_array($id, $TagIdVideo)) {
                                            array_push($TagIdVideo, $id);
                                            $NewTagIdVideo = serialize($TagIdVideo);
                                            $ModelTags::model()->updateByPk($SelectTag->tag_id, array('tag_idvideo' => $NewTagIdVideo));
                                        }
                                    }
                                }
                               
                        if(empty($ModelVideo->video_tags)) {
                            $TagsVideo = array();
                            array_push($TagsVideo, $SelectTag->tag_id);
                            $NewTagsVideo = serialize($TagsVideo);
                            $ModelVideo->video_tags = $NewTagsVideo;
                            }
                            else {
                                    $TagsVideo = unserialize($ModelVideo->video_tags);
                                    if(is_array($TagsVideo)) {
                                        if(!in_array($SelectTag->tag_id, $TagsVideo)) {
                                            array_push($TagsVideo, $SelectTag->tag_id);
                                            $NewTagsVideo = serialize($TagsVideo);
                                            $ModelVideo->video_tags = $NewTagsVideo;
                                        }
                                    }
                                } 
                            } 
                        }                        
                    }        
                $ModelVideo->save();
                
                if($ModelVideo->tag_delete) {
                    $TagDelete = explode(',',$ModelVideo->tag_delete);
                    foreach($TagDelete as $TagValue) {
                        $TagName = $ModelTags->ReplaceTagName($TagValue); 
                        $SelectTag = $ModelTags::model()->findByAttributes(array('tag_slug'=>$TagName));
                        if(Tags::model()->exists('tag_slug = :TagName', array(":TagName"=>$TagName))) {
                            $TagArr1 = unserialize($SelectTag->tag_idvideo);
                                if(count(array_keys($TagArr1)) <= 1) {
                                    $ModelTags::model()->deleteByPk($SelectTag->tag_id);
                                }
                                else {
                                    $TagArr2[] = $id;
                                    $TagDelDiff =  array_diff($TagArr1, $TagArr2);
                                    $NewTag = serialize($TagDelDiff);
                                    $ModelTags::model()->updateByPk($SelectTag->tag_id, array('tag_idvideo' => $NewTag));
                                    }
                                }
                            
                         if($ModelVideo::model()->exists('video_id = :IdVideo AND video_tags LIKE :TagName', array(":TagName" => '%"'.$SelectTag->tag_id.'"%', ":IdVideo" => $id))) {
                            $SelectVideo = CmsvideoVideo::model()->findByPk($id);
                            $VideoTagArr1[] = $SelectTag->tag_id;
                            $VideoTagArr2 = unserialize($SelectVideo->video_tags);
                            $VideoDelDiff =  array_diff($VideoTagArr2, $VideoTagArr1);
                            $NewTagVideo = serialize($VideoDelDiff);
                            $ModelVideo::model()->updateByPk($id, array('video_tags' => $NewTagVideo));
                         }                           
                    }
                }   
                $VideoUpdate = true;
            }
            $this->redirect(array('admin/videos/'));
            //$this->redirect(Yii::app()->request->urlReferrer);
        }
        
        $this->render('videoupdate', array(
            'ModelTags' => $ModelTags,
            'ModelVideo' => $ModelVideo,
            'VideoUpdate' => $VideoUpdate,
        ));
    }
    
    public function actionCategory()
    {
        $this->pageTitle = 'Category';
        $CategoryAdd = false;
        
        $ModelCategories = new CmsvideoCategories;
        
        if(isset($_POST['CmsvideoCategories']))
        {
            $ModelCategories->attributes=$_POST['CmsvideoCategories'];
            
            if($ModelCategories->validate())
            {
                $ModelCategories->save();
                $CategoryAdd = true;
                $ModelCategories->name = '';
            }
        }
        
        $DataCategory = new CActiveDataProvider('CmsvideoCategories', array(
        'sort'=>array(
	'defaultOrder'=>'id DESC',
			),
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
              )
            );
        $this->render('category', array(
            'Data' => $DataCategory,
            'CategoryAdd' => $CategoryAdd,
            'ModelCategory' => $ModelCategories
        ));
    }
    public function actionCategoryDelete($id)
    {
        if(!is_numeric($id))
        {
            exit;
        }
        CmsvideoCategories::model()->deleteAll('id=:IdCategory', array(':IdCategory'=>$id));
        $this->redirect(array('admin/category'));
    }
    
    public function actionCategoryUpdate($id)
    {
        $this->pageTitle = 'Edit Category';
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $CategoryUpdate = false;
        $ModelCategory = CmsvideoCategories::model()->findByPk($id);
        
        if(isset($_POST['CmsvideoCategories']))
        {
            $ModelCategory->attributes = $_POST['CmsvideoCategories'];
            if($ModelCategory->validate())
            {
                $ModelCategory->save();
                $CategoryUpdate = true;
            }
            $this->redirect(array('/admin/category'));
        }
        
        $this->render('categoryupdate', array(
            'ModelCategory' => $ModelCategory,
            'CategoryUpdate' => $CategoryUpdate,
        ));
    }
    
    function actionAutocompleteTag($term) {
        $criteria = new CDbCriteria;
        $criteria->compare('tag_name', $term, true);
        $ModelTags = Tags::model()->findAll($criteria);

        foreach ($ModelTags as $value) {
            $array[] = array('value' => trim($value->tag_name));
        }

        echo CJSON::encode($array);
        Yii::app()->end();
    }
    
//    public function actionPass()
//    {
//        $this->pageTitle = 'Change Pass';
//        $ChangePass = false;
//        $ErrorChangePass = false;
//        $ModelPass = new CmsvideoChangePass;
//        
//        if(isset($_POST['CmsvideoChangePass']))
//        {
//            $ModelPass->attributes=$_POST['CmsvideoChangePass'];
//            
//            if($ModelPass->validate())
//            {
//                $SelectPass = $ModelPass->SelectUser(Yii::app()->session['root']);
//                
//                foreach ($SelectPass as $ResultLine)
//                {
//                    $OldPass = $ResultLine['user_pass'];
//                }
//                
//                if($OldPass == md5($ModelPass->user_pass))
//                {
//                    if($ModelPass->user_newpass == $ModelPass->user_newpass2)
//                    {
//                        $ModelPass->UpdatePass(Yii::app()->session['root']);
//                        $ModelPass->user_pass = '';
//                        $ModelPass->user_newpass = '';
//                        $ModelPass->user_newpass2 = '';
//                        $ChangePass = true;
//                        $ErrorChangePass = 'no_error';
//                    }
//                    else {
//                        $ErrorChangePass = 'pass_no_match';
//                    }
//                    }
//                    else
//                    {
//                        $ErrorChangePass = 'wrong_pass';
//                }
//            }
//        }
//        $this->render('pass', array(
//            'ModelPass'=>$ModelPass,
//            'ErrorChangePass'=>$ErrorChangePass
//        ));
//    }
    
    //VAST admin
    public function actionVast()
    {
        $this->pageTitle = 'Vast';
        
        $VastAdd = false;
        $ModelVast = new VastVideo;
      //  $ModelCategories = new CmsvideoCategories;
        
        if(isset($_POST['VastVideo']))
        {
            $ModelVast->attributes=$_POST['VastVideo'];
            //$ModelVast->vast_source_vast ='/vast/'.$ModelVast->vast_title.'.xml'; <-- create vast .xml
             if($ModelVast->validate())
            {
                $ModelVast->vast_video_cat = implode(',', $ModelVast->video_category);
                $ModelVast->save();
                //$ModelVast->VastXml();  // create file .xml
                $VastAdd = true;
                $ModelVast->vast_title = '';
                $ModelVast->vast_source = '';
                $ModelVast->vast_link = '';     
            }
        }
        $DataVast = new CActiveDataProvider('VastVideo', array(
            'sort'=>array(
	'defaultOrder'=>'vast_id DESC',
			),
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
              )
            );
        
        $this->render('vast', array(
            'Data' => $DataVast,
            'VastAdd' => $VastAdd,
            'ModelVast' => $ModelVast,
        ));
    }
    
    public function actionVastDelete($id)
    {
        
        if(!is_numeric($id))
        {
            exit;
        }
       
        VastVideo::model()->deleteAll('vast_id=:IdVast', array(':IdVast'=>$id));
        $this->redirect(array('admin/vast'));
    }
    
    public function actionVastUpdate($id)
    {
        $this->pageTitle = 'Edit Vast';
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $VastUpdate = false;
        $ModelVast = VastVideo::model()->findByPk($id);
        
        if(isset($_POST['VastVideo']))
        {
            $ModelVast->attributes = $_POST['VastVideo'];
            if($ModelVast->validate())
            {
                $ModelVast->vast_video_cat = implode(',', $ModelVast->video_category);
                $ModelVast->save();
                $VastUpdate = true;
            }
            $this->redirect(array('/admin/vast'));
        }
        
        $this->render('vastupdate', array(
            'ModelVast' => $ModelVast,
            'VastUpdate' => $VastUpdate,
        ));
    }
    // KONIEC VAST 

    // SEO & ALL SETTINGS
    public function actionSettings()
    {
        $this->pageTitle = 'Seo';

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
            $this->redirect(array('/admin/settings/'));
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
                $ModelSettings->slider_dragorientation = $DataForm['slider_dragorientation'];
                $ModelSettings->slider_slidespacing = $DataForm['slider_slidespacing'];
                $ModelSettings->slider_mindragoffsettoslide = $DataForm['slider_mindragoffsettoslide'];
                $ModelSettings->slider_loop = $DataForm['slider_loop'];
                $ModelSettings->slider_hwa = $DataForm['slider_hwa'];
                $ModelSettings->slider_arrowkeynavigation = $DataForm['slider_arrowkeynavigation'];
                $ModelSettings->slider_lazyloading = $DataForm['slider_lazyloading'];
                $ModelSettings->disqus_shortname = $DataForm['disqus_shortname'];
                $ModelSettings->player_autoplay = $DataForm['player_autoplay'];
                $ModelSettings->player_preload = $DataForm['player_preload'];
                $ModelSettings->player_loop = $DataForm['player_loop'];
                $ModelSettings->player_controls = $DataForm['player_controls'];
            }
        }
        
        $this->render('settings', array(
            'ModelSettings' => $ModelSettings,
            'SettingsUpdate' => $SettingsUpdate,
        ));
    }
    // end SEO
    //start Slider
    public function actionSlider()
    {
        $this->pageTitle = 'Slider';
        
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
    //login
//    public function actionLogin()
//    {
//         if(Yii::app()->session['zalogowany'] == 'tak')
//        {
//            $this->redirect(array('admin/'));
//        }
//        $this->layout='admin/login';
//        $this->pageTitle = 'Login admin panel';
//        $ErrorData = false;
//        $ModelUsers = new CmsvideoUsers;
//        if (isset($_POST['CmsvideoUsers']))
//        {
//            $ModelUsers->attributes = $_POST['CmsvideoUsers'];
//            if($ModelUsers->validate())
//            {
//                $While = $ModelUsers->CountHowManyUsers();
//                if ($While == 1)
//                {
//                    Yii::app()->session['zalogowany'] = 'tak';
//                    $Results = $ModelUsers->SelectUser();
//                    
//                    foreach ($Results as $ResultsLine)
//                    {
//                        Yii::app()->session['root'] = $ResultsLine['user_id'];
//                    }
//                    
//                    $this->redirect(array('/admin'));
//                }
//                
//                else
//                {
//                    $ErrorData = true;
//                }
//            }
//        }
//        
//        $this->render('login',
//                array(
//                    'ModelUsers' => $ModelUsers,
//                    'ErrorData' => $ErrorData
//                )
//                );
//    }
//    
//    public function actionLogout()
//    {
//        Yii::app()->session['zalogowany'] = '';
//        Yii::app()->session['root'] = '';
//        
//        $this->redirect(array('/index'));
//    }

    public function actionLogin()
	{
        //$ErrorData = false;
       $this->layout='admin/login';
       $ModelUsers = new User;
       // $this->pageTitle = 'Login admin panel';
		    $model=new LoginForm('login');

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate()) {
			    if ($model->scenario=='login' && $model->login())
                            {
                                $ModelUsers->username = '';
                                $this->redirect('/admin');
                            }
                            
			    elseif ($model->scenario=='lost') {
				//$model->lostPassword();
			    }
			}
		}
                    $Data = new CActiveDataProvider('User');
		    $this->render('login',array('model'=>$model, 'ModelUsers'=>$ModelUsers, 'Data'=> $Data));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    //end login

        public function actionUserUpdate($id)
	{
		if (Yii::app()->user->id!=$id && !Yii::app()->user->isAdmin())
		    throw new CHttpException(404, "Strony nie znaleziono");
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save()) {
			    Yii::app()->user->setFlash('saved', "Zaktualizowano!");
                        } else {
                            Yii::app()->user->setFlash('failure', "Błąd!");
                        }
		}

		$this->render('userupdate',array(
			'model'=>$model,
		));
	}
        
        public function actionActivate($a) {
	    if ($a!='') {
		$model=User::model()->find('activate=:a',array(':a'=>$a));
		d2l($model->attributes);
		if ($model) {
//		    /$model->activate='';
		    if ($model->status!=User::STATUS_ACTIVE) {
			$model->status=User::STATUS_ACTIVE;
			if ($model->update(array('status'))) {
			    Yii::app()->user->login(UserIdentity::createAuthenticatedIdentity($model->username,$model->id),0);
			    d2l(Yii::app()->user->model->attributes);
			    $this->render('activate', array(
				'model'=>$model,
				'status'=>'success'));
			}
		    } else {
				Yii::app()->user->logout();
			    $this->render('activate', array(
				'model'=>$model,'status'=>'already'));
		    }
		} else {
		     throw new CHttpException(404, "Invalid Activation Code!");
		}
	    }
	}
        
        public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Dana strona nie istnieje!');
		return $model;
	}
        
    //dodanie usera
//    public function actionUser($id)
//	{
//		$this->render('user',array(
//			'model'=>$this->loadModel($id),
//		));
//	}
        
        public function actionCreateUser()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if ($model->role=='') $model->role=User::ROLE_SUBSCRIBER;
			if($model->save()) {
			    Yii::app()->user->setFlash('saved', "Użytkownik dodany poprawnie!");
			    if ($model->sendActivation())
				$this->redirect(array('thankyou','id'=>$model->id));
			    else
				throw new CHttpException(200, "Aktywacyjny email jest nie poprawny");
                        } else {
                            Yii::app()->user->setFlash('failure', "Zapis się nie powiódł!");
                        }
		}

		$this->render('createuser',array(
			'model'=>$model,
		));
	}
        public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        public function actionThankYou()
	{
		
		$this->render('thankyou',array(
			'model'=>$model,
		));
	}

    //
    public function actionUsers()
    {
         $this->pageTitle = 'AddUser';
//        $ErrorData = false;
//        $UserAdd = false;
        
        $ModelUser = new User;
        
//        if(isset($_POST['CmsvideoNewuser']))
//        {
//            $ModelUser->attributes=$_POST['CmsvideoNewuser'];
//            
//            if($ModelUser->validate())
//            {
//                if ($ModelUser->user_pass == $ModelUser->user_newpass)
//                {
//                $ModelUser->save();
//                $UserAdd = true;
//                $ModelUser->user_login = '';
//                $ModelUser->user_pass = md5($ModelUser->user_pass);
//                }
//                else
//                {
//                   $ErrorData = true;
//                }
//            }
//        }
        
        //$DataCategory = $ModelCategories->DownloadCategories();
        $DataUser = new CActiveDataProvider('User', array(
            'sort'=>array(
	'defaultOrder'=>'id DESC',
			),
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
              )
            );
        $this->render('users', array(
            'Data' => $DataUser,
            //'UserAdd' => $UserAdd,
            'ModelUser' => $ModelUser,
            //'ErrorData' => $ErrorData
        ));
    }
     public function actionAdduserDelete($id)
    {
        
        if(!is_numeric($id))
        {
            exit;
        }
        User::model()->deleteAll('id=:IdUser', array(':IdUser'=>$id));
        $this->redirect(array('admin/users'));
    }
    
//    public function actionUserUpdate($id)
//    {
//        $this->pageTitle = 'Edit User';
//        $AddUser = FALSE;
//        if(!is_numeric($id))
//        {
//            exit;
//        }
//        
//        $UserUpdate = false;
//        $ModelUser = CmsvideoNewuser::model()->findByPk($id);
//        
//        if(isset($_POST['CmsvideoNewuser']))
//        {
//            $ModelUser->attributes = $_POST['CmsvideoNewuser'];
//            if($ModelUser->validate())
//            {
//                $ModelUser->save();
//                $UserUpdate = true;
//                $AddUser = TRUE;
//            }
//            $this->redirect(array('/admin/adduser'));
//        }
//        
//        $this->render('userupdate', array(
//            'ModelUser' => $ModelUser,
//            'UserUpdate' => $UserUpdate,
//        ));
//    }
    
    //user koniec
    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionLog()
    {
         $this->pageTitle = 'Logi';
   
        $ModelLog = new log;
        
        $DataLog = new CActiveDataProvider('log', array(
            'sort'=>array(
	'defaultOrder'=>'id DESC',
			),
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
              )
            );
        $this->render('log', array(
            'Data' => $DataLog,
            'ModelLog' => $ModelLog,
        ));
    }
    
    public function actionLogDelete($id)
	{
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $ModelLog = new log;
       
        log::model()->deleteByPk($id);
 
        $this->redirect(array('admin/log'));
    
	}
        
        public function actionMenu()
    {
        $this->pageTitle = 'Menu';
        $MenuAdd = false;
        
        $ModelMenu = new CmsvideoMenu;
        
        if(isset($_POST['CmsvideoMenu']))
        {
            $ModelMenu->attributes=$_POST['CmsvideoMenu'];
            
            if($ModelMenu->validate())
            {
                $ModelMenu->save();
                $MenuAdd = true;
                $ModelMenu->menu_name = '';
                $ModelMenu->menu_text = '';
                $ModelMenu->menu_link = '';
            }
        }
        
        $DataMenu = new CActiveDataProvider('CmsvideoMenu', array(
            'sort'=>array(
	'defaultOrder'=>'id DESC',
			),
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
              )
            );
        $this->render('menu', array(
            'Data' => $DataMenu,
            'MenuAdd' => $MenuAdd,
            'ModelMenu' => $ModelMenu
        ));
    }
    public function actionMenuDelete($id)
    {
        
        if(!is_numeric($id))
        {
            exit;
        }
        CmsvideoMenu::model()->deleteAll('id=:IdMenu', array(':IdMenu'=>$id));
        $this->redirect(array('admin/menu'));
    }
    
    public function actionMenuUpdate($id)
    {
        $this->pageTitle = 'Edit Menu';
        
        if(!is_numeric($id))
        {
            exit;
        }
        
        $MenuUpdate = false;
        $ModelMenu = CmsvideoMenu::model()->findByPk($id);
        
        if(isset($_POST['CmsvideoMenu']))
        {
            $ModelMenu->attributes = $_POST['CmsvideoMenu'];
            if($ModelMenu->validate())
            {
                $ModelMenu->save();
                $MenuUpdate = true;
            }
            $this->redirect(array('/admin/menu'));
        }
        
        $this->render('menuupdate', array(
            'ModelMenu' => $ModelMenu,
            'MenuUpdate' => $MenuUpdate,
        ));
    }
    
    public function actionMessage()
    {
        $this->pageTitle = 'Wiadomość';
        $MessageAdd = false;
        
        $ModelMessage = new CmsvideoMessage;
        
        if(isset($_POST['CmsvideoMessage']))
        {
            $ModelMessage->attributes=$_POST['CmsvideoMessage'];
            
            if($ModelMessage->validate())
            {
                $ModelMessage->save();
                $MessageAdd = true;
                $ModelMessage->sender = '';
                $ModelMessage->recipient = '';
                $ModelMessage->text = '';
            }
        }
        
        $DataMessage = new CActiveDataProvider('CmsvideoMessage', array(
        'sort'=>array(
	'defaultOrder'=>'id DESC',
			),
            'pagination'=>array(
				'pageSize'=>Yii::app()->params['pageSize'],
				'pageVar'=>'page',
			),
              )
            );
        $this->render('message', array(
            'Data' => $DataMessage,
            'MessageAdd' => $MessageAdd,
            'ModelMessage' => $ModelMessage
        ));
    }
    public function actionMessageDelete($id)
    {
        if(!is_numeric($id))
        {
            exit;
        }
        CmsvideoMessage::model()->deleteAll('id=:IdMessage', array(':IdMessage'=>$id));
        $this->redirect(array('admin/message'));
    }
    
}
?>