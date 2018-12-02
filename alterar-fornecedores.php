<?php
session_start();
ob_start(); //buffer do PHP
include_once 'modelo/usuario.class.php';
if(isset($_SESSION['privateUser'])){  $log = unserialize($_SESSION['privateUser']);

if(isset($_GET['id'])){
    include_once "dao/farmaciadao.class.php";
    include_once "modelo/fornecedores.class.php";

    $farmDAO = new FarmaciaDAO();
    $array = $farmDAO->filtrarFornecedor("idforn", $_GET['id']);
    $forn = $array[0];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alteração de Fornecedores</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <link rel="stylesheet" href="./vendor/css/master.css">

     </head>

      <body>
          <div class="container">
            <h1 class="jumbotron bg-light text-center">Sistema Interno</h1>

            <nav class="navbar navbar-expand-lg bg-light navbar-info">
              <a class="navbar-brand" href="./index.php">Home</a>
              <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Cadastro
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="cadastro-farmacia.php">Produtos</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="cadastro-funcionario.php">Funcionarios</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="cadastro-fornecedores.php">Fornecedores</a>
                    </div>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Consulta
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="consulta-farmacia.php">Produtos</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="consulta-funcionarios.php">Funcionarios</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="consulta-fornecedores.php">Fornecedores</a>
                    </div>
                  </li>
                </ul>

                <ul class="nav navbar-nav navbar-right ml-auto">
                    <li class="nav nav-item">
                        <a class="nav-link" href='cadastro-user.php'><i class="fas fa-user"></i> New User</a>
                    </li>
                    <li class="nav nav-item">
                        <a class="nav-link" href='config-user.php?name=<?php echo $log->username;?>'><i class="fas fa-users-cog"></i> Config</a>
                    </li>
                </ul>

              </div>
            </nav>


        <form name="cadprod" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnomeforn" pattern="^[a-zA-ZÁ-ù0-9 ]{2,50}$" placeholder="Nome do fornecedor" class="form-control" value="<?php if(isset($forn)){ echo $forn->nomeForn; } ?>">
          </div>

          <div class="form-group">
            <input type="text" name="txtemailforn" pattern="^([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+$" placeholder="E-Mail do Fornecedor" class="form-control" value="<?php if(isset($forn)){ echo $forn->emailForn; } ?>">
          </div>
          <div class="form-group">
            <input type="text" name="txttelforn"  pattern="^\(?\d{2}\)?[\s-]?\d{4}-?\d{4}$" placeholder="Telefone do Fornecedor" class="form-control" value="<?php if(isset($forn)){ echo $forn->telForn; } ?>">
          </div>


          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
        if(isset($_SESSION['msg'])){
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
        }
        ?>

        <?php
        if(isset($_POST['alterar'])){
          include_once "modelo/fornecedores.class.php";
          include_once "dao/farmaciadao.class.php";
          include_once "util/padronizacao.class.php";
          include 'util/validacao.class.php';

          //entrada

          $idForn = ($_GET['id']);
          $nomeForn = Padronizacao::converterMaiMin($_POST['txtnomeforn']);
          $emailForn = ($_POST['txtemailforn']);
          $telForn = ($_POST['txttelforn']);

          //Validacao
          $err = array();

          if(!Validacao::validarID($idForn)){
              $err[] = "<span class='alert alert-danger'>Erro no ID</span>";
          }

          if(!Validacao::validarName($nomeForn)){
              $err[] = "<span class='alert alert-danger'>Erro no Nome</span>";
          }
          if(!Validacao::validarEmail($emailForn)){
              $err[] = "<span class='alert alert-danger'>Erro no Email</span>";
          }
          if(!Validacao::validarTelefone($telForn)){
              $err[] = "<span class='alert alert-danger'>Erro no Telefone</span>";
          }

          if(count($err) != 0){ //valida
              foreach($err as $e){
                  echo $e."<br><br>";
              }
              return 0;
          }else{

          //modelo
          $forn = new Fornecedores();
          $forn->idForn = $idForn;
          $forn->emailForn = $emailForn;
          $forn->nomeForn = $nomeForn;
          $forn->telForn = $telForn;

          $farmDAO = new FarmaciaDAO();
          $farmDAO->alterarFornecedor($forn);

          $_SESSION['msg']="<span class='alert alert-info'>Fornecedor Alterado com sucesso!</span> <br>";

          $forn->__destruct();

          header("location:consulta-fornecedores.php");
      }//fecha Validacao
  }//fecha alterar
    }else{//fecha if autenticação
header('location:index.php');
}//fecha else autenticação
        ?>
      </div>
  </body>
</html>
