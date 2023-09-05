<?php 

require_once "./models/like.php";

class PublicationController extends ViewController{


    public function like(){
        Helper::NothavePermission();

        if(!isset($_GET["id"])){
            return header("location: ".URL."home/index");
        }

        $user = $_SESSION["user"];
        $publication_id = $_GET["id"];
        $user_id= $user->id;

        $like = new Like();
        $like->setUserId($user_id);
        $like->setPublicationId($publication_id);
        $result = $like->like();
        if(!$result) {
            $_SESSION["message"]["error"] = "Ha ocurrido un error intentelo nuevamente";
            return header("location: ".URL."home/index");
        }
        return header("location: ".URL."home/index");
    }
}

// SELECT COUNT(l.publication_id) as likes FROM publications p INNER JOIN likes l ON p.id = l.publication_id WHERE l.publication_id = 4;