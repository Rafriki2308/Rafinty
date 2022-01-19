<?php

/** 
 * @file CommentController.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class CommentController
 * Genera un Controlador que verifica los datos que se mueven entre
 * vista y controlador.
*/
class CommentController{

    private $commentModel;/*Objeto que gestiona la conexion con la tabla comment de la BD */
    
    /**
     * @brief Constructor que genera un objeto commentModel, que se encargara de gestionar
     * la conexion con la tabla de comentarios de la BD.
     */
    public function __construct(){
        $this->commentModel = new CommentModel();
    }

    /**
     * @brief Metodo público que toma un valor numérico y verifica que el valor
     * sea correcto.
     * @param $value
     * Valor numérico.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testDataNumeric($value)
    {
        $isNumeric = is_numeric($value);
        $isEmpty = empty(trim($value));
        $correct = false;

        if ($isNumeric && $value > 0 && !$isEmpty) {
            $correct =  true;
        }
        return $correct;
    }

    /**
     * @brief Metodo público que toma un string  y verifica que no este vacio y
     * que sea correcto.
     * @param $value
     * Valor string.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testDataString($value)
    {

        $isString = is_string($value);
        $isEmpty = empty(trim($value));
        $correct = false;

        if (!$isEmpty && $isString) {
            $correct = true;
        }
        return $correct;
    }
    
    /**
     * @brief Metodo público que toma un string  y verifica que no este vacio y
     * que sea correcto y tenga la longitud necesaria.
     * @param $value
     * Valor string.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testComments($value){
        $isStringComment = $this->testDataString($value);
        $isCommentInRange = strlen($value)>9 && strlen($value)<201;
        $correct = false;

        if($isStringComment && $isCommentInRange){
            $correct = true;
        }
        return $correct;
    }
    
    
    /**
     * @brief Metodo público que toma una identidad pública de una película
     * realiza una conexion con la BD y devuelve una array de todos los 
     * comentarios de esa película.
     * @param $publicIdMovie
     * Identidad pública de la película
     * @return array
     * Devuelve una lista de objetos comentario.
     */
    public function commentsPublicId($publicIdMovie){

        $correct = $this->testDataString($publicIdMovie);
        if($correct){
        $listComments = $this->commentModel->getCommentsFromPrivateIdMovie($publicIdMovie);
        return $listComments;
        }

        /*En caso de modificacion del publicIdMovie o de inyeccion de codigo, redirige a la 
        pagina principal*/
        header("Location: ./Index.php?option=1");

    }

    /**
     * @brief Metodo público que toma un comentario y una identidad pública de una
     * película, realiza una conexión con la BD e introduce el comentario asociado a
     * esa película.
     * @param $commentString, $publicIdMovie
     * Corresponde a comentario y la identidad pública de la película.
     */
    public function insertComments($commentString,$publicIdMovie){

        $correct = $this->testComments($commentString);

        if($correct){

            try{       
                $this->testDataString($commentString);
                $commentObject = new Comment($commentString);
                $this->commentModel->insertComment($commentObject,$publicIdMovie);
            }catch (PDOException $PDOexception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php?option=4");
            }
            catch (Exception $exception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php?option=4");
            }    
        }
    }
}
?>