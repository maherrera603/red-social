<?php 

class Social{
    protected $created_at;
    protected $updated_at;
    protected $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance()->connection();
    }
}