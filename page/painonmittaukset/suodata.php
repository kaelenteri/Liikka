<?php

use Liikka\Entity\Painonmittaukset;
use Liikka\Entity\Painonmittaus;

include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Painonmittaukset.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Painonmittaus.php";

$kayttajanimi = $_POST['kayttajanimi'];
$alku = $_POST['alku'];
$loppu = $_POST['loppu'];
$rajoitus = $_POST['rajoitus'];



$a1 = date_create($alku);
$l1 = date_create($loppu);


$diff = date_diff($a1, $l1);
$diff = $diff->format("%a");

$pmt = new Painonmittaukset();
$pmt->etsiNimella($kayttajanimi, $alku, $loppu, $rajoitus);
if(count($pmt->getPainonmittaukset())>0){
$pmt->jarjestaPvmMukaan();

echo "<table id=\"tulokset\">";
echo "<tr>";
echo "<th>Pvm</th>";
echo "<th>Paino</th>";
echo "</tr>";

$yht_paino = 0.0;
foreach ($pmt->getPainonmittaukset() as /* @var $rs Painonmittaus */ $pm) {
    $lukema = $pm->getLukema();
    $yht_paino += $lukema;

    //var_dump($rs);
    echo "<tr id=\"" . $pm->getId() . "\">";
    echo "<td>" . date("d.m.Y", strtotime($pm->getPvm())) . "</td>";
    echo "<td>" . sprintf($pm->getLukema(), "%.2f") . "kg</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br />";





$alku_date = date_create($alku);
$loppu_date = date_create($loppu);

$pvm_ero =
        intval(
        date_diff($alku_date, $loppu_date)
                ->format("%a"));

echo "<ul>";
echo "<li>Aikaväli: " . date("d.m.Y", strtotime($alku)) . " - " . date("d.m.Y", strtotime($loppu)) . "</li>";
echo "<li>Päiviä tarkastelujakossa: " . $pvm_ero . "</li>";
echo "<li>Painon keskiarvo taskastelujaksolla: " . round($yht_paino / count($pmt->getPainonmittaukset()), 2) . "</li>";
} else {
echo "<p style=\"color: red\">Ei tuloksia valitulle haulle. Muuta suodatusta.</p>";
}