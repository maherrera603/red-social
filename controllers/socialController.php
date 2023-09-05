<?php 

require_once "./models/user.php";
require_once "./models/publications.php";

class SocialController extends ViewController{

    public function profile(){
        Helper::NothavePermission();
        $data = [];

        $id = (isset($_GET["id"])) ? $_GET["id"] : $_SESSION["user"]->id;
        $user = new User();
        $user->setId($id);
        $data["user"] = $user->getUserById();

        $publications = new Publications();
        $publications->setUserId($id);
        $data["publications"] = $publications->allPublicationsByIdUser();

        $this->view("social", "profile", $data);
    }

    public function update(){
        Helper::NothavePermission();
        if(!isset($_POST)){
            return header("location: ".URL."social/profile");
        }

        $name = isset($_POST["name"]) && !empty($_POST["name"]) ? $_POST["name"] : false; 
        $lastname = isset($_POST["lastname"]) && !empty($_POST["lastname"]) ? $_POST["lastname"] : false;
        $phone = isset($_POST["phone"]) && !empty($_POST["phone"]) ? $_POST["phone"] : false;
        $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"] : false;

        $validate_data = $name && $lastname && $phone && $email;
        if(!$validate_data){
            $_SESSION["message"]["error"] = "Complete los campos del formulario";
            return header("location: ".URL."social/profile");
        }

        $imageProfile = $_FILES["profile"]["name"];
        $typeImageProfile = $_FILES["profile"]["type"];
        $imageProfileTemp = $_FILES["profile"]["tmp_name"];

        $imageCover = $_FILES["cover"]["name"];
        $typeImageCover = $_FILES["cover"]["type"];
        $imageCoverTemp = $_FILES["cover"]["tmp_name"];
        

        $validate_imageProfile =  $typeImageProfile === "image/jpeg" || $typeImageProfile === "image/jpg" || $typeImageProfile === "image/png";
        $validate_imageCover = $typeImageCover === "image/jpeg" || $typeImageCover === "image/jpg" || $typeImageCover === "image/png";

        if(!empty($imageProfile)){
            if(!$validate_imageProfile){
                $_SESSION["message"]["error"] = "El formato de imagenes debe ser: jpeg, jpg y png";
                return header("location: ".URL."social/profile");
            }
        }

        if(!empty($imageCover)){
            if(!$validate_imageCover){
                $_SESSION["message"]["error"] = "El formato de imagenes debe ser: jpeg, jpg y png";
                return header("location: ".URL."social/profile");
            }
        }

        $url_profile_image = "uploads/".$name." ".$lastname."/profile";
        $url_cover_image = "uploads/".$name." ".$lastname."/cover";

        if(!is_dir($url_profile_image) && !is_dir($url_cover_image)){
            mkdir($url_profile_image, 0777, true);
            mkdir($url_cover_image, 0777, true);
        }

        $user = new User();
        $user->setId($_SESSION["user"]->id);
        $user->setName($name);
        $user->setLastname($lastname);
        $user->setPhone($phone);
        
        $profileImage = $imageProfile !== "" ? $url_profile_image."/".$imageProfile : $_SESSION["user"]->profile_image;
        $coverImage = $imageCover !== "" ? $url_cover_image."/".$imageCover : $_SESSION["user"]->cover_image;

        $user->setProfileImage($profileImage);
        $user->setCoverImage($coverImage);


        $result = $user->update();
        if(!$result){
            $_SESSION["message"]["error"] = "Ha ocurrido un error, intentelo nuevamente";
            return header("location: ".URL."social/profile");
        }

        move_uploaded_file($imageProfileTemp, $url_profile_image."/".$imageProfile);
        move_uploaded_file($imageCoverTemp, $url_cover_image."/".$imageCover);
        $_SESSION["message"]["success"] = "Se han actualizado los datos correctamente";
        return header("location: ".URL."social/profile");
    }
}