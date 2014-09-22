<?php

class AdminController extends Controller
{
    public function actionVideos()
    {
        $this->pageTitle = 'Videos';
        
        if (Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        $VideoAdd = false;
        
        $ModelCategories = new CmsvideoCategories;
        $ModelVideo = new CmsvideoVideo;
        //$ModelVast = new VastVideo();

        if(isset($_POST['CmsvideoVideo']))
        {
            $ModelVideo->attributes=$_POST['CmsvideoVideo'];
            $ImageUpload = CUploadedFile::getInstance($ModelVideo,'video_image');
           // $ModelVideo->video_date = date('Y-m-d');
            if ($ImageUpload) {
            $ImageNewName = date("d-m-Y")."-".$ImageUpload->getName();
            }
            $ModelVideo->video_image = 'images/orginal/'.$ImageNewName;
            $ModelVideo->video_thumb = 'images/thumbs/th-'.$ImageNewName;
            
            if($ModelVideo->validate())
            {
                $ModelVideo->AddNewVideo();
                if ($ImageUpload) {
                $ImageAdd = $ImageUpload->saveAs('images/orginal/' . $ImageNewName);
                }
                $ModelVideo->ImageThumbCreate($ModelVideo->video_image, $ImageNewName);
                $VideoAdd = true;
                $ModelVideo->video_title = '';
                $ModelVideo->video_text = '';
                $ModelVideo->video_category = '';
            //     $ModelVideo->video_date = '';
                $ModelVideo->video_480p = '';
                $ModelVideo->video_720p = '';
                $ModelVideo->video_1080p = '';
                $ModelVideo->video_image = '';
                $ModelVideo->video_thumb = '';
            }
        }
        
        $AmountVideo = $ModelVideo->CountAllVideo();
        $Site = new CPagination(intval($AmountVideo));
        $Site->pageSize = 10;
        
        $Data = $ModelVideo->SelectVideo($Site->pageSize, $Site->currentPage);

        $this->render('videos', array(
            'Data' => $Data,
            'ImageAdd' => $ImageAdd,
            'Site' => $Site,
            'VideoAdd' => $VideoAdd,
            'ModelVideo' => $ModelVideo,
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
        $ModelVideo->DeleteVideoImage($id);
        $ModelVideo->DeleteVideo($id);
        
        $this->redirect(array('admin/videos'));
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
        $ModelCategories = new CmsvideoCategories;
        
        
        if(isset($_POST['CmsvideoVideo']))
        {
            $ModelVideo->attributes = $_POST['CmsvideoVideo'];
            $ImageUpload = CUploadedFile::getInstance($ModelVideo,'video_image');
            $ImageNewName = date("d-m-Y", time())."-".$ImageUpload->getName();
            $ModelVideo->video_image = 'images/orginal/'.$ImageNewName;
            $ModelVideo->video_thumb = 'images/thumbs/th-'.$ImageNewName;
            
            if ($ModelVideo->validate())
            {
                $ModelVideo->UpdateVideo($id);
                $ImageAdd = $ImageUpload->saveAs('images/orginal/' . $ImageNewName);
                $ModelVideo->ImageThumbCreate($ModelVideo->video_image, $ImageNewName);
                $VideoUpdate = true;
            }
            $this->redirect(array('admin/videos'));
        }
        else
        {
            $Data = $ModelVideo->DownloadVideo($id);
            
            foreach($Data as $DataVideo)
            {
                $ModelVideo->video_title = $DataVideo['video_title'];
                $ModelVideo->video_text = $DataVideo['video_text'];
                $ModelVideo->video_category = $DataVideo['video_category'];
                $ModelVideo->video_480p = $DataVideo['video_480p'];
                $ModelVideo->video_720p = $DataVideo['video_720p'];
                $ModelVideo->video_1080p = $DataVideo['video_1080p'];
                $ModelVideo->video_image = $DataVideo['video_image'];
                $ModelVideo->video_thumb = $DataVideo['video_thumb'];
            }
        }
        
        $this->render('videoupdate', array(
            'ModelVideo' => $ModelVideo,
            'ImageAdd' => $ImageAdd,
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
        $ModelVast = new VastVideo;
        
        if(isset($_POST['CmsvideoCategories']))
        {
            $ModelCategories->attributes=$_POST['CmsvideoCategories'];
            
            if($ModelCategories->validate())
            {
                $ModelCategories->AddCategory();
                $CategotyAdd = true;
                $ModelCategories->category_name = '';
                $ModelCategories->category_vast = '';
            }
        }
        
        $DataCategory = $ModelCategories->DownloadCategories();
        
        $this->render('category', array(
            'Data' => $DataCategory,
            'CategoryAdd' => $CategotyAdd,
            'ModelCategory' => $ModelCategories,
                'ModelVast' =>$ModelVast
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
        $ModelVast = new VastVideo;
        
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
                $ModelCategory->category_vast = $DataForm['category_vast'];
            }
        }
        
        $this->render('categoryupdate', array(
            'ModelCategory' => $ModelCategory,
            'CategoryUpdate' => $CategoryUpdate,
            'ModelVast' => $ModelVast,
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
            'ModelVast' => $ModelVast
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
        
        if(isset($_POST['VastVideo']))
        {
            $ModelVast->attributes = $_POST['VastVideo'];
            if($ModelVast->validate())
            {
                $ModelVast->SaveVast($id);
                $VastUpdate = true;
            }
            $this->redirect(array('/admin/vast'));
        }
        else
        {
            $Data = $ModelVast->DownloadOneVast($id);
            foreach ($Data as $DataVast)
            {
                $ModelVast->vast_title = $DataVast['vast_title'];
                $ModelVast->vast_source = $DataVast['vast_source'];
                $ModelVast->vast_link = $DataVast['vast_link'];
                //$ModelVast->vast_source_vast = $DataVast['vast_source_vast']; <-- create xml
            }
        }
        
        $this->render('vastupdate', array(
            'ModelVast' => $ModelVast,
            'VastUpdate' => $VastUpdate,
        ));
    }
    // KONIEC VAST 
}

?>