<?php 

require_once "./models/friend.php";
require_once "./models/notifications.php";

class FriendController extends ViewController{

    public function addFriend(){
        Helper::NothavePermission();

        if(!isset($_GET["friend"])){
            return header("location: ".URL);
        }

        $friendId = $_GET["friend"];
        $user = $_SESSION["user"];
        
        
        $friend = new Friend();
        $friend->setUserId($user->id);
        $friend->setFriendId($friendId);
        $result = $friend->addFriend();
        if($result) {

            $notifications = new Notifications();
            $notifications->setUserId($user->id);
            $notifications->setFriendUserId($friendId);
            $notifications->setNotifications("Te ha enviado la solicitud de amistad");
            $result = $notifications->addNotifications();
            if($result){
                $_SESSION["message"]["success"] = "Solicitud enviada";
                return header("location: ".URL."social/profile&id=$friendId");
            }
            $_SESSION["message"]["error"] = "Ha ocurrido un error, intentelo nuevamente";
            return header("location: ".URL."social/profile&id=$friendId");
        }
        
        $_SESSION["message"]["error"] = "Ha ocurrido un error, intentelo nuevamente";
        return header("location: ".URL."social/profile&id=$friendId");
    }

    public function cancelRequest(){
        Helper::NothavePermission();

        if(!isset($_GET["friend"])){
            return header("location: ".URL);
        }

        $friendId = $_GET["friend"];
        $user = $_SESSION["user"];
        $friend = new Friend();
        $friend->setUserId($user->id);
        $friend->setFriendId($friendId);
        $result = $friend->cancelFriend();

        if(!$result){
            $_SESSION["message"]["error"] = "Ha ocurrido un error, intentelo nuevamente";
            return header("location: ".URL."social/profile&id=$friendId");
        }

        $_SESSION["message"]["success"] = "Solicitud cancelada";
        return header("location: ".URL."social/profile&id=$friendId");
    }

    public function request(){
        Helper::NothavePermission();
        $friend = new Friend();
        $friend->setFriendId($_SESSION["user"]->id);
        $result = $friend->getRequestsFriend();
        $data["friends"] = $result;
        $this->view("friends", "request", $data);
    }

    public function requestCancel(){
        Helper::NothavePermission();

        if(!isset($_GET["friend"])){
            return header("location: ".URL);
        }

        $friendId = $_GET["friend"];
        $user = $_SESSION["user"];
        $friend = new Friend();
        $friend->setUserId($user->id);
        $friend->setFriendId($friendId);
        $result = $friend->cancelFriend(true);

        if(!$result){
            $_SESSION["message"]["error"] = "Ha ocurrido un error, intentelo nuevamente";
            return header("location: ".URL."friend/request");
        }

        $_SESSION["message"]["success"] = "La solicitud ha sido cancelada";
        return header("location: ".URL."friend/request");
    }

    public function confirmRequest(){
        Helper::NothavePermission();

        if(!isset($_GET["friend"])){
            return header("location: ".URL);
        }

        $friendId = $_GET["friend"];
        $user = $_SESSION["user"];
        $friend = new Friend();
        $friend->setUserId($user->id);
        $friend->setFriendId($friendId);
        $result = $friend->confirmFriend();

        if($result){
            $notification = new Notifications();
            $notification->setUserId($user->id);
            $notification->setFriendUserId($friendId);
            $notification->setNotifications("Ha aceptado tu solicitud de amistad");
            $result = $notification->addNotifications();
            
            if($result){
                $_SESSION["message"]["success"] = "Solicitud confirmada";
                return header("location: ".URL."friend/request");
            }
        }


        $_SESSION["message"]["error"] = "Ha ocurrido un error, intentelo nuevamente";
        return header("location: ".URL."friend/request");
    }

    public function friends(){
        $friend = new Friend();
        $friend->setUserId($_SESSION["user"]->id);
        $data["users"] = $friend->allUsers();
        $this->view("friends", "addFriend", $data);
    }
}