<?php
session_start();
ob_start();

include_once "dao/farmaciadao.class.php";
include_once "modelo/funcionarios.class.php";

$farmDAO = new FarmaciaDAO();
$array = $farmDAO->buscarFuncionarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Consulta de funcionários</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./vendor/css/master.css">
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-light">Consulta de funcionários</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="./index.php">Home</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
          </div>
        </nav>

        <h1>Sistema para gerenciamento de funcionários</h1>
        <h2>Consulta de funcionários</h2>
        <?php

        if(isset($array)){
          if(count($array)==0){
            echo "<h3>Não há Funcionários cadastrados!</h3>";
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
                <option value="idfunc">ID do Funcionário</option>
                <option value="nomefunc">Nome do Funcionário</option>
                <option value="rgfunc">RG do Funcionário</option>
                <option value="funcaofunc">Função do Funcionário</option>
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
          $array = $farmDAO->filtrarFuncionario($filtro, $pesquisa);
          if(count($array) == 0){
            echo "<h2>Sua pesquisa não retornou nenhum funcionário!</h2>";
            return;
          }//fecha if
        }//fecha if
        ?>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th>Alterar</th>
                <th>Excluir</th>
                <th>ID do Funcionário</th>
                <th>Nome do Funcionário</th>
                <th>Endereço do Funcionário</th>
                <th>RG do Funcionário</th>
                <th>Entrada do Funcionário</th>
                <th>Função(Cargo) do Funcionário</th>
                <th>E-Mail do Funcionário</th>
              </tr>
            </thead>

            <tfoot>
              <th>Alterar</th>
              <th>Excluir</th>
              <th>ID do Funcionário</th>
              <th>Nome do Funcionário</th>
              <th>Endereço do Funcionário</th>
              <th>RG do Funcionário</th>
              <th>Entrada do Funcionário</th>
              <th>Função(Cargo) do Funcionário</th>
              <th>E-Mail do Funcionário</th>
            </tfoot>

            <tbody>
              <?php
                  foreach($array as $func){
                    echo "<tr>";
                      echo "<td><a href='alterar-funcionarios.php?id=$func->idFunc 'class='btn btn-warning'>Alterar</a></td>";
                      echo "<td><a href='consulta-funcionarios.php?id=$func->idFunc 'class='btn btn-danger'>Excluir</a></td>";
                      echo "<td>$func->idFunc</td>";
                      echo "<td>$func->nomeFunc</td>";
                      echo "<td>$func->enderecoFunc</td>";
                      echo "<td>$func->rgFunc</td>";
                      echo "<td>$func->entradaFunc</td>";
                      echo "<td>$func->funcaoFunc</td>";
                      echo "<td>$func->emailFunc</td>";
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
        $farmDAO->deletarFuncionario($_GET['id']);
        header("location:consulta-funcionarios.php");
      }//fecha if
      ?>
  </body>
</html>
