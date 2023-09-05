<?php 

require_once "./models/social.php";

class Publications extends Social{
    private $id;
    private $user_id;
    private $image;
    private $description;

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

    public function getImage(){
        return $this->image;
    }
    
    public function setImage($image){
        $this->image = $this->connection->real_escape_string($image);
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setDescription($description){
        $this->description = $this->connection->real_escape_string($description);
    }
    
    public function save(){
        $sql = "INSERT INTO publications VALUES(NULL, {$this->getUserId()}, '{$this->getImage()}', '{$this->getDescription()}', CURDATE(), CURDATE())";
        $result = $this->connection->query($sql);
        return $result ? true: false;
    }

    public function allPublications(){
        $sql = "SELECT * FROM publications p ";
        $sql .= "INNER JOIN users u ON p.user_id = u.id WHERE u.id = {$this->getUserId()}  ";
        $sql .= "OR p.user_id IN (SELECT f.friend_user_id FROM friends f WHERE f.user_id = {$this->getUserId()} and status = 'confirm') ";
        $sql .= "OR p.user_id IN (SELECT f.user_id FROM friends f WHERE f.friend_user_id = {$this->getUserId()} and status = 'confirm') ";
        $sql .= "ORDER BY p.id DESC";      
        $result = $this->connection->query($sql);

        return $result;
    }

    public function allPublicationsByIdUser(){
        $sql = "SELECT u.*, p.* FROM publications p INNER JOIN users u ON u.id = p.user_id WHERE p.user_id={$this->getUserId()} ORDER BY p.id DESC";
        $result = $this->connection->query($sql);
        return $result;
    }

    
    
}