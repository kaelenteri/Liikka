<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
        <script src="http://malsup.github.com/jquery.form.js"></script> 
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

        <script>
            $(function() {
                $("#dialog-form").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "OK": function() {

                        },
                        Cancel: function() {
                            $(this).dialog("close");
                        }
                    },
                    close: function() {
                        $(this).dialog("close");
                    }
                });

                $("#lisaa")
                        .button()
                        .click(function() {
                    $("#dialog").dialog("open");
                });
            });
        </script>



    </head>
    <body>
        <div id="dialog">


            <form id="myForm" action="laji_kasittele.php" method="post"> 
                <table id="lomake">
                    <tr>
                        <td>Lajin nimi</td>
                        <td><input type="text" name="nimi"  required /></td>
                    </tr>
                    <tr>
                        <td>Kulutus</td>
                        <td><input type="text" name="kulutus" required pattern="^\d{1,2}$"/></td>
                    </tr>
                    <tr>
                        <td>Kommentti</td>
                        <td> <input type="text" name="kommentti" /></td>
                    </tr>

                </table>
                <input type="submit" value="Lähetä" /> 
            </form>


        </div>

    </div>
    <div id="result">
    </div>

    <?php
// put your code here
    ?>
</body>
</html>
