<?php header('Content-Type: text/html; charset=iso-8859-1'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8;charset=iso-8859-1;" />
        <title>Base de Indicadores das Comissões Intergestores Regionais</title>
        <script src="js/validation.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">

        function checkForm(form) {
            var arrFld = new Array('tipo');

            if(!validationForm(form, arrFld)) {
            	return false;
            }
            return true;
        }
        
        $(document).ready(function()     {
            //submete formulario de grupo
            $('form:first').click(function() {
                $('#frmGrupo').submit();
            });
            //submete formulario botao Prosseguir>>>
            $('#btnEnviar').click(function() {
				if(jQuery("input:checkbox=:checked").length == 0) {
					alert("Por favor, selecione algum indicador.");
					return;
				}
                $('#frmIndicadores').submit();
            });
        }); //fim ready
    </script>

<link rel="stylesheet" href="css/fm_ms.css" type="text/css" />

</head>

<body>
    
<div id="barra-brasil-v3">
<span>
  <div class="imagemGov">
  	<a href="http://www.brasil.gov.br" target="_blank" class="brasilgov"></a>
  </div>
  <div class="imagemAi">
  	<a href="http://www.cgu.gov.br/acessoainformacaogov/" target="_blank" class="acessoainformacaogov"></a>
  </div>
</span>
</div>

    
<div align="center" class="center">
	<div id="wrapper">      
    
    	<div id="fios">
  
            <div id="cabecalho"><img src="img/titulo.gif" /></div>
            <div id="topo">
                <div id="top_dir"></div>
                <div id="top_esq"></div>
            </div>