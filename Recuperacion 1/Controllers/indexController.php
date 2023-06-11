<?php
namespace Controllers;
//Conexión inicial para mostrar todos los datos de la tabla.
use Models\Prestamo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/Ejercicio_1/Models/Prestamo.php');

$prestamo       = new Prestamo();
$prestamosArray = $prestamo->getPrestamosSocios();
 
 //Filtrar tabla por nombre del socio o el título del libro
 if(isset($_POST['filtrar']))
 {
    $filtrado = $_POST['filtro'];

    $prestamosArray = $prestamo->getPrestamosSocios($filtrado);

    unset($_POST['filtrar']);
}

//Devolver préstamo
if(isset($_GET['devolver']) and $_GET['devolver'])
{
    $signature = $_GET['pre_ejemplar'];

    $prestamo->devolverPrestamo($signature);

    unset($_GET['devolver'], $_GET['pre_ejemplar']);
    header('Location:index.php');
}

//Eliminar préstamo
if(isset($_GET['eliminar']) and $_GET['eliminar'])
{
    $idPrestamo = $_GET['pre_id'];
    $prestamo->eliminarPrestamo($idPrestamo);

    unset($_GET['eliminar'], $_GET['pre_id']);
    header('Location: index.php');
}

