<?php require('./Controllers/indexController.php') ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles.css">
    <title>Tarea 4 - CINETECA</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>
                BIENVENIDO A LA CINETECA
            </legend>

            <nav class="categorias">
                <a class="categoria boton" href="./listado.php">Ver listado de películas</a>
                <a class="categoria boton" href="./buscador.php">Usar buscador</a>
            </nav>
            
            <h2>Elija su película introduciendo los datos</h2>

            <label for="titulo">Título</label>
            <input id="titulo" name="titulo" type="text" placeholder="Introduzca el título de la película"> 

            <label for="anio">Año</label>
            <input id="anio" name="anio" type="number" min="1950" max="2021">

            <label for="genero">Género</label>
            <select id="genero" name="genero" type="text">
                <option value="Comedia">Comedia</option>
                <option value="Drama">Drama</option>
                <option value="Musical">Musical</option>
                <option value="Accion">Acción</option>
                <option value="Infantil">Infantil</option>
            </select>
            
            <label for="director">Director</label>
            <input id="director" name="director" type="text" placeholder="Introduzca el nombre">

            <button id="submit" name="enviar" type="submit" value="enviar">Enviar</button> 
        </fieldset>
    </form>
</body>
</html>