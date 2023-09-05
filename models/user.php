<?php 

require_once "./models/social.php";

class User extends Social{
    private $id;
    private $name;
    private $lastname;
    private $phone;
    private $cover_image;
    private $profile_image;
    private $email;
    private $password;
    private $status;
   

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $this->connection->real_escape_string($id);
    }

    public function getName(){
        return $this->name;
    }
    
    public function setName($name){
        $this->name = $this->connection->real_escape_string($name);
    }
    
    public function getLastname(){
        return $this->lastname;
    }
    
    public function setLastname($lastname){
        $this->lastname = $this->connection->real_escape_string($lastname);
    }
    
    public function getPhone(){
        return $this->phone;
    }
    
    public function setPhone($phone){
        $this->phone = $this->connection->real_escape_string($phone);
    }

    public function getCoverImage(){
        return $this->cover_image;
    }
    
    public function setCoverImage($cover_image){
        $this->cover_image = $this->connection->real_escape_string($cover_image);
    }
    
    public function getProfileImage(){
        return $this->profile_image;
    }
    
    public function setProfileImage($profile_image){
        $this->profile_image = $this->connection->real_escape_string($profile_image);
    }

    public function getEmail(){
        return $this->email;
    }
    
    public function setEmail($email){
        $this->email = $this->connection->real_escape_string($email);
    }
    
    public function getPassword(){
        $password = password_hash($this->password, PASSWORD_BCRYPT, ["cost" => 4]);
        return $password;
    }
    
    public function setPassword($password){
        $this->password = $this->connection->real_escape_string($password);
    }

    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($status){
        $this->status = $this->connection->real_escape_string($status);
    }
    

    public function create(){
        $sql = "INSERT INTO users VALUES(null, '{$this->getName()}', '{$this->getLastname()}', null, null, null, '{$this->getEmail()}', '{$this->getPassword()}', 'desactivado', CURDATE(), null)";
        $result = $this->connection->query($sql);
        return $result ? true: false;
    }

    public function getUser(){
        $sql = "SELECT * FROM users WHERE email='{$this->getEmail()}'";
        $result = $this->connection->query($sql);
        $user = $result->fetch_object();
        $validate_password = password_verify($this->password, $user->password);
        if($result->num_rows < 1 || !$validate_password){
            return false;
        }
        unset($user->password);
        return $user;
    }

    public function getUserById(){
        $sql = "SELECT id, name, lastname, phone, email, profile_image, cover_image FROM users WHERE id={$this->getId()}";
        $result = $this->connection->query($sql);
        $user = $result->fetch_object();
        if($result->num_rows < 1){
            return false;
        }
        return $user;
    }

    public function updateStatus($id){
        $sql = "UPDATE users SET status = '{$this->getStatus()}' where id={$id}";
        $result = $this->connection->query($sql);
        return $result ? true : false;
    }

    public function update(){
        $sql = "UPDATE users SET name='{$this->getName()}', lastname='{$this->getLastname()}', phone='{$this->getPhone()}', ";
        $sql .= "profile_image='{$this->getProfileImage()}', cover_image='{$this->getCoverImage()}', updated_at=CURDATE() WHERE id={$this->id}";
        $result = $this->connection->query($sql);
        return $result ? true : false;
    }

    public function closeSession(){
        $sql = "UPDATE users SET status='desactivado' WHERE id={$this->getId()}";
        $result =  $this->connection->query($sql);
        return $result ? true : false;
    }
}