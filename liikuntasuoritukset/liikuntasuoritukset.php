<?php
date_default_timezone_set('Europe/Helsinki');
use Liikka\Entity\Laji;
include "../entity/Laji.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/tyyli.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>




        <title></title>
    </head>
    <body>


        <?php

        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }
        $lajit_tulos = mysqli_query($conn, 'SELECT * FROM laji');
        $lajit = array();
        while ($rivi = mysqli_fetch_array($lajit_tulos)) {
            $laji = new Laji($rivi['id'], $rivi['nimi'], $rivi['kulutus'], $rivi['kommentti']);
            array_push($lajit, $laji);
        }

        mysqli_close($conn);

        function sortLajit($a, $b) {
            return strcmp($a->getNimi(), $b->getNimi());
        }

        usort($lajit, "sortLajit");

        $nimi = $_GET['kayttajanimi'];
        echo "Käyttäjän " . $nimi . " liikuntasuoritukset.";
        ?>


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
        <tr>
            <td>Laji</td>
            <td>

                <select id ="laji" style="width: 100%">
                    <option value="-1">Kaikki lajit</option>
                    <?php
                    foreach ($lajit as $laji) {
                        //TODO: Tähän muokataan drop-valikossa näkyviä lajin tietoja
                        echo "<option value =\"" . $laji->getID() . "\">" . $laji->getNimi() . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <button id="suodata" value="Suodata">Näytä</button>

    <!-- Dialogi -->
    <div id="dialogi" title="Lisää liikuntasuoritus">


        <form id="uusiAjax" method ="POST" action="lisaa_ls.php">
            <table>
                <tr>
                    <td>Päivämäärä</td>
                    <td>
                        <input type="date" id="paivays" name="pvm" value="<?php echo date("Y-m-d"); ?>"required title="Anna päivämäärä.">
                    </td>
                </tr>
                <tr>
                    <td>Laji</td>
                    <td>
                        <select name ="laji_id" style="width: 100%">

                            <?php
                            foreach ($lajit as $laji) {
                                //TODO: Tähän muokataan drop-valikossa näkyviä lajin tietoja
                                echo "<option value =\"" . $laji->getID() . "\">" . $laji->getNimi() . "</option>";
                            }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>Kesto minuutteina</td>
                    <td>
                        <input type="text" name="kesto" value="60"required pattern="^\d{1,4}$" title="Kesto minuutteina. Ainoastaan numeroita. 1-4 numeroa.">
                    </td>
                </tr>
                <tr>
                    <td>Kommentti</td>
                    <td>
                        <input type="text" id="kommentti" name="kommentti">
                    </td>
                </tr>


            </table>
            <input type="hidden" name="nimi" value="<?php echo $_GET['kayttajanimi']; ?>"> 
            <input type="submit" value="Lähetä" />
        </form>



    </div>
    <button id="lisaa">Lisää uusi</button>
    <p id="lisays"></p>





    <div id ="liikuntasuoritukset">Tähän haun tulokset.</div>
    
    <script>
    function microtime(get_as_float) {
        var now = new Date().getTime() / 1000;
        var s = parseInt(now, 10);
        return (get_as_float) ? now : (Math.round((now - s) * 1000) / 1000) + ' ' + s;
    }
    </script>
    <script>
        function suodata() {
            var time_start = microtime(true);
            
        
            var rajoitus = $("#rajoitus").val();

            var alku = $("#from").datepicker('getDate');
            alku = $.datepicker.formatDate('yy-mm-dd', alku);

            var loppu = $("#to").datepicker('getDate');
            loppu = $.datepicker.formatDate('yy-mm-dd', loppu);

            var nimi = <?php echo json_encode($_GET['kayttajanimi']); ?>;
            var laji_id = $("#laji").val();
            $.post("suodata.php",
                    {
                        nimi: nimi,
                        alku: alku,
                        loppu: loppu,
                        rajoitus: rajoitus,
                        laji_id: laji_id
                    },
            function(data) {
                $("#liikuntasuoritukset").html(data);
                var time_end = microtime(true);
                //alert("Hakuun kului aikaa: " + (time_end - time_start));
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
        $(document).ready(function() {
            $("#dialogi").dialog({
                autoOpen: false,
                modal: true,
                draggable: true,
                width: 600,
                buttons: {"Lisää": function() {
                        /*var lomake =  $("#uusiAjax");
                         
                         var validator = lomake.validate();
                         alert(validator.valid());
                         validator.form();
                         
                         
                         if(validator.valid()){
                         alert("Form is valid");
                         }else{
                         alert("Form not valid");
                         }*/


                        var form = $("#uusiAjax").serialize();

                        $.post("lisaa_ls.php", form, function() {
                            //alert("Onnistui");
                            suodata();
                            $("#uusiAjax")[0].reset();
                        }
                        );


                        //var nimi = <?php echo json_encode($_GET['kayttajanimi']); ?>;
                        /* var pvm = $("#pvm").val();
                         var laji_id = $("#laji_uusi").val();
                         var kesto = $("#kesto").val();
                         var kommentti = $("#kommentti");
                         var form = $("#uusi");*/

                        //$(this).dialog("close");

                        //alert(form);
                        //form.submit();
                        //$("#uusiAjax").submit();
                        /*$.post("lisaa_ls2.php",
                         {
                         nimi: nimi,
                         pvm: pvm,
                         laji_id: laji_id,
                         kesto: kesto,
                         kommentti: kommentti
                         },
                         function() {
                         
                         $(this).dialog("close");
                         });*/
                        $(this).dialog("close");
                    }, "Peruuta": function() {
                        $("#uusiAjax")[0].reset();
                        $(this).dialog("close");
                    }
                },
                title: "Lisää uusi liikuntasuoritus",
                show: {effect: 'drop', direction: "up"}

            });
            $("#lisaa").click(function() {
                $("#dialogi").dialog('open');
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $("#uusiB").click(function() {
                var nimi = <?php echo json_encode($_GET['kayttajanimi']); ?>;
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

    </script>
    <script>
        $(document).ready(function() {
            // bind 'myForm' and provide a simple callback function 
            $('#uusiAjax').ajaxForm(function() {
                alert("Thank you for your comment!");
            });
        });
    </script>
</body> 
</html>
