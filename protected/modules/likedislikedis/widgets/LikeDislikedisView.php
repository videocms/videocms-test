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
class LikeDislikedisView extends CWidget
{
	/**
	 * @property string the content name.
	 */
	public $field_iddis;
        public $rate_dislike_percent;
	/**
	 * Runs the widget.
	 */
	public function run()
	{
            function percentdis($num_amountdis, $num_totaldis) {
        $count1dis = $num_amountdis / $num_totaldis;
        $count2dis = $count1dis * 100;
        $countdis = number_format($count2dis, 0);
        return $countdis;
    }

                if (!(Yii::app()->getModule('likedislikedis')->countlikesdis($this->field_iddis)) == 0)
                {
                    
                    echo $rate_dislike_percent = percentdis(Yii::app()->getModule('likedislikedis')->countlikesdis($this->field_iddis), (Yii::app()->getModule('likedislikedis')->countlikesdisall($this->field_iddis))+ Yii::app()->getModule('likedislikedis')->countlikesdisall1($this->field_iddis));
                }
                else {
                        echo '0';
                }
	}
}
?>