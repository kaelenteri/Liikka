<?php

use Liikka\Entity\Painonmittaukset;
use Liikka\Entity\Painonmittaus;
use Liikka\Entity\Kayttajat;

include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Painonmittaus.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Painonmittaukset.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Kayttajat.php";



include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/page/osiot/tarkista_kirjautuminen.php";

$kayttajanimi = $_SESSION['kayttajanimi'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Liikunta- ja ruokapäiväkirja - Painonmittaukset - <?php echo $kayttajanimi; ?></title>
        <link rel="stylesheet" type="text/css" href="../css/tyyli.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    </head>
    <body>
        <a href="../logout/logout.php">Kirjaudu ulos</a>
        <br />
        <?php
        $pmt = new Painonmittaukset();
        $kayttaja = Kayttajat::etsi($kayttajanimi);
        $pmt->etsi($kayttaja);
        $pmt->jarjestaPvmMukaan();
        
        foreach ($pmt->getPainonmittaukset() as /* @var $pm Painonmittaus */ $pm ){
            echo $pm->getKayttaja()->getEtunimi(), " ", $pm->getKayttaja()->getSukunimi() ," " , $pm->getLukema();
        }
        ?>
    </body>
</html>
