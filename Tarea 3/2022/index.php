<?php require('./Controllers/indexController.php') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Juan Manuel Serrano Pérez">
    <link type="text/css" rel="stylesheet" href="./styles.css">
    <title>Tarea 3 - DWES</title>
</head>
<body>
    <form action="./index.php" method="POST">
        <fieldset>
            <legend>Filtro por socio/título de libro</legend>
            <input type="text" id="filtro" name="filtro">

            <div class="botones">
                <button type="submit" id="filtrar" name="filtrar">Filtrar</button>
                <a class="boton" href="./index.php">Mostrar todos</a>
            </div>
        </fieldset>
    </form>
    <table>
        <thead>
            <th>Nombre Socio</th>
            <th>Signatura Ejemplar</th>
            <th>Título Libro</th>
            <th>Fecha préstamo</th>
            <th>Fecha devolución</th>
            <th>¿Eliminar?</th>
        </thead>
        <tbody>
            <?php for($i = 0; $i < sizeof($filas); $i++): ?>
                <tr>
                    <td><?= $filas[$i][0] ?></td>
                    <td><?= $filas[$i][1] ?></td>
                    <td><?= $filas[$i][2] ?></td>
                    <td><?= $filas[$i][3] ?></td>
                    <td><?= ($filas[$i][4] != null) ? $filas[$i][4] : '<a class="boton" href="./index.php?devolver=true&pre_ejemplar='. $filas[$i][1] .'">Devolver</a>' ?></td>
                    <td><a class="boton eliminar" href="./index.php?eliminar=true&pre_id=<?= $filas[$i][5] ?>">Eliminar</a></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    
</body>
</html>