<?php

/** 
 * @file UserModel.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class UserModel
 * Genera un objeto conector que gestiona la conexion con la tabla.
*/

class UserModel extends Connection{

    /**
     * @brief Constructor genera una conexion con nuestra BD.
     */
    public function __construct(){
        parent :: __construct();
    }

    /**
     * @brief Método público que toma como parametro un Data de la BD y utiliza los valores
     * para construir un usuario.
     * @param $userData 
     * Toma como parámetro un Data de la BD.
     * @return object
     * Devuelve un objeto usuario.
     */
    public function createUserFromData($userData){

        $nick = $userData['nick'];
        $avatarURL = $userData['avatarURL'];
        $email = $userData['email'];
        
        
        $user = new User($nick, $avatarURL, $email);

        return $user;

    }

    /**
     * @brief Método público que toma como parametro una lista Data de la BD y utiliza los valores
     * para construir una lista de usuarios.
     * @param $usersData 
     * Toma como parámetro una lista Data de la BD.
     * @return array
     * Devuelve una lista de objetos usuario.
     */
    public function createListMovies($usersData){

        $users=array();
        while ($userData = $usersData->fetch()) {
            $numFilmFav= $userData['favmovieperuser'];
            $user = $this->createUserFromData($userData);
            $user->setNumFilmFav($numFilmFav);
            array_push($users, $user);
        }

        return $users;
    }
    
    /**
     * @brief Método público que realiza una consulta a la tabla de usuarios de la BD
     * y crea una lista de objetos usuarios. 
     * @return array
     * Devuelve una lista de objetos usuario.
     */
    public function getListUsers(){
        
        $this->connect();
        $usersData = $this->connection->query("SELECT *  FROM myfilmaffinity.listUsers");
        $this->disconnect();

        $users = $this->createListMovies($usersData);
        
        return $users;

    }

    /**
     * @brief Método público que toma como parametro un nick de usuario
     * y devuelve un Data de la BD con los datos de ese usuario.
     * @param $nick 
     * Toma como parámetro un nick de usuario.
     * @return PDOData
     * Devuelve un Data de la BD.
     */
    public function getUserDataFromNick($nick){

        $this->connect();
        $getUserData= $this->connection->prepare("SELECT *  FROM myfilmaffinity.user WHERE nick = ?");
        
        $getUserData->bindParam(1,$nick);
        $getUserData->execute();
        $this->disconnect();

        $userData = $getUserData->fetch();

        return $userData;
    }
    
    /**
     * @brief Método público que toma como parametro un nick de un usuario, realiza
     * una conexion a la tabla de usuarios de la BD y devuelve un objeto usuario con 
     * los datos de este usuario.
     * @param $nick 
     * Toma como parámetro un nick de usuario.
     * @return object
     * Devuelve un objeto usuario.
     */
    public function infoUser($nick){

        $userData = $this->getUserDataFromNick($nick);
        $user = $this->createUserFromData($userData);
        $user->setPrivateId($userData['id']);
    

        return $user;
    }

    /**
     * @brief Método público que toma como parametro un objeto usuario, realiza una
     * conexión con la BD y lo introduce en la tabla usuarios de la BD.
     * 
     * @param $user 
     * Toma como parámetro un objeto usuario.
     */
    public function insertDataUser($user){
        

            $this->connect();
            $insertComment = $this->connection->prepare('INSERT INTO user (nick, avatarURL, email) 
            VALUES (?, ?, ?)');
    
                   
            $nick= $user->getNick();
            $email = $user->getEmail();
            $photoUrl = $user->getAvatarURL();
            
            $insertComment->bindParam(1, $nick);
            $insertComment->bindParam(2, $photoUrl);
            $insertComment->bindParam(3, $email);
                    
            $insertComment->execute();
    
            $this->disconnect();
    }
}
?>