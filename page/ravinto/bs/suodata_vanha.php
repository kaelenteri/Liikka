<?php

function muunna($sana) {
    $alku = "\"";
    $loppu = "\"";

    $sana1 = $alku . $sana . $loppu;
//echo $sana1;

    return $sana1;
}

$kayttaja = muunna($_POST['nimi']);
$alku = $_POST['alku'];
$loppu = $_POST['loppu'];
$rajoitus = $_POST['rajoitus'];

$a1 = date_create($alku);
$l1 = date_create($loppu);
//echo $alkuString;

$diff1 = date_diff($a1, $l1);
$diff = $diff1->format("%a");

/* $a = array();
  array_push($a, $alku);
  array_push($a, $loppu);
  $das = join(", ", $a);
  echo var_dump($das); */

$conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}

$kysely = "SELECT DISTINCT ru.id AS id, 
    ru.kayttajanimi AS kayttaja, 
    r.id, ru.ruoka_id AS ruoka_id, 
    ru.pvm AS pvm, r.nimi AS ruoka, 
    ru.maara AS maara, 
    ru.kommentti AS kommentti, 
    r.kalorit AS kalorit, 
    r.kommentti AS r_kommentti 
    FROM ruokailu AS ru, ruoka AS r 
    WHERE kayttajanimi = " . $kayttaja . " 
    AND ruoka_id = r.id AND kayttajanimi = " . $kayttaja . " 
    AND pvm BETWEEN " . $alkuString . " AND " . $loppuString . " 
    ORDER BY pvm ASC 
    LIMIT " . $rajoitus;


//echo "SQL-kysely: " . $kysely . "<br /><br />";



if ($tulos = $conn->query($kysely)) {
    if ($tulos->num_rows > 0) {


        $ruokailut = "
            <table id =\"ruokailut_table\">
            <tr>
            <th>Päivämäärä</th>
            <th>Ruoka</th>
            <th>Määrä</th>
            <th>Kalorit</th>
            <th>Kommentti</th>
            </tr>            
            ";

        $yht_kalorit = 0;
        while ($rivi = mysqli_fetch_array($tulos)) {

            $kalorit = ($rivi['kalorit'] * $rivi['maara']) / 100;
            $yht_kalorit += $kalorit;

            $ruokailut .="
            <tr>
            <td>" . date("d.m.Y", strtotime($rivi['pvm'])) . "</td>
            <td>" . utf8_encode($rivi['ruoka'] .", ".$rivi['r_kommentti']). "</td>
            <td>" . $rivi['maara'] . " g</td>
            <td>" . $kalorit . " kcal</td>
            <td>" . utf8_encode($rivi['kommentti']) . "</td>
            </tr>
            ";
        }

        $ruokailut .= "</table>";
        echo $ruokailut . "<br />";

        /* echo "<table>
          <tr>
          <td>Kulutus yhteensä</td>
          <td>" . $yht_kulutus . "</td>
          </tr>
          <tr>
          <td>Liikuttu aika yhteensä</td>
          <td>" . $yht_min . "</td>
          </tr>
          </table>"; */

        $al = date("d.m.Y", strtotime($alku));
        $lo = date("d.m.Y", strtotime($loppu));
        echo "<p>Aikavälillä " . $al . " - " . $lo . " söit yhteensä " . $yht_kalorit . " kilokaloria. 
        Tuon " . $diff . ":n päivän aikana söit yhteensä " . $yht_kalorit . "kcal. 
        Keskimäärin söit päivässä " . round($yht_kalorit / $diff) . "kcal.</p>";

        $tulos->close();
    }
} else {
    echo "<p style=\"color: red\">Ei tuloksia valitulle haulle. Muuta suodatusta.</p>";
}
mysqli_close($conn);
