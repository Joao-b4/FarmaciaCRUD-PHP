<?php
session_start();
ob_start();
include_once 'modelo/usuario.class.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Consulta de produtos</title>
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

<?php
if(isset($_SESSION['privateUser'])){  $log = unserialize($_SESSION['privateUser']);?>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<?php } ?>
        </nav>

    <div class="section mx-auto shadow-lg text-capitalize container">
        <div class=" mx-auto">
        <?php
            if(isset($_SESSION['privateUser'])){
                include_once 'modelo/usuario.class.php';
                $log = unserialize($_SESSION['privateUser']);
                echo "<h1>Bem Vindo $log->username!</h1>";
            ?>
            <form name="deslogar" action="" class="mx-auto form-group" method="post">
                <div class="form-group form-inline">
                <input type="submit" name="deslogar" class="mt-3 mx-auto btn btn-md btn-danger form-control" value="Deslogar">
                </div>
            </form>
            <?php
                if(isset($_POST['deslogar'])){
                    unset($_SESSION['privateUser']);
                    header("location:index.php");
                }
            } else {
            ?>
            <h1>Login</h1>
            <form name="log" class="form-group" method="post" action="">
              <label class="sr-only" for="inlineFormInputGroup">Username</label>
              <div class='input-group mb-1'>
                  <div class='input-group-prepend'>
                      <div class='input-group-text'>@</div>
                  </div>
                  <input class="form-control" pattern="^[a-zA-ZÁ-ù0-9]{2,50}$" name="username" required="required" id="inlineFormInputGroup" placeholder="Username"
                   type="text"></input>
              </div>
              <label class="sr-only" for="inlineFormInputGroup">Password</label>
              <div class='input-group mb-4'>
                  <div class='input-group-prepend'>
                      <div class='input-group-text'>#</div>
                  </div>
                  <input name="pass" pattern"^[a-zA-ZÁ-ù0-9]{2,50}$" required="required" class="form-control" id="inlineFormInputGroup" required="required" placeholder="Password"
                   type="password"></input>
              </div>
              <input type="submit" name="logar" value="logar" class="btn btn-outline-success">
              </form>


        </div>
        <br><br><br><br>
    </div>

  </body>
</html>
<?php
if(isset($_POST['logar'])){
    include_once 'modelo/usuario.class.php';
    include 'dao/usuariodao.class.php';
    include 'util/crypto.class.php';
    include 'util/padronizacao.class.php';
    include 'util/validacao.class.php';

    //entrada
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    //valida
    $err = array();

    if(!Validacao::validarUsername($username)){
        $err[] = "Erro no Login!";
    }
    if(!Validacao::validarPass($pass)) {
        $err[] = "Erro no Login!";
    }

    if(count($err) != 0){ //inicio validacao
        echo"<span class='alert-danger'>Erro no Login!</span>";
        return 0;
    }else{
        //padronizacao
        $username = padronizacao::padronizarSeguraMaiMin($username);
        $pass = Seguranca::criptografar(padronizacao::converterMaiMin($pass));

        //Modelo
        $u = new Usuario();
        $u->username = $username;
        $u->pass = $pass;

        //DAO
        $uDAO = new usuarioDAO();
        $usuario = $uDAO->verificarUsuario($u);

        if($usuario && !is_null($usuario)){
            var_dump($usuario);
            $_SESSION['privateUser'] = serialize($usuario);
            header("location:index.php");
        }else{
            //não existe usuario;
            echo "<span class='alert-danger'>Usuario inexistente!</span>";
        }//fecha else
        unset($_POST['logar']);
    }//fim validacao

}//fecha post logar

}//fecha session nao existente

 ?>
