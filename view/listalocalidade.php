<?php
header('Content-Type: text/html; charset=iso-8859-1');      ?>
<style type="text/css">
#divLoc {
margin: 5px;
/*border: 1px solid #bdbdbd;*/
height:186px;
overflow: auto;
}
#Localidades {
padding: 0;
margin: 10px;
font: 12px Verdana, sans-serif;
background: #efefef;
border-top: 3px solid #bdbdbd;
border-bottom: 3px solid #bdbdbd;
}
#Localidades li {
list-style: none;
margin: 0.5em 0 0.5em 0.2em;
}
#Localidades li a {
margin:0;
padding:0;
text-decoration:none;
color: #000;
}
#Localidades li a:visited {
color: #000;
}
#Localidades li a:hover {
text-decoration:underline;
}
</style>
<?php
      if (isset($_REQUEST['cirId'])){
                require_once("../business/localidade_business_class.php");
                $cirId = $_REQUEST['cirId'];
                $oLdao = new LocalidadeBusiness();
                $arrLocalidades = $oLdao->findLocsByCirId($cirId);               
                echo "<p style='text-align:right;margin-right:10px;border-bottom:1px solid #000'>Municípios da CIR</p>";
		echo "<div id=\"divLoc\">";
                echo "<ul id='Localidades'>";
                foreach($arrLocalidades as $indice => $arrMun){
                    echo "<li style=\"font-size:11px;\">{$arrMun->getLocalidadeNome()}</li>";
                }
                echo "</ul></div>"; 

        }

?>