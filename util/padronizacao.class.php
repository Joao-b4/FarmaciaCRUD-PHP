<?php
class Padronizacao{

  public static function converterMaiMin($v):string{
    return ucwords(strtolower($v));
  }

  public static function antiXSS($v):string{
    return htmlspecialchars($v);
  }
  public static function converterData($v){
    echo date("d/m/Y", strtotime($v));
  }
}
?>
