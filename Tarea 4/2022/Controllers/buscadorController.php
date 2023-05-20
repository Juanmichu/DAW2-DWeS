<?php
    session_start();
    
    $filtrado = '';

    if(isset($_POST['filtroGenero']))
    {
        $filtrado = $_POST['filtroGenero'];
    }

   
?>