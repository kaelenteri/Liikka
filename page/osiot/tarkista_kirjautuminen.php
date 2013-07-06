<?php
session_start();
if (!isset($_SESSION['kayttajanimi']) || !isset($_SESSION['kirjautunut']) || $_SESSION['kirjautunut'] == false) {
    header('Location: ../login/login.php');
}
date_default_timezone_set('Europe/Helsinki');
