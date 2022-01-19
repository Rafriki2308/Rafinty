<?php

/** 
 * @file Movie.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class Movie
 * Genera una pelicula con todos sus atributos.
*/

class Movie{
    
    private $publicId;/*Identidad pública de la película */
    private $name;/*Nombre de la película */
    private $synopsis;/*Synopsis de la película */
    private $releaseYear;/*Año de salida de la película */
    private $directorName;/*Nombre del director de la película */
    private $posterUrl;/*Direccion URL de la imagen */
    private $rating;/*Nota de la pelicula */
    private $privateId;/*Identidad privada de la pelicula en la BD */
    private $isFav;/*Guarda booleano que indica si es Favorita*/
    
    /**
     * @brief Constructor que toma los atributos publicId, name y posterURL como obligatorios
     * y genera una película, los demas atributos son opcionales.
     */
    
    public function __construct($publicId, $name, $posterUrl, $synopsis=null, $releaseYear=null, 
    $directorName = null, $rating=null, $privateId=null, $isFav=null)
    {
        $this->publicId = $publicId;
        $this->name =$name;
        $this->synopsis = $synopsis;
        $this->releaseYear =$releaseYear;
        $this->directorName = $directorName;
        $this->posterUrl = $posterUrl;
        $this->rating = $rating;
        $this->privateId = $privateId;
        $this->isFav = $isFav; 
        

    }

    /**
     * @brief Metodo público que devuelve la identidad publica de la película.
     * @return int 
     * Identidad pública de la película.
     */
    public function getPublicId(){
        return $this->publicId;
    }

    /**
     * @brief Metodo público que modifica el valor del atributo de identidad pública de
     * la película.
     * @param $publicId
     * Valor que corresponde a la identidad pública de la película.
     */
    public function setPublicId($publicId){
        $this->publicId = $publicId;
    }

    /**
     * @brief Metodo público que devuelve el nombre de la película.
     * @return string
     * Nombre  de la película.
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @brief Metodo público toma un nombre y se lo asigna a la película.
     * @param $name
     * Nombre de la película.
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * @brief Metodo público que devuelve la identidad publica de la película.
     * @return string 
     * Sinopsis de la película.
     */
    public function getSynopsis(){
        return $this->synopsis;
    }

    /**
     * @brief Metodo público que devuelve la sinopsis de la película.
     * @param $synopsis 
     * Sinopsis de la película.
     */
    public function setSynopsis($synopsis){
        $this->synopsis = $synopsis;
    }

    /**
     * @brief Metodo público que devuelve la fecha de plublicación de la película
     * @return int
     *  Año de publicación de la película.
     */
    public function getReleaseYear(){
        return $this->releaseYear;
    }

    /**
     * @brief Metodo público asigna un valor al atributo releaseYear, que
     * corresponde al año de producción de la pelicula.
     * @param $releaseYear 
     * Año de publicación la película.
     */
    public function setReleaseYear($releaseYear){
        $this->releaseYear = $releaseYear;
    }

    /**
     * @brief Metodo público que devuelve el nombre del director de la película.
     * @return string 
     * Nombre del director de la película.
     */
    public function getDirectorName(){
        return $this->directorName;
    }

    /**
     * @brief Metodo público asigna un valor al atributo directorName, que
     * corresponde al nombre del director de la pelicula.
     * @param $releaseYear 
     * Año de publicación la película.
     */
    public function setDirectorName($directorName){
        $this->directorName =$directorName;
    }

    /**
     * @brief Metodo público que devuelve la dirección URL de la imagen de la pelicula.
     * @return string 
     * Dirección URL de la imagen de la película.
     */
    public function getPosterUrl(){
        return $this->posterUrl;
    }

    /**
     * @brief Metodo público asigna un valor al atributo releaseYear, que
     * corresponde al año de producción de la pelicula.
     * @param $releaseYear 
     * Año de publicación la película.
     */
    public function setPosterUrl($posterUrl){
        $this->posterUrl =$posterUrl;
    }

    /**
     * @brief Metodo público que devuelve la nota de la película.
     * @return double 
     * Nota de la película.
     */
    public function getRating(){
        return $this->rating;
    }

    /**
     * @brief Metodo público asigna un valor al atributo rating, que
     * corresponde a la nota de la película.
     * @param $rating 
     * Nota de la pelicula.
     */
    public function setRating($rating){
        $this->rating = $rating;
    }

    /**
     * @brief Metodo público que devuelve la identidad privada de la película.
     * @return int 
     * Identidad privada de la película BD.
     */
    public function getPrivateId(){
        return $this->privateId;
    }

    /**
     * @brief Metodo público asigna un valor al atributo releaseYear, que
     * corresponde al año de producción de la pelicula.
     * @param $privateId
     * Identidad privada de la pelicula en la BD.
     */
    public function setPrivateId($privateId){
        $this->privateId = $privateId;
    }

    /**
     * @brief Metodo público un boleano que indica si es favorita.
     * @return boolean
     * Indica si la  película es favorita.
     */
    public function getisFav(){
        return $this->isFav;
    }

    /**
     * @brief Metodo público asigna un valor al atributo isFav, que
     * corresponde a si es una pelicula es favorita.
     * @param $isFav 
     * Indica si una película es favorita.
     */
    public function setIsFav($isFav){
        $this->isFav = $isFav;
    }
    
}

?>