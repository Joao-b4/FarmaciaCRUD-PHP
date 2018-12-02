<?php
class ConexaoBanco extends PDO {

  private static $instance = null;

  public function __construct($dsn, $user, $pass){
    parent::__construct($dsn,$user,$pass);
  }

  public static function getInstance(){
      try{ //PADRÃO SINGLETON - design patterns
        if(!isset(self::$instance)){
          /* Criar uma conexão */
          self::$instance = new
ConexaoBanco("mysql:dbname=farmacia;host=localhost","root","");
        }
        return self::$instance;
      }catch(PDOException $e){
        echo "Erro ao conectar. ".$e;
      }
  }
}//fecha classe
