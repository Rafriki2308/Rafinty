<?php

/** 
 * @file MovieModel.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class MovieModel
 * Hereda de Connection y genera un objeto MovieModel que gestiona las consultas con la 
 * tabla de peliculas en nuestra BD.
*/

class MovieModel extends Connection{

    /**
     * @brief Constructor genera una conexion con nuestra BD.
     */

    function __construct()
    {
        parent :: __construct();

    }

    /**
     * @brief Método público que toma como parametro un Data de la BD y utiliza los valores
     * para construir una película.
     * @param $movieData 
     * Toma como parámetro un Data de la BD.
     * @return object
     * Devuelve un objeto película.
     */    
    public function createMovieFromData($movieData){

        $publicId = $movieData['publicid'];
        $name = $movieData['name'];
        $posterUrl = $movieData['posterurl'];
        
        $movie = new Movie($publicId, $name,$posterUrl);

        return $movie;

    }

    /**
     * @brief Método público que toma como parametro un array de Datas de la BD,  
     * extrae cada Data del array y crea un array de objetos películas.
     * 
     * Este metodo guarda en el atributo rating la media de las notas
     * de la pelicula.
     * @param $moviesData 
     * Toma como parámetro un array de Datas de la BD.
     * @return array
     * Devuelve un array de objetos película.
     */
    public function createListMovies($moviesData){

        $movies=array();
        while ($movieData = $moviesData->fetch()) {
            
            $movie = $this->createMovieFromData($movieData);
            $movie->setRating($movieData['averagerating']);
            $movie->setSynopsis($movieData['synopsis']);
            array_push($movies, $movie);
        }

        return $movies;
    }

    /**
     * @brief Método público que toma como parametro un array de Datas de la BD,  
     * extrae cada Data del array y crea un array de objetos películas.
     * 
     * Este metodo guarda en el atributo rating la nota
     * de la pelicula dada por el usuario principal.
     * @param $moviesData
     * Toma como parámetro un array de Datas de la BD.
     * @return array
     * Devuelve un array de objetos película.
     */
    public function createListFavMovies($moviesData){

        $movies=array();
        while ($movieData = $moviesData->fetch()) {
            
            $movie = $this->createMovieFromData($movieData);
            $movie->setRating($movieData['rating']);
            $movie->setSynopsis($movieData['synopsis']);

            array_push($movies, $movie);
        }

        return $movies;

    }
    
    /**
     * @brief Método público que realiza una conexión a la BD y una consulta
     * que consiste en la lista de peliculas almacenada. Transforma dicha consulta
     * en un array de objetos película.
     *  
     * @return array
     * Devuelve un array de objetos película.
     */
    public function getListMovies(){

        $this->connect();
        $moviesData = $this->connection->query("SELECT *  FROM myfilmaffinity.infoIndexFilm");
        $this->disconnect();

        $movies = $this->createListMovies($moviesData);
        
        return $movies;
    }

    /**
     * @brief Método público que toma como parametro un id público de una película,  
     * realiza una consulta a la BD con ese id y obtiene la pelicula almacenada en la
     * BD con dicha id, devolviendo el objeto de esa película.
     * 
     * @param $idPublic
     * Toma como parámetro un string que es una id pública de una película.
     * @return object
     * Devuelve un objeto película.
     */
    public function getMovieFromIdPublic($idPublic){

        $this->connect();
        $getMovieData= $this->connection->prepare("SELECT *  FROM myfilmaffinity.infoIndexFilm WHERE publicid = ?");
        
        $getMovieData->bindParam(1,$idPublic);
        $getMovieData->execute();
        $this->disconnect();

        $movieData = $getMovieData->fetch();

        $movie = $this->createMovieFromData($movieData);
        $movie->setSynopsis($synopsis = $movieData['synopsis']);
        $movie->setReleaseYear($releaseYear= $movieData['releaseyear']);
        $movie->setDirectorName($directorName = $movieData['directorname']);
        $movie->setRating($rating =$movieData['averagerating']);
        $isFav = $this->queryFavMovie($movie);
        $movie->setIsFav($isFav);

        return $movie;

    }

