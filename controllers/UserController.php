<?php 

require_once "./models/user.php";

class UserController extends ViewController{
    private $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function register(){
        Helper::havePermission();
        $this->view("user", "register");
    }

    public function create(){
        if(!isset($_POST) && empty($_POST)){
            $this->data["message"] = "Envie los datos confirmados";
            return header("location: ".URL."user/register");
        }

        $name = isset($_POST["name"]) && !empty($_POST["name"]) ? $_POST["name"] : false;
        $lastname = isset($_POST["lastname"]) && !empty($_POST["lastname"]) ? $_POST["lastname"] : false;
        $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"] : false;
        $password = isset($_POST["password"]) && !empty($_POST["password"]) ? $_POST["password"] : false;
        $pass = isset($_POST["pass"]) && !empty($_POST["pass"]) ? $_POST["pass"] : false;

        $validate_fields = $name && $lastname && $email && $password;
        if(!$validate_fields) {
            $_SESSION["message"]["error"] = "Todos los campos son requeridos";
            return header("location: ".URL."user/register");
        }

        $validate_password = $pass === $password;
        if(!$validate_password) {
            $_SESSION["message"]["error"] = "Las Contraseñas debe ser iguales";
            return header("location: ".URL."user/register");
        }

        $user = new User();
        $user->setName($name);
        $user->setLastname($lastname);
        $user->setEmail($email);
        $user->setPassword($password);
        $result = $user->create(); 
        if(!$result) {
            $_SESSION["message"]["error"] = "Error al registrarse, intentelo nuevamente";
            return header("location: ".URL."user/register");
        }

        $_SESSION["message"]["success"] = "Se ha registrado correctamente!!";
        return header("location: ".URL."user/register");
    }

    public function login(){
        Helper::havePermission();
        $this->view("user", "login");
    }

    public function loguearse(){
        if(!isset($_POST)){
            $_SESSION["message"]["error"] = "Complete los campos requeridos";
            return header("location: ".URL);
        }

        $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"]: false;
        $password = isset($_POST["password"]) && !empty($_POST["password"])? $_POST["password"] : false;

        $validate_data = $email && $password;
        if(!$validate_data){
            $_SESSION["message"]["error"] = "Todos los campos son requeridos";
            return header("location: ". URL);
        }

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $result = $user->getUser();
        if(!$result){
            $_SESSION["message"]["error"] = "Las credenciales son incorrectas";
            return header("location: ".URL);
        }


        $user->setStatus("Activado");
        $result_status = $user->updateStatus($result->id);
        if(!$result_status){
            $_SESSION["message"]["error"] = "Las credenciales son incorrectas";
            return header("location: ".URL);
        }

        $result->status = "en linea";
        $_SESSION["user"] = $result;
        return header("location: ". URL."home/index");
    }

    public function logout(){
        if(!isset($_SESSION["user"]) && empty($_SESSION["user"])){
            return header("location: ".URL."home/index");
        }

        $userSession = $_SESSION["user"];
        $user = new User();
        $user->setId($userSession->id);
        $result = $user->closeSession();
        if(!$result){
            $_SESSION["message"]["error"] = "Ha ocurrido un error intentelo nuevamente"; 
            return header("location: ".URL."home/index");
        }
        session_destroy();
        return header("location: ".URL);
    }

}