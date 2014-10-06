<?php

class ImageLinkColumn extends CDataColumn {
 
    public $urlExpression;
    public $url="javascript:void(0)";
    public $linkHtmlOptions=array();
    public $imageUrl;
 
    protected function renderDataCellContent($row, $data) {
        ob_start();
        parent::renderDataCellContent($row, $data);
        $label = ob_get_clean();
 
        if($this->urlExpression!==null)
            $url=$this->evaluateExpression($this->urlExpression,array('data'=>$data,'row'=>$row));
        else
            $url=$this->url;
 
        $options=$this->linkHtmlOptions;
        if(is_string($this->imageUrl))
            echo CHtml::link(CHtml::image($this->imageUrl,$label),$url,$options);
        else
            echo CHtml::link($label,$url,$options);
    }
}
?>

