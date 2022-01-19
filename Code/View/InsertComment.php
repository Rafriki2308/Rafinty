<?php

/** 
 * @file InsertComment.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class InsertComment 
 * Este archivo gestiona la insercción de un comentario.
*/

include("../Model/Connection.php");
include("../Controller/UserController.php");
include("../Controller/CommentController.php");
include("../Model/CommentModel.php");
include("../Model/UserModel.php");
include("../Model/User.php");
include("../Model/Comment.php");

/**
 * @brief Esta variable almacena un objeto controlador.
 */
$commentController = new CommentController();
/**
 * @brief Esta variable almacena un comentario.
 */
$commentString = $_POST['addComment'];
/**
 * @brief Esta variable almacena una identidad pública de una pelicula;
 */
$publicId = $_POST['publicId'];

$commentController->insertComments($commentString,$publicId);


