<?php
session_start();
ob_start();

include_once "dao/farmaciadao.class.php";
include_once "modelo/fornecedores.class.php";

include_once 'modelo/usuario.class.php';
if(isset($_SESSION['privateUser'])){  $log = unserialize($_SESSION['privateUser']);
$farmDAO = new FarmaciaDAO();
$array = $farmDAO->buscarFornecedores();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Consulta de fornecedores</title>
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

        <h1>Sistema para gerenciamento de fornecedores</h1>
        <h2>Consulta de fornecedores</h2>
        <?php

        if(isset($array)){
          if(count($array)==0){
            echo "<h3>Não há Fornecedores cadastrados!</h3>";
            return;
          }
          ?>
          <form name="pesquisa" method="post" action="">
          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" name="txtfiltro"
              class="form-control" placeholder="Digite sua pesquisa">
            </div>
            <div class="form-group col-md-6">
              <select name="selfiltro" class="form-control">
                <option value="todos">Todos</option>
                <option value="idforn">ID do Fornecedor</option>
                <option value="nomeforn">Nome do Fornecedor</option>

              </select>
            </div>
          </div>

          <div class="form-group">
            <input type="submit" name="filtrar" value="Filtrar"
                   class="btn btn-primary btn-block">
          </div>
        </form>
        <?php
        if(isset($_POST['filtrar'])){
          $pesquisa = $_POST['txtfiltro'];
          $filtro = $_POST['selfiltro'];
          $farmDAO = new FarmaciaDAO();
          $array = $farmDAO->filtrarFornecedor($filtro, $pesquisa);
          if(count($array) == 0){
            echo "<h2>Sua pesquisa não retornou nenhum fornecedor!</h2>";
            return;
          }//fecha if
        }//fecha if
        ?>

        <div class="table-responsive">
          <table class="table table-light table-striped table-bordered table-hover table-condensed">
            <thead class="thead-dark">
              <tr>
                <th>Alterar</th>
                <th>Excluir</th>
                <th>ID do Fornecedor</th>
                <th>Nome do Fornecedor</th>
                <th>E-Mail do Fornecedor</th>
                <th>Telefone do Fornecedor</th>
              </tr>
            </thead>

            <tfoot class="thead-dark">
              <th>Alterar</th>
              <th>Excluir</th>
              <th>ID do Fornecedor</th>
              <th>Nome do Fornecedor</th>
              <th>E-Mail do Fornecedor</th>
              <th>Telefone do Fornecedor</th>
            </tfoot>

            <tbody>
              <?php
                  foreach($array as $forn){
                    echo "<tr>";
                      echo "<td><a href='alterar-fornecedores.php?id=$forn->idForn 'class='btn btn-warning'>Alterar</a></td>";
                      echo "<td><a href='consulta-fornecedores.php?id=$forn->idForn 'class='btn btn-danger'>Excluir</a></td>";
                      echo "<td>$forn->idForn</td>";
                      echo "<td>$forn->nomeForn</td>";
                      echo "<td>$forn->emailForn</td>";
                      echo "<td>$forn->telForn</td>";
                    echo "</tr>";
                  }//fecha foreach
              }//fecha if
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php
      if(isset($_GET['id'])){
        $farmDAO = new FarmaciaDAO();
        $farmDAO->deletarFornecedor($_GET['id']);
        header("location:consulta-fornecedores.php");
      }//fecha if
  }else{//fecha if autenticação
      header('location:index.php');
  }//fecha else autenticação
      ?>
  </body>
</html>
