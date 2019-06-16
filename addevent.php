<?php
session_start();
include_once 'logic/UserActions.php';
$ua = new UserActions();

if (isset($_REQUEST['submit'])) {
  extract($_REQUEST);
  $change = $ua->addEvent($eventname,$location,$eventdate,$opis,$_SESSION['iduser']);
  if ($change) {
      $_SESSION['tmpevent'] = 1;
     header("location:addevent.php");
  } else {
      $_SESSION['tmpevent'] = 2;
  }
}

?>
<html>
<!--
    <head>
-->
<?php include_once 'core/head.php'; ?>

<body>
    <?php include_once 'core/header.php'; ?>
    <!-- sekcja header -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                            <li class="breadcrumb-item active">Dodawanie nowego eventu</li>
                          </ol>
                        </div>
                  </div>
                </div>
                <br>
                <h3> Dodawanie nowego eventu</h3><br>
                <?php
                if(isset($_SESSION['uid']) and $_SESSION['uid'] < 3){

                  if(isset($_SESSION['tmpevent']) and $_SESSION['tmpevent'] == 1){ ?>
                      <div class="alert alert-success" role="alert">Udało Ci się dodać event do poczekalni!</div>
                      <?php
                      $_SESSION['tmpevent'] = 0;
                    }else if(isset($_SESSION['tmpevent']) and $_SESSION['tmpevent'] == 2){
                      ?>
                      <div class="alert alert-danger" role="alert">Wystąpił problem z dodaniem eventu!</div>
                        <?php
                      $_SESSION['tmpevent'] = 0;
                    }
                    ?>
                  <form method=post>
                      <div class="form-group">
                          <label for="nazwaeventu">Nazwa eventu:</label>
                          <input type="text" class="form-control" name="eventname" placeholder="Podaj nazwę wydarzenia">
                      </div>
                      <div class="form-group">
                          <label for="miejsceventu">Miejsce wydarzenia:</label>
                          <input type="text" class="form-control" name="location" placeholder="Podaj lokalizację">
                      </div>
                      <div class="form-group">
                        <label for="dataeventu">Data wydarzenia:</label>
                        <input type="text" class="form-control" id="datepicker" name="eventdate" placeholder="Kliknij, by wybrać datę">
                      </div>
                      <div class="form-group">
                        <label for="opiseventu">Krótki opis wydarzenia:</label>
                        <textarea class="form-control" name="opis" id="exampleFormControlTextarea1" placeholder="Maksymalnie 250 znaków." rows="4"></textarea>
                      </div>
                      <input type="submit" name="submit" class="btn btn-dark" value="Dodaj event" />
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
</body>

</html>
