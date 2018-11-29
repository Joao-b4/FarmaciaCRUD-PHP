<?php
class Funcionarios{
  private $idFunc;
  private $nomeFunc;
  private $enderecoFunc;
  private $rgFunc;
  private $entradaFunc;
  private $funcaoFunc;
  private $emailFunc;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}


  public function __toString(){
    return nl2br("Nome do Funcionário: $this->nomeFunc
                  Endereço do Funcionário: $this->enderecoFunc
                  RG: $this->rgFunc
                  Data de entrada na empresa: $this->entradaFunc
                  Função(Cargo): $this->funcaoFunc
                  E-Mail do Funcionário: $this->emailFunc");
  }
}
