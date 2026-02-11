<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
  //ativo=021;
}?>
<?php
$relatorio_titulo="RELATÓRIO MANEJO DO ANIMAL v:3.2";
switch($_GET['converter']){
	
	case 'xls':
		$filename='relatorio_animal';
		header('Content-type: application/x-msdownload');
        header('Content-Disposition: attachment; filename='.$filename.'.xls');
        header('Pragma: no-cache');
        header('Expires: 0');
		$_GET['list_qtdd']='10000';
		$conv='2';
	break;
	case 'pri':
		$_GET['list_qtdd']='10000';
		$conv='2';
	break;
	
	default;
	$conv='1';
	
	}


?>
<?php require_once("../sistema_funcoes/seguranca_usuario.php"); ?>
<?php require_once('../Connections/connection.php'); ?>
<?php include("../sistema_funcoes/converte_datas.php"); ?>
<?php include "../sma_funcoes/calcular_idade.php"; ?>
<?php 
include "../sma_funcoes/converter_codigo_animal.php";
$_GET['cod_animal']=converte_cod_animal($_GET['cod_animal']);
?>


<?php 
############################### FILTRAR PESQUISA #############################
//------------------------------------------------->COD_ANIMAL
$sql_local= "'".$_SESSION['LOCAL']."' ";

//------------------------------------------------->COD_ANIMAL
if(!empty($_GET['cod_animal'])){
	$sql_cod_animal= " AND cod_animal='".$_GET['cod_animal']."'";
}else{ include("../sma_relatorios_leite/relatorios_manejo_animal_include_cod.php"); exit; }
//------------------------------------------------->IDADE
if(!empty($_GET['ativo'])){
 	$sql_ativo= " AND    ativo= ".$_GET['ativo']."  ";
}else{ $sql_ativo = " AND  ativo='1' "; $_GET['ativo']='1'; }

?>
<?php 
//------------------- lista a quantidade
$list_qtdd=$_GET['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd= '10';
}?>
<?php //echo $_GET['tipo_manejo'];
 if($_GET['tipo_manejo']==''){
		$list_tipo_manejo="";
		}else{
			$list_tipo_manejo=" AND tipo_manejo=".$_GET['tipo_manejo'];
		}?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_relatorio_list_acao = $list_qtdd;
$pageNum_relatorio_list_acao = 0;
if (isset($_GET['pageNum_relatorio_list_acao'])) {
  $pageNum_relatorio_list_acao = $_GET['pageNum_relatorio_list_acao'];
}
$startRow_relatorio_list_acao = $pageNum_relatorio_list_acao * $maxRows_relatorio_list_acao;

$colname_relatorio_list_acao = "-1";
if (isset($_GET['cod_animal'])) {
  $colname_relatorio_list_acao = $_GET['cod_animal'];
}
mysql_select_db($database_connection, $connection);
 $query_relatorio_list_acao = sprintf("SELECT * FROM vwnext_mod_sma_manejo_animais_cad_animais WHERE cod_animal = %s  ".$list_tipo_manejo." ORDER BY  `data` DESC", GetSQLValueString($colname_relatorio_list_acao, "text"));
$query_limit_relatorio_list_acao = sprintf("%s LIMIT %d, %d", $query_relatorio_list_acao, $startRow_relatorio_list_acao, $maxRows_relatorio_list_acao);
$relatorio_list_acao = mysql_query($query_limit_relatorio_list_acao, $connection) or die(mysql_error());
$row_relatorio_list_acao = mysql_fetch_assoc($relatorio_list_acao);

if (isset($_GET['totalRows_relatorio_list_acao'])) {
  $totalRows_relatorio_list_acao = $_GET['totalRows_relatorio_list_acao'];
} else {
  $all_relatorio_list_acao = mysql_query($query_relatorio_list_acao);
  $totalRows_relatorio_list_acao = mysql_num_rows($all_relatorio_list_acao);
}
$totalPages_relatorio_list_acao = ceil($totalRows_relatorio_list_acao/$maxRows_relatorio_list_acao)-1;

