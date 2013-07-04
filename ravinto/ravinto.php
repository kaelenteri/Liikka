<?php

use Liikka\Entity\Tyyppi;
use Liikka\Entity\Ravinto;
use Liikka\Entity\Ravinnot;
use Liikka\Entity\Ravinnon_saannit;
use Liikka\Entity\Ravinnon_saanti;

include_once '../Entity/Ravinto.php';
include_once '../Entity/Ravinnot.php';
include_once '../Entity/Tyyppi.php';
include_once '../Entity/Ravinnon_saannit.php';
include_once '../Entity/Ravinnon_saanti.php';

date_default_timezone_set('Europe/Helsinki');
$kayttaja = $_GET['kayttajanimi'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../css/tyyli.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    </head>
    <body>
        <?php ?>
        <h1>Käyttäjän <?php echo $kayttaja ?> ravinnonsaanti:</h1>
        <h2>Suodata tuloksia</h2>
        <table>
            <tr>
                <td>
                    <div id="date_picker">
                        <label for="from">Alkaen</label>
                </td>
                <td>
                    <input type="text"  id="from" name="from" readonly/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="to">Loppuen</label>
                </td>
                <td>
                    <input type="text" id="to" name="to" readonly/>
                </td>
            </tr>
        </div>
        <tr>
            <td>Tuloksia</td>
            <td>
                <select id="rajoitus_ravinto" style="width: 100%">

                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="999999999">Ei rajoitusta</option>
                </select>
            </td>
        </tr>

    </table>
    <button id="suodata_ravinto" value="Suodata">Näytä ruokailut</button>
    <div id ="ravinnon_saannit">Tähän tulee ruokailut.</div>















    
    <h2>Ravinnot</h2>
    <?php
    $ravinnot = new Ravinnot();
    $ravinnot->alusta();
    if (count($ravinnot->getRavinnot()) > 0) {
        echo "<select id=\"ravinto\">";

        foreach ($ravinnot->getRavinnot() as $ravinto) {
            echo utf8_encode("<option value=\"" . $ravinto->getId() . "\">" . $ravinto->getNimi() . ", " . $ravinto->getMerkki() . ", " .$ravinto->getTyyppi()->getNimi());
        }


        echo "</select>";
    }
    ?>
    
    <br /><br />
    <ul>
        <?php 
        $ravinnons = new Ravinnon_saannit();
        $ravinnons->hae($kayttaja);
        foreach ($ravinnons->getRavinnon_saannit() as $rs){

            //echo var_dump($rs);
            echo "<li>".
                    $rs->getKayttajanimi(). ", " .
                    utf8_encode($rs->getRavinto()->getNimi()) .", ".
                    $rs->getRavinto()->getMerkki().",  ".
                    $rs->getRavinto()->getTyyppi()."</li>";
        }

        ?>
        
        
    </ul>
    
    <script>
        function suodata_ruokailut() {
            var rajoitus = $("#rajoitus_ruokailut").val();

            var alku = $("#from").datepicker('getDate');
            alku = $.datepicker.formatDate('yy-mm-dd', alku);

            var loppu = $("#to").datepicker('getDate');
            loppu = $.datepicker.formatDate('yy-mm-dd', loppu);

            var nimi = <?php echo json_encode($kayttaja); ?>;
            $.post("suodata.php",
                    {
                        nimi: nimi,
                        alku: alku,
                        loppu: loppu,
                        rajoitus: rajoitus
                    },
            function(data) {
                $("#ruokailut").html(data);
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#suodata_ruokailut").click(function() {
                suodata_ruokailut();

            });
        });
    </script>

    <script>
        $(function() {
            $("#from").datepicker({
                defaultDate: "+0w",
                changeMonth: true,
                numberOfMonths: 1,
                showWeek: true,
                dateFormat: 'dd.mm.yy',
                onClose: function(selectedDate) {
                    $("#to").datepicker("option", "minDate", selectedDate);
                }
            });
            var alku = new Date();
            alku.setHours(-168);
            $("#from").datepicker("setDate", alku);
            $("#to").datepicker({
                defaultDate: "+0w",
                changeMonth: true,
                numberOfMonths: 1,
                showWeek: true,
                dateFormat: 'dd.mm.yy',
                onClose: function(selectedDate) {
                    $("#from").datepicker("option", "maxDate", selectedDate);
                }
            });
            var loppu = new Date();
            $("#to").datepicker("setDate", loppu);
        });
    </script>
</body>
</html>