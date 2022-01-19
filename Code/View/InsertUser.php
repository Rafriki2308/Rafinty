<?php
/** 
 * @file InsertUser.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class InsertUser
 * Este archivo genera el formulario de insercción de usuario
 * y gestiona dicha insercción.
*/

include("../Model/Connection.php");
include("../Controller/MovieController.php");
include("../Controller/UserController.php");
include("../Model/MovieModel.php");
include("../Model/UserModel.php");
include("../Model/User.php");
include("../Model/Movie.php");
include("./PrintInfo.php");
include("./Templates/Header.html");

/**
 * @brief Esta variable almacena la opcion que ejecutara la acción.
 */
$option = $_GET['option'];
/**
 * @brief Esta variable almacena un objeto controlador.
 */
$userController = new UserController();

/**
 * @brief Esta estructura gestiona la impresion del formmulario 
 * para insercción de un nuevo usuario y la gestión del mismo.
 */
switch($option){

    case 1:

        include("./Templates/insertUser.html");
    
    break;

    case 2:
        $nick = $_POST['nickIUser'];
        $photoUrl = $_POST['photoIURLUser'];
        $email = $_POST['emailIUser'];

        $userController->insertUser($nick,$email,$photoUrl);
        header("Location: ./Index.php?option=2");

    break;

    default:

        include("./Templates/insertUser.html");

    }

    include("./Templates/Footer.html");
?>