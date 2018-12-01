<?php
require_once "config/conexaobanco.class.php";
class FarmaciaDAO{

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }
  public function __destruct(){}

  public function cadastrarProduto($prod){
    try{
      $stat=$this->conexao->prepare("insert into produtos(idprod,nomeprod,precoprod,fabricante,tipoprod,datafabri,datavali)values(null,?,?,?,?,?,?)");

      $stat->bindValue(1, $prod->nomeProd);
      $stat->bindValue(2, $prod->precoProd);
      $stat->bindValue(3, $prod->fabricante);
      $stat->bindValue(4, $prod->tipoProd);
      $stat->bindValue(5, $prod->dataFabri);
      $stat->bindValue(6, $prod->dataVali);

      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao cadastrar! ".$e;
    }
  }
  public function cadastrarFuncionario($func){
    try{
      $stat=$this->conexao->prepare("insert into funcionarios(idfunc,nomefunc,enderecofunc,rgfunc,entradafunc,funcaofunc,emailfunc)values(null,?,?,?,?,?,?)");

      $stat->bindValue(1, $func->nomeFunc);
      $stat->bindValue(2, $func->enderecoFunc);
      $stat->bindValue(3, $func->rgFunc);
      $stat->bindValue(4, $func->entradaFunc);
      $stat->bindValue(5, $func->funcaoFunc);
      $stat->bindValue(6, $func->emailFunc);



      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao cadastrar! ".$e;
    }
  }

  public function cadastrarFornecedor($forn){
    try{
      $stat=$this->conexao->prepare("insert into fornecedores(idforn,nomeforn,emailforn,telforn)values(null,?,?,?)");

      $stat->bindValue(1, $forn->nomeForn);
      $stat->bindValue(2, $forn->emailForn);
      $stat->bindValue(3, $forn->telForn);

      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao cadastrar! ".$e;
    }
  }
  public function buscarProdutos(){
     try{
       $stat = $this->conexao->query("select * from produtos");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, "Farmacia");
       return $array;
     }catch(PDOException $e){
       echo "Erro ao buscar produtos!".$e;
     }//fecha catch
 }//fecha método
 public function buscarFuncionarios(){
    try{
      $stat = $this->conexao->query("select * from funcionarios");
      $array = $stat->fetchAll(PDO::FETCH_CLASS, "Funcionarios");
      return $array;
    }catch(PDOException $e){
      echo "Erro ao buscar funcionários!".$e;
    }//fecha catch
}//fecha método
public function buscarFornecedores(){
   try{
     $stat = $this->conexao->query("select * from fornecedores");
     $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Fornecedores');
     return $array;
   }catch(PDOException $e){
     echo "Erro ao buscar fornecedores!".$e;
   }//fecha catch
}//fecha método
public function filtrarProduto($filtro, $pesquisa){
  try{
    $query = "";
    switch($filtro){
      case "idprod": $query = "where idprod=".$pesquisa;
      break;
      case "nomeprod": $query="where nomeprod like '%".$pesquisa."%'";
      break;
      case "fabricante": $query="where fabricante like '%".$pesquisa."%'";
      break;
      case "tipoprod": $query="where tipoprod like '%".$pesquisa."%'";
      break;

    }//fecha switch

    if(empty($pesquisa)){
      $query = "";
    }

    $stat = $this->conexao->query("select * from produtos ".$query);
    $array = $stat->fetchAll(PDO::FETCH_CLASS, "Farmacia");
    return $array;
  }catch(PDOException $e){
    echo "Erro ao filtrar produtos!".$e;
  }//fecha catch
}//fecha filtrar
public function deletarProduto($id){
    try{
      $stat = $this->conexao->prepare("delete from produtos where idprod=?");
      $stat->bindValue(1, $id);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao deletar produto!".$e;
    }//fecha catch
  }//fecha deletarLivro

  public function alterarProduto($prod){
    try{
      $stat = $this->conexao->prepare("update produtos set nomeprod=?, precoprod=?, fabricante=?, tipoprod=?, datafabri=?, datavali=? where idprod=?");
      $stat->bindValue(1, $prod->nomeProd);
      $stat->bindValue(2, $prod->precoProd);
      $stat->bindValue(3, $prod->fabricante);
      $stat->bindValue(4, $prod->tipoProd);
      $stat->bindValue(5, $prod->dataFabri);
      $stat->bindValue(6, $prod->dataVali);
      $stat->bindValue(7, $prod->idProd);

      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao alterar produto! ".$e;
    }//fecha catch
  }//fecha alterarLivro

  public function filtrarFuncionario($filtro, $pesquisa){
    try{
      $query = "";
      switch($filtro){
        case "idfunc": $query = "where idfunc=".$pesquisa;
        break;
        case "nomefunc": $query="where nomefunc like '%".$pesquisa."%'";
        break;
        case "rgfunc": $query="where rgfunc like '%".$pesquisa."%'";
        break;
        case "funcaofunc": $query="where funcaofunc like '%".$pesquisa."%'";
        break;

      }//fecha switch

      if(empty($pesquisa)){
        $query = "";
      }

      $stat = $this->conexao->query("select * from funcionarios ".$query);
      $array = $stat->fetchAll(PDO::FETCH_CLASS, "Funcionarios");
      return $array;
    }catch(PDOException $e){
      echo "Erro ao filtrar produtos!".$e;
    }//fecha catch
  }//fecha filtrar
  public function deletarFuncionario($id){
      try{
        $stat = $this->conexao->prepare("delete from funcionarios where idfunc=?");
        $stat->bindValue(1, $id);
        $stat->execute();
      }catch(PDOException $e){
        echo "Erro ao deletar produto!".$e;
      }//fecha catch
    }//fecha deletarLivro

    public function alterarFuncionario($func,$id){
      try{
        $stat = $this->conexao->prepare("update funcionarios set nomeFunc=?, enderecoFunc=?, rgFunc=?, entradaFunc=?, funcaoFunc=?, emailFunc=? where idFunc=?");
        $stat->bindValue(1, $func->nomeFunc);
        $stat->bindValue(2, $func->enderecoFunc);
        $stat->bindValue(3, $func->rgFunc);
        $stat->bindValue(4, $func->entradaFunc);
        $stat->bindValue(5, $func->funcaoFunc);
        $stat->bindValue(6, $func->emailFunc);
        $stat->bindValue(7, $id);
        $stat->execute();
      }catch(PDOException $e){
        echo "Erro ao alterar funcionário! ".$e;
      }//fecha catch
    }//fecha alterarLivro
    public function filtrarFornecedor($filtro, $pesquisa){
      try{
        $query = "";
        switch($filtro){
          case "idforn": $query = "where idforn=".$pesquisa;
          break;
          case "nomeforn": $query="where nomeforn like '%".$pesquisa."%'";
          break;
          case "emailforn": $query="where emailforn like '%".$pesquisa."%'";
          break;
          case "telforn": $query="where telforn like '%".$pesquisa."%'";
          break;

        }//fecha switch

        if(empty($pesquisa)){
          $query = "";
        }

        $stat = $this->conexao->query("select * from fornecedores ".$query);
        $array = $stat->fetchAll(PDO::FETCH_CLASS, "Fornecedores");
        return $array;
      }catch(PDOException $e){
        echo "Erro ao filtrar fornecedores!".$e;
      }//fecha catch
    }//fecha filtrar
    public function deletarFornecedor($id){
        try{
          $stat = $this->conexao->prepare("delete from fornecedores where idforn=?");
          $stat->bindValue(1, $id);
          $stat->execute();
        }catch(PDOException $e){
          echo "Erro ao deletar fornecedor!".$e;
        }//fecha catch
      }//fecha deletarLivro

      public function alterarFornecedor($forn){
        try{
          $stat = $this->conexao->prepare("update fornecedores set nomeforn=?, emailforn=?, telForn=? where idforn=?");
          $stat->bindValue(1, $forn->nomeForn);
          $stat->bindValue(2, $forn->emailForn);
          $stat->bindValue(3, $forn->telForn);
          $stat->bindValue(4, $forn->idForn);
          $stat->execute();
        }catch(PDOException $e){
          echo "Erro ao alterar fornecedor! ".$e;
        }//fecha catch
      }//fecha alterarLivro
}
