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
class LikeDislikeLike extends CWidget
{
	/**
	 * @property string the content name.
	 */
	public $field_id;
        //public $rate_like_percent;
	/**
	 * Runs the widget.
	 */
	public function run()
	{
  ?>
		<?php echo Yii::app()->getModule('likedislike')->countlikes($this->field_id);?>
		<?php
//	}
	}
}
?>