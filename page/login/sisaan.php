<?php

use Liikka\Entity\Kayttajat;

include_once '../../Entity/Kayttajat.php';


$kayttajanimi = $_POST['kayttajanimi'];
$salasana = $_POST['salasana'];

echo $kayttajanimi . "<br />";
echo $salasana;

if (Kayttajat::kirjautuminenOk($kayttajanimi, $salasana)) {
    session_start();
    $_SESSION['kayttajanimi'] = $kayttajanimi;
    $_SESSION['kirjautunut'] = true;
    header("Location: ../kayttaja/kayttaja.php");
    //header("Location: ../liikuntasuoritukset/liikuntasuoritukset.php?kayttajanimi=$kayttajanimi");
} else {

    header('Location: login.php');
}

