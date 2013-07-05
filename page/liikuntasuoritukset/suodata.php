<?php
$nimi = $_POST['nimi'];
$alku = $_POST['alku'];
$loppu = $_POST['loppu'];
$rajoitus = $_POST['rajoitus'];
$laji_id = $_POST['laji_id'];
$alkuString = date("Y-m-d", strtotime($alku));
$loppuString = date("Y-m-d", strtotime($loppu));


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

$kysely = "SELECT DISTINCT ls.kayttajanimi, ls.pvm, l.nimi AS laji, l.kulutus, ls.kesto, ls.kommentti 
            FROM liikuntasuoritus AS ls, laji AS l 
            WHERE ls.kayttajanimi = \"" . $nimi . "\" ";

if ($laji_id != -1) {
    $kysely .= "AND ls.laji_ID = " . $laji_id . " ";
}

$kysely .= "AND l.ID = ls.laji_ID 
            AND ls.pvm BETWEEN \"" . $alkuString . "\" 
            AND \"" . $loppuString . "\"   
            ORDER BY ls.pvm ASC
            LIMIT " . $rajoitus;

//echo "SQL-kysely: ". $kysely;



$tulos = mysqli_query($conn, $kysely);
if (mysqli_num_rows($tulos) > 0) {


    $liikuntasuoritukset = "
            <table id =\"liikuntasuoritukset\">
            <tr>
            <th>Päivämäärä</th>
            <th>Laji</th>
            <th>Kesto</th>
            <th>Kulutus</th>
            <th>Kommentti</th>
            </tr>            
            ";

    $yht_kulutus = 0;
    $yht_min = 0;
    while ($rivi = mysqli_fetch_array($tulos)) {

        $kulutus = ($rivi['kesto'] * $rivi['kulutus']);
        $yht_kulutus += $kulutus;
        $yht_min += $rivi['kesto'];

        $liikuntasuoritukset .="
            <tr>
            <td>" . date("d.m.Y", strtotime($rivi['pvm'])) . "</td>
            <td>" . $rivi['laji'] . "</td>
            <td>" . $rivi['kesto'] . " min</td>
            <td>" . $kulutus . " kcal</td>
            <td>" . $rivi['kommentti'] . "</td>
            </tr>
            ";
    }

    $liikuntasuoritukset .= "</table>";
    echo $liikuntasuoritukset."<br />";
    
    /*echo "<table>
            <tr>
            <td>Kulutus yhteensä</td>
            <td>" . $yht_kulutus . "</td>
            </tr>
            <tr>
            <td>Liikuttu aika yhteensä</td>
            <td>" . $yht_min . "</td>
            </tr>
            </table>";*/
    
    $al = date("d.m.Y", strtotime($alku));
    $lo = date("d.m.Y", strtotime($loppu));
    echo "<p>Aikavälillä ". $al . " - " . $lo . " liikuit yhteensä " . $yht_min . " minuuttia. 
        Tuon " . $diff . ":n päivän aikana kulutit yhteensä " . $yht_kulutus . "kcal. 
        Keskimäärin liikuit päivässä " . round($yht_min/$diff) . " min ja kulutit " . round(($yht_kulutus/$diff)) . " kcal.</p>";


    
} 

else {
    echo "<p style=\"color: red\">Ei tuloksia valitulle haulle. Muuta suodatusta.</p>";
}
mysqli_close($conn);
