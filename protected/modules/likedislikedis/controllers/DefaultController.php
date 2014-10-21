<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionLikedislikedis(){
		$field_iddis = Yii::app()->request->getParam('field_id');
		//$user_id = yii::app()->user->GetId();
                $user_ipdis = Yii::app()->request->userHostAddress;
		
		$criteriadis=new CDbCriteria;
		$criteriadis->select='*';  // only select the 'title' column
                //$criteria->condition='field_id=:field_id and user_ip=:user_ip';
		//$criteria->condition='field_id=:field_id and user_id=:user_id';
		//$criteria->params=array(':field_id'=>$field_id,':user_id'=>$user_id);
                $criteriadis->condition='field_id=:field_id and user_ip=:user_ip';
		$criteriadis->params=array(':field_id'=>$field_iddis,':user_ip'=>$user_ipdis);
		$modeldis = Likedislikedis::model()->find($criteriadis);
                //$model1 = Likedislike::model()->find($criteria);
		
		if(count($modeldis)==0){
			$modeldis = new Likedislikedis();
			$modeldis->field_id = $field_iddis;
			$modeldis->user_ip = $user_ipdis;
                        //$model->user_id = $user_id;
			$modeldis->status = 2;
			$modeldis->add_timestamp = time();
			$displaynowdis = '<img src="/css/img/dislike-ico-h.png">';
		}
		else if(($modeldis->status==0) ||($modeldis->status==1)){
			$modeldis->status = 2;
			$modeldis->edit_timestamp = time();
			$displaynowdis = '<img src="/css/img/dislike-ico-h.png">';
		}
		else{
			$modeldis->status = 0;
			$modeldis->edit_timestamp = time();
			$displaynowdis = '<img src="/css/img/dislike-ico.png">';
		}
		
		if($modeldis->save()){
			$datadis['status'] = true;
			$datadis['displaytext'] = $displaynowdis;
		}
		else{
			$datadis['status'] = false;
		}
		$datadis['count'] = Yii::app()->getModule('likedislikedis')->countlikesdis($field_iddis);
		echo json_encode($datadis);
	}     
}