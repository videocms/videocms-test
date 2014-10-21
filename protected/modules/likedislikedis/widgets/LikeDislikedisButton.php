<?php


/**
 * <a href="javascript:void(1);" onclick="likedislikedis('<?php echo $this->field_iddis;?>')"><span id="displaytextdis_<?php echo $this->field_iddis;?>"><?php echo Yii::app()->getModule('likedislikedis')->defaultOnloaddis($this->field_iddis);?></span></a><small>(<span id="likedislikecountdis_<?php echo $this->field_iddis;?>"><?php echo Yii::app()->getModule('likedislikedis')->countlikesdis($this->field_iddis);?></span>)</small>
 */
class LikeDislikedisButton extends CWidget
{

	public $field_iddis;
	/**
	 * Runs the widget.
	 */
	public function run()
	{

		?>
		<span>
			<a href="javascript:void(1);" onclick="likedislikedis('<?php echo $this->field_iddis;?>')"><span id="displaytextdis_<?php echo $this->field_iddis;?>"><?php echo Yii::app()->getModule('likedislikedis')->defaultOnloaddis($this->field_iddis);?></span></a>
			<input type="hidden" id="mybaseurldis" value="<?php echo Yii::app()->baseUrl;?>/likedislikedis/default/likedislikedis">
		</span>
                
		<?php

	}
}
?>