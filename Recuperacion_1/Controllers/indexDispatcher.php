<?php
namespace Controllers;

require_once($_SERVER['DOCUMENT_ROOT'] . '/Ejercicio_1/Controllers/Dispatcher.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Ejercicio_1/Models/MySQLConnector.php');

class indexDispatcher extends Dispatcher
{
    public function load(): array
    {
        return $this->mySqlConnector->getPrestamosSocios();
    }

    /**
     * Filtrar tabla por nombre del socio o el título del libro
     * @return array
     */
    public function filtrar()
    {
        if(isset($_POST['filtrar'])) {
            $filtrado = $_POST['filtro'];
            unset($_POST['filtrar']);

            return $this->mySqlConnector->getPrestamosSocios($filtrado);
        }
    }

    /**
     * Eliminar préstamo
     * @return void
     */
    public function eliminar(): void
    {
        if(isset($_GET['eliminar']) and $_GET['eliminar'])
        {
            $idPrestamo = $_GET['pre_id'];
            $this->mySqlConnector->eliminarPrestamo($idPrestamo);

            unset($_GET['eliminar'], $_GET['pre_id']);
            header('Location: index.php');
        }
    }

}
