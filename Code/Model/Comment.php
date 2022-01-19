<?php

/** 
 * @file Comment.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class Comment
 * Genera un objeto comentario.
*/

class Comment{

    private $comment;/*Identificador del comentario */
    private $commentData;/*Comentario */
    private $userid;/*Número privado del usuario que realizó el comentario */
    private $movieid;/*Número privado de la película  */
    private $nick;/*Nick del usuario que ha realizado el comentario */
    private $photoUser;/*Dirección URL del avatar del usuario que realiza comentario */    
    
    
    /**
     * @brief Constructor que toma como obligatorios el atributo comment y construye un
     * comentario. Los demas atributos son opcionales.
     */
    public function __construct($comment, $commentData=null, $nick = null, $photoUser = null, 
    $userid=null, $movieid=null){

        $this->comment = $comment;
        $this->commentData = $commentData;
        $this->nick = $nick;
        $this->photoUser= $photoUser;
        $this->userid = $userid;
        $this->movieid = $movieid;
        
    }

    /**
     * @brief Metodo público que devuelve el identificador del comentario.
     * @return int 
     * Identificador del comentario.
     */
    public function getComment(){
        return $this->comment;
    }

    /**
     * @brief Metodo público asigna un valor al atributo comment, que
     * corresponde con el identificador del comentario.
     * @param $comment 
     * Identificador del comentario.
     */
    public function setComment($comment){
        $this->comment=$comment;
    }

    /**
     * @brief Metodo público que devuelve el comentario del usuario.
     * @return string 
     * Comentario del usuario.
     */
    public function getCommentData(){
        return $this->commentData;
    }

    /**
     * @brief Metodo público asigna un valor al atributo commentData, que
     * corresponde al comentario.
     * @param $commentData 
     * Comentario.
     */
    public function setCommentData($commentData){
        $this->commentData = $commentData;
    }

    /**
     * @brief Metodo público que devuelve el nick del usuario que realiza el comentario.
     * @return string 
     * Nick del usuario que realiza el comentario.
     */
    public function getNick(){
        return $this->nick;
    }

    /**
     * @brief Metodo público asigna un valor al atributo nick, que
     * corresponde con el nick del usuario.
     * @param $nick 
     * Indica si una película es favorita.
     */
    public function setNick($nick){
        $this->nick = $nick;
    }

    /**
     * @brief Metodo público que devuelve la dirección URL del avatar del usuario.
     * @return string 
     * Dirección URL del avatar del usuario.
     */
    public function getPhotoUser(){
        return $this->photoUser;
    }

    /**
     * @brief Metodo público asigna un valor al atributo photoUser, que
     * corresponde con la direccion URL del avatar del usuario que realiza el comentario.
     * @param $photoUser 
     * Dirección URL del avatar del usuario que realiza el comentario.
     */
    public function setPhotoUser($photoUser){
        $this->photoUser = $photoUser;
    }

    /**
     * @brief Metodo público que devuelve la identidad privada del usuario que realiza el comentario.
     * @return int 
     * Identidad privada del usuario que realiza el comentario.
     */
    public function getUserId(){
        return $this->userid;
    }

    /**
     * @brief Metodo público asigna un valor al atributo userId, que
     * corresponde con la identidad privada en la BD del usuario que realiza el comentario.
     * @param $userid 
     * Identidad privada en la BD del usuario que realiza el comentario.
     */
    public function setUserId($userid){

        $this->userid = $userid;    
    }

    /**
     * @brief Metodo público que devuelve el identificador privado de la pelicula sobre la
     * que se realiza el comentario.
     * @return int 
     * Identificador privado de la pelicula sobre la
     * que se realiza el comentario.
     */
    public function getMovieId(){
        return $this->movieid;
    }

    /**
     * @brief Metodo público asigna un valor al atributo movieid, que
     * corresponde con la identidad privada en la BD de la película sobre la que se realiza el comentario.
     * @param $movieid 
     * Identidad privada en la BD de la película sobre la que se realiza el comentario.
     */
    public function setMovieId($movieid){
        $this->movieid = $movieid;
    }
               
}

?>