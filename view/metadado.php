<?php
  header('Content-Type: text/html; charset=iso-8859-1');
  require_once("../business/grupo_business_class.php");
  require_once("../business/indicador_business_class.php");
  
  $idIndicador = $_GET['ind'];
  $oBIndicador = new IndicadorBusiness();
  $indicador = $oBIndicador->findIndicadorById($idIndicador);
  
  echo "<b>{$indicador->getIndicadorNome()}</b>";
?>