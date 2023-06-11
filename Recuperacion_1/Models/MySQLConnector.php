<?php

namespace Models;

use mysqli;

class MySQLConnector
{
    /** @var mysqli $conexion */
    private $conexion;
    public function __construct()
    {
        //Conexión inicial para mostrar todos los datos de la tabla.
        $this->conexion             = new mysqli('localhost','super', '123456', 'biblioteca', '3307');
    }

    /**
     * @return mysqli
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * @param mysqli $conexion
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAllPrestamosBySocioId($idSocio, $filtrado = ''): array
    {
        $filtro = !empty($filtrado) ? ' AND lib_titulo LIKE "%' . $filtrado . '%" ' : '';
        $resultado1 = $this->conexion->query(
            'SELECT soc_nombre AS socio, 
                        lib_titulo AS libro, 
                        pre_ejemplar AS signatura, 
                        pre_id as id, 
                        pre_fecha AS prestamo, 
                        pre_devolucion AS devolucion 
                    FROM prestamos 
                    JOIN ejemplares ON pre_ejemplar = eje_signatura 
                    JOIN libros ON eje_libro = lib_isbn 
                    JOIN socios ON pre_socio = soc_id 
                    WHERE pre_socio = ' . $idSocio
                    . $filtro .
                    ' ORDER BY pre_fecha DESC');

        $prestamos = [];
        while($datos = $resultado1->fetch_object())
        {
            $prestamos['socio']                                      = $datos->socio;
            $prestamos['prestamos'][$datos->id]['libro']             = $datos->libro;
            $prestamos['prestamos'][$datos->id]['signatura']         = $datos->signatura;
            $prestamos['prestamos'][$datos->id]['fecha_prestamo']    = $datos->prestamo;
            $prestamos['prestamos'][$datos->id]['fecha_devolucion']  = $datos->devolucion;
        }

        return $prestamos;
    }

    public function getPrestamosSocios($filtrado = '')
    {
        $filtro = !empty($filtrado) ? 'AND soc.soc_nombre LIKE "%'. $filtrado .'%" ' : '';

        $resultado = $this->conexion->query(
            'SELECT soc.soc_id as id, soc.soc_nombre AS socio, COUNT(pre.pre_socio) AS prestamos
                    FROM socios soc, prestamos pre 
                    WHERE soc.soc_id = pre.pre_socio '
                    . $filtro .
                    ' GROUP BY soc.soc_id
                    ORDER BY prestamos DESC');

        $prestamos = [];
        while($datos = $resultado->fetch_object())
        {
            $prestamos[$datos->id]['socio']             = $datos->socio;
            $prestamos[$datos->id]['prestamos']         = $datos->prestamos;
        }

        return $prestamos;
    }

    public function devolverPrestamo($signature): void
    {
        $hoy = date('Y-m-d');
        $resultado = $this->conexion->prepare(
            'UPDATE prestamos 
                    SET pre_devolucion = "'. $hoy .'" 
                    WHERE pre_devolucion IS NULL 
                    AND pre_ejemplar = "' . $signature . '"');
        if(!$resultado->execute()) {
          error_log('Ocurrió un error al intentar actualizar el préstamo con signature =>' . $signature);
        }

        $resultado->close();
        $this->conexion->close();
    }

    public function eliminarPrestamo($idPrestamo)
    {
        $resultado = $this->conexion->prepare('DELETE FROM prestamos WHERE pre_id = "' . $idPrestamo . '"');

        if(!$resultado->execute()) {
            error_log('Ocurrió un error al intentar eliminar el préstamo con ID =>' . $idPrestamo);
        }

        $resultado->close();
        $this->conexion->close();
    }

}