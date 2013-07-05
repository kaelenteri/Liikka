<?php
session_start();
if (!isset($_SESSION['kayttajanimi']) || !isset($_SESSION['kirjautunut']) || $_SESSION['kirjautunut'] == false) {
    header('Location: ../login/login.php');
}
/*
  if (!isset($_SESSION['kayttajanimi'])) {
  header('Location: ../login.login.php');
  }
  if (!isset($_SESSION['kirjautunut'])) {
  header('Location: ../login.login.php');
  }
  if ($_SESSION['kirjautunut'] == false) {
  header('Location: ../login.login.php');
  }
 */
$kayttajanimi = $_SESSION['kayttajanimi'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <a href="../logout/logout.php">Kirjaudu ulos</a>
        <br />
        <h1>Käyttäjän <?php echo $kayttajanimi ?> käyttäjäsivu</h1>
        <p><a href="../liikuntasuoritukset/liikuntasuoritukset.php">Liikuntasuoritukset</a></p>
        <p><a href="../ravinto/ravinto.php">Ravinnon saanti</a></p>
    </body>
</html>
