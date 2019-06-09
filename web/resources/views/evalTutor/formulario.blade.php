<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Evaluacion de tutor</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
            <div class="content">
                <div class="title m-b-md">
                    Evaluacion: <?php echo $id; ?>
                </div>
                <form action="/evaluacion/<?php echo $id; ?>" method="post" id="search">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" name="compromiso">
                    <input type="text" name="adaptabilidad">
                    <input type="text" name="comunicacion">
                    <input type="text" name="equipo">
                    <input type="text" name="liderazgo">
                    <input type="text" name="sobreponerse">
                    <input type="text" name="habilidades">
                    <input type="text" name="proactividad">
                    <input type="text" name="innovacion">
                    <input type="text" name="etica">
                    <input type="textarea" name="comentario">
                    <input type="submit" name="enviar">
                </form>
            </div>
        </div>
    </body>
</html>
