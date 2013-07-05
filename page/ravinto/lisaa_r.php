<?php

use Liikka\Entity\ApuMetodit;
include_once '../Entity/ApuMetodit.php';

// paivays, ravinto_id, maara, kommentti, nimi
$kommentti = $_POST['kommentti'];
if ($kommentti == null || $kommentti == "") {
    $kommentti = "-";
}
$lisays = array(
    "nimi" => $_POST['nimi'],
    "pvm" => $_POST['pvm'],
    "ravinto_id" => $_POST['ravinto_id'],
    "maara" => $_POST['maara'],
    "kommentti" => $kommentti,
);

// muutetaan valmiiksi hakua varten
ApuMetodit::muunnaTaulukkoKyselyaVarten($lisays);



$conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
    exit();
}

$kysely = "
INSERT INTO ravinnon_saanti (id, kayttajanimi, pvm, ravinto_id, maara, kommentti)
VALUES (
NULL, " .
        $lisays['nimi'] . ", " .
        $lisays['pvm'] . ", " .
        $lisays['ravinto_id'] . ", " .
        $lisays['maara'] . ", " .
        $lisays['kommentti'] . ")";

if(!mysqli_query($conn, $kysely)){
  die("Rivin lisäämisessa tapahtui virhe eikä riviä tallennettu. <br /> SQL-kysely: <br />".$kysely);
  //die('Error: ' . mysqli_error($con));
  
}
echo "Yksi rivi lisätty!";
// TODO: insert your code here.
mysqli_close($conn);
//echo var_dump($lisays);
/*mysqli_query($conn, 'SET NAMES \'utf8\'');
// TODO: insert your code here.
mysqli_close($conn);*/