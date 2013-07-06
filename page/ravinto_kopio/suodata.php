<?php


use Liikka\Entity\Ravinnon_saannit;

$f1 = stream_resolve_include_path('../../Entity/Ravinnon_saannit.php');
include_once $f1;

$haku = $_POST['haku'];

$rst = new Ravinnon_saannit();



//var_dump($rst);


$rst->hae($haku['nimi'], $haku['alku'], $haku['loppu'], $haku['rajoitus']);

if (count($rst->getRavinnon_saannit()) > 0) {
    $rst->jarjesta();

    $yht_kalorit = 0;
//var_dump($rst);
// luodaan table ravinnon saanneista
    echo "<table id=\"ravinnon_saannit_table\">";
    echo "<tr>";
    echo "<th>Pvm</th>";
    echo "<th>Tyyppi</th>";
    echo "<th>Ravinto</th>";
    echo "<th>Lisätieto</th>";
    echo "<th>Määrä</th>";
    echo "<th>Kalorit</th>";
    echo "<th>Kommentti</th>";
    echo "</tr>";
/* @var $rs Ravinnon_saanti */
$joo = $rst->getRavinnon_saannit();
    foreach ($joo as  $rs) {
        
        $kalorit = $rs->getMaara() * $rs->getRavinto()->getKalorit() / 100;
        $yht_kalorit += $kalorit;

        //var_dump($rs);
        echo "<tr id=\"" . $rs->getId() . "\">";
        echo "<td>" . date("d.m.Y", strtotime($rs->getPvm())) . "</td>";
        echo "<td>" . $rs->getRavinto()->getTyyppi() . "</td>";
        echo "<td>" . utf8_encode($rs->getRavinto()->getNimi()) . "</td>";
        echo "<td>" . utf8_encode($rs->getRavinto()->getMerkki()) . "</td>";
        echo "<td>" . $rs->getMaara() . $rs->getRavinto()->getTyyppi()->getGr_ml() . "</td>";
        echo "<td>" . $kalorit . "</td>";
        echo "<td>" . $rs->getKommentti() . "</td>";
        echo "</tr>";
        
    }
    echo "</table>";
    echo "<br />";




//ar_dump($pvm_ero);
    $alku_date = date_create($haku['alku']);
    $loppu_date = date_create($haku['loppu']);

    $pvm_ero =
            intval(
            date_diff($alku_date, $loppu_date)
                    ->format("%a"));

    echo "<ul>";
    echo "<li>Aikaväli: " . date("d.m.Y", strtotime($haku['alku'])) . " - " . date("d.m.Y", strtotime($haku['loppu'])) . "</li>";
    echo "<li>Päiviä tarkastelujakossa: " . $pvm_ero . "</li>";
    echo "<li>Keskimäärin päivässä saadut kalorit: " . round($yht_kalorit / $pvm_ero) . "</li>";
    echo "<li>Yhteensä saatuja kaloreit: ".$yht_kalorit."</li>";
} else {
    echo "<p style=\"color: red\">Ei tuloksia valitulle haulle. Muuta suodatusta.</p>";
}
?>