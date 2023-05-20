<?php require('./Controllers/listadoController.php') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./styles.css">
    <title>Listado películas</title>
</head>
<body>

<div class="listadoPelis">
    <fieldset>
        <legend>Catálogo actual de películas</legend>
        <table>
            <thead>
                <th>Título</th>
                <th>Año</th>
                <th>Género</th>
                <th>Director</th>
            </thead>
            <tbody>
                <?php foreach($_SESSION['peliculas'] as $element) : ?>
                    <tr>
                        <td><?= $element['titulo'] ?></td>
                        <td><?= $element['año'] ?></td>
                        <td><?= $element['genero'] ?></td>
                        <td><?= $element['director'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </fieldset>
</div>

<a class="boton" href="./index.php">Volver al inicio</a>  
    
</body>
</html>