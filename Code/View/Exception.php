<?php

/** 
 * @file Exception.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class Exception
 * Este archivo genera una pagina de excepciones para posibles
 * errores de la base de datos
*/

include("./Templates/Header.html");
include("./Templates/Exception.html");

/**
 * @brief Esta variable almacena el tipo de excepcion.
 */
$option = $_GET['option'];

/**
 * @brief Esta estructura genera un página distinta
 * en funcion de la excepción que haya ocurrido.
 */
switch($option){

    case 1: 
        echo"<div id='exceptionContainer'>";
        echo "<div id='messageContainer'>
        <h2> UPPPPPSSS! Parece que estas intentando 
        valorar la pelicula dos veces.
        </div>";
        echo"</div>";
    break;

    case 2: 
        echo"<div id='exceptionContainer'>";
        echo "<div id='messageContainer'>
        <h2> UPPPPPSSS! Parece que ha habido un 
        problema la intentar insertar la pelicula.
        </div>";
        echo"</div>";
    break;

    case 3: 
        echo"<div id='exceptionContainer'>";
        echo "<div id='messageContainer'>
        <h2> UPPPPPSSS! Parece que ha habido un
        problema al intenar registrar el usuario.
        </div>";
        echo"</div>";
    break;

    case 4: 
        echo"<div id='exceptionContainer'>";
        echo "<div id='messageContainer'>
        <h2> UPPPPPSSS! Parece que ha habido un
        problema al intenar insertar el comentario.
        </div>";
        echo"</div>";
    break;

    case 5: 
        echo"<div id='exceptionContainer'>";
        echo "<div id='messageContainer'>
        <h2> UPPPPPSSS! Parece que ha habido un
        problema al intentar borrar la película.
        </div>";
        echo"</div>";
    break;

    case 6: 
        echo"<div id='exceptionContainer'>";
        echo "<div id='messageContainer'>
        <h2> UPPPPPSSS! Lo sentimos pero
        esta funcionalidad esta todavia
        en desarrollo.
        </div>";
        echo"</div>";
    break;

    default:
    echo"<div id='exceptionContainer'>";    
    echo "<div id='messageContainer'>
        MADRE MIA!, que has tocado? parece que ha habido un error
        catastrófico
        </div>";
    echo"</div>";
}

include("./Templates/Footer.html");
