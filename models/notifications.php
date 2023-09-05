<?php 

require_once "./models/social.php";

class Notifications extends Social{
    private $id;
    private $user_id;
    private $friend_user_id;
    private $notifications;

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = (int) $this->connection->real_escape_string($id);
    }
    
    public function getUserId(){
        return $this->user_id;
    }
    
    public function setUserId($user_id){
        $this->user_id = (int) $this->connection->real_escape_string($user_id);
    }

    public function getFriendUserId(){
        return $this->friend_user_id;
    }
    
    public function setFriendUserId($friend_user_id){
        $this->friend_user_id = (int) $this->connection->real_escape_string($friend_user_id);
    }

    public function getNotifications(){
        return $this->notifications;
    }
    
    public function setNotifications($notifications){
        $this->notifications = $this->connection->real_escape_string($notifications);
    }
    
    public function getNotificationsByUser(){
        $sql = "SELECT * FROM users u INNER JOIN notifications n ON u.id = n.user_id WHERE n.friend_user_id = {$this->getUserId()}";
        $result = $this->connection->query($sql);
        return $result;
    }

    public function addNotifications(){
        $sql = "INSERT INTO notifications VALUES (null, {$this->getUserId()}, {$this->getFriendUserId()}, '{$this->getNotifications()}', CURDATE(), CURDATE())";
        $result = $this->connection->query($sql);
        return $result ? true: false;
    }

    public function countNotificationOfTheUser(){
        $sql = "SELECT COUNT(*) as 'count' FROM users u INNER JOIN notifications n ON u.id = n.user_id WHERE n.friend_user_id = {$this->getUserId()}";
        $result = $this->connection->query($sql);
        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM notifications where id={$this->getId()}";
        $result = $this->connection->query($sql);
        return $result ? true: false;
    }
}