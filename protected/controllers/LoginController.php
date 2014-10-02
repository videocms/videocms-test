<?php

class LoginController extends Controller {
    public $slider_duration;
    public $slider_arrow;
    public function actionIndex()
    {
        $this->pageTitle = 'Login';
        $ErrorData = false;
        $ModelUsers = new CmsvideoUsers;
        if (isset($_POST['CmsvideoUsers']))
        {
            $ModelUsers->attributes = $_POST['CmsvideoUsers'];
            if($ModelUsers->validate())
            {
                $While = $ModelUsers->CountHowManyUsers();
                if ($While == 1)
                {
                    Yii::app()->session['zalogowany'] = 'tak';
                    $Results = $ModelUsers->SelectUser();
                    
                    foreach ($Results as $ResultsLine)
                    {
                        Yii::app()->session['root'] = $ResultsLine['user_id'];
                    }
                    
                    $this->redirect(array('/admin'));
                }
                
                else
                {
                    $ErrorData = true;
                }
            }
        }
        
        $this->render('index',
                array(
                    'ModelUsers' => $ModelUsers,
                    'ErrorData' => $ErrorData
                )
                );
    }
    
    public function actionLogout()
    {
        Yii::app()->session['zalogowany'] = '';
        Yii::app()->session['root'] = '';
        
        $this->redirect(array('cmsvideo/index'));
    }
}

?>