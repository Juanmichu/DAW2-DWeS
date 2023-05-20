<?php 
//Conexión inicial para mostrar todos los datos de la tabla.
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
 $conexion = new PDO('mysql:host=localhost;dbname=biblioteca', 'super', '123456', $opciones); 

 $resultado1 = $conexion->query('SELECT soc_nombre AS socio, lib_titulo AS libro, pre_ejemplar AS signatura, pre_id as id, pre_fecha AS prestamo, pre_devolucion AS devolucion 
                                FROM prestamos 
                                JOIN ejemplares ON pre_ejemplar = eje_signatura 
                                JOIN libros ON eje_libro = lib_isbn 
                                JOIN socios ON pre_socio = soc_id 
                                ORDER BY pre_fecha DESC');

 $filas = array();
 $numFila = 0;
 while($datos = $resultado1->fetchObject())
 {
    $socio      = $datos->socio;
    $libro      = $datos->libro;
    $signatura  = $datos->signatura;
    $prestamo   = $datos->prestamo;
    $devolucion = $datos->devolucion;
    $id         = $datos->id;

    $filas[$numFila] = [$socio,$signatura,$libro,$prestamo,$devolucion,$id];
    $numFila++;
 }
 
 //Filtrar tabla por nombre del socio o el título del libro
 if(isset($_POST['filtrar']))
 {
    $filas = array();
    $numFila = 0;
    $filtrado = $_POST['filtro'];

    $resultado2 = $conexion->query('SELECT soc_nombre AS socio, lib_titulo AS libro, pre_ejemplar AS signatura, pre_id as id, pre_fecha AS prestamo, pre_devolucion AS devolucion 
                                        FROM prestamos 
                                        JOIN ejemplares ON pre_ejemplar = eje_signatura 
                                        JOIN libros ON eje_libro = lib_isbn 
                                        JOIN socios ON pre_socio = soc_id
                                        WHERE soc_nombre LIKE "'. $filtrado. '" OR lib_titulo LIKE "' . $filtrado . '"
                                        ORDER BY pre_fecha DESC');

    while($datos = $resultado2->fetchObject())
    {
        $socio      = $datos->socio;
        $libro      = $datos->libro;
        $signatura  = $datos->signatura;
        $prestamo   = $datos->prestamo;
        $devolucion = $datos->devolucion;
        $id         = $datos->id;

        $filas[$numFila] = [$socio,$signatura,$libro,$prestamo,$devolucion, $id];
        $numFila++;
    }

    unset($_POST['filtrar']);
}

//Devolver préstamo
if(isset($_GET['devolver']) and $_GET['devolver'] == true)
{
    $hoy = date('Y-m-d');
    $resultado3 = $conexion->exec('UPDATE prestamos SET pre_devolucion = "'. $hoy .'" WHERE pre_devolucion IS NULL AND pre_ejemplar = "'. $_GET['pre_ejemplar'] .'"');
}

//Eliminar préstamo
if(isset($_GET['eliminar']) and $_GET['eliminar'] == true)
{
    $resultado4 = $conexion->exec('DELETE FROM prestamos WHERE pre_id = "' . $_GET['pre_id'] . '"');
    header('Location: index.php');
}

?>