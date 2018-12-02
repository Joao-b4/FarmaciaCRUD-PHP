<?php
class Seguranca{

  public static function criptografar($v){
    return md5('Salt'.$v.'Joao');
  }//fecha criptografar

}//fecha classe
