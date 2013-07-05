<?php
/*


  use Liikka\Entity\Ravinnon_saannit;
  use Liikka\Entity\Ravinnon_saanti;
  use Liikka\Entity\ApuMetodit;




  include_once '../Entity/Ravinnon_saannit.php';
  include_once '../Entity/Ravinnon_saanti.php';
  include_once '../Entity/ApuMetodit.php'; */

use Liikka\Entity\Ravinnot;
use Liikka\Entity\Ravinto;
use Liikka\Entity\Tyyppi;

include_once '../../Entity/Tyyppi.php';
include_once '../../Entity/Ravinto.php';
include_once '../../Entity/Ravinnot.php';
session_start();
if(!isset($_SESSION['kayttajanimi']) || !isset($_SESSION['kirjautunut']) || $_SESSION['kirjautunut'] == false){
    header('Location: ../login/login.php');
}
date_default_timezone_set('Europe/Helsinki');
$kayttajanimi = $_SESSION['kayttajanimi'];
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
        <a href="../logout/logout.php">Kirjaudu ulos</a>
        <br />
        <?php ?>
        <h1>Käyttäjän <?php echo $kayttajanimi ?> ravinnonsaanti:</h1>
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
                <select id="rajoitus_ravinnon_saanti" style="width: 100%">

                    <option value="2">2</option>
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
    <button id="suodata_ravinnon_saanti_button" value="Suodata">Näytä ruokailut</button>
    <div id="dialogi" title="Lisää ravinnon saanti">


        <form id="uusiAjax" method="POST" action="lisaa_r.php">
            <table>
                <tr>
                    <td>Päivämäärä</td>
                    <td>
                        <input type="date" id="paivays" name="pvm" value="<?php echo date("Y-m-d"); ?>"required title="Anna päivämäärä.">
                    </td>
                </tr>
                <tr>
                    <td>Ravinto</td>
                    <td>


                        <?php
                        $ravinnot = new Ravinnot();
                        $ravinnot->alusta();


                        if (count($ravinnot->getRavinnot()) > 0) {
                            echo "<select id=\"ravinto_id\" name=\"ravinto_id\">";

                            foreach ($ravinnot->getRavinnot() as $ravinto) {
                                echo utf8_encode("<option value=\"" . $ravinto->getId() . "\">" . $ravinto->getNimi() . ", " . $ravinto->getMerkki() . ", " . $ravinto->getTyyppi()->getNimi());
                            }
                            echo "</select>";
                        }
                        ?>
                    </td>
                </tr> 
                <tr>
                    <td>Määrä (g tai ml)</td>
                    <td>
                        <input type="text" name="maara" value="100" maxlength="5" required pattern="^\d{1,5}$" title="Määrä grammoina tai millilitroina. 1-5 numeroa.">
                    </td>
                </tr>
                <tr>
                    <td>Kommentti</td>
                    <td>
                        <input type="text" id="kommentti" name="kommentti">
                    </td>
                </tr>


            </table>
            <input type="hidden" name="nimi" value="<?php echo $kayttajanimi; ?>"> 
            <input type="submit" value="Lähetä" />
        </form>



    </div>
    <button id="lisaa">Lisää uusi</button>

    <div id="ravinnon_saannit">Tähän tulee ruokailut.</div>

    <div id="testi">Tähän response</div>

    <h2>Ravinnot</h2>
    <?php
    ?>

    <br /><br />



</table>

<script>
    $(document).ready(function() {

        $("#dialogi").dialog({
            autoOpen: false,
            modal: true,
            draggable: true,
            width: 600,
            buttons: {"Lisää": function() {


                    var form = $("#uusiAjax").serialize();
                    var jee = "Jee";

                    $.post("lisaa_r.php", form, function(data) {
                        alert(data);
                        //$("#testi").html(data);
                        suodata_ravinnon_saanti();

                        $("#uusiAjax")[0].reset();
                    }
                    );


                    $(this).dialog("close");
                }, "Peruuta": function() {
                    $("#uusiAjax")[0].reset();
                    $(this).dialog("close");
                }
            },
            title: "Lisää uusi ravinnon saanti",
            show: {effect: 'clip', direction: "up"}

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

<script>
    function suodata_ravinnon_saanti() {
        var time_start = microtime(true);

        var rajoitus = $("#rajoitus_ravinnon_saanti").val();

        var alku = $("#from").datepicker('getDate');
        alku = $.datepicker.formatDate('yy-mm-dd', alku);

        var loppu = $("#to").datepicker('getDate');
        loppu = $.datepicker.formatDate('yy-mm-dd', loppu);

        var nimi = <?php echo json_encode($kayttajanimi); ?>;


        //var haku = <?php echo json_encode(serialize(array("nimi" => "make", "ika" => "23"))) ?>;
        //var haku = "jahuu";

        $.post("suodata.php",
                {
                    haku: {
                        nimi: nimi,
                        alku: alku,
                        loppu: loppu,
                        rajoitus: rajoitus
                    }
                },
        function(data) {
            $("#ravinnon_saannit").html(data);
            var time_end = microtime(true);
            //alert("Hakuun kului aikaa: " + (time_end - time_start));
        });
    }
</script>

<script>
    $(document).ready(function() {
        $("#suodata_ravinnon_saanti_button").click(function() {
            suodata_ravinnon_saanti();

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
<script>
    /*
     $(document).ready(function() {
     $("#uusiB").click(function() {
     var nimi = <?php echo json_encode($kayttajanimi); ?>;
     var pvm = $("#pvm").val();
     var laji_id = $("#laji_uusi").val();
     var kesto = $("#kesto").val();
     var kommentti = $("#kommentti");
     
     $.post("lisaa_ls.php",
     {
     nimi: nimi,
     pvm: pvm,
     laji_id: laji_id,
     kesto: kesto,
     kommentti: kommentti
     },
     function() {
     
     $("#dialogi").dialog("close");
     });
     
     });
     });
     */
</script>
</body>
</html>


