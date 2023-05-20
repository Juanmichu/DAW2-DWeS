<?php
echo "<h1>Binariodecimal.php</h1>";

//Botón volver atrás
echo "<a href='/inicio' style='padding: 10px 30px;
                        border: 1px solid darkgray;
                        background-color: #f6f6f6;
                        color: #3a3a3a;
                        font-weight: 700;
                        text-decoration: none;
                        transition: .5s'>Volver atrás</a>";

//Mediante los if insertados dentro de cada input, dejamos la posibilidad de dejar marcadas las casillas tras el envío del formulario
echo 
    "<h2>Pulse en los cuadros para crear un nº binario</h2>
    <form action='?' method='post'>
        <div style='margin: 30px 0; text-align: center'> 
            <input type='checkbox' name='128' value='1'"; if(isset($_POST['128'])) echo "checked = 'checked'"; echo ">
            <input type='checkbox' name='64' value='1'"; if(isset($_POST['64'])) echo "checked = 'checked'"; echo ">
            <input type='checkbox' name='32' value='1'"; if(isset($_POST['32'])) echo "checked = 'checked'"; echo ">
            <input type='checkbox' name='16' value='1'"; if(isset($_POST['16'])) echo "checked = 'checked'"; echo ">
            <input type='checkbox' name='8' value='1'"; if(isset($_POST['8'])) echo "checked = 'checked'"; echo ">
            <input type='checkbox' name='4' value='1'"; if(isset($_POST['4'])) echo "checked = 'checked'"; echo ">
            <input type='checkbox' name='2' value='1'"; if(isset($_POST['2'])) echo "checked = 'checked'"; echo ">
            <input type='checkbox' name='1' value='1'"; if(isset($_POST['1'])) echo "checked = 'checked'"; echo ">
        </div>
       <div style='text-align: center'>
            <input type='submit'></input>
       </div>
    </form>";

    //Comprobamos cada checkbox para ver si esta checkeado o no y le asignamos el valor de ese checkbox si está checkeado o 0 si no lo está.
    if(isset($_POST['128']))
    {
        $siete = $_POST['128'];
    }
    else
    {
        $siete = 0;
    }

    if(isset($_POST['64']))
    {
        $seis = $_POST['64'];
    }
    else
    {
        $seis = 0;
    }

    if(isset($_POST['32']))
    {
        $cinco = $_POST['32'];
    }
    else
    {
        $cinco = 0;
    }

    if(isset($_POST['16']))
    {
        $cuatro = $_POST['16'];
    }
    else
    {
        $cuatro = 0;
    }

    if(isset($_POST['8']))
    {
        $tres = $_POST['8'];
    }
    else
    {
        $tres = 0;
    }

    if(isset($_POST['4']))
    {
        $dos = $_POST['4'];
    }
    else
    {
        $dos = 0;
    }

    if(isset($_POST['2']))
    {
        $uno = $_POST['2'];
    }
    else
    {
        $uno = 0;
    }
    
    if(isset($_POST['1']))
    {
        $cero = $_POST['1'];
    }
    else
    {
        $cero = 0;
    }

    //Imprimimos el decimal seleccionado.
    echo 
        "<table style='text-align:center; margin:auto'>
            <thead>
                <th colspan='8'>
                    Número binario
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>".$siete."</td><td>".$seis."</td><td>".$cinco."</td><td>".$cuatro."</td><td>".$tres."</td><td>".$dos."</td><td>".$uno."</td><td>".$cero."</td>
                </tr>
            </tbody>    
        </table>";

        //Guardamos nuestro binario en un string
        $binario = $siete . $seis . $cinco . $cuatro . $tres . $dos . $uno . $cero;
        
        //Y lo convertimos a número.
        $decimal = bindec($binario);

    //Finalmente lo imprimimos.
    echo 
        "<table style='text-align:center; margin:auto'>
            <thead>
                <th colspan='8'>
                    Número decimal
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>".$decimal."</td>
                </tr>
            </tbody>    
        </table>";












?>