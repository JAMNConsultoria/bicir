<?php
//recebe cod uf
if(isset($_REQUEST['uf'])){
    $uf=$_REQUEST['uf'];
}else{
    $uf=0;//Brasil
}
//nivel 1=uf - 2=cir 3= municipio
if(isset($_REQUEST['nivel'])){
    $nivel=$_REQUEST['nivel'];
}else{
    $nivel=2;//Brasil
}
//indicador do mapa ex. grupo_socio etc
if(isset($_REQUEST['indicador'])){
    $indMap=$_REQUEST['indicador'];
}else{
    $indMap='grupo_socio';//Grupos Socioeconomicos
}

header('Content-Type: text/html; charset=iso-8859-1');
require_once("../business/localidade_business_class.php");
$oLdao = new LocalidadeBusiness();  
echo $oLdao->geraMapaGeoJSon($nivel,$uf,$indMap);
?>