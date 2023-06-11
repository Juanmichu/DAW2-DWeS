<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/Ejercicio_1/Controllers/indexDispatcher.php');

$indexDispatcher = new \Controllers\indexDispatcher();
$prestamosArray = $indexDispatcher->load();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Juan Manuel Serrano Pérez">
        <link type="text/css" rel="stylesheet" href="./styles.css">
        <title>Tarea 1 RECUPERACION - DWES</title>
    </head>
    <body>
        <form action="./index.php" method="POST">
            <fieldset>
                <legend>Filtro por nombre de socio</legend>
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
                <th>Préstamos realizados</th>
                <th></th>
            </thead>
            <tbody>
                <?php foreach($prestamosArray as $id => $prestamo) { ?>
                    <tr>
                        <td><?= $prestamo['socio'] ?></td>
                        <td><?= $prestamo['prestamos'] ?></td>
                        <td><a class="boton show-prestamos" href="./mostrarPrestamos.php?soc_id=<?= $id ?>">Ver préstamos</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </body>
</html>