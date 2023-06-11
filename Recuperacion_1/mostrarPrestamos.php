<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/Ejercicio_1/Controllers/mostrarPrestamosDispatcher.php');

global $prestamosArray;

if(isset($_REQUEST['soc_id'])) {
    $mostrarDispatcher = new \Controllers\mostrarPrestamosDispatcher($_REQUEST['soc_id']);
    $prestamosArray = $mostrarDispatcher->load();

    if(isset($_GET['devolver']) and $_GET['devolver']) {
        $mostrarDispatcher->devolverPrestamo($_GET['pre_ejemplar']);
    }

    if(isset($_POST['filtro'])) {
        $prestamosArray = $mostrarDispatcher->load($_POST['filtro']);
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Juan Manuel Serrano Pérez">
    <link type="text/css" rel="stylesheet" href="./styles.css">
    <title>MOSTRAR PRESTAMOS - Tarea 1 RECUPERACION - DWES</title>
</head>
<body>
<form action="./mostrarPrestamos.php" method="POST">
    <fieldset>
        <legend>Filtro por nombre de libro</legend>
        <input type="text" id="filtro" name="filtro">
        <input type="hidden" id="soc_id" name="soc_id" value="<?= $mostrarDispatcher->idSocio ?>">

        <div class="botones">
            <button type="submit">Filtrar</button>
            <a class="boton" href="./mostrarPrestamos.php?soc_id=<?= $mostrarDispatcher->idSocio ?>">Mostrar todos</a>
        </div>
    </fieldset>
</form>
<?php if(!empty($prestamosArray)) { ?>
<h2>Préstamos realizados por <?= $prestamosArray['socio'] ?></h2>
<?php } ?>
<table>
    <thead>
    <th>Signatura Ejemplar</th>
    <th>Título Libro</th>
    <th>Fecha préstamo</th>
    <th>Fecha devolución</th>
    <th></th>
    </thead>
    <tbody>
    <?php if(!empty($prestamosArray)) {
        foreach($prestamosArray['prestamos'] as $key => $prestamo) { ?>
        <tr>
            <td><?= $prestamo['signatura'] ?></td>
            <td><?= $prestamo['libro'] ?></td>
            <td><?= $prestamo['fecha_prestamo'] ?></td>
            <td><?= $prestamo['fecha_devolucion'] ?? '-' ?></td>
            <td>
            <?php if(is_null($prestamo['fecha_devolucion'])) { ?>
                <button class="boton show-prestamos" onclick="<?php $mostrarDispatcher->devolverPrestamo($prestamo['signatura']); ?>'">Devolver préstamo</button>
            <?php } ?>
        <?php } ?>
            </td>
    <?php } else { ?>
        <td colspan="5"> No se encuentran préstamos para este socio o con el nombre indicado. </td>
    <?php } ?>
        </tr>
    </tbody>
</table>

</body>
</html>