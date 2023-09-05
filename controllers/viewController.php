<?php 

class ViewController{

    protected function view($folder, $file, $data=null){
        require_once "./views/$folder/$file.php";
    }
}