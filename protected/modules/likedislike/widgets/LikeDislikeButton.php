<?php

/**
 * <a href="javascript:void(0);" onclick="likedislike('<?php echo $this->field_id;?>')"><span id="displaytext_<?php echo $this->field_id;?>"><?php echo Yii::app()->getModule('likedislike')->defaultOnload($this->field_id);?></span></a><small>(<span id="likedislikecount_<?php echo $this->field_id;?>"><?php echo Yii::app()->getModule('likedislike')->countlikes($this->field_id);?></span>)</small>
 * 
 */
class LikeDislikeButton extends CWidget
{
	public $field_id;
	/**
	 * Runs the widget.
	 */
	public function run()
	{

		$assetsurl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('likedislike.assets') );
		Yii::app()->clientScript->registerScriptFile($assetsurl.'/js/likedislike.js', CClientScript::POS_HEAD);
		?>
		<span>
			<a href="javascript:void(0);" onclick="likedislike('<?php echo $this->field_id;?>')"><span id="displaytext_<?php echo $this->field_id;?>"><?php echo Yii::app()->getModule('likedislike')->defaultOnload($this->field_id);?></span></a>
			<input type="hidden" id="mybaseurl" value="<?php echo Yii::app()->baseUrl;?>/likedislike/default/likedislike">
		</span>
                
		<?php
	}
}
?>