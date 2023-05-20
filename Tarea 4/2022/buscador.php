<?php require('./Controllers/buscadorController.php') ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./styles.css" >
    <title>Buscador de películas</title>
</head>
<body>
    <form action="./buscador.php" method="POST">
        <fieldset>
            <legend>Buscador de películas</legend>
        
            <label for="filtroGenero">Filtrar por género</label>
            <select type="text" id="filtroGenero" name="filtroGenero">
                <option value="Comedia" <?= ($filtrado == 'Comedia') ? 'selected=selected' : '' ?>>Comedia</option>
                <option value="Drama" <?= ($filtrado == 'Drama') ? 'selected=selected' : '' ?>>Drama</option>
                <option value="Musical" <?= ($filtrado == 'Musical') ? 'selected=selected' : '' ?>>Musical</option>
                <option value="Accion" <?= ($filtrado == 'Accion') ? 'selected=selected' : '' ?>>Acción</option>
                <option value="Infantil" <?= ($filtrado == 'Infantil') ? 'selected=selected' : '' ?>>Infantil</option>
            </select>
        
            <button type="submit" id="submit" name="filtrar" value="filtrar">Filtrar</button> 
        </fieldset>
    </form>

    <div class="buscadorPelis">
        <fieldset>
            <legend>Resultados</legend>

            <table>
                <thead>
                    <th>Título</th>
                    <th>Año</th>
                    <th>Género</th>
                    <th>Director</th>
                </thead>
                <tbody>
                    <?php foreach($_SESSION['peliculas'] as $element): ?>

                        <?php if($element['genero'] == $filtrado): ?>
                            <tr>
                                <td><?= $element['titulo'] ?></td>
                                <td><?= $element['año'] ?></td>
                                <td><?= $element['genero'] ?></td>
                                <td><?= $element['director'] ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </fieldset>
    </div>
    <a class="boton" href="./index.php">Volver al inicio</a>
    
</body>
</html>