<?php
class Fornecedores{
  private $idForn;
  private $nomeForn;
  private $emailForn;
  private $telForn;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}

  public function __toString(){
    return nl2br("Nome do Fornecedor: $this->nomeForn
                  E-Mail do Fornecedor: $this->emailForn
                  Telefone do Fornecedor: $this->telForn");
  }

}
