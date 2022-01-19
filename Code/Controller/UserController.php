<?php

/** 
 * @file UserController.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class UserController
 * Genera un Controlador que verifica los datos que se mueven entre
 * vista y controlador.
*/

class UserController
{

    private $userModel;/*Objeto que gestiona la conexion con la tabla movie de la BD*/

    /**
     * @brief Constructor que genera un objeto userModel, que se encargara de gestionar
     * la conexion con la tabla de peliculas de la BD.
     */
    public function __construct()
    {

        $this->userModel = new UserModel();
    }

    /**
     * @brief Metodo público que toma un email y comprueba que este en formato correcto
     * y devuelve un true o un false
     * @param $email
     * Correo del usuario.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testEmail($email)
    {
        $isEmpty = empty(trim($email));
        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!$isEmpty && $isValid) {
            $correct = true;
        } else {
            $correct = false;
        }
        return $correct;
    }

    /**
     * @brief Metodo público que toma una dirección URL, comprueba si esta en formato valido,
     * en caso afirmativo devuelve una true
     * @param $avatarUrl
     * Dirección URL de avatar de usuario.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testUrl($avatarUrl)
    {

        $isEmpty = empty(trim($avatarUrl));
        $isValid =  filter_var($avatarUrl, FILTER_VALIDATE_URL);

        if (!$isEmpty && $isValid) {
            $correct = true;
        } else {
            $correct = false;
        }
        return $correct;
    }

     /**
     * @brief Metodo público que toma un valor string, comprueba que no
     * este vacio y que sea un objeto string.
     * 
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
        } else {
            $correct = false;
        }
        return $correct;
    }

     /**
     * @brief Metodo público realiza una conexcion con la BD mediante el objeto userModel
     * para obtener una lista de usuarios.
     * 
     * @return array
     * Devuelve una lista de objetos usuario.
     */
    public function listUsers()
    {

        $users = $this->userModel->getListUsers();
        return $users;
    }

     /**
     * @brief Metodo público que toma un nick, realiza una conexión con la BD
     * mediante el objeto userModel para obtener un objeto usuario.
     * @param $nick
     * Nick del usuario.
     * @return object
     * Objeto usuario.
     */
    public function getUserInfo($nick)
    {
        $user = $this->userModel->infoUser($nick);

        return $user;
    }

     /**
     * @brief Metodo público que toma un nick de usuario, un email
     * una dirección URL de la foto de usuario, comprueba si estos datos estan
     * correctos.
     * 
     * @param $nick, $email, $photoUrl
     * Nick, email y dirección URL del avatar del usuario.
     * @return boolean
     * Devuelve un true para valor correcto, false para valor incorrecto.
     */
    public function testData($nick, $email, $photoUrl)
    {
        $nickIsValid = $this->testDataString($nick);
        $emailIsValid = $this->testEmail($email);
        $photoUrlIsValid = $this->testUrl($photoUrl);

        $isCorrect = ($nickIsValid && $emailIsValid && $photoUrlIsValid);

        if ($isCorrect) {
            $correct = true;
        } else {
            $correct = false;
        }
        return $correct;
    }

     /**
     * @brief Metodo público que toma un nick de usuario, un email
     * una dirección URL de la foto de usuario, comprueba si estos datos estan
     * correctos y en caso afirmativo lo inserta en la BD.
     * 
     * @param $nick, $email, $photoUrl
     * Nick, email y dirección URL del avatar del usuario.
     */
    public function insertUser($nick, $email, $photoUrl)
    {
        $nick = strtolower($nick);
        $correct = $this->testData($nick, $email, $photoUrl);

        if ($correct) {
            try{
                $user = new User($nick, $photoUrl, $email);
                $this->userModel->insertDataUser($user);
            }catch (PDOException $PDOexception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php?option=3");
            }
            catch (Exception $exception) {
                /**
                 * @exception
                 * Redirige a una página de error especifico
                 */
                header("Location: ./Exception.php?option=3");
            }
        }
    }
}
