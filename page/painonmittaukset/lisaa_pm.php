<?php
use Liikka\Entity\ApuMetodit;

include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/page/osiot/tarkista_kirjautuminen.php";

include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/ApuMetodit.php";

//pvm,lukema,kommentti, kayttajanimi
$pvm = ApuMetodit::muunnaJonoKyselyaVarten($_POST['pvm']);
$lukema = ApuMetodit::muunnaJonoKyselyaVarten($_POST['lukema']);
$kommentti = ApuMetodit::muunnaJonoKyselyaVarten($_POST['kommentti']);
$kayttajanimi = ApuMetodit::muunnaJonoKyselyaVarten($_POST['kayttajanimi']);

$conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}

$kysely = "INSERT INTO painonmittaus (pvm, lukema, kommentti, kayttajanimi) 
    VALUES ($pvm, $lukema, $kommentti, $kayttajanimi)";
if(!mysqli_query($conn, $kysely)){
      die('Riviä ei voitu lisätä. Error: ' . mysqli_error($con));
}
echo "Yksi rivi lisätty!";

mysqli_close($conn);



?>