<?php 

require_once "./models/like.php";

class LikeController extends ViewController{

    public function dislike(){
        if(!isset($_GET["id"])){
            return header("location: ".URL."home/index");
        }

        $publicationId = $_GET["id"];
        $userId = $_SESSION["user"]->id;

        $like = new Like();
        $like->setUserId($userId);
        $like->setPublicationId($publicationId);
        $like->delete();
        return header("location: ".URL."home/index");
    }

}