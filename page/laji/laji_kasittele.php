<?php

$conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
$alku = "\"";
$loppu = "\"";

$nimi = $_POST['nimi'];
$kulutus = $_POST['kulutus'];
$kommentti = $_POST['kommentti'];
if($kommentti == "" || $kommentti == NULL){$kommentti = "Ei kommenttia";}


$nimi = $alku . $nimi . $loppu;
$kulutus = $alku . $kulutus . $loppu;
$kommentti = $alku . $kommentti . $loppu;
echo $nimi . "<br>" . $kulutus . "<br>" . $kommentti ."<br>";

$kysely = "INSERT INTO laji (nimi, kulutus, kommentti ) VALUES (" .$nimi. ", " .$kulutus. ", ".$kommentti. ")";
echo $kysely;

mysqli_query($conn, $kysely);
echo "Yksi rivi lisätty!";
mysqli_close($conn);