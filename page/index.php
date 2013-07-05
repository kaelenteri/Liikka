<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php 
session_start();
if(isset($_SESSION['kayttajanimi'])){
    if(isset($_SESSION['kirjautunut'])){
        if($_SESSION['kirjautunut'] == true){
            header('Location: kayttaja/kayttaja.php');
        }
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <a href="login/login.php">Kirjaudu sisään</a>
    </body>
</html>
