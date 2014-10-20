<?php
/**
 * CmsBlock class file.
 * @author Christoffer Niska <christoffer.niska@nordsoftware.com>
 * @copyright Copyright &copy; 2011, Nord Software Ltd
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package cms.widgets
 */

/**
 * Widget that renders the node with the given name.
 */
class LikeDislikedisButton extends CWidget
{
	/**
	 * @property string the content name.
	 */
	public $field_iddis;
	/**
	 * Runs the widget.
	 */
	public function run()
	{

		//if(!Yii::app()->user->isGuest){
		//$assetsurl1 = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('likedislikedis.assets') );
		//Yii::app()->clientScript->registerScriptFile($assetsurl1.'/js/likedislikedis.js', CClientScript::POS_HEAD);
		?>
		<span>
			<a href="javascript:void(1);" onclick="likedislikedis('<?php echo $this->field_iddis;?>')"><span id="displaytextdis_<?php echo $this->field_iddis;?>"><?php echo Yii::app()->getModule('likedislikedis')->defaultOnloaddis($this->field_iddis);?></span></a><small>(<span id="likedislikecountdis_<?php echo $this->field_iddis;?>"><?php echo Yii::app()->getModule('likedislikedis')->countlikesdis($this->field_iddis);?></span>)</small>
			<input type="hidden" id="mybaseurldis" value="<?php echo Yii::app()->baseUrl;?>/likedislikedis/default/likedislikedis">
		</span>
                
		<?php
                //echo $rate_dislike_percent = percentdis(Yii::app()->getModule('likedislikedis')->countlikesdis($this->field_iddis), Yii::app()->getModule('likedislikedis')->countlikesdisall($this->field_iddis));
	//}
//	else{
//		
//	}
	}
}
?>