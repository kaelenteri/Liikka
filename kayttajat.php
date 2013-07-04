<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="tyyli.css">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".user").click(function() {
                    $name = $(this).attr("user");
                    window.location.replace("liikuntasuoritukset/liikuntasuoritukset.php?kayttajanimi="+$name);
                });
            });
        </script>
        <title>Moiccu</title> 
    </head>
    <body>

        <?php
        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }
        

        $tulos = mysqli_query($conn, "SELECT * FROM kayttaja");

        $taulukko = "
    <table class=\"kayttajataulukko\">
    <tr>
    <th>Käyttäjänimi</th>
    <th>Etunimi</th>
    <th>Sukunimi</th>
    <th>Pituus</th>
    </tr>"
        ;

        while ($rivi = mysqli_fetch_array($tulos)) {
            $taulukko .=
                    //"<tr onClick=\"kayttajatiedot.php?kayttajanimi=".$rivi['kayttajanimi']."\" >".
                    "<tr class=\"user\" user=\"" . $rivi['kayttajanimi'] . "\">" .
                    "<td>" . $rivi['kayttajanimi'] . "</td>" .
                    "<td>" . $rivi['etunimi'] . "</td>" .
                    "<td>" . $rivi['sukunimi'] . "</td>" .
                    "<td>" . $rivi['pituus'] . "</td>" .
                    "</tr>";
        }
        $taulukko .= "</table>";

        mysqli_close($conn);
        echo $taulukko;
        ?>
    </body>
</html>
