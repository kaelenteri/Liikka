<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <title></title>
    </head>
    <body>
        <?php
        include "../entity/Laji.php";
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
        ?>
        <div id="dialogi" title="Lisää liikuntasuoritus">


            <form id="uusi" action="lisaa_ls.php" method="POST">
                <table>
                    <tr>
                        <td>Päivämäärä</td>
                        <td>
                            <input type="date" id="pvm" name="paivays">
                        </td>
                    </tr>
                    <tr>
                        <td>Laji</td>
                        <td>
                            <select id ="laji" style="width: 100%">

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
                            <input type="text" id="kesto" required pattern="^\d{1,4}$" title="Kesto minuutteina. Ainoastaan numeroita. 1-4 numeroa.">
                        </td>
                    </tr>
                    <tr>
                        <td>Kommentti</td>
                        <td>
                            <input type="text" id="kommenti">
                        </td>
                    </tr>

                </table>
                <input type="submit" value="jahu">
            </form>


        </div>
        <button id="nayta">Näytä</button>
        <?php
        // put your code here
        ?>
    </body>
    <script>
        $(function() {
            $("#dialogi").dialog({
                autoOpen: false,
                modal: true,
                draggable: true,
                buttons: {"Lisää": function() {
                        $(this).dialog("close");
                    }, "Peruuta": function() {
                        $(this).dialog("close");
                    }
                },
                title: "Lisää uusi liikuntasuoritus",
                show: {effect: 'drop', direction: "up"}

            });
            $("#nayta").click(function() {
                $("#dialogi").dialog('open');
            });

        });
    </script>
</html>
