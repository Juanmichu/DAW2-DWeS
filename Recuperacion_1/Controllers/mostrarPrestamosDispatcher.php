<?php
namespace Controllers;

require_once($_SERVER['DOCUMENT_ROOT'] . '/Ejercicio_1/Controllers/Dispatcher.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Ejercicio_1/Models/MySQLConnector.php');

class mostrarPrestamosDispatcher extends Dispatcher
{
    /** @var int $idSocio */
    public $idSocio;

    public function __construct($idSocio)
    {
        parent::__construct();
        $this->idSocio = $idSocio;
    }

    public function load($filtrado = '')
    {
        return $this->mySqlConnector->getAllPrestamosBySocioId($this->idSocio, $filtrado);
    }

    /**
     * Devolver préstamo
     * @return void
     */
    public function devolverPrestamo($signature)
    {
        $signature = $_GET['pre_ejemplar'];

        $this->mySqlConnector->devolverPrestamo($signature);

        unset($_GET['devolver'], $_GET['pre_ejemplar']);
        header('Location:mostrarPrestamos.php');
    }

}

