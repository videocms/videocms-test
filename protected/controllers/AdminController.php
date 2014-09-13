<?php

class AdminController extends Controller
{
    public function actionVideo()
    {
        $this->pageTitle = 'Video';
        
        if (Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
        
        $VideoAdd = false;
        
        $ModelCategories = new CmsvideoCategories;
        $ModelVideo = new CmsvideoVideo;
        
        if(isset($_POST['CmsvideoVideo']))
        {
            $ModelVideo->attributes=$_POST['CmsvideoVideo'];
            $ModelVideo->video_date = date('Y-m-d');
            
            if($ModelVideo->validate())
            {
                $ModelVideo->AddNewVideo();
                
                $VideoAdd = true;
                $ModelVideo->video_title = '';
                $ModelVideo->video_text = '';
                $ModelVideo->video_category = '';
                $ModelVideo->video_date = '';
                $ModelVideo->video_480p = '';
                $ModelVideo->video_720p = '';
            }
        }
        
        $AmountVideo = $ModelVideo->CountAllVideo();
        
        $Site = new CPagination(intval($AmountVideo));
        $Site->pageSize = 10;
        
        $Data = $ModelVideo($Site->pageSize, $Site->currentPage);
        
        $this->render('video', array(
            'Data' => $Data,
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
        $ModelVideo->DeleteVideo($id);
        
        $this->redirect(array('admin/video'));
    }
    
    public function actionVideoUpdate($id)
    {
        $this->pageTitle = 'Edit Video';
        if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('login/index'));
        }
    }
}

?>