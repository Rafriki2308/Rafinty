<?php

/** 
 * @file Index.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class Index
 * Este archivo genera el indice de la página web, y gestiona
 * distintas vistas.
*/

include("./Templates/Header.html");
include("../Model/Connection.php");
include("../Controller/MovieController.php");
include("../Controller/UserController.php");
include("../Model/MovieModel.php");
include("../Model/UserModel.php");
include("../Model/User.php");
include("../Model/Movie.php");
include("./PrintInfo.php");

/**
 * @brief Esta variable almacena un objeto print que permite
 * usar sus metodos para imprimir por la pantalla.
 */
$print = new PrintInfo();

/**
 * @brief Esta variable almacena un objeto controlador.
 */
$movieController = new MovieController();

/**
 * @brief Esta variable almacena un objeto controlador.
 */
$userController = new UserController();

/**
 * @brief Esta variable almacena la accion que
 * ejecutará la página.
 */
$option = $_GET['option'];

/**
 * @brief Esta estructura, en función de la opcion, generará
 * una pantalla u otra.
 */
switch($option){

    case 1:
        echo"<div id='moviesContainer'>"; 
        $movies = $movieController->listMovies();
        $print->printAllMovies($movies);
        echo"</div>";
    break;

    case 2:
        echo"<div id='usersContainer'>";
        $users = $userController->listUsers();
        $print->printAllUsers($users);
        echo"</div>";
    break;

    case 3:
        echo"<div id='UserFavMovieContainer'>";
        $nick = "ragnar";
        $user = $userController-> getUserInfo($nick);
        $movies = $movieController->listFavMovies($user);
        $print->printUserInfo($user, $movies);
        echo"</div>";
    break;
    case 4:
        echo"<div id='moviesSearchContainer'>";
        $search = $_POST['searchI'];
        $movies = $movieController->searchMovie($search);
        $print->printAllMovies($movies);
        echo"</div>";
    break;

    default:
        echo"<div id='moviesContainer'>"; 
        $movies = $movieController->listMovies();
        $print->printAllMovies($movies);
        echo"</div>";

}

include("./Templates/Footer.html");