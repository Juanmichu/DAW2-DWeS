<?php

namespace Models;

use mysqli;

class Prestamo
{
    /** @var mysqli $conexion */
    private $conexion;
    private $socio;
    private $libro;
    private $signatura;
    private $fecha_prestamo;
    private $fecha_devolucion;
    private $id;
    public function __construct()
    {
        //Conexión inicial para mostrar todos los datos de la tabla.
        $this->conexion             = new mysqli('localhost','super', '123456', 'biblioteca', '3307');
        $this->id                   = '';
        $this->socio                = '';
        $this->libro                = '';
        $this->signatura            = '';
        $this->fecha_prestamo       = '';
        $this->fecha_devolucion     = '';
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

    /**
     * @return string
     */
    public function getSocio()
    {
        return $this->socio;
    }

    /**
     * @param string $socio
     */
    public function setSocio($socio)
    {
        $this->socio = $socio;
    }

    /**
     * @return string
     */
    public function getLibro()
    {
        return $this->libro;
    }

    /**
     * @param string $libro
     */
    public function setLibro($libro)
    {
        $this->libro = $libro;
    }

    /**
     * @return string
     */
    public function getSignatura()
    {
        return $this->signatura;
    }

    /**
     * @param string $signatura
     */
    public function setSignatura($signatura)
    {
        $this->signatura = $signatura;
    }

    /**
     * @return string
     */
    public function getFechaPrestamo()
    {
        return $this->fecha_prestamo;
    }

    /**
     * @param string $fecha_prestamo
     */
    public function setFechaPrestamo($fecha_prestamo)
    {
        $this->fecha_prestamo = $fecha_prestamo;
    }

    /**
     * @return string
     */
    public function getFechaDevolucion()
    {
        return $this->fecha_devolucion;
    }

    /**
     * @param string $fecha_devolucion
     */
    public function setFechaDevolucion($fecha_devolucion)
    {
        $this->fecha_devolucion = $fecha_devolucion;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAllPrestamos($filtrado = ''): array
    {
        $filtro = !empty($filtrado) ? 'WHERE soc_nombre LIKE "'. $filtrado. '" OR lib_titulo LIKE "' . $filtrado . '"' : '';
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
                    JOIN socios ON pre_socio = soc_id '
                    . $filtro .
                    'ORDER BY pre_fecha DESC');

        $prestamos = [];
        while($datos = $resultado1->fetch_object())
        {
            $prestamos[$datos->id]['socio']             = $datos->socio;
            $prestamos[$datos->id]['libro']             = $datos->libro;
            $prestamos[$datos->id]['signatura']         = $datos->signatura;
            $prestamos[$datos->id]['fecha_prestamo']    = $datos->prestamo;
            $prestamos[$datos->id]['fecha_devolucion']  = $datos->devolucion;
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