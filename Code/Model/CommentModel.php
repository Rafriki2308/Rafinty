<?php

/** 
 * @file CommentModel.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class CommentModel
 * Hereda de Connection que gestiona las conexiones
 * con la tabla comentarios de la BD.
*/

class CommentModel extends Connection{

    /**
     * @brief Constructor genera una conexion con nuestra BD.
     */
    function __construct()
    {
        parent :: __construct();
        
    }

    /**
     * @brief Método público que toma como parametro un Data de la BD y utiliza los valores
     * para construir una objeto comentario.
     * @param $commentData 
     * Toma como parámetro un Data de la BD.
     * @return object
     * Devuelve un objeto comentario.
     */
    public function createCommentFromData($commentData){

        $comment = $commentData['comment'];
        $commentDate = $commentData['commentdate'];
        $nick = $commentData['nick'];
        $photoUser = $commentData['avatarURL'];
        

        $commentObjet = new Comment($comment, $commentDate, $nick, $photoUser);

        return $commentObjet;

    }

    /**
     * @brief Método público que toma como parametro un array de Data de la BD y utiliza los valores
     * para construir una lista de  objetos comentario.
     * @param $commentsData 
     * Toma como parámetro un array de Data de la BD.
     * @return array
     * Devuelve una lista objeto comentario.
     */
    public function createListComments($commentsData){

        $comments=array();
        while ($commentData = $commentsData->fetch()) {
            
            $comment = $this->createCommentFromData($commentData);
            array_push($comments, $comment);
        }

        return $comments;
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
     * realiza una consulta a la BD con ese id y obtiene una lista de comentarios 
     * correspondientes a dicha película.
     * 
     * @param $publicIdMovie
     * Toma como parámetro un string que es una id pública de una película.
     * @return array
     * Devuelve una lista de comentarios.
     */public function getCommentsFromPrivateIdMovie($publicIdMovie){

        
        $idPrivateMovie = $this->getIdPrivateFromIdPublic($publicIdMovie);
        
        $this->connect();
        
        $getCommentData= $this->connection->prepare("SELECT *  FROM listComments WHERE movieid = ?");
        
        $getCommentData->bindParam(1,$idPrivateMovie);
        $getCommentData->execute();
        $this->disconnect();

        $commentList = $this->createListComments($getCommentData);

        return $commentList;

    }

    /**
     * @brief Método público que toma como parametro un objeto comment,  
     * realiza una conexion a la BD e inserta dicho comentario en la tabla 
     * de comentarios de la BD.
     * 
     * @param $comment
     * Toma como parámetro un objeto comment.
     */
    public function insertDataComment($comment){

        $this->connect();
        $insertComment = $this->connection->prepare('INSERT INTO usercommentsmovie
        (userid, movieid, comment) 
        VALUES (?, ?, ?)');

               
        $commentString = $comment->getComment();
        $userid =  3;
        $movieid = $comment->getMovieId();
        
        $insertComment->bindParam(1, $userid);
        $insertComment->bindParam(2, $movieid);
        $insertComment->bindParam(3, $commentString);
                
        $insertComment->execute();

        $this->disconnect();
    
    }

    /**
     * @brief Método público que toma como parametro un objeto comment,  
     * realiza una conexion a la BD e inserta dicho comentario en la tabla 
     * de comentarios de la BD.
     * 
     * @param $comment, $publicIdMovie
     * Toma como parámetro un objeto comment y una id pública de una película.
     */
    public function insertComment($comment, $publicIdMovie){

       $privateMovieId = (int) $this->getIdPrivateFromIdPublic($publicIdMovie);
       $comment->setMovieId($privateMovieId);
       $this->insertDataComment($comment);
    }

    
}

