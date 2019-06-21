<?php
session_start();
include_once 'logic/AdminActions.php';
$admin = new AdminActions();

if (isset($_REQUEST['submit'])) {
  extract($_REQUEST);
  $change = $admin->acceptMusic($music, $musicradio);
  if ($change) {
     header("location:musicqueue.php");
     $_SESSION['tmpmusicq'] = 1;
  } else {
      $_SESSION['tmpmusicq'] = 2;
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
                            <li class="breadcrumb-item"><a href="adminpage.php">Panel Administratora</a></li>
                            <li class="breadcrumb-item active">Kolejka muzyki</li>
                          </ol>
                        </div>
                  </div>
                </div>
                <br>
                <h3> Kolejka muzyki</h3><br>
                <?php
                if(isset($_SESSION['uid']) and $_SESSION['uid'] == 1){

                  if(isset($_SESSION['tmpmusicq']) and $_SESSION['tmpmusicq'] == 1){ ?>
                      <div class="alert alert-success" role="alert">Akcja została wykonana pomyślnie!</div>
                      <?php
                      $_SESSION['tmpmusicq'] = 0;
                    }else if(isset($_SESSION['tmpmusicq']) and $_SESSION['tmpmusicq'] == 2){
                      ?>
                      <div class="alert alert-danger" role="alert">Wystąpił problem z wykonaniem akcji!</div>
                        <?php
                      $_SESSION['tmpmusicq'] = 0;
                    }
                  ?>

                  <form method=post>
                      <div class="form-group">
                          <label for="event">Wykonaj akcję na wydawnictwie o ID:</label>
                          <input type="text" class="form-control" name="music" placeholder="Podaj ID wydawnictwa">
                      </div>
                      <div class="form-group">
                        <label for="musicradio">Wybierz akcję do wykonania:</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="musicradio" id="acceptradio" value="1">
                          <label class="form-check-label" for="acceptradio">
                            Zaakceptuj
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="musicradio" id="deleteradio" value="2">
                          <label class="form-check-label" for="deleteradio">
                            Usuń
                          </label>
                        </div>
                      </div>
                      <input type="submit" name="submit" class="btn btn-dark" value="Wykonaj" />
                  </form>


                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID Muzyki</th>
                        <th>Wykonawca</th>
                        <th>Tytuł</th>
                        <th>Rok wydania</th>
                        <th>Format</th>
                        <th>Gatunek</th>
                        <th>Data dodania</th>
                        <th>Dodany przez</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include_once 'logic/Database.php';
                      include_once 'logic/MusicQTablePrinter.php';
//                      $database = new Database();
//                      $q ="SELECT * FROM muzykaq";
//                      $result = $database->query($q);
                      $musicPrinter = new MusicQTablePrinter("SELECT * FROM muzykaq");
                      $musicPrinter->printTable();
                      ?>
                      <tr>
                        <?php
                        //while($row = mysqli_fetch_assoc($result)){
//                        foreach($result as $row){
//                          ?>
<!--                          <th scope="row">--><?php //echo $row["id_music"]; ?><!--</th>-->
<!--                          <td>--><?php //echo $row["performer"]; ?><!--</td>-->
<!--                          <td>--><?php //echo $row["title"]; ?><!--</td>-->
<!--                          <td>--><?php //echo $row['year']; ?><!--</td>-->
<!--                          <td>--><?php //echo $row['ftype']; ?><!--</td>-->
<!--                          <td>--><?php //echo $row['gname']; ?><!--</td>-->
<!--                          <td>--><?php //echo $row['add_date']; ?><!--</td>-->
<!--                          <td>--><?php //echo $row['username']; ?><!--</td></td>-->
<!--                        </tr>-->
                    <?php
                 // }

                  //$result->closeCursor();
                  //$database->finish();

                   ?>
                 </tbody>
               </table>
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
