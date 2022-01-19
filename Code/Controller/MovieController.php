<?php

/** 
 * @file MovieController.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class MovieController
 * Genera un Controlador que verifica los datos que se mueven entre
 * vista y controlador.
*/

class MovieController{

    private $movieModel;/*Objeto que gestiona la conexion con la tabla movie de la BD*/

    /**
     * @brief Constructor que genera un objeto movieModel, que se encargara de gestionar
     * la conexion con la tabla de peliculas de la BD.
     */
    function __construct(){
        $this->movieModel = new MovieModel();
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
        $isRange = $value >= 0;
        $isNumeric = is_numeric($value);
        $isEmpty = empty(trim($value));

        if ($isNumeric && $isRange && !$isEmpty) {
            $correct =  true;
        }else{
            $correct = false;
        }
        return $correct;
    }
    
    /**
     * @brief Metodo público que toma un valor de una dirección URL de la foto
     * de la pelicula, comprueba que sea una URL correcta y devuelve un booleno.
     * @param $posterUrl
     * String que contiene una dirección URL que pertenece a la foto de la película.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testUrl($posterUrl){

        return filter_var($posterUrl, FILTER_VALIDATE_URL);
    }

    /**
     * @brief Metodo público que toma un valor string y verifica que el valor
     * sea correcto.
     * @param $value
     * Valor string.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testDataString($value)
    {

        $isString = is_string($value);
        $isEmpty = empty(trim($value));

        if (!$isEmpty && $isString) {
            $correct =  true;
        }else{
            $correct = false;
        }
        return $correct;
    }
    
    
    /**
     * @brief Metodo público utiliza el objeto modelo para obtener una lista de
     * peliculas.
     * @return array
     * Devuelve una lista de objetos pelicula.
     */
    public function listMovies(){
        
        $movies = $this->movieModel->getListMovies();
        return $movies;
    }

    /**
     * @brief Metodo público que toma un id público de una pelicula
     * y mediante el objeto model obtiene un objeto pelicula.
     * @param $idPublic
     * Identidad pública de una película.
     * @return object
     * Devuelve objeto película.
     */
    public function infoFilmFromIdPublic($idPublic){
        $movie = $this->movieModel->getMovieFromIdPublic($idPublic);
        return $movie;
    }

