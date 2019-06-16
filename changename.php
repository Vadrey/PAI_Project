<?php
session_start();
include_once 'logic/UserActions.php';
$ua = new UserActions();

if (isset($_REQUEST['submit'])) {
  extract($_REQUEST);
    $change = $ua->changeName($newname,$newsurname,$_SESSION['iduser']);
  if ($change) {
      $_SESSION['tmpchangename'] = 1;
     header("location:changename.php");
  } else {
      $_SESSION['tmpchangename'] = 2;
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
                            <li class="breadcrumb-item active">Zmiana danych personalnych</li>
                          </ol>
                        </div>
                  </div>
                </div>
                <br>
                <h3> Panel Użytkownika - zmiana danych personalnych</h3><br>
                <?php
                if(isset($_SESSION['uid']) and $_SESSION['uid'] < 3){

                  if(isset($_SESSION['tmpchangename']) and $_SESSION['tmpchangename'] == 1){ ?>
                      <div class="alert alert-success" role="alert">Udało Ci się zmienić swoje dane!</div>
                      <?php
                      $_SESSION['tmpchangename'] = 0;
                    }else if(isset($_SESSION['tmpchangename']) and $_SESSION['tmpchangename'] == 2){
                      ?>
                      <div class="alert alert-danger" role="alert">Wystąpił problem ze zmianą Twoich danych!</div>
                        <?php
                      $_SESSION['tmpchangename'] = 0;
                    }

                  $udata = $ua->getName($_SESSION['iduser']);
                  echo 'Twoje imię to: ';
                  echo $udata['name'];
                  echo '<br>Twoje nazwisko to: ';
                  echo $udata['surname'];
                  ?>
                  <br><br>
                  <form method=post>
                      <div class="form-group">
                          <label for="login">Imie</label>
                          <input type="text" class="form-control" name="newname" placeholder="Podaj nowe imię">
                      </div>
                      <div class="form-group">
                          <label for="haslo">Nazwisko</label>
                          <input type="text" class="form-control" name="newsurname" placeholder="Podaj nowe nazwisko">
                      </div>
                      <input type="submit" name="submit" class="btn btn-dark" value="Zmień dane" />
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
