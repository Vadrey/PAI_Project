<?php
include_once 'logic/Database.php';

class User{

  protected $db;

  public function __construct(){
    //$this->db = new mysqli('localhost', 'root', '', 'bstage');

    $this->db = new Database();

    /*if(mysqli_connect_errno()) {
	     echo "Error: Could not connect to database.";
	     exit;
	  }
    */

  }

  /*** for registration process ***/
  public function registerUser($name,$surname,$username,$email,$password1,$password2){

    // test loginu
    if(strlen($username) > 30 || strlen($username) < 5 || ctype_alnum($username)==false){
        return false;
    }

    //test email
    $email2 = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($email2, FILTER_VALIDATE_EMAIL)==false) || ($email2!=$email)){
      return false;
    }

    if(strlen($password1) < 7 || strlen($password1) > 30){
      if($password1 != $password2){
          return false;
      }
      return false;
    }

    $password = md5($password1);
    $sql="SELECT * FROM user WHERE username='$username' OR email='$email'";

    //checking if the username or email is available in db
    $check =  $this->db->query($sql);
    $count_row = $check->num_rows;

    //if the username is not in db then insert to the table
    if ($count_row == 0){
      $sql1="INSERT INTO user SET username='$username', password='$password', name='$name', surname='$surname', email='$email', id_role = (SELECT id_role FROM role WHERE id_role=2)";
      //$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
      $result = $this->db->query($sql1) or die("Smth");
          return $result;
    }
    else {
      return false;
    }
  }

  /*** for login process ***/
  public function checkLogin($username, $password){

    $password = md5($password);
    $sql2="SELECT id_user, username, id_role from user WHERE username='$username' and password='$password'";

    //checking if the username is available in the table
    $result = $this->db->query($sql2);
    $user_data = $result->fetch(/*PDO::FETCH_ASSOC*/);
    $count_row = $result->rowCount();

    if ($count_row == 1) {
      // this login var will use for the session thing
      $_SESSION['login'] = true;
      $_SESSION['uid'] = $user_data['id_role'];
      $_SESSION['iduser'] = $user_data['id_user'];
      $_SESSION['username'] = $user_data['username'];
      return true;
    }else{
      return false;
    }
  }


    public function getColumn($uid,$col){
      $sql="SELECT $col FROM user WHERE id_user = $uid";
      $result = $this->db->query($sql);
      $user_data = $result->fetch(/*PDO::FETCH_ASSOC*/);
      //echo $user_data['fullname'];
    }

    /*** starting the session ***/
    public function get_session(){
      return $_SESSION['login'];
    }

    public function userLogout() {
      $_SESSION['login'] = FALSE;
      session_destroy();
    }
}
?>
