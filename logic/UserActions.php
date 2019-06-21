<?php
include_once 'logic/Database.php';

class UserActions{

  protected $db;

  public function __construct(){
    //$this->db = new mysqli('localhost', 'root', '', 'bstage');

    //if(mysqli_connect_errno()) {
     //  echo "Error: Could not connect to database.";
     //  exit;
    $pdo = new Database();
    $this->db = $pdo->connect();

    }

  public function getDatabase(){
    return $this->db;
  }

  public function getName($iduser){
    $sql="SELECT name,surname FROM user WHERE id_user = $iduser";
    $result = $this->db->query($sql);
    $user_data = $result->fetchAll(PDO::FETCH_ASSOC);
    return $user_data;
  }

  public function getEmail($iduser){
    $sql="SELECT email FROM user WHERE id_user = $iduser";
    $result = $this->db->query($sql);
    $user_data = $result->fetchAll(PDO::FETCH_ASSOC);
    return $user_data;
  }

  public function changeName($newname, $newsurname, $iduser){
    if($newname!='' and $newsurname != ''){
      $sql = "UPDATE user SET name='$newname', surname='$newsurname' WHERE id_user='$iduser'";
      if($result = $this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }else if($newname=='' || $newsurname == ''){
      return false;
    }

  }

  public function changeEmail($newemail,$iduser){
    $nemail = filter_var($newemail, FILTER_SANITIZE_EMAIL);
    if ((filter_var($nemail, FILTER_VALIDATE_EMAIL)==false) || ($newemail!=$nemail)){
      return false;
    }
    if($newemail != ''){
      $sql = "UPDATE user SET email='$newemail' WHERE id_user='$iduser'";
    }else{
      return false;
    }
    if($result = $this->db->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function changePassword($oldpassword, $newpassword, $iduser){
    if(strlen($newpassword) < 7 || strlen($newpassword) > 30){
          return false;
    }

    $opass = md5($oldpassword);
    $npass = md5($newpassword);

    $sql = "UPDATE user SET password='$npass' WHERE id_user='$iduser' AND password='$opass'";
    if($result = $this->db->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function addEvent($eventname,$location,$eventdate,$opis,$iduser){
    $sql = "INSERT INTO eventq (ename, date, location, description, id_whoadd) VALUES ('$eventname',STR_TO_DATE('$eventdate', '%m/%d/%Y'),'$location','$opis','$iduser')";
    $result = $this->db->query($sql) or die("Data cannot inserted");
    return $result;
  }

  public function addMusic($title,$performer,$year,$genreradio,$formatselect,$iduser){
    $sql = "INSERT INTO musicq (title, year, performer, id_format, id_genre, id_whoadd) VALUES ('$title', '$year', '$performer','$formatselect','$genreradio','$iduser')";
    $result = $this->db->query($sql) or die("Data cannot inserted");
    return $result;
  }

}
 ?>
