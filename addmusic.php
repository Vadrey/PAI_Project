<?php
session_start();
include_once 'logic/UserActions.php';
$ua = new UserActions();

if (isset($_REQUEST['submit'])) {
  extract($_REQUEST);
  $change = $ua->addMusic($title,$performer,$year,$genreradio,$formatselect,$_SESSION['iduser']);
  if ($change) {
      $_SESSION['tmpmusic'] = 1;
     header("location:addmusic.php");
  } else {
      $_SESSION['tmpmusic'] = 2;
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
                            <li class="breadcrumb-item active">Dodawanie muzyki</li>
                          </ol>
                        </div>
                  </div>
                </div>
                <br>
                <h3> Dodawanie nowego wydawnictwa muzycznego</h3><br>
                <?php
                if(isset($_SESSION['uid']) and $_SESSION['uid'] < 3){

                  if(isset($_SESSION['tmpmusic']) and $_SESSION['tmpmusic'] == 1){ ?>
                      <div class="alert alert-success" role="alert">Udało Ci się dodać muzykę do poczekalni!</div>
                      <?php
                      $_SESSION['tmpmusic'] = 0;
                    }else if(isset($_SESSION['tmpmusic']) and $_SESSION['tmpmusic'] == 2){
                      ?>
                      <div class="alert alert-danger" role="alert">Wystąpił problem z dodaniem muzyki!</div>
                        <?php
                      $_SESSION['tmpmusic'] = 0;
                    }
                    ?>
                  <form method=post>
                      <div class="form-group">
                          <label for="nazwamuzyki">Tytuł:</label>
                          <input type="text" class="form-control" name="title" placeholder="Podaj nazwę wydawnictwa">
                      </div>
                      <div class="form-group">
                          <label for="wykonawca">Wykonawca:</label>
                          <input type="text" class="form-control" name="performer" placeholder="Podaj wykonawcę">
                      </div>
                      <div class="form-group">
                        <label for="dataeventu">Rok wydania:</label>
                        <input type="text" class="form-control" name="year" placeholder="Wpisz rok">
                      </div>
                      <!-- wybór gatunku -->
                      <div class="form-group">
                        <label for="gatunekmuzyczny">Wybierz gatunek muzyczny:</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="genreradio" id="reggaeradio" value="1" checked>
                          <label class="form-check-label" for="reggaeradio">
                            Reggae
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="genreradio" id="rootsradio" value="2">
                          <label class="form-check-label" for="rootsradio">
                            Roots
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="genreradio" id="dubradio" value="3" checked>
                          <label class="form-check-label" for="dubradio">
                            Dub
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="genreradio" id="bassradio" value="4">
                          <label class="form-check-label" for="bassradio">
                            Bass Music
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="genreradio" id="jungleradio" value="5">
                          <label class="form-check-label" for="jungleradio">
                            Jungle
                          </label>
                        </div>
                      </div>
                      <!-- wybór fortmatu -->
                      <div class="form-group">
                        <label for="formatselect">Wybierz format wydawnictwa</label>
                          <select class="form-control" name="formatselect" id="formatselect">
                            <option value="1">CD</option>
                            <option value="2">Vinyl</option>
                            <option value="3">Digital</option>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-dark" value="Dodaj muzykę" />
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
