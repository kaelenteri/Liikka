<?php

        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }
        //$tulos = mysqli_query($conn, "SELECT ls.kayttajanimi FROM liikuntasuoritus WHERE kayttajanimi = \"".$nimi."\"");
        
        
        
        
        $nimi = $_GET['kayttaja'];
        $limit = $_GET['limit'];
        
        
        
        
        
        
        $tulos = mysqli_query($conn, "
            SELECT DISTINCT ls.kayttajanimi, ls.pvm, l.nimi AS laji, l.kulutus, ls.kesto, ls.kommentti 
            FROM liikuntasuoritus AS ls, laji AS l 
            WHERE ls.kayttajanimi = \"" . $nimi . "\" AND l.ID = ls.laji_ID 
            ORDER BY ls.pvm ASC
            LIMIT 0,".$limit
                );


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

        while ($rivi = mysqli_fetch_array($tulos)) {
            // $lajinimi = mysqli_fetch_array(mysqli_query($conn, "SELECT nimi FROM laji WHERE laji.ID = \"" . $rivi['laji'] . "\""));
            $kulutus = ($rivi['kesto'] * $rivi['kulutus']);
            $liikuntasuoritukset .="
            <tr>
            <td>" . $rivi['pvm'] . "</td>
            <td>" . $rivi['laji'] . "</td>
            <td>" . $rivi['kesto'] . " min</td>
            <td>" . $kulutus . " kcal</td>
            <td>" . $rivi['kommentti'] . "</td>
            </tr>
            ";
        }

        $liikuntasuoritukset .= "</table>";
        echo $liikuntasuoritukset;
        mysqli_close($conn);