mysql_select_db($database_connection, $connection);
$query_list_tipo_manejo = "SELECT * FROM tbnext_mod_sma_manejo_tipo ORDER BY nome ASC";
$list_tipo_manejo = mysql_query($query_list_tipo_manejo, $connection) or die(mysql_error());
$row_list_tipo_manejo = mysql_fetch_assoc($list_tipo_manejo);
$totalRows_list_tipo_manejo = mysql_num_rows($list_tipo_manejo);

$queryString_relatorio_list_acao = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_relatorio_list_acao") == false && 
        stristr($param, "totalRows_relatorio_list_acao") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_relatorio_list_acao = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_relatorio_list_acao = sprintf("&totalRows_relatorio_list_acao=%d%s", $totalRows_relatorio_list_acao, $queryString_relatorio_list_acao);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $relatorio_titulo; ?></title>

<?php if($conv==1){ ?>
<link href="relatorios_estilo.css" rel="stylesheet" type="text/css" />
<?php }else{?>
<?php include('relatorios_estilo_imprimir.php');?>
<?php }?>


<script type="text/javascript"  src="../jquery/jquery-1.5.2.min.js"></script>
<script type="text/javascript"  src="../jquery/jquery_valida_form.js"></script>
<script type="text/javascript" src="../sistem_funcoes/carregandoDados.js"></script>
<script src="../sistema_funcoes/openWindow.js" type="text/javascript"></script>
<script src="../sistema_funcoes/goURL.js" type="text/javascript"></script>



</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="rel_table" >
  <tr>
    <td colspan="11" align="center" class="rel_informacoes"><?php if($conv==1){ ?>
    <form id="form1" name="form1" method="get" action="">
      
      <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td width="111" align="center" ><img width="84" height="42" src="../empresa_logo/logo_cabanha-126x64.png" /></td>
          <td width="347" ><div style="font-size:10px"><b><?php echo $relatorio_titulo; ?></b><br />
		  <?php echo $totalRows_relatorio_list_acao ?>&nbsp;Quantidade de manejo</div></td>
          <td width="347" > 
          <div title="EXPORTA XLS" id="divXls"  onclick="goToURL('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=xls&%d%s", $currentPage,$ordem , $queryString_1); ?>')">
        </div><div id="divHtml" onClick="MM_openBrWindow('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=pri&%d%s", $currentPage,$ordem , $queryString_1); ?>',
