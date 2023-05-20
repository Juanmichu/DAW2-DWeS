<?php

echo "<h1>Calendario.php</h1>";

//Botón volver atrás
echo "<a href='/inicio' style='padding: 10px 30px;
                        border: 1px solid darkgray;
                        background-color: #f6f6f6;
                        color: #3a3a3a;
                        font-weight: 700;
                        text-decoration: none;
                        transition: .5s'>Volver atrás</a>";
echo 

    "<h2>Introduzca mes y año.</h2>
    <h4>El mes tiene que ser introducido como número</h4>
    <form action='?' method='post'>
        <div style='margin: 30px 0; text-align: center'>
            <label for='mes'>Mes</label>
            <input type='number' name='mes'></input>
            <label for='anio'>Año</label>
            <input type='number' name='anio'></input>
        </div>
       <div style='text-align: center'>
            <input type='submit'></input>
       </div>

        

    </form>";

if(isset($_POST['mes']) && isset($_POST['anio']))
{       
    //Recogemos en dos variables el año y mes y año introducidos por el usuario mediante un post redirigido a la misma página.
    $anio = $_POST['anio']; 
    $mes = $_POST['mes']; 

    
    //Obtenemos el día de la semana correspondiente al día 1 del mes introducido del año introducido.
    $primerDiaNumero = date("N",mktime(0,0,0,$mes, 1, $anio));
    //Obtenemos el nº de días que tiene ese mes de ese año. 
    $diasMes = date("t",mktime(0,0,0,$mes, 1, $anio));
    /* 
    *Comprobaciones
    *echo "<p>MES: ". $mes ."</p>";
    *echo "<p>AÑO: ". $anio ."</p>";
    *echo "<p>Nº de la semana: ".$primerDiaNumero."</p>";
    *echo "<p>Días mes: ".$diasMes."</p>"; 
    */

    echo "<div style='display: flex; justify-content:space-evenly; margin:auto'>
            <p><b>MES INTRODUCIDO:</b> ". $mes ."</p>
            <p><b>AÑO INTRODUCIDO: </b>". $anio ."</p>
        </div>";
   
    //Normalmente haría que este php apuntara a un html enlazado a un css donde generaría los estilos asociados a clases para cada celda, por ejemplo. Pero al tratarte una práctica donde se pide 
    //que se haga en php, he incluido los estilos en las propias etiquetas.
    echo "<table style='text-align:center;box-shadow:1px 1px 5px #000; margin: auto'>
            <thead style='background-color: #49a2f1; color: white;'>
                <th style='border-collapse: collapse; padding: 5px 15px;'>
                    Lunes
                </th>
                <th style='border-collapse: collapse; padding: 5px 15px;'>
                    Martes
                </th>
                <th style='border-collapse: collapse; padding: 5px 15px;'>
                    Miércoles
                </th>
                <th style='border-collapse: collapse; padding: 5px 15px;'>
                    Jueves
                </th>
                <th style='border-collapse: collapse; padding: 5px 15px;'>
                    Viernes
                </th>
                <th style='border-collapse: collapse; padding: 5px 15px;'>
                    Sábado
                </th>
                <th style='border-collapse: collapse; padding: 5px 15px;'>
                    Domingo
                </th>
            </thead>";
            echo    "<tbody style='background-color: #dbdbdb'>";
                $dia = 1;
                $hueco = 1;
                for ($fila = 1; $fila < 7; $fila++)
                {                  
                    for($columna = 1; $columna < 8; $columna++)
                    {
                        if($hueco < $primerDiaNumero)
                        {
                            echo "<td>---</td>";
                            $hueco++;
                        }else if($dia <= $diasMes)
                        {
                            echo "<td>".$dia . "</td>";
                            $dia++;
                            $hueco++; 
                        }else
                        {
                            echo "<td>---</td>";
                            $hueco++;
                        }                
                    }   
                    echo "</tr>";
                }       
        echo "</tbody>";

    echo "</table>";
}else
{
    echo "<p style='color:red;'>Introduzca un valor numérico como mes y año. No deje campos vacíos.</p>";
}





?>