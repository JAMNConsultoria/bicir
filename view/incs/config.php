<?php
/*
 * define os labels da tabela resumo
 */
$labels=array(
    0=>'N�mero de CIR',
    1=>'% no total de CIR',
    2=>'N�mero de Munic�pios',
    3=>'% no total de munic�pios',
    4=>'Popula��o (proje��o 2011)',
    5=>'% no total da popula��o',
    6=>'M�dia de munic�pios por CIR',
    7=>'M�dia da popula��o por munic�pio',
    8=>'Benefici�rios de plano de sa�de na popula��o (em %)',
    9=>'Popula��o cadastrada na ESF (em %)',
    10=>'M�dicos por mil habitantes',
    11=>'M�dicos SUS no total de m�dicos (em %)',
    12=>'Leitos por mil habitantes',
    13=>'Leitos SUS no totoal de leitos (em %)');
/*
 * define a formata��o para cada vari�veis
 */
$arredondar[0] =0;
$arredondar[1] =1;
$arredondar[2] =0;
$arredondar[3] =1;
$arredondar[4] =0;
$arredondar[5] =1;
$arredondar[6] =0;
$arredondar[7] =0;
$arredondar[8] =1;
$arredondar[9] =1;
$arredondar[10] =2;
$arredondar[11] =1;
$arredondar[12] =1;
$arredondar[13] =1;


/*
 * Estrutura para Mapas - legendas, cores
 * 
 */
$arrMapa['mapa']['grupo_socio']['titulo'] = "Distribui��o das CIR segundo os Cinco Grupos Socioecon�micos";
$arrMapa['mapa']['grupo_socio']['corGrupo']=array(1=>"#0209f3",2=>"#00fdfe",3=>"#bff715",4=>"#fbfdc6",5=>"#fd7b00");
$arrMapa['mapa']['grupo_socio']['legenda']=array(1=>"Grupo 1",2=>"Grupo 2",3=>"Grupo 3",4=>"Grupo 4",5=>"Grupo 5");
$arrMapa['mapa']['grupo_socio']['descricao']=array(1=>"baixo desenvolvimento socioecon�mico e baixa oferta de servi�os",2=>"m�dio/alto desenvolvimento socioecon�mico e baixa oferta de servi�os",3=>"m�dio desenvolvimento socioecon�mico e m�dia oferta de servi�os",4=>"alto desenvolvimento socioecon�mico e m�dia oferta de servi�os",5=>"alto desenvolvimento socioecon�mico e alta oferta de servi�os");


$arrMapa['mapa']['grupo_prestador']['titulo'] = "Distribui��o das CIR segundo os Perfis de Prestador SUS";
$arrMapa['mapa']['grupo_prestador']['corGrupo']=array(0=>"#ffffff",1=>"#808080",2=>"#ff9b36",3=>"#ffc000");
$arrMapa['mapa']['grupo_prestador']['legenda']=array(0=>"Divis�o n�o dispon�vel",1=>"Predominantemente p�blico",2=>"Predominantemente privado",3=>"Situa��o intermedi�rio");
$arrMapa['mapa']['grupo_prestador']['descricao']=array(0=>"Divis�o n�o dispon�vel",1=>"presen�a expressiva do prestador p�blico",2=>"presen�a expressiva do prestado privado no SUS",3=>"perfil intermedi�rio entre os dois anteriores");

//perfil prestadores do grupo socio 1
$arrMapa['mapa']['grupo_socio_prestador_1']['titulo'] = "Distribui��o das CIR  do  grupo socioecon�mico 1, segundo perfil do prestador do SUS";
$arrMapa['mapa']['grupo_socio_prestador_1']['corGrupo']=array(0=>"#ffffff",1=>"#808080",2=>"#ff9b36",3=>"#ffc000");
$arrMapa['mapa']['grupo_socio_prestador_1']['legenda']=array(0=>"N�o se aplica",1=>"Predominantemente p�blico",2=>"Predominantemente privado",3=>"Situa��o intermedi�rio");
$arrMapa['mapa']['grupo_socio_prestador_1']['descricao']=array(0=>"N�o se aplica",1=>"presen�a expressiva do prestador p�blico",2=>"presen�a expressiva do prestado privado no SUS",3=>"perfil intermedi�rio entre os dois anteriores");