'','toolbar=no,location=no ,menubar=no, status=yes, scrollbars=yes,  resizable=yes, width=1024,height=768')"></div></td>
          <td width="347"  ><label for="cod_animal">Qtdd</label>
            <br />
            <select name="list_qtdd" class="form_pesquisa_input" id="list_qtdd">
              <option value="10" <?php if (!(strcmp(10, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>10</option>
              <option value="30" <?php if (!(strcmp(30, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>30</option>
              <option value="45" <?php if (!(strcmp(45, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>45</option>
              <option value="70" <?php if (!(strcmp(70, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>70</option>
              <option value="100" <?php if (!(strcmp(100, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>100</option>
              <option value="150" <?php if (!(strcmp(150, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>150</option>
              <option value="200" <?php if (!(strcmp(200, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>200</option>
              <option value="250" <?php if (!(strcmp(250, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>250</option>
              <option value="500" <?php if (!(strcmp(500, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>500</option>
              <option value="1000" <?php if (!(strcmp(1000, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>1000</option>
            </select></td>
          <td width="347" ><label for="tipo manejo">Tipo Manejo</label><br />
            <select name="tipo_manejo" class="form_pesquisa_input" id="tipo_manejo" style="width:90px;">
            <option value="" <?php if (!(strcmp("", $_GET['tipo_manejo']))) {echo "selected=\"selected\"";} ?>>Todos</option>
            <?php
do {  
?>
            <option value="<?php echo $row_list_tipo_manejo['tipo_manejo']?>"<?php if (!(strcmp($row_list_tipo_manejo['tipo_manejo'], $_GET['tipo_manejo']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_tipo_manejo['nome']?></option>
            <?php
} while ($row_list_tipo_manejo = mysql_fetch_assoc($list_tipo_manejo));
  $rows = mysql_num_rows($list_tipo_manejo);
  if($rows > 0) {
      mysql_data_seek($list_tipo_manejo, 0);
	  $row_list_tipo_manejo = mysql_fetch_assoc($list_tipo_manejo);
  }
?>
          </select></td>
          <td width="600">
            <label for="cod_animal"></label>
            <input  name="cod_animal" type="text" class="form_pesquisa_input" id="cod_animal" value="<?php echo $_GET['cod_animal']; ?>" size="38" />
            <input type="submit" name="botao" id="botao" value="Pesquisar por animal" /></td>
          </tr>
    </table>
      
    </form><?php }?></td>
  </tr>
  <tr class="rel_opcoes">
    <td width="5%" align="center">Qdd. </td>
    <td align="left" class="coluna_titulo">Sexo</td>
    <td align="left" class="coluna_titulo">&nbsp;COD</td>
    <td align="left" class="coluna_titulo">&nbsp;Animal</td>
    <td width="10%" align="center" class="coluna_titulo">Estatus</td>
    <td width="10%" align="center" class="coluna_titulo">&nbsp;Idade</td>
    <td align="left" class="coluna_titulo">&nbsp;Lote</td>
    <td align="left" class="coluna_titulo">&nbsp;Classificação</td>
    <td align="left" class="coluna_titulo">&nbsp;Raça</td>
    <td align="left" class="coluna_titulo">&nbsp;Parceiro</td>
    <td align="left" class="coluna_titulo">&nbsp;</td>
  </tr><?php if( $totalRows_relatorio_list_acao >=1){ ?>
  <tr class="rel_informacoes">
    <td align="center" ><?php echo   $totalRows_relatorio_list_acao; ?></td>
    <td width="5%" align="left" class="rel_info"><?php
	  $sexo= $row_relatorio_list_acao['sexo'];
	include ("../sma_animais/list_animais_sexo.php");
	 echo $nome=$row_list_animais_sexo['nome'];
	  ?></td>
    <td width="10%" align="left" class="rel_info"><?php echo  $_GET['cod_animal']; ?></td>
    <td width="20%" align="left" class="rel_info" style="width:200px;">&nbsp;
      <?php   $id_animais= $row_relatorio_list_acao['id_animais']; ?>
      <?php include("../sma_animais/list_animais.php"); ?>
    <?php  echo $row_list_filtro_animais['nome']; ?></td>
    <td align="center" class="rel_info"><?php
	 $id_estatus= $row_relatorio_list_acao['id_estatus'];
	   include("../sma_animais/list_animais_estatus.php"); 
	      echo $row_list_estatus_animal['nome']?>
</td>
    <td align="center" class="rel_info"><?php
	 $data_nasc= $row_list_filtro_animais['data_nasc'];
	  echo CalculaIdade(''.$data_nasc.'',"amd","-"); // Separados - Ano/Mes/Dia
	  
	 
	  
	  ?></td>
    <td width="8%" align="left" class="rel_info"><?php $id_lote= $row_relatorio_list_acao['id_lote']; 
	include ("../sma_lote/list_lote.php");  echo $nome= $row_list_filtro_lote['nome'];
	 ?></td>
    <td width="9%" align="left" class="rel_info"><?php   $id_animal_class=$row_relatorio_list_acao['id_animal_class']; include ("../sma_animais/list_animais_class.php"); ?>
      
    <?php  echo $nome= $row_list_filtro_animais_class['nome']; ?></td>
    <td width="6%" align="left" class="rel_info"><?php $id_racas= $row_relatorio_list_acao['id_raca']; include ("../sma_racas/list_racas.php"); echo  $row_list_filtro_racas['nome'];  ?></td>
    <td width="24%" align="left" class="rel_info">
	<?php $id_usuario= $row_relatorio_list_acao['id_usuario']; include ("../sistem_usuario/list_usuario.php") ?>
      <?php  echo $row_list_acao_usuario['nome']; ?>
      
    </td>
    <td width="3%" align="left" class="rel_info">&nbsp;</td>
  </tr><?php } ?>
  <tr  class="rel_info">
    <td colspan="11" >&nbsp;</td>
  </tr>
</table><br />
<table style="width:100%;" border="0" align="center" cellpadding="0" cellspacing="1" class="rel_table">
  <tr  class="rel_titulo">
    <td width="5%">&nbsp;&nbsp;DATA</td>
    <td width="5%">&nbsp;&nbsp;Peso</td>
    <td width="7%" align="center"  class="rel_cod_animal" onClick="MM_openBrWindow('../sma_relatorios_leite/infor_escore.php',
'','toolbar=no, location=no, menubar=no, status=yes, scrollbars=yes,  resizable=yes, width=840, height=380, ')" title="Informações cobre ESCORE" >     Escore '?'</td>
    <td width="83%">&nbsp;&nbsp;Tipo de Manejo</td>
  </tr>
  <?php $l=1;?>
  <?php if( $totalRows_relatorio_list_acao >=1){ ?>
  <?php do { ?>
  <tr  class="linha<?php   echo $l;  ?>" >
    <td align="center">&nbsp;&nbsp;<?php echo $data_manejo=converte_data($row_relatorio_list_acao['data']); ?>
      <div class="subText" >ID Manejo:<?php echo $id_manejo= $row_relatorio_list_acao['id_manejo']; ?></div></td>
    <td align="center" valign="top">&nbsp;&nbsp;
      <?php $id_animal= $row_relatorio_list_acao['id_animal']; ?>
      
      <?php echo $peso=$row_relatorio_list_acao['peso']; ?></td>
    <td align="center" valign="top"><?php echo $id_escore=$row_relatorio_list_acao['id_escore']." | ";  echo $escore_condicao= $row_relatorio_list_acao['escore_condicao']; ?></td>
    <td align="left" valign="top" style="padding:5px;"><div>
      <?php  $tipo_manejo= $row_relatorio_list_acao['tipo_manejo']; ?>
      <?php include("../sma_manejo/list_manejo_tipo.php"); ?>
      <div ><b>
        <?php  echo $row_list_filtro_manejo_tipo['nome']; ?>
      </b></div>
      <div>
        <?php $id_manejo= $row_relatorio_list_acao['id_manejo'];
 
switch ($tipo_manejo){
//--------------------------------------------------------------------------> MEDICAMENTO
	case '1': 
	 echo '<span class="rel_info2">';
	 	include ("../sma_relatorios_leite/relatorios_manejo_animal_include_med_tipo.php");
	 echo '</span>';
	 break;	
//--------------------------------------------------------------------------> CRUZAMENTO
	 case '2': // 
			//recebe da list no animais selecionado
			//--------------------------------------------------------------> CRUZAMENTO --> REPRODUTOR
			$row_list_filtro_animais['sexo']; 
			if($row_list_filtro_animais['sexo']==1){
			include ("../sma_relatorios_leite/relatorios_manejo_animal_include_cruzamento_reprodutor.php");
			
			//--------------------------------------------------------------> CRUZAMENTO --> MATRIZ 
			}elseif ($row_list_filtro_animais['sexo']==2){
			include ("../sma_relatorios_leite/relatorios_manejo_animal_include_cruzamento_matriz.php"); 	}
			break;	
//--------------------------------------------------------------------------> LOTE
	case '9': 
	  
	 include ("../sma_relatorios_leite/relatorios_manejo_animal_include_lote.php");
	 break;
//--------------------------------------------------------------------------> ALIMENTAÇÃO

	case '13': 
	 include ("../sma_relatorios_leite/relatorios_manejo_animal_include_alimentacao.php");
	 
	 break;	
//--------------------------------------------------------------------------> STATUS FEMIA
	case '16': 
	 include ("../sma_relatorios_leite/relatorios_manejo_animal_include_femea_status.php");
	 break;	
//--------------------------------------------------------------------------> ALIMENTAÇÃO
/*
	 case '17': 
	 include ("../sma_relatorios_leite/relatorios_manejo_animal_include_leite.php");
	 
	 break;	
	 */
//--------------------------------------------------------------------------> AVALIAÇÂO DO LEITE
	 case '17': 
	 include ("../sma_relatorios_leite/relatorios_manejo_animal_include_leite.php");
	 
	 break;	
//--------------------------------------------------------------------------> VEMDA DO LEITE
	 case '18': 
	 //include ("../sma_relatorios_leite/relatorios_manejo_animal_include_leite.php");
	 break;	
//--------------------------------------------------------------------------> ALIMENTAÇÃO
	 case '19': 
	 include ("../sma_relatorios_leite/relatorios_manejo_animal_include_custo.php");
	 
	 break;	
}
 ?>
      </div>
    </div>
      <div >
        <?php  $id_animais_peso= $row_relatorio_list_acao['id_animais_peso']; 
 
 include ("../sma_relatorios_leite/relatorios_manejo_animal_include_complementar.php");
  ?>
          <?php  
 
 include ("../sma_relatorios_leite/relatorios_manejo_animal_funcionarios.php");
  ?>
  
  
      </div>      <br /></td>
  </tr>
  <?php   $l++; if($l>2){   $l=1;}?>
  <?php } while ($row_relatorio_list_acao = mysql_fetch_assoc($relatorio_list_acao)); ?>
  <?php } else{?>
  <tr  class="rel_info">
    <td colspan="4" align="center" class="rel_informacoes"> codigo do animal n&atilde;o exite ou não possue registro no manejo!</td>
  </tr>
  <?php } ?>
  <tr  class="rel_titulo_fim">
    <td colspan="4" align="center">&nbsp;<?php if ($pageNum_relatorio_list_acao > 0) { // Show if not first page ?>
      <input type="button" name="button3" id="button3" value="|&lt; Inicio" onclick="MM_goToURL('parent','<?php printf("%s?pageNum_relatorio_list_acao=%d%s", $currentPage, 0, $queryString_relatorio_list_acao); ?>');return document.MM_returnValue" />
      <?php } // Show if not first page ?>
      <?php if ($pageNum_relatorio_list_acao > 0) { // Show if not first page ?>
      <input type="button" name="button2" id="button2" value="&lt;&lt; Voltar" onclick="MM_goToURL('parent','<?php printf("%s?pageNum_relatorio_list_acao=%d%s", $currentPage, max(0, $pageNum_relatorio_list_acao - 1), $queryString_relatorio_list_acao); ?>');return document.MM_returnValue"/>
      <?php } // Show if not first page ?>
      <?php if ($pageNum_relatorio_list_acao < $totalPages_relatorio_list_acao) { // Show if not last page ?>
      <input type="button" name="button" id="button" value="Avançar &gt;&gt;" onclick="MM_goToURL('parent','<?php printf("%s?pageNum_relatorio_list_acao=%d%s", $currentPage, min($totalPages_relatorio_list_acao, $pageNum_relatorio_list_acao + 1), $queryString_relatorio_list_acao); ?>');return document.MM_returnValue" />
      <?php } // Show if not last page ?>
      <?php if ($pageNum_relatorio_list_acao < $totalPages_relatorio_list_acao) { // Show if not last page ?>
      <input type="submit" name="button4" id="button4" value="Fim &gt;|" onclick="MM_goToURL('parent','<?php printf("%s?pageNum_relatorio_list_acao=%d%s", $currentPage, $totalPages_relatorio_list_acao, $queryString_relatorio_list_acao); ?>');return document.MM_returnValue" />
    <?php } // Show if not last page ?></td>
  </tr>
  
</table>
</body>
</html>


<?php
mysql_free_result($relatorio_list_acao);

mysql_free_result($list_tipo_manejo);
?>
