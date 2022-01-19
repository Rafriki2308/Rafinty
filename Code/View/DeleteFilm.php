<?php

/** 
 * @file DeleteFilm.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class DeleteFilm
 * Este archivo genera un boton de borrado y
 * gestiona el borrado de la pelicula.
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
 * @brief Esta variable almacena el controlador.
 */
$movieController = new MovieController();

/**
 * @brief Esta variable almacena la id pública de la película
 */
$publicId = $_GET['id'];

/**
 * @brief Esta variable almacena la respuesta del método deleteFilm
 */
$isDeleted = $movieController->deleteFilm($publicId);

/**
 * @brief Esta estructura redirige en funcion de
 * la respuesta del método deleteFilm.
 */
if($isDeleted){
    header("Location: ./Index.php?option=0");
}else{
    header("Location: ./Infofilm.php");
}



