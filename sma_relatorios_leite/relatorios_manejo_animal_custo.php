<?php
$relatorio_titulo="RELATÓRIO DE ANIMAL - Custos - Mão de Obra v:3.1";
switch($_GET['converter']){
	
	case 'xls':
		$filename='lista_animais_custos';
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



<?php require_once('../Connections/connection.php'); ?>
<?php require_once("../sistem_funcoes/seguranca_usuario.php"); ?>
<?php 
############################### CONVERTE COD ANIMAL #############################
include "../sma_funcoes/converter_codigo_animal.php";
$_GET['cod_animal']=converte_cod_animal($_GET['cod_animal']);


?>
<?php 

include "../sistem_funcoes/converter_numero_moeda_3.php";



//------------------- lista a quantidade
$list_qtdd=$_GET['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd= '30';
}?>
<?php 
############################### FILTRAR PESQUISA #############################
//------------------------------------------------->COD_ANIMAL
$sql_local= "'".$_SESSION['LOCAL']."' ";

//------------------------------------------------->COD_ANIMAL
if(!empty($_GET['cod_animal'])){
	$sql_cod_animal= "  cod_animal='".$_GET['cod_animal']."'";
}else{ include("../sma_relatorios_leite/relatorios_manejo_animal_include_cod.php"); exit; }
//------------------------------------------------->IDADE
if(!empty($_GET['ativo'])){
 	$sql_ativo= " AND    ativo= ".$_GET['ativo']."  ";
}else{ $sql_ativo = " AND  ativo='1' "; $_GET['ativo']='1'; }

if($_GET['id_tipo_custo']!=''){
	$SQL_tipo_cusot="  AND id_tipo_custo='".$_GET['id_tipo_custo']."'";
	}else{$SQL_tipo_cusot="";}

?>
<?php
################################### ORDEM COLUNA ################################
$ordem_coluna=$_GET['ordem_coluna'];

switch($ordem_coluna){
	case '1':
			$ordem_colunaSQL='id_manejo';
		break;
	case '2':
			$ordem_colunaSQL='data';
		break;
	case '3':
			$ordem_colunaSQL='leite_qtdd';
		break;
	case '4':
			$ordem_colunaSQL='leite_proteina';
		break;
	case '5':
			$ordem_colunaSQL='leite_gordura';
		break;

	default:
		$ordem_colunaSQL='id_manejo';
}
//oredem crecente ou decrente
$ordem=$_GET['ordem'];

switch($ordem){
	case '2'://DESC
		$ordem='1';
		$ordemSQL='ASC';
		$class='_asc';
		$title='A Ordem esta Crecente';
		break;
	case '1'://ASC
		$ordem='2';
		$ordemSQL=DESC;
		$class='_desc';
		$title='A Ordem esta Decrecente';
		break;
	default:
		$ordem='1';
		$class='';
		$title='A Ordem esta Crecente';
}


//$ordem $class

?>
<?php require_once('../Connections/connection.php'); 


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
?>
<?php
$colname_uni_animal = "-1";
if (isset($_GET['cod_animal'])) {
  $colname_uni_animal = $_GET['cod_animal'];
}
mysql_select_db($database_connection, $connection);
$query_uni_animal = sprintf("SELECT * FROM tbnext_mod_sma_otimizar_relatorio_animais WHERE cod_animal = %s", GetSQLValueString($colname_uni_animal, "text"));
$uni_animal = mysql_query($query_uni_animal, $connection) or die(mysql_error());
$row_uni_animal = mysql_fetch_assoc($uni_animal);
$totalRows_uni_animal = mysql_num_rows($uni_animal);

mysql_select_db($database_connection, $connection);
$query_list_tipo_custo = "SELECT id_tipo_custo, nome, valor FROM tbnext_mod_sma_manejo_custo_tipo ORDER BY nome ASC ";
$list_tipo_custo = mysql_query($query_list_tipo_custo, $connection) or die(mysql_error());
$row_list_tipo_custo = mysql_fetch_assoc($list_tipo_custo);
$totalRows_list_tipo_custo = mysql_num_rows($list_tipo_custo);

$maxRows_relatorio_list_acao =  $list_qtdd;
$pageNum_relatorio_list_acao = 0;
if (isset($_GET['pageNum_relatorio_list_acao'])) {
  $pageNum_relatorio_list_acao = $_GET['pageNum_relatorio_list_acao'];
}
$startRow_relatorio_list_acao = $pageNum_relatorio_list_acao * $maxRows_relatorio_list_acao;
mysql_select_db($database_connection, $connection);
$query_relatorio_list_acao = "SELECT   * FROM   vwnext_relatorio_manejo_custo  WHERE $sql_cod_animal $SQL_tipo_cusot   ORDER BY $ordem_colunaSQL $ordemSQL";

$query_limit_relatorio_list_acao = sprintf("%s LIMIT %d, %d", $query_relatorio_list_acao, $startRow_relatorio_list_acao, $maxRows_relatorio_list_acao);
$relatorio_list_acao = mysql_query($query_limit_relatorio_list_acao, $connection) or die(mysql_error());
$row_relatorio_list_acao = mysql_fetch_assoc($relatorio_list_acao);


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
<script src="../sistem_funcoes/openWindow.js" type="text/javascript"></script>
<script src="../sistem_funcoes/goURL.js" type="text/javascript"></script>
</head>

<body>
<?php if($conv==1){ ?>
<div id="loading_transicao">
<div id="loading_fundo" ></div>
<div id="loading_conteudo" ><img src="../images/aparencia/cabanha/loading.gif" width="106" height="106" /><br />&nbsp;&nbsp;LOADING...</div>
</div>
<?php }else{?>
<b><?php echo $relatorio_titulo ?> '<?php echo $_GET['converter']; ?></b> - Data:<?php echo date(d.'/'.m.'/'.Y.' - '.H.':'.i.':'.s);?><br>
<?php }?>
<table border="0" cellspacing="0" cellpadding="0" class="rel_table">
  <tr class="rel_cabecalho">
    <td colspan="8" class="rel_informacoes" ><?php if($conv==1){ ?>
    <form action="?" method="get" enctype="application/x-www-form-urlencoded">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:5px;">
      <tr>
        <td width="11%" align="center" valign="middle"><img width="84" height="42" src="../empresa_logo/logo_cabanha-126x64.png"></td>
        <td width="15%" align="center" valign="middle">
          
          <div style="font-size:10px"><b><?php echo $relatorio_titulo; ?></b><br />
		  <?php echo $totalRows_relatorio_list_acao ?>&nbsp;Quantidade de animal(is)</div>
          </td>
        <td width="6%" align="center" valign="middle"><label for="cod_animal"> Qtdd</label><br />
          <select name="list_qtdd" class="form_pesquisa_input" id="list_qtdd">
            <option value="30" <?php if (!(strcmp(30, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>30</option>
            <option value="45" <?php if (!(strcmp(45, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>45</option>
            <option value="70" <?php if (!(strcmp(70, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>70</option>
            <option value="100" <?php if (!(strcmp(100, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>100</option>
            <option value="150" <?php if (!(strcmp(150, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>150</option>
            <option value="200" <?php if (!(strcmp(200, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>200</option>
            <option value="250" <?php if (!(strcmp(250, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>250</option>
            <option value="500" <?php if (!(strcmp(500, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>500</option>
            <option value="1000" <?php if (!(strcmp(1000, $_GET['list_qtdd']))) {echo "selected=\"selected\"";} ?>>1000</option>
            </select>
          </td>
        <td width="5%" align="center" valign="middle"><label for="cod_animal">TIPO CUSTO</label>
          <select name="id_tipo_custo" id="id_tipo_custo" class="form_pesquisa_input" style="width:80px;">
            <option value="" <?php if (!(strcmp("", $_GET['id_tipo_custo']))) {echo "selected=\"selected\"";} ?>>Tudo</option>
            <?php
do {  
?>
            <option value="<?php echo $row_list_tipo_custo['id_tipo_custo']?>"<?php if (!(strcmp($row_list_tipo_custo['id_tipo_custo'], $_GET['id_tipo_custo']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_tipo_custo['nome']?></option>
            <?php
} while ($row_list_tipo_custo = mysql_fetch_assoc($list_tipo_custo));
  $rows = mysql_num_rows($list_tipo_custo);
  if($rows > 0) {
      mysql_data_seek($list_tipo_custo, 0);
	  $row_list_tipo_custo = mysql_fetch_assoc($list_tipo_custo);
  }
?>
          </select></td>
        <td width="5%" align="center">
        <div title="EXPORTA XLS" id="divXls"  onclick="goToURL('<?php printf("%s?".$_SERVER['QUERY_STRING']."&converter=xls&cod_animal=".$_GET['cod_animal']."&%d%s", $currentPage,$ordem , $queryString_1); ?>')">
        </div><div id="divHtml" onClick="MM_openBrWindow('<?php printf("%s?".$_SERVER['QUERY_STRING']."&converter=pri&cod_animal=".$_GET['cod_animal']."&%d%s", $currentPage,$ordem , $queryString_1); ?>',
'','toolbar=no,location=no ,menubar=no, status=yes, scrollbars=yes,  resizable=yes, width=1024,height=768')"></div></td>
        <td width="71%" align="center"><label for="filtro"></label>
          <label for="list_qtdd">COD Animal:</label>
          <input name="cod_animal" type="text" class="form_pesquisa_input" id="cod_animal" value="<?php echo $_GET['cod_animal']; ?>" size="34" />
          <input type="submit" name="bt_prequisar" id="bt_prequisar" value="Pesquisar" />
          <input name="ordem_coluna" type="hidden" id="ordem_coluna" value="<?php echo $ordem_coluna; ?>" />
          <input name="ordem" type="hidden" id="ordem" value="<?php echo $_GET['ordem']; ?>" /></td>
        </tr>
      </table>
    </form>
    <?php }?>
    </td>
  </tr>
  <tr class="rel_titulo">
    <td  class="coluna_titulo" >MANEJO
      <?php	$ordem_coluna_nome='1';//PESO ATUAL
	$queryString_1 = sprintf("&cod_animal=".$_GET['cod_animal']."&ordem_coluna=%d%s", $ordem_coluna_nome, $queryString);?>
      <div class="ordem<?php   switch($ordem_coluna){	case $ordem_coluna_nome:	echo $class; break;	default: echo $class_defaul='';	} ?>" onclick="goToURL('<?php printf("%s?ordem=%d%s", $currentPage,$ordem , $queryString_1); ?>')"></div>    </td>
    
    <td class="coluna_titulo" title="PRIMEIRA DATA">TIPO-CUSTO
        <?php	$ordem_coluna_nome='2';
	$queryString_1 = sprintf("&cod_animal=".$_GET['cod_animal']."&ordem_coluna=%d%s", $ordem_coluna_nome, $queryString);?>
        <div class="ordem<?php   switch($ordem_coluna){	case $ordem_coluna_nome:	echo $class; break;	default: echo $class_defaul='';	} ?>" onclick="goToURL('<?php printf("%s?ordem=%d%s", $currentPage,$ordem , $queryString_1); ?>')"></div>    <div class="ordem<?php   switch($ordem_coluna){	case $ordem_coluna_nome:	echo $class; break;	default: echo $class_defaul='';	} ?>" onclick="goToURL('<?php printf("%s?ordem=%d%s", $currentPage,$ordem , $queryString_1); ?>')"></div>
    </td>
    <td " class="coluna_titulo" title="PRIMEIRO PESO">DATA INICIAL
    <?php	$ordem_coluna_nome='4';
	$queryString_1 = sprintf("&cod_animal=".$_GET['cod_animal']."&ordem_coluna=%d%s", $ordem_coluna_nome, $queryString);?></td>
    <td  class="coluna_titulo" title="PRIMEIRO PESO">DATA FINAL<?php	$ordem_coluna_nome='4';
	$queryString_1 = sprintf("&cod_animal=".$_GET['cod_animal']."&ordem_coluna=%d%s", $ordem_coluna_nome, $queryString);?></td>
    <td  class="coluna_titulo" title="PRIMEIRO PESO">PERIODO/DIAS</td>
    <td  class="coluna_titulo" title="PRIMEIRO PESO">VALOR/CUSTO</td>
    <td  class="coluna_titulo" title="PRIMEIRO PESO">QTDD-ANIMAIS</td>
    <td class="coluna_titulo" title="PRIMEIRO PESO">VALOR DE ANIMAIS/DIAS</td>
  </tr> 
  <?php $l=1;?>
  <?php do { ?>
  <tr class="linha<?php   echo $l;  ?>" >
   
      <td class="coluna_conteudo" ><?php echo $row_relatorio_list_acao['id_manejo']; ?></td>
      <td class="coluna_conteudo"><?php echo $row_relatorio_list_acao['nome_tipo_custo']; ?></td>
      <td class="coluna_conteudo"><?php echo $row_relatorio_list_acao['data_inicial']; ?></td>
      <td class="coluna_conteudo"><?php echo $row_relatorio_list_acao['data_final']; ?></td>
      <td class="coluna_conteudo"><?php echo $row_relatorio_list_acao['periodo_dias']; ?></td>
      <td class="coluna_conteudo"><?php echo converter_numero_moeda_3($row_relatorio_list_acao['valor_custo']); ?></td>
      <td class="coluna_conteudo"><?php echo $row_relatorio_list_acao['qtdd_animais']; ?></td>
      <td class="coluna_conteudo"><?php echo converter_numero_moeda_3($row_relatorio_list_acao['valor_animais_dia']); ?></td>
    </tr>
  <?php   $l++; if($l>2){   $l=1;}?>
  <?php } while ($row_relatorio_list_acao = mysql_fetch_assoc($relatorio_list_acao)); ?>
  <tr class="rel_titulo_fim">
    <td colspan="9" align="center">&nbsp;
      <?php if ($pageNum_relatorio_list_acao > 0) { // Show if not first page ?>
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
        <?php } // Show if not last page ?>
      </td>
  </tr>
</table><br />
<br />
<table  border="0" align="center" cellpadding="0" cellspacing="0" class="rel_table"  style="text-indent:5px; width:650px;">
  <tr class="rel_titulo">
    <td>&nbsp;</td>
    <td width="18%">MÉDIA</td>
  </tr>
  <tr class="linha1">
    <td>Data Otimização : <?php include("../sma_relatorios_leite/otimizacao_data.php");  ?><?php echo $row_list_otim['data_otimizar']; ?></td>
    <td align="right" class="coluna_conteudo"></td>
  </tr>
  <tr class="linha2">
    <td>Custo por Animal</td>
    <td align="right" class="coluna_conteudo"><?php echo converter_numero_moeda_3($row_uni_animal['custo_kilo']); ?></td>
  </tr>
  <tr class="linha1">
    <td>Kilo por Animal</td>
    <td align="right" class="coluna_conteudo"><?php echo converter_numero_moeda_3($row_uni_animal['kilo_soma_animal']); ?></td>
  </tr>
  <tr class="linha2">
    <td class="coluna_conteudo">Custo total Alimentação</td>
    <td align="right" class="coluna_conteudo"><?php echo converter_numero_moeda_3($row_uni_animal['custo_alimentacao']); ?></td>
  </tr>
  <tr class="rel_titulo_fim">
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

<script>
$(function(){
	$('#loading_transicao').html('');
	
	});

</script>
</body>
</html>
<?php
mysql_free_result($uni_animal);

mysql_free_result($list_tipo_custo);

mysql_free_result($relatorio_list_acao);

?>
