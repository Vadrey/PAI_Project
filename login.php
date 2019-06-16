<?php
  session_start();
  include_once 'logic/User.php';
  $user = new User();

  if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $login = $user->checkLogin($username, $haslo);
    if ($login) {
        // Registration Success
       header("location:index.php");
       $_SESSION['tmplogged'] = 1;
    } else {
        // Registration Failed
        echo 'Podana nazwa użytkownika oraz hasło nie istnieją w bazie!';
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
                                <li class="breadcrumb-item active">Logowanie</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <script type="text/javascript" language="javascript">

                  function submitlogin() {
                    var form = document.login;
				            if(form.username.value == ""){
					             alert( "Enter username." );
					             return false;
				            }else if(form.haslo.value == ""){
					             alert( "Enter password." );
					             return false;
				            }
			            }

                </script>
                <?php
                  if(isSet($_SESSION['login']) == FALSE){
                ?>
                <h3> Logowanie</h3><br>
                <form method=post>
                    <div class="form-group">
                        <label for="login">Nazwa użytkownika</label>
                        <input type="text" class="form-control" name="username" placeholder="Podaj nazwę użytkownika">
                    </div>
                    <div class="form-group">
                        <label for="haslo">Hasło</label>
                        <input type="password" class="form-control" name="haslo" placeholder="Podaj hasło">
                    </div>
                    <!--<button type="submit" onclick="return(submitlogin());" class="btn btn-primary">Zaloguj się</button>-->
                    <input onclick="return(submitlogin());" type="submit" name="submit" class="btn btn-primary" value="Zaloguj się" />
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
