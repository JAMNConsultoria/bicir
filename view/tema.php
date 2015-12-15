<?php
require_once("../business/tema_business_class.php");
?>
<script language="javascript">
function listaIndics(ind) {
	var ds = document.getElementById(ind).style;
	if (ds.display == '') {
		ds.display = 'none';
	} else {
		ds.display = '';
	}
}
function SelAll(it) {
	var status = it.checked;
	var p = it.parentNode;
	for (i=0;i < p.childNodes.length;i++) {
		if (p.childNodes[i].nodeName == "INPUT") {
			p.childNodes[i].checked = status;
		}
	}
}

function checkForm2(form) {
	var arrFld = new Array('indicadors[]');

	if(!validationForm(form, arrFld)) {
		return false;
	}
	return true;
}

</script>
 
  <form action="localidade.php" method="post" id="frmIndicadores" name="frmIndicadores" onsubmit="return checkForm2(this)">
<?php

  $oBTema = new TemaBusiness();
  $temas = $oBTema->loadGrupoTemaIndicador($idGrupo);
  if(isset($_SESSION['indicadores'])){
    $arrTemas=$oBTema->findTemaIdByArrIndicsAndGrupoId($_SESSION['indicadores'], $_SESSION['grupo']);
  }else{
    $arrTemas=array();
  }


  foreach ($temas as $key => $tema) {
	  if (count($tema->getIndicadors()) > 0) {
        echo "<br/><a href=\"javascript:listaIndics('ind_{$tema->getTemaId()}');\"><img src=\"img/mais.png\" border=\"0\"></a> {$tema->getTemaNome()}\n";
        echo "<div style=\"display:{(in_array($tema->getTemaId(), $arrTemas)? '' : 'none')}; margin-left:22px;\" id=\"ind_{$tema->getTemaId()}\" class=\"div1\">";
        echo "<input type=\"checkbox\" onClick=\"SelAll(this)\"> <i>Selecionar todos os indicadores deste n&iacute;vel</i><br>\n";
        foreach ($tema->getIndicadors() as $key2 => $indicador) {
            if(isset($_SESSION['indicadores'])){
                $checked=(in_array($indicador->getIndicadorId(), $_SESSION['indicadores'])?'checked':'');
            }else{
                $checked=""; 
            }

            echo "<input type=\"checkbox\" name=\"indicadors[]\" {$checked} value=\"{$indicador->getIndicadorId()}\">&nbsp;{$indicador->getIndicadorNome()}<br/>\n";
        }
        echo "</div>";
	  }
  }		
?>
</form>