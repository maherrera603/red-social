<?php 

require_once "./models/social.php";

class Like extends Social {
    private $id;
    private $user_id;
    private $publication_id;
    private $like;


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
    
    public function getPublicationId(){
        return $this->publication_id;
    }
    
    public function setPublicationId($publication_id){
        $this->publication_id = (int) $this->connection->real_escape_string($publication_id);
    }
    
    public function getLike(){
        return $this->like;
    }
    
    public function setLike($like){
        $this->like = (int) $this->connection->real_escape_string($like);
    }

    public function like(){
        $sql = "INSERT INTO likes VALUES(null, {$this->getUserId()}, {$this->getPublicationId()}, CURDATE(), CURDATE())";
        $result = $this->connection->query($sql);
        return $result ? true : false;
    }

    public function countLike(){
        $sql = "SELECT COUNT(l.publication_id) as likes FROM publications p INNER JOIN likes l ON p.id = l.publication_id WHERE l.publication_id = {$this->getPublicationId()}";
        $result = $this->connection->query($sql);
        return $result;
    }

    public function getLikeByUserWithPublication(){
        $sql = "SELECT * FROM likes l INNER JOIN users u ON u.id = l.user_id WHERE l.user_id = {$this->getUserId()} AND l.publication_id = {$this->getPublicationId()} LIMIT 1";
        $result = $this->connection->query($sql);
        return $result->num_rows > 0 ? true : false;
    }

    public function delete(){
        $sql = "DELETE from likes WHERE user_id={$this->getUserId()} AND publication_id={$this->getPublicationId()}";
        $result = $this->connection->query($sql);
        return $result;
    }
    
    
}