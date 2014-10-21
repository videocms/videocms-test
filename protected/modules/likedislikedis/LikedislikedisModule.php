<?php

class LikedislikedisModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'likedislikedis.models.*',
			'likedislikedis.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	public function defaultOnloaddis($field_iddis){
		//$user_id = yii::app()->user->GetId();
                $user_ipdis = Yii::app()->request->userHostAddress;
		$criteriadis=new CDbCriteria;
		$criteriadis->select='*';  // only select the 'title' column
		//$criteria->condition='field_id=:field_id and user_id=:user_id';
		//$criteria->params=array(':field_id'=>$field_id,':user_id'=>$user_id);
		$criteriadis->condition='field_id=:field_id and user_ip=:user_ip';
		$criteriadis->params=array(':field_id'=>$field_iddis,':user_ip'=>$user_ipdis);
                $modeldis = Likedislikedis::model()->find($criteriadis);
                		
		if(count($modeldis)==0){
			return '<img src="/css/img/dislike-ico.png">';
		}
		elseif(($modeldis->status==0) || ($modeldis->status==1)){
			return '<img src="/css/img/dislike-ico.png">';
		}
		else{
			return '<img src="/css/img/dislike-ico-h.png">';
		}
	}
        	
	public function countlikesdis($field_iddis){
		$criteriadis=new CDbCriteria;
		$criteriadis->select='count(id) as count';  // only select the 'title' column
		$criteriadis->condition='field_id=:field_id and status=:status';
		$criteriadis->params=array(':field_id'=>$field_iddis,'status'=>2);
		$modeldis = Likedislikedis::model()->find($criteriadis);
		
		return $modeldis->count;
	}
        public function countlikesdisall($field_iddis){
		$criteriadis=new CDbCriteria;
		$criteriadis->select='count(id) as count';  // only select the 'title' column
		$criteriadis->condition='field_id=:field_id and status=:status';
		$criteriadis->params=array(':field_id'=>$field_iddis,':status'=>1);
		$modeldis = Likedislikedis::model()->find($criteriadis);
		
		return $modeldis->count;
	}
        public function countlikesdisall1($field_iddis){
		$criteriadis=new CDbCriteria;
		$criteriadis->select='count(id) as count';  // only select the 'title' column
		$criteriadis->condition='field_id=:field_id and status=:status';
		$criteriadis->params=array(':field_id'=>$field_iddis,':status'=>2);
		$modeldis = Likedislikedis::model()->find($criteriadis);
		
		return $modeldis->count;
	}
}
