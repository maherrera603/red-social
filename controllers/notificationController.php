<?php 

require_once "./models/notifications.php";

class NotificationController extends ViewController{

    public function index(){
        Helper::NothavePermission();
        $user = $_SESSION["user"];

        $notification = new Notifications();
        $notification->setUserId($user->id);
        $notifications = $notification->getNotificationsByUser();

        $data["notifications"] = $notifications;
        $this->view("notifications", "index", $data);
    }

    public function delete(){
        Helper::NothavePermission();

        if(!isset($_GET["notification"])){
            return header("location: ".URL."notification/index");
        }
        $idNotification = $_GET["notification"];
        $notification = new Notifications();
        $notification->setId($idNotification);
        $result = $notification->delete();

        if(!$result){
            $_SESSION["message"]["error"] = "Ha ocurrido un error, intento nuevamente";
            return header("location: ".URL."notification/index");
        }

        $_SESSION["message"]["success"] = "Ha eliminado correctamente la notificacion";
        return header("location: ".URL."notification/index");
    }
}