    /**
     * @brief Método público que toma como parametro un id público de una película,  
     * realiza una consulta a la BD con ese id y obtiene el id privado en dicha BD,
     * devolviendo un int con dicha id.
     * 
     * @param $publicIdMovie
     * Toma como parámetro un string que es una id pública de una película.
     * @return int
     * Devuelve una identidad privada de la película en la BD.
     */
    public function getIdPrivateFromIdPublic($publicIdMovie){

        $this->connect();
        
        $getPrivateIdMovie= $this->connection->prepare("SELECT id  FROM movie WHERE publicid = ?");
        
        $getPrivateIdMovie->bindParam(1,$publicIdMovie);
        $getPrivateIdMovie->execute();
        $this->disconnect();

        $privateIdData = $getPrivateIdMovie->fetch();

        $privateIdMovie = (int)$privateIdData['id'];

        return $privateIdMovie;

    }

    /**
     * @brief Método público que toma como parametro un id público de una película,  
     * realiza una consulta a la BD con ese id y obtiene el id privado en dicha BD,
     * devolviendo un int con dicha id.
     * 
     * @param $publicIdMovie
     * Toma como parámetro un string que es una id pública de una película.
     * @return int
     * Devuelve una identidad privada de la película en la BD.
     */
    public function insertDataRating($movie){
        
        $rating = $movie->getRating();
        $userid =  3;
        $movieid = $movie->getPrivateId();
        $this->connect();
        $insertMovie = $this->connection->prepare('INSERT INTO userratesmovie
        (userid, movieid, rating)  VALUES (?, ?, ?)');
     
            $insertMovie->bindParam(1, $userid);
            $insertMovie->bindParam(2, $movieid);
            $insertMovie->bindParam(3, $rating);
                    
            $insertMovie->execute();
    
            $this->disconnect();
        
        }
    
    /**
     * @brief Método público que toma como parametros un objeto película, id público y una nota
     * de una película, realiza una conexión a la BD e introduce dicha nota en la celda de la nota
     * de la tabla de pelicula en la BD.
     * 
     * @param $movie, $publicIdMovie, $rating
     * Toma como parámetros:
     * Objeto Pelicula /n, 
     *  String que es una id pública de una película, 
     *  int corresponde a la nota de la película,
     */
    public function insertRating($movie, $publicIdMovie,$rating){

        $privateMovieId = (int)$this->getIdPrivateFromIdPublic($publicIdMovie);
        $movie->setPrivateId($privateMovieId);
        $movie->setRating($rating);
        $this->insertDataRating($movie);
     }

     
    /**
     * @brief Método público que toma como parametro un objeto usuario,  
     * realiza una consulta a la BD con ese usuario y obtiene una lista de peliculas
     * favoritas para ese usuario.
     * 
     * @param $user
     * Toma como parámetro un objeto que es un usuario.
     * @return array
     * Devuelve un array de objetos película.
     */
    public function listFavMoviesFromUser($user){

       $privateId = $user->getPrivateId();

        $this->connect();

        $moviesData = $this->connection->prepare("SELECT m.*, ratedfavs.userid, ratedfavs.rating FROM
        (
            SELECT f.*, r.rating
            FROM userfavmovie f
            LEFT JOIN userratesmovie r
            ON f.userid=r.userid and f.movieid=r.movieid
        ) ratedfavs
        JOIN movie m
        ON ratedfavs.movieid = m.id
        WHERE userid= ?");
        $moviesData->bindParam(1,$privateId);
        $moviesData->execute();
        $this->disconnect();

        $movies = $this->createListFavMovies($moviesData);

        return $movies;
     }

    /**
     * @brief Método público que toma como parametro un objeto película, 
     * realiza una conexión con la BD e inserta dicha película en la tabla 
     * peliculas de la BD.
     * 
     * @param $movie
     * Toma como parámetro un objeto película.
     */
    public function insertDataMovie($movie){
        

        $this->connect();
        $insertMovie = $this->connection->prepare('INSERT INTO movie (publicid, name, synopsis, releaseyear,
        directorname, posterurl) VALUES (?, ?, ?, ?, ?, ?)');

               
        $publicId= $movie->getPublicId();
        $name = $movie->getName();
        $synopsis = $movie->getSynopsis();
        $releaseYear = $movie->getReleaseYear();
        $directorName = $movie->getDirectorName();
        $posterUrl = $movie->getPosterUrl();

        
        $insertMovie->bindParam(1, $publicId);
        $insertMovie->bindParam(2, $name);
        $insertMovie->bindParam(3, $synopsis);
        $insertMovie->bindParam(4, $releaseYear);
        $insertMovie->bindParam(5, $directorName);
        $insertMovie->bindParam(6, $posterUrl);
                
        $insertMovie->execute();

        $this->disconnect();
       
    }
    
    /**
     * @brief Método público que toma como parametro un id público de una película,  
     * realiza una conexión con la BD con ese id y elimina la pelicula de la tabla peliculas
     * de la BD, devolviendo un boleano con la respuesta a la acción.
     * 
     * @param $publicId
     * Toma como parámetro un string que es una id pública de una película.
     * @return boolean
     * Devuelve un true si se ha eliminado y un false en caso contrario.
     */
    public function deleteMovieFromPublidId($publicId){

        $id = $this->getIdPrivateFromIdPublic($publicId);
        $this->connect();
        $moviesData = $this->connection->prepare("DELETE FROM myfilmaffinity.movie 
            WHERE id = ?");

        $moviesData->bindParam(1,$id);
        $moviesData->execute();
        $this->disconnect();

        return true;
    }

    /**
     * @brief Método público que toma como parametro una búsqueda  de una película,  
     * le da formato al string y lo devuelve formateado.
     * 
     * @param $search
     * Toma como parámetro un string que es una busqueda realizada por el usuario.
     * @return string
     * Devuelve una búsqueda formateada para ser introducida en una consulta de BD.
     */
    public function formatSearch($search){
       return  $search = "%".trim($search)."%";

    }
    
    /**
     * @brief Método público que toma como parametro una búsqueda de una película,  
     * realiza una consulta a la BD con esa búsqueda y obtiene una lista de películas,
     * que coinciden con la búsqueda.
     * 
     * @param $search
     * Toma como parámetro un string que es una búsqueda de una película.
     * @return array
     * Devuelve una lista de objetos película.
     */
    public function searchDataMovie($search){

        $search = $this->formatSearch($search);
        $this->connect();
        $getMoviesData = $this->connection->prepare("SELECT * FROM myfilmaffinity.infoIndexFilm 
        WHERE name like ?");

        $getMoviesData->bindParam(1,$search);
        $getMoviesData->execute();
        $this->disconnect();
        $movies = $this->createListMovies($getMoviesData);

        return $movies;

    }

    /**
     * @brief Método público que toma como parametro un objeto película,  
     * realiza una consulta a la BD con ese objeto y averigua si esa película
     * es favorita para ese usuario.
     * 
     * @param $movie
     * Toma como parámetro un objeto película.
     * @return boolean
     * Devuelve un true si es favorita o un false si no lo es.
     */
    public function queryFavMovie($movie){

        $publicId = $movie->getPublicId();
        $privateId = $this->getIdPrivateFromIdPublic($publicId);
        $userId = 3;
        $isFav = false;

        $this->connect();
        $moviesData = $this->connection->prepare("SELECT * FROM myfilmaffinity.userfavmovie 
        WHERE userid = ? AND movieid = ?");

        $moviesData->bindParam(1,$userId);
        $moviesData->bindParam(2,$privateId);
        $moviesData->execute();
        $this->disconnect();

        if($moviesData->rowCount()>0){
            $isFav = true;
        }
        
        return $isFav;

    }

    /**
     * @brief Método público que toma como parametro un objeto película,  
     * realiza una conexión a la BD y añade dicha película a la tabla de 
     * películas favoritas de la BD.
     * 
     * @param $movie
     * Toma como parámetro un objeto película.
     */
    public function addFavMovie($movie){

        $publicId = $movie->getPublicId();
        $privateId = $this->getIdPrivateFromIdPublic($publicId);
        $userId = 3;

        $this->connect();
        $moviesData = $this->connection->prepare('INSERT INTO myfilmaffinity.userfavmovie 
        (userid, movieid)  VALUES (?, ?)');

        $moviesData->bindParam(1,$userId);
        $moviesData->bindParam(2,$privateId);
        $moviesData->execute();
        $this->disconnect();
    }

  
    /**
     * @brief Método público que toma como parametro un objeto película,  
     * realiza una conexión a la BD y elimina dicha película de la tabla
     * de favoritos de la BD.
     * 
     * @param $movie
     * Toma como parámetro un objeto película.
     * @return boolean
     * Devuelve true si se ha borrado satisfactoriamente.
     */
    public function delFavMovie($movie){
        
        $publicId = $movie->getPublicId();
        $privateId = $this->getIdPrivateFromIdPublic($publicId);
        $userId = 3;

        $this->connect();
        $moviesData = $this->connection->prepare("DELETE FROM myfilmaffinity.userfavmovie 
            WHERE userid = ? AND  movieid = ?");

        $moviesData->bindParam(1,$userId);
        $moviesData->bindParam(2,$privateId);
        $moviesData->execute();
        $this->disconnect();

        return true;
    }
}
?>