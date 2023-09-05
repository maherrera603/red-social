<?php 
session_start();
require_once "./autload.php";
require_once "./config/connection.php";
require_once "./config/parameters.php";
require_once "./helpers/helper.php";

require_once "./views/layouts/header.php";


if(isset($_GET["controller"])){
    $nombreController = $_GET["controller"]."Controller";
}elseif(!isset($_GET["controller"]) && !isset($_GET["action"])){
    $nombreController = CONTROLLER_DEFAULT;
}else{
    die();
}


if(class_exists($nombreController)){
    $controller = new $nombreController();

    if(isset($_GET["action"]) && method_exists($controller, $_GET["action"])){
        $action = $_GET["action"];
        $controller->$action();
    }elseif(!isset($_GET["controller"]) && !isset($_GET["action"])){
        $action = ACTION_DEFAULT;
        $controller->$action();
    }else{
        die();
    }

}else{
    die();
}

require_once "./views/layouts/footer.php";
