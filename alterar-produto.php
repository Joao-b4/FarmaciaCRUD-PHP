<?php
session_start();
ob_start(); //buffer do PHP
include_once 'modelo/usuario.class.php';
if(isset($_SESSION['privateUser'])){  $log = unserialize($_SESSION['privateUser']);

if(isset($_GET['id'])){
    include_once "dao/farmaciadao.class.php";
    include_once "modelo/farmacia.class.php";

    $farmDAO = new FarmaciaDAO();
    $array = $farmDAO->filtrarProduto("idprod", $_GET['id']);
    //var_dump($array);
    $prod = $array[0];
    //echo $liv;
    //só para teste....
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alteração de Produtos</title>
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


        <form name="cadprod" method="post" action="" class="formC">
          <div class="form-group">
            <input type="text" name="txtnomeprod"  pattern="^[a-zA-ZÁ-ù0-9 ]{2,50}$" placeholder="Nome do produto" class="form-control" value="<?php if(isset($prod)){ echo $prod->nomeProd; } ?>">
          </div>
          <div class="form-group">
            <input type="number" min="0"  pattern="^[.0-9 ]{2,10}$" name="numberpreco" placeholder="Preço" step="0.01" class="form-control"  value="<?php if(isset($prod)){ echo $prod->precoProd; } ?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtfabricante"  pattern="^[a-zA-ZÁ-ù0-9 ]{2,50}$" placeholder="Fabricante" class="form-control" value="<?php if(isset($prod)){ echo $prod->fabricante; } ?>">
          </div>
          <div class="form-group">
            <input type="text" name="txttipoprod"  pattern="^[a-zA-ZÁ-ù0-9 ]{2,50}$" placeholder="Tipo de Produto" class="form-control" value="<?php if(isset($prod)){ echo $prod->tipoProd; } ?>">
          </div>
          <h5>Data de Fabricação</h5>
          <div class="form-group">
            <input type="date" name="txtdatafabri" pattern="^[0-9\/-]{1,10}$" placeholder="Data de Fabricação" class="form-control" value="<?php if(isset($prod)){ echo $prod->dataFabri; } ?>">
          </div>
          <h5>Data de Validade</h5>
          <div class="form-group">
            <input type="date" name="txtdatavali" pattern="^[0-9\/-]{1,10}$" placeholder="Data de Validade" class="form-control" value="<?php if(isset($prod)){ echo $prod->dataVali; } ?>">
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
          include_once "modelo/farmacia.class.php";
          include_once "dao/farmaciadao.class.php";
          include_once "util/padronizacao.class.php";
          include_once "util/validacao.class.php";

          //entrada
          $idProd =     $_GET['id'];
          $nomeProd =   ($_POST['txtnomeprod']);
          $precoProd =  ($_POST['numberpreco']);
          $fabricante = ($_POST['txtfabricante']);
          $tipoProd =   ($_POST['txttipoprod']);
          $dataFabri =  ($_POST['txtdatafabri']);
          $dataVali =    ($_POST['txtdatavali']);

          $err = array();

          if(!Validacao::validarID($idProd)){
              $err[] = "<span class='alert alert-danger'>Erro no ID</span>";
          }
          if(!Validacao::validarName($nomeProd)){
              $err[] = "<span class='alert alert-danger'>Erro no Produto</span>";
          }
          if(!Validacao::validarPreco($precoProd)) {
              $err[] = "<span class='alert alert-danger'>Erro no Preço</span>";
          }
          if(!Validacao::validarName($fabricante)) {
              $err[] = "<span class='alert alert-danger'>Erro no Fabricante!</span>";
          }
          if(!Validacao::validarName($tipoProd)) {
              $err[] = "<span class='alert alert-danger'>Erro no Tipo!</span>";
          }
          if(!Validacao::validarData($dataFabri)) {
              $err[] = "<span class='alert alert-danger'>Erro na Fabricação! </span>";
          }
          if(!Validacao::validarData($dataVali)) {
              $err[] = "<span class='alert alert-danger'>Erro na Validade!</span>";
          }

          if(count($err) != 0){ //valida
              foreach($err as $e){
                  echo $e."<br><br>";
              }
              return 0;
          }else{

        //modelo
          $prod = new Farmacia();
          $prod->idProd = $idProd;
          $prod->nomeProd = $nomeProd;
          $prod->precoProd = $precoProd;
          $prod->fabricante = $fabricante;
          $prod->tipoProd = $tipoProd;
          $prod->dataFabri = $dataFabri;
          $prod->dataVali = $dataVali;

          //banco
          $farmDAO = new FarmaciaDAO();
          $farmDAO->alterarProduto($prod);

          echo "<br> <span class='alert alert-info'>Produto Alterado com sucesso!</span> <br>";
          $prod->__destruct();

          header("location:consulta-farmacia.php");
      }//fecha validar
  }//fecha alterar
    }else{//fecha if autenticação
header('location:index.php');
}//fecha else autenticação
        ?>
      </div>
  </body>
</html>
