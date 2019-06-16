<?php
include_once 'UserActions.php';

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
      $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Uzytkownik nie moze zostac usunięty");
      return true;
    }else{
      return false;
    }
  }

  public function acceptEvent($id_event, $action){
    $sql="SELECT * FROM eventq WHERE id_event='$id_event'";
    $check = $this->db->query($sql);
    $count_row = $check->num_rows;
    if ($count_row == 1){
      //akceptacja
      if($action == 1){
        //transaction
        /*
        $this->db->autocommit(FALSE);
        $sql1 = "INSERT INTO event SELECT * FROM eventq WHERE id_event='$id_event'";
        $this->db->query($sql1);
        $sql1 = "DELETE FROM eventq WHERE id_event='$id_event'";
        $this->db->query($sql1);
        $this->db->commit();
        */
        try {
          $this->db->begin_transaction();
          $sql1 = "INSERT INTO event SELECT * FROM eventq WHERE id_event='$id_event'";
          $this->db->query($sql1);
          $sql1 = "DELETE FROM eventq WHERE id_event='$id_event'";
          $this->db->query($sql1);
          $this->db->commit();
          return true;
        } catch (Exception $e) {
          $db->rollback();
          return false;
        }
      //usunięcie
      }else if($action == 2){
        $sql1 = "DELETE FROM eventq WHERE id_event='$id_event'";
        $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Event nie moze zostac usunięty");
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
    $count_row = $check->num_rows;
    if ($count_row == 1){
      //akceptacja
      if($musicradio == 1){
        //transaction
        try {
          $this->db->begin_transaction();
          $sql1 = "INSERT INTO music SELECT * FROM musicq WHERE id_music='$music'";
          $this->db->query($sql1);
          $sql1 = "DELETE FROM musicq WHERE id_music='$music'";
          $this->db->query($sql1);
          $this->db->commit();
          return true;
        } catch (Exception $e) {
          $db->rollback();
          return false;
        }
        /*
        $sql1 = "INSERT INTO music SELECT * FROM musicq WHERE id_music='$music'";
        $stmt = $this->db->prepare($sql1);
        if(!$stmt->execute())
          $this->db->rollback();
          return false;
        //$stmt->close();
        $sql1 = "DELETE FROM musicq WHERE id_music='$music'";
        $stmt = $this->db->prepare($sql1);
        if(!$stmt->execute())
          $this->db->rollback();
          return false;
        //$stmt->close();
        $this->db->commit();
        return true;
        */
      //usunięcie
      }else if($musicradio == 2){
        $sql1 = "DELETE FROM musicq WHERE id_music='$music'";
        $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Muzyka nie moze zostac usunięta");
        return true;
      }
    else{
      return false;
    }
    }
  }

}

 ?>
