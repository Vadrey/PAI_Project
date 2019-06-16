<?php
session_start();
include_once 'logic/UserActions.php';
$ua = new UserActions();

if (isset($_REQUEST['submit'])) {
  extract($_REQUEST);
  $change = $ua->changeEmail($newemail,$_SESSION['iduser']);
  if ($change) {
     header("location:changeemail.php");
     $_SESSION['tmpmail'] = 1;
  } else {
      $_SESSION['tmpmail'] = 2;
  }
}

?>
<html>
<!--
    <head>
-->
<?php include_once 'core/head.php'; ?>
</head>

<body>
    <?php include_once 'core/header.php'; ?>
    <!-- sekcja header -->

    <?php
      if(1==1){
      include_once 'core/userpanel.php';
    }
    ?>
    <!--sekcja main-->
    <div id="main" class="container">
        <div class="row justify-content-right">
            <div id="tresc" class="col-md-12">
                <div id="navi" class="container">
                <!--navibar-->
                  <div clas="row">
                      <div class="col">
                          <br>
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Strona główna</a></li>
                            <?php
                            if(isset($_SESSION['uid']) and $_SESSION['uid'] == 2){ ?>
                            <li class="breadcrumb-item"><a href="userpage.php">Panel Użytkownika</a></li>
                            <?php
                          }else if(isset($_SESSION['uid']) and $_SESSION['uid'] == 1 ){ ?>
                              <li class="breadcrumb-item"><a href="adminpage.php">Panel Administatora</a></li>
                              <?php
                            }
                              ?>
                            <li class="breadcrumb-item active">Zmiana adresu e-mail</li>
                          </ol>
                        </div>
                  </div>
                </div>
                <br>
                <h3> Panel Użytkownika - zmiana adresu e-mail</h3><br>
                <?php
                if(isset($_SESSION['uid']) and $_SESSION['uid'] < 3){

                  if(isset($_SESSION['tmpmail']) and $_SESSION['tmpmail'] == 1){ ?>
                      <div class="alert alert-success" role="alert">Udało Ci się zmienić adres e-mail!</div>
                      <?php
                      $_SESSION['tmpmail'] = 0;
                    }else if(isset($_SESSION['tmpmail']) and $_SESSION['tmpmail'] == 2){
                      ?>
                      <div class="alert alert-danger" role="alert">Wystąpił problem ze zmianą Twojego adresu e-mail!</div>
                        <?php
                      $_SESSION['tmpmail'] = 0;
                    }

                  $udata = $ua->getEmail($_SESSION['iduser']);
                  echo 'Twoj adres e-mail to: ';
                  echo $udata['email'];
                  ?>
                  <br><br>
                  <form method=post>
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" name="newemail" placeholder="Podaj nowy e-mail">
                      </div>
                      <input type="submit" name="submit" class="btn btn-dark" value="Zmień adres e-mail" />
                  </form>
                  <?php
                }else{
                  ?>
                  <div class="alert alert-danger" role="alert">Nie jesteś zarejestrowanym użytkownikiem, więc nie powinno Cię tu być!</div>
                  <?php
                }
                  ?>

            <br>
            <a href="javascript:scroll(0,0);">Wróć na górę strony</a>
            <br>

        </div>
        </div>

    </div>

    <!-- sekcja footer-->
    <?php include_once 'core/footer.php'; ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

</html>