    /**
     * @brief Metodo público que toma dos valores, el id público de una película
     * y la nota que se le asigna, comprueba los datos y si estan correctos los
     * inserta en la BD.
     * 
     * @param $idPublic, $rating
     * Id pública de la película y nota
     */
    public function insertRating($idPublic,$rating){
        
         /*En este caso no uso el metodo testNumeric, porque al comprobar que
        no este vacio el cero lo considera vacio y no permite hacer una valoracion de 
        pelicula igual a cero*/
        $isNumeric = is_numeric($rating);
        $isInRange = $rating >=0 && $rating <= 5;
        $correct= $isNumeric &&  $isInRange;

        if($correct){
            try{
                $movie = $this->movieModel->getMovieFromIdPublic($idPublic);
                $movie->setRating($rating);
                $this->movieModel->insertRating($movie, $idPublic,$rating);
                /*Esta linea redirige de nuevo a la pagina de informacion de la pelicula
                tras haber calificado la pelicula*/
                header("Location: ./InfoFilm.php?publicId=$idPublic && option=0");
            }catch (PDOException $PDOexception) {
				/**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php?option=1");
			}
			catch (Exception $exception) {
				/**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php?option=1");
			}
        }  
    }

    /**
     * @brief Metodo público que toma un objeto usuario y obtiene una lista
     * de objetos película que son las favoritas de ese usuario.
     * 
     * @param $user
     * Objeto usuario.
     * @return array
     * Devuelve una lista de objetos película.
     */
    public function listFavMovies($user){
        $movies = $this->movieModel->listFavMoviesFromUser($user);
        return $movies;
    }

    /**
     * @brief Metodo público que toma un nombre de una película y lo 
     * formatea para obtener una id pública para esta película.
     * 
     * @param $name
     * Nombre de la película.
     * @return string
     * Devuelve una id pública para la película.
     */
    public function createPublicId($name){
        $name = strtolower($name);
        $name = strtr($name, " ", "-");
        return $name;
    }
    
    /**
     * @brief Metodo público que toma un año de producción de una película y lo
     * comprueba, devuelve si esta correcto o no.
     * sea correcto.
     * @param $releaseYear
     * Año de producción de la película.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testYear($releaseYear)
    {
        $isRange = $releaseYear >= 1800 && $releaseYear <= 2100;
        $isNumeric = $this->testDataNumeric($releaseYear);

        if ($isNumeric && $isRange) {
            $correct =  true;
        }else{
            $correct = false;
        }
        return $correct;
    }   
    
    /**
     * @brief Metodo público que toma una sinopsis de una película y 
     * comprueba que sea correcta, devuelve si esta correcta o no.
     * 
     * @param $synopsis
     * Sinopsis de la película.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testSynopsis($synopsis){

        $isString = $this->testDataString($synopsis);
        $isRange = strlen($synopsis)>0 && strlen($synopsis)<201;

        if($isString && $isRange){
            $correct =  true;
        }else{
            $correct = false;
        }
        return $correct;

    }

    /**
     * @brief Metodo público que toma una dirección URL de una foto de una 
     * película, comprueba que sea correcta e indica si es correcta o no.
     * @param $posterURL
     * Dirección URL de la foto de la película
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testPosterUrl($posterUrl){
        $isStringValid = $this->testDataString($posterUrl);
        $isURLValid = $this->testUrl($posterUrl);

        if($isStringValid && $isURLValid){
            $correct =  true;
        }else{
            $correct = false;
        }
        return $correct;
        
    }

    /**
     * @brief Metodo público que toma los valores de nombre de película, sinopsis,
     * año de produccion, nombre de director y direccion URL de foto, comprueba todos los
     * datos y en caso que esten correctos los inserta en la BD.
     * 
     * @param $name, $synopsis, $releaseYear, $directorName, $posterUrl
     * Nombre de película, sinopsis,
     * año de produccion, nombre de director y direccion URL de foto
     * @return boolean
     * Indica si se ha insertado correctamente la película.
     */
    public function insertMovie($name, $synopsis, $releaseYear,
    $directorName, $posterUrl){

        $isNameValid = $this->testDataString($name);
        $isSynopsisValid = $this->testSynopsis($synopsis);
        $isreleaseYearValid = $this->testYear($releaseYear);
        $isDirectorNameValid = $this->testDataString($directorName);
        $isposterUrlValid = $this->testPosterUrl($posterUrl);

        $isDataValid = $isNameValid && $isSynopsisValid && $isreleaseYearValid &&
        $isDirectorNameValid && $isposterUrlValid;

        if($isDataValid){
        try{
        $publicId = $this->createPublicId($name);
        $movie = new Movie($publicId, $name, $posterUrl, $synopsis, $releaseYear, 
        $directorName);
        $this->movieModel->insertDataMovie($movie);
        $insert = true;
        }catch (PDOException $PDOexception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
           header("Location: ./Exception.php?option=2");
        }
        catch (Exception $exception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
            header("Location: ./Exception.php?option=2");
        }
        }else{
            
            header("Location: ./insertFilm.html");
            $insert=false;
        }
        return $insert;

    }

    /**
     * @brief Metodo público que toma una identidad pública de una 
     * película, y la elimina de la BD. 
     * @param $publicId
     * Identidad pública de película.
     * @return boolean
     * Devuelve un true o false en función de lo que ocurra.
     */
    public function deleteFilm($publicId){
        
        try{
            $deleted = $this->movieModel->deleteMovieFromPublidId($publicId);
        }catch (PDOException $PDOexception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
            header("Location: ./Exception.php?option=5");
        }
        catch (Exception $exception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
            header("Location: ./Exception.php?option=5");
        }

        if($deleted){
            $isDeleted = true;
        }else{
            $isDeleted = false;
        }

        return $isDeleted;
    }
    
    /**
     * @brief Metodo público que toma un string que corresponde a una
     * busqueda realizada por el usuario, comprueba que string este 
     * correcto y realiza una consulta a la BD. 
     * @param $search
     * Busqueda realizada por el usuario.
     * @return array
     * Devuelve una lista de objetos pelicula, que coinciden con la búsqueda del
     * usuario.
     */
    public function searchMovie($search){
        $correct = $this->testDataString($search);

        if ($correct){
           $listMovies= $this->movieModel->searchDataMovie($search);
        }

        return $listMovies;

    }

    /**
     * @brief Metodo público que toma un objeto película y un booleana
     * que indica si la película es favorita y en caso que sea favorita 
     * la elimina de la tabla favorita, en caso contrario la añade en dicha
     * tabla de la BD. 
     *  
     * @param $movie, $isFav
     * Objeto película, es favorita.
     */
    public function manageFav($movie, $isFav){

        if($isFav){
            try{
                $this->movieModel->delFavMovie($movie);
            }catch (PDOException $PDOexception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php");
            }
            catch (Exception $exception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php");
            }
            
        }else{
            try{
                $this->movieModel->addFavMovie($movie);
            }catch (PDOException $PDOexception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php");
            }
            catch (Exception $exception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php");
            }

        }

    }
}
?>