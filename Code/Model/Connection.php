<?php

/** 
 * @file Connection.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class Connection
 * Genera una conexion con la BD.
*/
class Connection{

    protected $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    protected $hostname;
    protected $schema;
    protected $user;
    protected $password;
    protected $connection; #Este conector es el del PDO

    /**
     * @brief Constructor que genera un objeto conexion donde asignamos a los atributos de la 
     * clase los valores de la conexion con nuestra base de datos
     */
    public function __construct($hostname = "localhost", $schema = "myfilmaffinity", $user = "root", $password = "")
    {
        $this->hostname = $hostname;
        $this->schema = $schema;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @brief Metodo público que establece una conexion con nuestra base de datos.
     * @return object 
     * Conexión con la base de datos.
     */
    public function connect()
    {

        $connectionString = 'mysql:host=' . $this->hostname . ';dbname=' . $this->schema;
        $this->connection = new PDO($connectionString, $this->user, $this->password, $this->option);
        return $this->connection;
    }

    /**
     * @brief Metodo público que realiza una desconexión con la base de datos.
     */
    public function disconnect()
    {
        $this->connection = null;
    }
}

?>