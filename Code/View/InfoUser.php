<?php

/** 
 * @file InfoUser.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class InfoUser
 * Este archivo genera la información del usuario.
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
 * @brief Variable que guarda el objeto controlador.
 */
$movieController = new MovieController();
/**
 * @brief Variable que guarda el objeto controlador.
 */
$userController = new UserController();
/**
 * @brief Esta variable almacena un objeto print que permite
 * usar sus metodos para imprimir por la pantalla.
 */
$print = new PrintInfo();
/**
 * @brief Esta variable almacena la id pública del usuario.
 */
$nick = $_GET['id'];

/**
 * @brief Esta variable almacena un objeto usuario.
 */
$user = $userController->getUserInfo($nick);
/**
 * @brief Esta variable almacena una lista de objetos peliculas favoritas.
 */
$movies = $movieController->listFavMovies($user);

echo"<div id='UserFavMovieContainer'>";
$print->printUserInfo($user,$movies);
echo "</div>";

include("./Templates/Footer.html");


?>