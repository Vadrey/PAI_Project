<?php
include_once 'logic/Database.php';
$db = new Database();
 ?>
<html>
<body>

<div id="userpanel" class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-9">
                        <?php
                          if(isset($_SESSION['uid']) and $_SESSION['uid'] == 1){
                            ?>
                            <a href="../adminpage.php"><button type="button" class="btn btn-secondary">Panel administratora</button></a>
                            <a href="logout.php"><button type="button" class="btn btn-secondary">Wyloguj się</button></a>
                            <?php
                            $usn = $_SESSION['username'];
                            echo "Witaj ";
                            echo $_SESSION['username'];
                            echo ", jesteś administratorem.";
                          }else if(isset($_SESSION['uid']) and $_SESSION['uid'] > 1){
                            ?>
                            <a href="../userpage.php"><button type="button" class="btn btn-secondary">Panel użytkownika</button></a>
                            <a href="logout.php"><button type="button" class="btn btn-secondary">Wyloguj się</button></a>
                            <?php
                            echo "Witaj ";
                            echo $_SESSION['username'];
                            echo ", jesteś użytkownikiem.";
                          }else{
                            ?>
                          <div class="btn-toolbar" role="toolbar" aria-label="Panel użytkownika">
                            <div class="btn-group mr-2" role="group" aria-label="Przyciski panelu">
                              <a href="../register.php"><button type="button" class="btn btn-secondary">Rejestracja</button></a>
                              <a href="../login.php"><button type="button" class="btn btn-secondary">Logowanie</button></a>
                            <?php
                            echo "Witaj, niezarejestrowany użytkowniku!";
                          }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
