<?php

class CmsvideoPlayer extends CFormModel
{
    public $player_id;
    public $player_type;
    public $player_autoplay;


    public function rules() {
        return array(
            array('player_type, player_autoplay', 'required'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'player_id' => 'ID',
            'player_type' => 'Type',
            'player_autoplay' => 'Autoplay',
        );
    }
    
     public function DownloadPlayer()
    {
        $SelectPlayer = Yii::app()->db->createCommand('SELECT * FROM videocms_player');
        $InfPlayer = $SelectPlayer->query();
        return $InfPlayer;
    }
    
    public function DownloadOnePlayer($id)
    {
        $SelectPlayer = Yii::app()->db->createCommand('Select * FROM videocms_player WHERE player_id = :IdPlayer');
        $SelectPlayer->bindValue(':IdPlayer', $id, PDO::PARAM_INT);
        $InfPlayer = $SelectPlayer->query();
        
        return $InfPlayer;
    }
    
    //////// ADD PLAYER
    
   // public function AddPLayer()
   // {
    //    $AddPlayer = Yii::app()->db->createCommand('INSERT INTO videocms_player (player_type, player_autoplay) VALUES (:PlayerType, :PlayerAutoplay)');
     //   $AddPlayer->bindValue(':PlayerType', $this->player_type, PDO::PARAM_STR);
     //   $AddPlayer->bindValue(':PlayerAutoplay', $this->player_autoplay, PDO::PARAM_STR);
     //   $AddPlayer->execute();
   // }
    
    ///////////// DELETE PLAYER
  //  public function DeletePlayer($id)
  //  {
  //      $DeletePlayer = Yii::app()->db->createCommand('DELETE FROM videocms_player WHERE player_id = :PlayerId');
  //      $DeletePlayer->bindValue(':PlayerId',$id, PDO::PARAM_INT);
  //      $DeletePlayer->execute();
  //  }
    
    public function SavePlayer($id)
    {
        $UpdatePlayer = Yii::app()->db->createCommand('UPDATE videocms_player SET player_type = :PlayerType, player_autoplay = :PlayerAutoplay WHERE player_id = :PlayerId');
        $UpdatePlayer->bindValue(':PlayerType',$this->player_type,PDO::PARAM_STR);
        $UpdatePlayer->bindValue(':PlayerSource',$this->player_autoplay,PDO::PARAM_STR);
        $UpdatePlayer->bindValue(':PlayerId',$id,PDO::PARAM_INT);
        $UpdatePlayer->execute();
    }
}
?>