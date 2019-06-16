<?php
session_start();
include_once 'logic/User.php';
$user = new User(); // Checking for user logged in or not

  if (isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $register = $user->registerUser($imie, $nazwisko,$username, $email, $haslo1, $haslo2);
    if ($register) {
      // Registration Success
      $_SESSION['tmpreg'] = 1;
      echo 'Registration successful <a href="login.php">Click here</a> to login';
    } else {
      // Registration Failed
      $_SESSION['tmpreg'] = 2;
      echo 'Registration failed.';
    }
 }
?>
<html>
<?php include_once 'core/head.php'; ?>

<body>
    <?php include_once 'core/header.php'; ?>

    <?php include_once 'core/userpanel.php'; ?>

    <!--sekcja main-->
    <div id="main" class="container">

        <div class="row">
            <div id="tresc" class="col-md-9">
                    <!--navibar-->
                <div id="navi" class="container">
                    <div clas="row">
                        <div class="col">
                            <br>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Strona główna</a></li>
                                <li class="breadcrumb-item active">Rejestracja</li>
                            </ol>
                        </div>
                    </div>
                </div>
              <?php
                if(isSet($_SESSION['login']) == FALSE){
                  if(isset($_SESSION['tmpreg']) and $_SESSION['tmpreg'] == 1){
                    ?>
                    <div class="alert alert-success" role="alert">Rejestracja udana! <a href="login.php">Kliknij tutaj</a> aby się zalogować!</div>
                    <?php
                    //echo 'Registration successful <a href="login.php">Click here</a> to login';
                  }else if(isset($_SESSION['tmpreg']) and $_SESSION['tmpreg'] == 2){
                    ?>
                    <div class="alert alert-danger" role="alert">Rejestracja nieudana!</div>
                    <?php
                    //echo 'Registration failed.';
                  }

              ?>
                <h3> Rejestracja nowego użytkownika</h3><br>
                <form method=post>
                    <div class="form-group">
                        <label for="Imie">Imię</label>
                        <input type="text" class="form-control" name="imie" placeholder="Podaj imię">
                    </div>
                    <div class="form-group">
                        <label for="Nazwisko">Nazwisko</label>
                        <input type="text" class="form-control" name="nazwisko" placeholder="Podaj nazwisko">
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="Username">Nazwa użytkownika</label>
                            <input type="text" class="form-control" name="username" placeholder="Login">
                            <small id="warunkiHasla" class="form-text text-muted">
                            Wymagana długość loginu to min. 5 znaków (nie więcej niż 30). Nie używaj polskich znaków.
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="Haslo">Hasło</label>
                            <input type="password" class="form-control" name="haslo1" placeholder="Hasło">
                            <small id="warunkiHasla" class="form-text text-muted">
                            Hasło powinno mieć co najmniej 8 znaków (maksymalnie 35).
                            </small>
                        </div>
                        <br>
                        <div class="form-group col">
                            <label for="Haslo">Potwierdź hasło</label>
                            <input type="password" class="form-control" name="haslo2" placeholder="Potwierdź hasło">
                    </div>

        </div>
        <!--<button type="submit" class="btn btn-primary">Zarejestruj się</button>-->
        <input onclick="return(submitlogin());" type="submit" name="submit" class="btn btn-primary" value="Zarejestruj się" />
        </form>
        <?php
      }else{
        ?>
          <div class="alert alert-warning" role="alert">Jesteś już zalogowany!</div>
      <?php
    }
       ?>
            <br>
            <a href="javascript:scroll(0,0);">Wróć na górę strony</a>
            <br>

        </div>
        <?php
          include_once 'core/menu.php';
         ?>
        </div>

    </div>

    <?php include_once 'core/footer.php'; ?>
</body>

</html>
