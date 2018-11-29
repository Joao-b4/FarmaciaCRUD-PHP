<?php
class Validacao{

  public static function validarTitulo($v){
    $exp = "/^[a-zA-ZÁ-ù0-9 ]{2,100}$/";
    return preg_match($exp,$v);
  }

  public static function validarEmail($v){
    return filter_var(FILTER_VALIDATE_EMAIL,$v);
  }

  public static function validarEditora($v){
    $exp = "/^[a-zA-ZÁ-ù0-9 ]{2,100}$/";
    return preg_match($exp,$v);
  }

}
