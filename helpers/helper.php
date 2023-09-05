<?php 

require_once "./models/like.php";
require_once "./models/friend.php";
require_once "./models/notifications.php";

class Helper{


    public static function clearSession($session){
        if(isset($_SESSION[$session])){
            unset($_SESSION[$session]);
        }
    }

    public static function havePermission(){
        if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
            return header("location: ".URL."home/index");
        }
        return true;
    }

    public static function NothavePermission(){
        if(!isset($_SESSION["user"]) && empty($_SESSION["user"])){
            $_SESSION["message"]["error"] = "Debe Iniciar sesion primero";
            return header("location: ".URL);
        }
        return true;
    }

    public static function getLikes($publication_id){
        $likes = new Like();
        $likes->setPublicationId($publication_id);
        $result = $likes->countLike();
        $counts = $result->fetch_object()->likes; 
        return $counts;
    }

    public static function likeOrDislike($publicationId){
        $like = new Like();
        $like->setUserId($_SESSION["user"]->id);
        $like->setPublicationId($publicationId);
        $result = $like->getLikeByUserWithPublication();
        return $result;
    }

    public static function requestSent($friend_id){
        $friend = new Friend();
        $friend->setUserId($_SESSION["user"]->id);
        $friend->setFriendId($friend_id);
        $friend->setStatus("sent");
        return $friend->getRequestFriend();
    }

    public static function countFriendsRequest(){
        $user = $_SESSION["user"];
        $friend = new Friend();
        $friend->setFriendId($user->id);
        $result = $friend->countFriendsRequest();
        return $result->fetch_object()->request;
    }

    public static function countNotifications(){
        $user = $_SESSION["user"];
        $notification = new Notifications();
        $notification->setUserId($user->id);
        $count = $notification->countNotificationOfTheUser();
        return $count->fetch_object()->count;
    }

}