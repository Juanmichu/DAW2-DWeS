<?php
    echo "<h1>Decimalbinario.php</h1>";

    //Botón volver atrás
    echo "<a href='/inicio' style='padding: 10px 30px;
                            border: 1px solid darkgray;
                            background-color: #f6f6f6;
                            color: #3a3a3a;
                            font-weight: 700;
                            text-decoration: none;
                            transition: .5s'>Volver atrás</a>";

    //Form para insertar el nº entero. Inserto un if dentro del atributo value para comprobar si el usuario ha introducido algún valor y mantenerlo tras el envío del formulario
    echo 
        "<h2>Inserte un nº entero en el cuadro</h2>
        <form action='?' method='post'>
            <div style='margin: 30px 0; text-align: center'> 
                <input type='number' name='entero' value='"; if(isset($_POST['entero'])) echo $_POST['entero']; echo "'>
            </div>
        <div style='text-align: center'>
                <input type='submit'></input>
        </div>
        </form>";
    //Guardamos el nº introducido por el usuario en una variable. Comprobamos si existe para no generar un error.
    if (isset($_POST['entero']))
    {
        $entero = $_POST['entero'];
        
        //Convertimos el decimal introducido a binario.
        $binario = decbin($entero);

        //Imprimimos el nº binario
        echo 
        "<table style='text-align:center; margin:auto'>
            <thead>
                <th colspan='8'>
                    Número binario
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>".$binario."</td>
                </tr>
            </tbody>    
        </table>";

        //Recorremos el string generado que representa el nº binario. Por cada 1 que encontremos mostramos una casilla marcada y por cada 0 una sin marcar.
        echo "<h3 style='text-align:center'>Representación del nº con checkboxes</h3>";
        echo "<div style='display:flex; justify-content: center; margin: 30px 0'>";
        for($i = 0; $i < strlen($binario); $i++)
        {
            switch($binario[$i])
            {
                case "0":
                    echo "<input type='checkbox'>";
                    break;
                case "1":
                    echo "<input type='checkbox' checked = 'checked'>";
                    break;
            }
        }
        echo "</div>";
    }
?>


