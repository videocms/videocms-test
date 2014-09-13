<?php

class CmsVideoController extends Controller
{
    public function actionIndex()
    {
        $this->pageTitle='Strona główna';
        $ModelCategories = new CmsvideoCategories;
        $DataCategory = $ModelCategories->DownloadCategories();
    }
    
    
}


?>