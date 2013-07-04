<?php

$conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
function muunna($sana) {
    $alku = "\"";
    $loppu = "\"";

    $sana1 = $alku . $sana . $loppu;
echo $sana1;

    return $sana1;
}


$kayttaja = muunna($_POST['nimi']);
$pvm = muunna($_POST['pvm']);
$laji_id = muunna($_POST['laji_id']);
$kesto = muunna($_POST['kesto']);
$kommentti1 =($_POST['kommentti']);



if ($kommentti1 == null || $kommentti1 == "") {
    $kommentti1 = "-";
}

$kommentti = muunna($kommentti1);
$kysely = "INSERT INTO liikuntasuoritus (kayttajanimi, pvm, laji_ID, kesto, kommentti) 
    VALUES (" .$kayttaja. ", " .$pvm. ", ".$laji_id. ", ".$kesto.", ". $kommentti.")";

echo $kysely;
mysqli_query($conn, $kysely);

echo "Yksi rivi lisätty";
mysqli_close($conn);