//perfil prestadores do grupo socio 2
$arrMapa['mapa']['grupo_socio_prestador_2']['titulo'] = "Distribui��o das CIR  do  grupo socioecon�mico 2, segundo perfil do prestador do SUS";
$arrMapa['mapa']['grupo_socio_prestador_2']['corGrupo']=array(0=>"#ffffff",1=>"#808080",2=>"#ff9b36",3=>"#ffc000");
$arrMapa['mapa']['grupo_socio_prestador_2']['legenda']=array(0=>"N�o se aplica",1=>"Predominantemente p�blico",2=>"Predominantemente privado",3=>"Situa��o intermedi�rio");
$arrMapa['mapa']['grupo_socio_prestador_2']['descricao']=array(0=>"N�o se aplica",1=>"presen�a expressiva do prestador p�blico",2=>"presen�a expressiva do prestado privado no SUS",3=>"perfil intermedi�rio entre os dois anteriores");

//perfil prestadores do grupo socio 3
$arrMapa['mapa']['grupo_socio_prestador_3']['titulo'] = "Distribui��o das CIR  do  grupo socioecon�mico 3, segundo perfil do prestador do SUS";
$arrMapa['mapa']['grupo_socio_prestador_3']['corGrupo']=array(0=>"#ffffff",1=>"#808080",2=>"#ff9b36",3=>"#ffc000");
$arrMapa['mapa']['grupo_socio_prestador_3']['legenda']=array(0=>"N�o se aplica",1=>"Predominantemente p�blico",2=>"Predominantemente privado",3=>"Situa��o intermedi�rio");
$arrMapa['mapa']['grupo_socio_prestador_3']['descricao']=array(0=>"N�o se aplica",1=>"presen�a expressiva do prestador p�blico",2=>"presen�a expressiva do prestado privado no SUS",3=>"perfil intermedi�rio entre os dois anteriores");

//perfil prestadores do grupo socio 4
$arrMapa['mapa']['grupo_socio_prestador_4']['titulo'] = "Distribui��o das CIR  do  grupo socioecon�mico 4, segundo perfil do prestador do SUS";
$arrMapa['mapa']['grupo_socio_prestador_4']['corGrupo']=array(0=>"#ffffff",1=>"#808080",2=>"#ff9b36",3=>"#ffc000");
$arrMapa['mapa']['grupo_socio_prestador_4']['legenda']=array(0=>"N�o se aplica",1=>"Predominantemente p�blico",2=>"Predominantemente privado",3=>"Situa��o intermedi�rio");
$arrMapa['mapa']['grupo_socio_prestador_4']['descricao']=array(0=>"N�o se aplica",1=>"presen�a expressiva do prestador p�blico",2=>"presen�a expressiva do prestado privado no SUS",3=>"perfil intermedi�rio entre os dois anteriores");

//perfil prestadores do grupo socio 5
$arrMapa['mapa']['grupo_socio_prestador_5']['titulo'] = "Distribui��o das CIR  do  grupo socioecon�mico 5, segundo perfil do prestador do SUS";
$arrMapa['mapa']['grupo_socio_prestador_5']['corGrupo']=array(0=>"#ffffff",1=>"#808080",2=>"#ff9b36",3=>"#ffc000");
$arrMapa['mapa']['grupo_socio_prestador_5']['legenda']=array(0=>"N�o se aplica",1=>"Predominantemente p�blico",2=>"Predominantemente privado",3=>"Situa��o intermedi�rio");
$arrMapa['mapa']['grupo_socio_prestador_5']['descricao']=array(0=>"N�o se aplica",1=>"presen�a expressiva do prestador p�blico",2=>"presen�a expressiva do prestado privado no SUS",3=>"perfil intermedi�rio entre os dois anteriores");

?>


