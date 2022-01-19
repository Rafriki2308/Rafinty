<?php

/** 
 * @file InsertRating.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class InsertRating
 * Este archivo gestiona la insercción de una nota.
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
 * @brief Esta variable almacena un objeto controlador.
 */
$movieController =  new MovieController();
/**
 *@brief Esta variable almacena la nota a asignar. 
 */
$rating =(int) $_POST['rating'];
/**
 * @brief Esta variable almacena la identidad pública de la película.
 */
$publicId = $_GET['publicId'];
$movieController->insertRating($publicId, $rating);

?>