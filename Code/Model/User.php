<?php

/** 
 * @file User.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class User
 * Genera un usuario con todos sus atributos.
*/


class User{

    private $privateId;/*Identidad privada del usuario */
    private $nick;/*Nick que identifica al usuario */
    private $avatarURL;/*Dirección URL de la fotografia del avatar */
    private $email;/*Email del usuario */
    private $numFilmFav;/*Número de películas Favoritas */

    /**
     * @brief Constructor que toma como obligatorios los atributos, nick, avatarURL y email y construye
     * un usuario. Los atributos numFilmFav y privateId, son opcionales.
     */
    public function __construct($nick, $avatarURL, $email, $numFilmFav =null, 
    $privateId=null){

        $this->privateId = $privateId;
        $this->nick = $nick;
        $this->avatarURL = $avatarURL;
        $this->email = $email;
        $this->numFilmFav = $numFilmFav;
     }

    /**
     * @brief Metodo público que devuelve el nick del usuario.
     * @return string 
     * Nick del usuario.
     */
    public function getNick(){
        return $this->nick;
    }

    /**
     * @brief Metodo público asigna un valor al atributo nick, que
     * corresponde con el nick del usuario.
     * @param $nick
     * Nick del usuario.
     */
    public function setNick($nick){
        $this->nick = $nick;
    }

    /**
     * @brief Metodo público que devuelve la dirección URL de la imagen
     * del avatar del usuario.
     * @return string  
     * Dirección URL de la imagen del avatar del usuario.
     */
    public function getAvatarURL(){
        return $this->avatarURL;
    }

    /**
     * @brief Metodo público asigna un valor al atributo avatarURL, que
     * corresponde con la dirección de la imagen del avatar del usuario.
     * @param $avatarURL
     * Dirección de la imagen del avatar del usuario.
     */
    public function setAvatarURL($avatarURL){
        $this->avatarURL = $avatarURL;
    }

    /**
     * @brief Metodo público que devuelve el email del usuario.
     * @return string 
     * Email del usuario.
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @brief Metodo público asigna un valor al atributo email, que
     * corresponde con el email del usuario.
     * @param $email 
     * Corresponde con el email del usuario.
     */
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * @brief Metodo público que devuelve el número de películas favoritas del usuario.
     * @return int
     * Número de películas favoritas del usuario.
     */
    public function getNumFilmFav(){
        return $this->numFilmFav;
    }

    /**
     * @brief Metodo público asigna un valor al atributo numFilFav, que
     * corresponde con el número de películas favoritas del usuario.
     * @param $numFilmFav 
     * Número de peliculas favoritas del usuario.
     */
    public function setNumFilmFav($numFilmFav){
        $this->numFilmFav = $numFilmFav;
    }

    /**
     * @brief Metodo público que devuelve la identidad privada del usuario.
     * @return int 
     * Identidad privada del usuario en la BD.
     */
    public function getPrivateId(){
        return $this->privateId;
    }

    /**
     * @brief Metodo público asigna un valor al atributo privateId, que
     * corresponde con el identificador privado del usuario en la BD.
     * @param $privateId 
     * Pertenece al identificador privado del usuario en la BD.
     */
    public function setPrivateId($privateId){
        $this->privateId = $privateId;

    }
}

?>