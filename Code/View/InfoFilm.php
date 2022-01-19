<?php

/** 
 * @file InfoFilm.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class InfoFilm
 * Este archivo genera la informacíon de la 
 * película.
*/

include("./Templates/Header.html");
include("../Model/Connection.php");
include("../Controller/MovieController.php");
include("../Controller/UserController.php");
include("../Controller/CommentController.php");
include("../Model/MovieModel.php");
include("../Model/CommentModel.php");
include("../Model/Comment.php");
include("../Model/UserModel.php");
include("../Model/User.php");
include("../Model/Movie.php");
include("./PrintInfo.php");


/**
 * @brief Esta variable almacena la identidad pública de la película.
 */
$publicId = $_GET["publicId"];
/**
 * @brief Variable que guarda el objeto controlador.
 */
$movieController =  new MovieController();
/**
 * @brief Variable que guarda el objeto controlador.
 */
$commentController = new CommentController();
/**
 * @brief Esta variable almacena un objeto print que permite
 * usar sus metodos para imprimir por la pantalla.
 */
$printInfo = new PrintInfo();
/**
 * @brief Esta varible almacena la accion que realizará la página
 */
$option = $_GET["option"];
/**
 * @brief Esta variable almacena un objeto pelicula.
 */
$movie =  $movieController->infoFilmFromIdPublic($publicId);

/**
 * @brief Esta estructura, en funcion de la opción muestra la pantalla de 
 * informacion de película o gestiona la inserccion de notas para la pelicula
 * asi como de comentarios.
 */
switch ($option){

    case 0:
        echo"<div id='infoFilmContainer'>";
        $listComments = $commentController->commentsPublicId($publicId);
        $printInfo->printInfoFilm($movie, $listComments);
        echo"</div>";
    break;

    case 1:
        $rating = $_POST['rating'];
        $publicId = $_GET['publicId'];
        $movieController->insertRating($publicId, $rating);
        header("Location: ./InfoFilm.php?publicId=$publicId && option=0");
    break;
    case 2:
        $commentString = $_POST['addComment'];
        $publicId = $_GET['publicId'];
        $commentController->insertComments($commentString,$publicId);
        header("Location: ./InfoFilm.php?publicId=$publicId && option=0");
    break;
    case 3:
        
        $isFav = $_POST['isFavI'];
        $movieController->manageFav($movie,$isFav);
        header("Location: ./InfoFilm.php?publicId=$publicId && option=0");
    break;

    default:
        echo"<div id='infoFilmContainer'>";
        $movie =  $movieController->infoFilmFromIdPublic($publicId);
        $listComments = $commentController->commentsPublicId($publicId);
        $printInfo->printInfoFilm($movie, $listComments);
        echo"</div>";
}



include("./Templates/Footer.html");

