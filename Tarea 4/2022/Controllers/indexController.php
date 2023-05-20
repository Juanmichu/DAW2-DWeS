<?php
    session_start();

    if(empty($_SESSION))
    {
        $_SESSION['peliculas'] = array();
    }

    if(isset($_POST['enviar']))
    {       
       array_push($_SESSION['peliculas'], ["titulo" => $_POST['titulo'], "año" => $_POST['anio'],"genero" => $_POST['genero'],"director" => $_POST['director']]);
    }
?>