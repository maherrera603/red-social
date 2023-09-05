<?php 

require_once "./models/social.php";

class Comment extends Social{
    private $id;
    private $user_id;
    private $publication_id;
    private $comment;

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
    
    public function getComment(){
        return $this->comment;
    }
    
    public function setComment($comment){
        $this->comment = $this->connection->real_escape_string($comment);
    }
    
}