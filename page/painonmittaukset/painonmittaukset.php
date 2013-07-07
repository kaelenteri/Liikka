<?php

use Liikka\Entity\Painonmittaukset;
use Liikka\Entity\Painonmittaus;
use Liikka\Entity\Kayttajat;

include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Painonmittaus.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Painonmittaukset.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Kayttajat.php";



include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/page/osiot/tarkista_kirjautuminen.php";

$kayttajanimi = $_SESSION['kayttajanimi'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Liikunta- ja ruokapäiväkirja - Painonmittaukset - <?php echo $kayttajanimi; ?></title>
        <link rel="stylesheet" type="text/css" href="../css/tyyli.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    </head>
    <body>
        <a href="../logout/logout.php">Kirjaudu ulos</a>
        <br />
        <h1>Käyttäjän <?php echo $kayttajanimi ?> painonmittaukset</h1>

        <h2>Suodata tuloksia:</h2>
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
                <select id="rajoitus" style="width: 100%">
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
    <button id="suodata" value="Suodata">Näytä</button>
    <button id="lisaa">Lisää uusi</button>
    <div id="painonmittaukset">Tähän tulee painonmittaukset.</div>
    <div id="aikaa_kului">Tähän tulee kauan aikaa kului hakuun.</div>
    <div id="response"></div>

    <!-- Dialogi -->
    <div id="dialogi" title="Lisää liikuntasuoritus">


        <form id="uusiAjax" method ="POST" action="lisaa_pm.php">
            <table>
                <tr>
                    <td>Päivämäärä</td>
                    <td>
                        <input type="date" id="paivays" name="pvm" value="<?php echo date("Y-m-d"); ?>"required title="Anna päivämäärä.">
                    </td>
                </tr>
                <tr>
                    <td>Lukema</td>
                    <td>
                        <input type="text" name="lukema" value="100.00"required pattern="^\d{2,3}(,|.)\d{1,2}$" title="Paino kiloina. 2-3 etunumeroa piste tai pilkku ja 1-2 desimaalia.">
                    </td>
                </tr>
                <tr>
                    <td>Kommentti</td>
                    <td>
                        <input type="text" id="kommentti" name="kommentti">
                    </td>
                </tr>


            </table>
            <input type="hidden" name="kayttajanimi" value="<?php echo $kayttajanimi; ?>"> 
            <input type="submit" value="Lähetä" />
        </form>



    </div>

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

    <script>
        function suodata() {
            var time_start = microtime(true);


            var rajoitus = $("#rajoitus").val();

            var alku = $("#from").datepicker('getDate');
            alku = $.datepicker.formatDate('yy-mm-dd', alku);

            var loppu = $("#to").datepicker('getDate');
            loppu = $.datepicker.formatDate('yy-mm-dd', loppu);

            var kayttajanimi = <?php echo json_encode($kayttajanimi); ?>;
            
            $.post("suodata.php",
                    {
                        kayttajanimi: kayttajanimi,
                        alku: alku,
                        loppu: loppu,
                        rajoitus: rajoitus
                    },
            function(data) {
                $("#painonmittaukset").html(data);
                var time_end = microtime(true);
                $("#aikaa_kului").html("Hakuun kului aikaa: " + (time_end - time_start));
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#suodata").click(function() {
                suodata();

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#dialogi").dialog({
                autoOpen: false,
                modal: true,
                draggable: true,
                width: 600,
                buttons: {"Lisää": function() {

                        var form = $("#uusiAjax").serialize();

                        $.post("lisaa_pm.php", form, function(data) {
                            //alert(data);
                            $("#response").html(data);
                            suodata();
                            $("#uusiAjax")[0].reset();
                        }
                        );

                        $(this).dialog("close");
                    }, "Peruuta": function() {
                        $("#uusiAjax")[0].reset();
                        $(this).dialog("close");
                    }
                },
                title: "Lisää uusi painonmittaus",
                show: {effect: 'drop', direction: "up"}

            });
            $("#lisaa").click(function() {
                $("#dialogi").dialog('open');
            });

        });
    </script>
    <script>
        function microtime(get_as_float) {
            var now = new Date().getTime() / 1000;
            var s = parseInt(now, 10);
            return (get_as_float) ? now : (Math.round((now - s) * 1000) / 1000) + ' ' + s;
        }
    </script>
</body>
</html>
