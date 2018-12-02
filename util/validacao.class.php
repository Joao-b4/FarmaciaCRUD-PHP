<?php
class Validacao{

  public static function validarUsername($v){
    $exp = "/^[a-zA-ZÁ-ù0-9]{2,50}$/";
    return preg_match($exp,$v);
  }
  public static function validarName($v){
    $exp = "/^[a-zA-ZÁ-ù0-9 ]{2,50}$/";
    return preg_match($exp,$v);
  }

  public static function validarPass($v){
    $exp = "/^[a-zA-ZÁ-ù0-9]{2,100}$/";
    return preg_match($exp,$v);
  }

  public static function validarID($v){
    $exp = "/^[0-9]{1,5}$/";
    return preg_match($exp,$v);
  }

  public static function validarPreco($v){
    $exp = "/^[.0-9 ]{2,10}$/";
    return preg_match($exp,$v);
  }

  public static function validarEmail($v){
     $exp =  "/^([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+$/";
     return preg_match($exp,$v);
  }
  public static function validarData($v) {
      $exp = "/^[0-9\/-]{1,10}$/";
      return preg_match($exp, $v);
  }

  public static function validarRg($v) {
      $exp = "/^[0-9]{6,15}$/";
      return preg_match($exp, $v);
  }

  public static function validarTelefone($v) {
      $exp = "/^\(?\d{2}\)?[\s-]?\d{4}-?\d{4}$/";
      return preg_match($exp, $v);
  }

}
