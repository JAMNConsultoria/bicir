<?php 
session_start();
/*
 * armazena os dados da UF na sessão para poupar conexões com o BD
 */
if(!isset($_SESSION['ufs'])){
    require_once("../business/localidade_business_class.php");
    $oBuf = new LocalidadeBusiness();
    $arrUF = $oBuf->findAllUf();
    $_SESSION['ufs'] = $arrUF;
}
$arrUFs=$_SESSION['ufs'];
//indicador
if(isset($_REQUEST['indicador'])){
    $indicador=$_REQUEST['indicador'];    
}else{
    $indicador="grupo_socio";//Brasil
}
//uf
if(isset($_REQUEST['uf'])){
    $uf=$_REQUEST['uf'];    
}else{
    $uf=0;//Brasil
}
require_once("incs/cabecalho.php"); 
require_once("incs/config.php"); 
?>            
<script>
    $(document).ready(function() {         
        var coduf=<?php echo $uf;?>;
        var indicador="<?php echo $indicador;?>";
        //$("#divInfMapa").html("");
        //seleção da UF
        $('#lstUF').change(function(){            
           coduf = $(this).val();
           var linkMapTemat = "mapas.php?uf="+coduf+"&indicador="+indicador;           
           window.location=linkMapTemat;        
        });
        //seleção do mapa
        $('#mapagrp').change(function(){            
           indicador = $(this).val();
           var linkMapTemat = "mapas.php?uf="+coduf+"&indicador="+indicador;           
           window.location=linkMapTemat;        
        });        
    });        
</script>

<div id="conteudo">
    <div id="menu">
        <a href="index.php" class="menu">Apresenta&ccedil;&atilde;o</a><br />
        <div id="menu_active">Mapas</div>
        <a href="indicadores.php?clrSession=true" class="menu3">Indicadores<br />por Tema</a><br />
        <a href="metodologia.php" target="_blank" class="menu">Metodologia</a><br />
        <a href="ficha.php" class="menu">Ficha T&eacute;cnica</a><br />
    </div>               
   <div id="corpo" style="text-align:center;"><br /><br />
        <div id="divgrupo" class="styled-select">            
        Mapas: <select name="indicador" id="mapagrp">            
            <?php
               foreach($arrMapa as $indice => $mapas){                   
                   foreach($mapas as $grp => $campos){
                       $selected = ($grp==$indicador?"selected":"");
                       echo "<option value=\"{$grp}\" {$selected}>{$campos['titulo']}</option>";
                   }
               }
            ?>
        </select>
        </div>        
        <div id="menuUF">            
             <h3>Selecione a Localidade</h3>
              <select name="lstUf" id="lstUF" class="lstUF">           
             <?php
              foreach($arrUFs as $arrCampos){
                  $ufsel = ($arrCampos['ufId']==$uf ? ' selected':'');
                 echo "<option {$ufsel} value=\"{$arrCampos['ufId']}\" >{$arrCampos['ufNome']} - {$arrCampos['ufSigla']} </option>";
              }   
             ?>
             </select>
        </div>
        <div id="divInfMapa" style="border: 2px dashed #808080">
            <div id="tituloInfo">Área para informações</div>
            <div id="divInfLoc"></div>
            <div id="informacoes"></div>
        </div>  
        <?php require_once("mapatematico.php")?> 
  </div>   
</div>
<?php include 'incs/rodape.php'; ?> 