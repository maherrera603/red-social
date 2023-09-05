<?php 

require_once "./models/social.php";



class Friend extends Social{
    private $id;
    private $user_id;
    private $friend_id;
    private $status;


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

    public function getFriendId(){
        return $this->friend_id;
    }
    
    public function setFriendId($friend_id){
        $this->friend_id = (int) $this->connection->real_escape_string($friend_id);
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($status){
        $this->status = $this->connection->real_escape_string($status);
    }
    
    public function getRequestFriend(){
        $sql = "SELECT * FROM friends WHERE (user_id = {$this->getUserId()} AND friend_user_id = {$this->getFriendId()}) or (user_id = {$this->getFriendId()} AND friend_user_id = {$this->getUserId()}) AND (status = 'sent' or status='confirm');";
        $result = $this->connection->query($sql);
        return ($result->num_rows > 0)? true: false;
    }

    public function addFriend(){
        $sql = "INSERT INTO friends VALUES(null, {$this->getUserId()}, {$this->getFriendId()}, 'sent', CURDATE(), CURDATE())";
        $result = $this->connection->query($sql);
        return $result ? true: false;
    }

    public function cancelFriend($data = false){

        if($data){
            $sql = "DELETE FROM friends WHERE user_id={$this->getFriendId()} AND friend_user_id={$this->getUserId()} AND status='sent'";
        }else{
            $sql = "DELETE FROM friends WHERE user_id={$this->getUserId()} AND friend_user_id={$this->getFriendId()} AND (status='sent' OR status='confirm') ";
        }
        $result = $this->connection->query($sql);
        return $result ? true: false;
    }

    public function countFriendsRequest(){
        $sql = "SELECT COUNT(friend_user_id) as 'request' FROM friends WHERE friend_user_id={$this->getFriendId()} AND status = 'sent'";
        $result = $this->connection->query($sql);
        return $result;
    }

    public function getRequestsFriend(){
        $sql = "SELECT u.* from users u INNER JOIN friends f ON f.user_id = u.id WHERE f.friend_user_id = {$this->getFriendId()} and f.status='sent'";
        $result = $this->connection->query($sql);
        return $result;
    }

    public function confirmFriend(){
        $sql = "UPDATE friends SET status='confirm' WHERE user_id={$this->getFriendId()} and friend_user_id= {$this->getUserId()}";
        $result = $this->connection->query($sql);
        return $result ? true: false;
    }

    public function getFriends(){
        $sql = "SELECT u.* FROM friends f INNER JOIN users u ON f.friend_user_id = u.id or f.user_id = u.id WHERE (f.user_id = {$this->getUserId()} or f.friend_user_id = {$this->getUserId()}) AND f.status = 'confirm'";
        $friends = $this->connection->query($sql);
        return $friends;
    }

    public function allUsers(){
        $sql = "SELECT u.* FROM users u WHERE NOT EXISTS (SELECT * FROM friends f WHERE (f.user_id = u.id OR f.friend_user_id = u.id) AND (f.user_id = {$this->getUserId()} or f.friend_user_id = {$this->getUserId()}) ) AND u.id <> {$this->getUserId()}";
        $result = $this->connection->query($sql);
        return $result;
    }

}