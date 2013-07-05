<?php 
session_start();


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form id="login_form" action="sisaan.php" method="post"><table>
                <tr>
                    <td>
                        Käyttäjänimi
                    </td>
                    <td>
                        <input type="text" name="kayttajanimi" required minlength="5" title="Vähintään 5 merkkiä.">
                    </td>
                </tr>
                <tr>
                    <td>
                        Salasana
                    </td>
                    <td>
                        <input type="password" name="salasana" required pattern="^[a-zA-Z0-9]{3,50}$" title="Vähintään 3 merkkiä.">
                    </td>
                </tr>

            </table>
            <input type="submit" value="Kirjaudu">

        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
