<?php
session_start();
ob_start(); //buffer do PHP

    include_once "dao/usuariodao.class.php";
    include_once 'modelo/usuario.class.php';
    $log = unserialize($_SESSION['privateUser']);

    if(isset($_SESSION['privateUser'])){  $log = unserialize($_SESSION['privateUser']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alteração de Usuario</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="./vendor/css/master.css">

  <script language="Javascript">
  function funcao(){
       var resposta = confirm("Deseja remover esse registro?");

       if (resposta == true) {
            window.location.href = "config-user.php?deletar=1&name=" + '<?php echo $log->username; ?>';
       }
  }
  </script>

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

        <form name="altUser" method="post" action="">
          <div class="form-group">
            <input type="text" name="username" placeholder="username" class="form-control" value="<?php if(isset($_SESSION['privateUser'])){ echo $log->username; } ?>">

          <div class="form-group mt-3">
            <input type="text" name="pass" placeholder="senha" class="form-control" value="">
          </div>


          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary shadow-lg"> <br>
            <a onclick="funcao();" href="javascript::funcao()" type="text" class="btn btn-danger mt-2 shadow-lg">Deletar Conta</a>
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
            //include
          include_once "modelo/usuario.class.php";
          include_once "dao/usuariodao.class.php";
          include_once "util/padronizacao.class.php";
          include "util/validacao.class.php";
          include "util/crypto.class.php";

          //entradas
          $usernameOld = $_GET['name'];
          $username = $_POST['username'];
          $pass = $_POST['pass'];

          //validacao
          $err = array();

          if(!Validacao::validarUsername($username)){
              $err[] = "Erro!";
          }
          if(!Validacao::validarUsername($usernameOld)){
              $err[] = "Erro!";
          }
          if(!Validacao::validarPass($pass)) {
              $err[] = "Erro!";
          }

          if(count($err) != 0){ //valida
              echo"<span class='alert-danger'>Erro! Verifique os valores.</span>";
              return 0;
          }else{
             //padronizacao
             $username = padronizacao::padronizarSeguraMaiMin($username);
             $pass = Seguranca::criptografar(padronizacao::converterMaiMin($pass));

             //modelo
          $forn = new Usuario();
          $forn->username = $username;
          $forn->pass = $pass;
          $forn->usernameOld = $usernameOld;

          $uDAO = new UsuarioDAO();
          //Banco pesquisa
          $uDAO = new UsuarioDAO();

          $query = "";
          $query = $forn->username;
          $array = $uDAO->verificaCad($query);

          //alterar
          if(count($array) == 0){
              $uDAO->alterarUsuario($forn);
              echo "<span class='alert-success mx-auto infos'>Sucesso!</span>";
              unset($array);
              unset($_SESSION['privateUser']);
              header("location:index.php");
          }else{
              echo "<span class='alert-info mx-auto infos'>Usuario ja cadastrado!</span>";
          }//fecha else
          $forn->__destruct();

         // header("location:consulta-fornecedores.php");
      }//fim valida
  }//fim post alterar
  if(isset($_GET['deletar'])){
    include_once "util/validacao.class.php";
    $farmDAO = new UsuarioDAO();
    $delUser = $_GET['name'];
    if(!Validacao::validarUsername($delUser)){
        echo "Erro!";
    }else{
        if($delUser == $log->username){
            $farmDAO->deletarUsuario($delUser);
            //unset($_SESSION['privateUser']);
            //header("location:index.php");
        }else{
            echo "Invalido.";
        }
    }//Fecha else valida
  }//fecha if
}else{ //fecha if valida
    header("location:index.php");
}//fecha else valida
        ?>
      </div>
  </body>
</html>
