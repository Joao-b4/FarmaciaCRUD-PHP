<?php
class Farmacia{
  private $idProd;
  private $nomeProd;
  private $precoProd;
  private $fabricante;
  private $dataFabri;
  private $dataVali;
  private $tipoProd;




  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}

  public function __toString(){
    return nl2br("Nome do Produto: $this->nomeProd
                  Preço do Produto:$this->precoProd
                  Fabricante: $this->fabricante
                  Tipo de Produto: $this->tipoProd
                  Data de Fabricação: $this->dataFabri
                  Data de Validade: $this->dataVali");
  }

}
