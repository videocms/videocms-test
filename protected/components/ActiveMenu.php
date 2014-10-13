<?php

Yii::import('zii.widgets.CMenu', true);

class ActiveMenu extends CMenu
{
    public function init()
    {
        // Here we define query conditions.
        $criteria = new CDbCriteria;
        //$criteria->condition = '`status` = 1';
        $criteria->order = '`id` ASC';

        $items = CmsvideoMenu::model()->findAll($criteria);

        foreach ($items as $item)
            $this->items[] = array('label'=>$item->menu_text, 'url'=>$item->menu_link);
        
        parent::init();
    }
}
?>

