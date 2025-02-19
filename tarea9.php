<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Darkrai</title>
    <style>
        body {
            background: #B4B0AF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 10px 10px 10px #332155;
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        h1 {
            font-size: 2.2em;
            color: #3FB850;
        }
        img {
            width: 200px;
            height: auto;
            border-radius: 10px;
            margin-top: 20px;
        }
        .info {
            font-size: 1.2em;
            color: #332155;
            margin-top: 20px;
            text-align: left;
        }
        .info p {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        /**
         * En urlAPI guardo la URL de la API de la que voy a sacar la información.
         * En contenido guardo lo que genera la función file_get_contents que va a ser un array asociativo.
         * Y en datos guardo lo que genera la función json_decode que es para sacar la información del fichero JSON.
         */
        $urlAPI = "https://pokeapi.co/api/v2/pokemon/darkrai";
        $contenido = file_get_contents($urlAPI);
        $datos = json_decode($contenido, true);
        /**
         * Aquí se comprueba que el JSON ha generado contenido y en disitntas variables se guarda información que se va mostrar
         * en pantalla. Luego se mostrarán en un div con todo el contenido sacado del JSON.
         * Con array_map recorro el array que hay dentro de una de las claves del JSON y con ucfirst saco el primer elemento indicado.
         */
        if ($datos) {
            $nombre = ucfirst($datos['name']);
            $imagen = $datos['sprites']['front_shiny'];
            $altura = $datos['height'] / 10;
            $peso = $datos['weight'] / 10; 
            $habilidades = array_map(function($habilidad) {
                return ucfirst($habilidad['ability']['name']);
            }, $datos['abilities']);
            $tipos = array_map(function($tipo) {
                return ucfirst($tipo['type']['name']);
            }, $datos['types']);
        ?>
            <h1><?php echo $nombre; ?></h1>
            <img src="<?php echo $imagen; ?>" alt="<?php echo $nombre; ?>">
            <div class="info">
                <p>Altura: <?php echo $altura; ?> metros</p>
                <p>Peso: <?php echo $peso; ?> kg</p>
                <p>Habilidades: <?php echo implode(", ", $habilidades); ?></p>
                <p>Tipo: <?php echo implode(", ", $tipos); ?></p>
            </div>
        <?php
        } else {
            echo "<p>No se pudo obtener la información de Darkrai en esta API.</p>";
        }
        ?>
    </div>
</body>
</html>