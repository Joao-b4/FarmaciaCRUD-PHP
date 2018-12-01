<?php
//require
require_once "config/conexaobanco.class.php";

class UsuarioDAO{
    private $conexao = null;

    public function __construct(){
      $this->conexao = ConexaoBanco::getInstance();
    }
    public function __destruct(){}

    public function cadastrarUsuario($u){
        try{
            $stat = $this->conexao->prepare('insert into user(id,username,pass)values(default,?,?)');
            $stat->bindValue(1,$u->username);
            $stat->bindValue(2,$u->pass);
            $stat->execute();
            $this->conexao = null;
        }catch(PDOException $err){
            echo "Erro ao cadastrar!</br>".$err;
        }//fecha catch
    }//fecha cadUser

    public function buscarUsuario(){
        try{
            $stat = $this->conexao->query("select * from user");
            $array = $stat->fetchAll(PDO::FETCH_CLASS,'Usuario');
            return $array;
        } catch (PDOException $err) {
            echo 'Erro ao buscar usuários!'.$err;
        }//fecha catch
    }//fecha buscarUsuarios

    public function deletarUsuario($username){
        try {
            $stat = $this->conexao->prepare(
            "delete from user where username = ?");
            $stat->bindValue(1, $username);
            $stat->execute();
        } catch (PDOException $err) {
            echo 'Erro ao deletar! '.$err;
        }//fecha catch
    }//fecha deletarUsuario

    public function filtrarUsuario($query){
        try {
            $stat = $this->conexao->query("select * from user ".$query);
            $array = $stat->fetchAll(PDO::FETCH_CLASS,'Usuario');
            return $array;
        } catch (PDOException $err) {
            echo 'Erro ao filtrar! '.$err;
        }//fecha catch
    }//fecha filtrarUser

    public function verificarUsuario($u){
        try{
            $stat = $this->conexao->query("select * from user where username='$u->username'and pass='$u->pass'");
            $usuario = null;
            $usuario = $stat->fetchObject('Usuario');
            return $usuario;
        }catch(PDOException $err){
            echo"erro ao verificar!".$err;
        }//fecha catch
    }//fecha verificarUsuario

    public function verificaCad($query){
        try {
            $stat = $this->conexao->query("select * from user where username='$query'");
            $array = $stat->fetchAll(PDO::FETCH_CLASS,'Usuario');
            return $array;
        } catch (PDOException $err) {
            echo 'Erro ao filtrar! '.$err;
        }//fecha Catch
    }//fecha testarCad

    public function alterarUsuario($u){
      try{
        $stat = $this->conexao->prepare("update user set username=?, pass=? where username=?");
        $stat->bindValue(1, $u->username);
        $stat->bindValue(2, $u->pass);
        $stat->bindValue(3, $u->usernameOld);
        $stat->execute();
      }catch(PDOException $e){
        echo "Erro ao alterar usuario! ".$e;
      }//fecha catch
    }//fecha alterar

}//fecha classe
?>
