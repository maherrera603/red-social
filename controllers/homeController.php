<?php 

require_once "./models/publications.php";

require_once "./models/friend.php";

class HomeController extends ViewController{

  public function index(){
    Helper::NothavePermission();
    $publications = new Publications();
    $publications->setUserId($_SESSION["user"]->id);
    $data["publications"] = $publications->allPublications();
    
    $friend = new Friend();
    $friend->setUserId($_SESSION["user"]->id);
    $data["friends"] = $friend->getFriends();


    $this->view("home", "index", $data);
  }

  public function savePublications(){
    if(!isset($_POST)){
      $_SESSION["message"]["error"] = "Ha ocurrido un error, intentelo nuevamente";
      return header("location: ".URL."home/index");
    }
    
    $user = $_SESSION["user"];

    $description = isset($_POST["description"]) && !empty($_POST["description"]) ? $_POST["description"] : false;

    if(!$description){
      $_SESSION["message"]["error"] = "Debe realizar un comentario si desea publicarlo";
      return header("location: ".URL."home/index");
    }

    $imageName = $_FILES["image"]["name"];
    $imageType = $_FILES["image"]["type"];
    $image_tmp = $_FILES["image"]["tmp_name"];

    if($imageName !== ""){
      $validate_imageType = $imageType === "image/jpeg" || $imageType === "image/jpg" || $imageType === "image/png";
      if(!$validate_imageType){
        $_SESSION["message"]["error"] = "El formato de imagenes debe ser jpeg, jpg o png";
        return header("location: ".URL."home/index");
      }
    }

    $urlFolder = "uploads/".$user->name." " .$user->lastname."/publications";
    if(!is_dir($urlFolder)){
      mkdir($urlFolder, 0777, true);
    }

    $publications = new Publications();
    $publications->setUserId($user->id);
    $publications->setDescription($description);

    $image = $imageName !== "" ? "$urlFolder/$imageName": null;
    $publications->setImage($image);

    $result = $publications->save();
    
    if(!$result){
      $_SESSION["message"]["error"] = "Ha ocurrido un error, intentelo nuevamente";
      return header("location: ".URL."home/index");
    }

    move_uploaded_file($image_tmp, $urlFolder."/".$imageName);
    $_SESSION["message"]["success"] = "Se realizo correctamente la publicacion";
    return header("location: ".URL."home/index");
  }

}