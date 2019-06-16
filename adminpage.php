<?php
session_start();
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
                            <li class="breadcrumb-item active">Panel Administratora</li>
                          </ol>
                        </div>
                  </div>
                </div>
                <br>
                <h3> Panel Aministratora</h3><br>
                <?php
                if(isset($_SESSION['uid']) and $_SESSION['uid'] == 1){
                  ?>
                  <a href="changename.php"><button type="button" class="btn btn-dark">Zmień dane personalne</button></a>
                  <br><br>
                  <a href="changeemail.php"><button type="button" class="btn btn-dark">Zmień adres e-mail</button></a>
                  <br><br>
                  <a href="changepass.php"><button type="button" class="btn btn-dark">Zmień hasło</button></a>
                  <br><br>
                  <a href="addmusic.php"><button type="button" class="btn btn-dark">Dodaj wydawnictwo muzyczne do bazy</button></a>
                  <br><br>
                  <a href="addevent.php"><button type="button" class="btn btn-dark">Dodaj event do bazy</button></a>
                  <br><br>
                  <a href="musicqueue.php"><button type="button" class="btn btn-dark">Sprawdź poczekalnię muzyki</button></a>
                  <br><br>
                  <a href="eventqueue.php"><button type="button" class="btn btn-dark">Sprawdź poczekalnię eventów</button></a>
                  <br><br>
                  <a href="userslist.php"><button type="button" class="btn btn-dark">Sprawdź listę użytkowników</button></a>
                  <?php
                }else{
                  ?>
                  <div class="alert alert-danger" role="alert">Nie jesteś administratorem, więc nie powinno Cię tu być!</div>
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
