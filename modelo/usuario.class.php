<?php
class Usuario{

    private $id;
    private $username;
    private $senha;
    private $usernameOld;

    public function __construct(){}
    public function __destruct(){}

    public function __get($a){ return $this->$a; }
    public function __set($a,$v){ $this->$a = $v; }


    public function _toString(){
        return nl2br("username: $this->username
                    senha: *******");
    }

}
