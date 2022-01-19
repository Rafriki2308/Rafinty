<?php

/** 
 * @file InsertFilm.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class InsertFilm
 * Este archivo genera el formulario de insercción de pelicula
 * y gestiona dicha insercción.
*/

include("../Model/Connection.php");
include("../Controller/MovieController.php");
include("../Model/MovieModel.php");
include("../Model/Movie.php");
include("./Templates/Header.html");

/**
 * @brief Variable que guarda la opcion que ejecutará el archivo.
 */
$option = $_GET['option'];

/**
 * @brief Variable que guarda el objeto controlador.
 */
$movieController = new MovieController();

/**
 * @brief Esta estructura, en funcion de la opción muestra la pantalla de insercción 
 * de película o gestiona la propia insercción.
 */

switch($option){ 

    case 1:
        include("./Templates/insertFilm.html");
    break;
       
    case 2:

    $name = $_POST['nameI'];
    $synopsis = $_POST['synopsisI'];
    $releaseYear = $_POST['yearI'];
    $directorName = $_POST['directorI'];
    $posterUrl = $_POST['photoI'];

    $insertValid = $movieController->insertMovie($name, $synopsis, $releaseYear,
    $directorName, $posterUrl);
    

    if($insertValid){
        
        header("Location: ./index.php?option=0");
    }else{
        echo "<script>alert('Dato Incorrecto');</scrip>";
    }

    break;

    default:
        include("./Templates/insertFilm.html");
}

include("./Templates/Footer.html");

?>