<?php
include_once 'UserActions.php';
include_once 'Database.php';

class AdminActions extends UserActions{
  public function __construct(){
    parent::__construct();
  }

  public function deleteUser($usertoban){
    $sql="SELECT * FROM user WHERE username='$usertoban'";
    $check = $this->db->query($sql);
    $count_row = $check->num_rows;

    if ($count_row == 1){
      $sql1 = "DELETE FROM user WHERE username='$usertoban'";
      $result = $this->db->query($sql1) or die("Uzytkownik nie moze zostac usunięty");
      return true;
    }else{
      return false;
    }
  }

  public function acceptEvent($id_event, $action){
    $sql="SELECT * FROM eventq WHERE id_event='$id_event'";
    $check = $this->db->query($sql);
    $count_row = $check->rowCount();
    if ($count_row == 1){
      //akceptacja
      if($action == 1){

        try {
          $this->db->beginTransaction();
          $sql1 = "INSERT INTO event SELECT * FROM eventq WHERE id_event='$id_event'";
          $this->db->query($sql1);
          $sql1 = "DELETE FROM eventq WHERE id_event='$id_event'";
          $this->db->query($sql1);
          $this->db->commit();
          return true;
        } catch (Exception $e) {
          $this->db->rollBack();
          return false;
        }
      //usunięcie
      }else if($action == 2){
        $sql1 = "DELETE FROM eventq WHERE id_event='$id_event'";
        $result = $this->db->query($sql1) or die("Event nie moze zostac usunięty");
        return true;
      }
    else{
      return false;
    }
  }
}

  public function acceptMusic($music, $musicradio){
    $sql="SELECT * FROM musicq WHERE id_music='$music'";
    $check = $this->db->query($sql);
    $count_row = $check->rowCount();
    if ($count_row == 1){
      //akceptacja
      if($musicradio == 1){
        //transaction
        try {
          $this->db->beginTransaction();
          $sql1 = "INSERT INTO music SELECT * FROM musicq WHERE id_music='$music'";
          $this->db->query($sql1);
          $sql1 = "DELETE FROM musicq WHERE id_music='$music'";
          $this->db->query($sql1);
          $this->db->commit();
          return true;
        } catch (Exception $e) {
          $this->db->rollBack();
          return false;
        }

      }else if($musicradio == 2){
        $sql1 = "DELETE FROM musicq WHERE id_music='$music'";
        $result = $this->db->query($sql1) or die("Muzyka nie moze zostac usunięta");
        return true;
      }
    else{
      return false;
    }
    }
  }

}

 ?>
