<?php
session_start();
ob_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Cadastro de Fornecedores</title>
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
    <h1 class="jumbotron bg-light">Cadastro de fornecedores</h1>


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
            
      <form name="cadforn" method="post" action="">
        <div class="form-group">
          <input type="text" name="txtnomeforn" placeholder="Nome do Fornecedor" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" name="txtemailforn" placeholder="E-Mail do fornecedor" class="form-control">
        </div>
        <div class="form-group">
          <input type="text"  name="txttelforn" placeholder="Telefone do fornecedor"  class="form-control">
        </div>

        <div class="form-group">
          <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
          <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
        </div>
      </form>


        <?php
        if(isset($_SESSION['msg'])){
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
        } ?>
        <?php
        if(isset($_POST['cadastrar'])){
          include_once "modelo/farmacia.class.php";
          include_once "dao/farmaciadao.class.php";
          include_once "modelo/fornecedores.class.php";
          include_once "util/padronizacao.class.php";
          include_once "util/validacao.class.php";

          $forn = new Fornecedores();
          $forn->nomeForn = Padronizacao::converterMaiMin($_POST['txtnomeforn']);
          $forn->emailForn = ($_POST['txtemailforn']);
          $forn->telForn = ($_POST['txttelforn']);


          $farmDAO = new FarmaciaDAO();
          $farmDAO->cadastrarFornecedor($forn);

          $_SESSION['msg']="Fornecedor cadastrado com sucesso!";

          $forn->__destruct();

          //echo "Livro cadastrado com sucesso!";
        //  echo $liv;
        header("location:cadastro-fornecedores.php");
        }
          ?>
      </div>
  </body>
</html>
