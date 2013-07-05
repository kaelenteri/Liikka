<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sets up validation for a form, then checks if the form is when clicking a button valid.</title>
        <link rel="stylesheet" href="http://jquery.bassistance.de/validate/demo/site-demos.css">
        <style>

        </style>
    </head>
    <body>
        <div id="divi">
            <form id="formi" action="action.php" method="POST">
                <label for="nimi">Nimi
                    <input type="text" name="nimi" required />
                </label>
                <label for="ika">Ikä
                    <input type="text" name="ika" required pattern="^\d{1,3}$" title="Yhdestä kolmeen numeroa."/>
                    <button id="painike">Painike</button
                </label>
            </form>

        </div>
    </body>
</html>