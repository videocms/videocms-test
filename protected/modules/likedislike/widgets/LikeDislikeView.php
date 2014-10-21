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
class LikeDislikeView extends CWidget
{
	/**
	 * @property string the content name.
	 */
	public $field_id;
        public $rate_like_percent;
	/**
	 * Runs the widget.
	 */
	public function run()
	{
            function percent($num_amount, $num_total) {
        $count1 = $num_amount / $num_total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);
        return $count;
    }

                if (!(Yii::app()->getModule('likedislike')->countlikes($this->field_id)) == 0)
                {
                    
                    echo $rate_like_percent = percent(Yii::app()->getModule('likedislike')->countlikes($this->field_id), (Yii::app()->getModule('likedislike')->countlikesall($this->field_id))+ Yii::app()->getModule('likedislike')->countlikesall1($this->field_id));
                }
                else {
                        echo '0';
                }
	}
}
?>