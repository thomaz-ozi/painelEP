<?php
$relatorio_titulo="RELATÓRIO MENSAL DE ANIMAIS v:3.5";
//---------> ANO
if($_GET['id_ano']==""){ $_GET['id_ano']=date(Y);}
$ano=$_GET['id_ano'];
//---------> MES
if($_GET['id_mes']==""){ $_GET['id_mes']=date(n);}
$mes=$_GET['id_mes'];
//---------> LOTE
if($_GET['id_lote']!=""){ $SQLlote=" AND id_lote= '".$_GET['id_lote']."'";}

//---------> CLASS
if($_GET['id_animal_class']!=""){ $SQLclass=" AND id_animal_class= '".$_GET['id_animal_class']."'";}


if($_GET['id_lactacao']==""){
	$_GET['id_lactacao']=1; 
	$SQLtabela= "  vwnext_relatorio_primerio_manejo_animais";
	 }elseif($_GET['id_lactacao']==2){
		$SQLlactacao= "  lactacao='2' AND";
		$SQLtabela= "  vwnext_relatorio_primerio_manejo_animais_lactacao";
}else{$_GET['id_lactacao']=1; 
	$SQLtabela= "  vwnext_relatorio_primerio_manejo_animais";}


switch($_GET['converter']){
	
	case 'xls':
		$filename='relatorio_diario';
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
<?php require_once('../sistema_funcoes/converter_numero_moeda_3.php'); ?>
<?php include "../sma_funcoes/calcular_idade.php"; ?>


<?php 
############################### FILTRAR PESQUISA #############################
//------------------------------------------------->COD_ANIMAL
$sql_local= "'".$_SESSION['LOCAL']."' ";

//------------------------------------------------->COD_ANIMAL
/*
if(!empty($_GET['cod_animal'])){
	$sql_cod_animal= " AND cod_animal='".$_GET['cod_animal']."'";
}else{ include("../sma_relatorios_leite/relatorios_manejo_animal_include_cod.php"); exit; }
*/
//------------------------------------------------->IDADE
if(!empty($_GET['ativo'])){
 	$sql_ativo= " AND    ativo= ".$_GET['ativo']."  ";
}else{ $sql_ativo = " AND  ativo='1' "; $_GET['ativo']='1'; }

?>
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

mysql_select_db($database_connection, $connection);
$query_list_animal_class = "SELECT * FROM tbnext_mod_sma_cad_animais_class ORDER BY nome ASC";
$list_animal_class = mysql_query($query_list_animal_class, $connection) or die(mysql_error());
$row_list_animal_class = mysql_fetch_assoc($list_animal_class);
$totalRows_list_animal_class = mysql_num_rows($list_animal_class);



$colname_list_acao = "-1";

mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM ".$SQLtabela."  WHERE   (YEAR(data)='".$ano."' AND  MONTH(data)='".$mes."')  ".$SQLlote."  ".$SQLclass."  GROUP BY id_animais  ORDER BY id_animais ASC  ";
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>

<?php 
include "../sma_funcoes/converter_codigo_animal.php";
$_GET['cod_animal']=converte_cod_animal($_GET['cod_animal']);
?>



<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo $relatorio_titulo; ?></title>

<?php if($conv==1){ ?>
<link href="relatorios_estilo.css" rel="stylesheet" type="text/css" />
<?php }else{?>
<?php include('relatorios_estilo_imprimir.php');?>
<?php }?>
<script src="../sistem_funcoes/openWindow.js" type="text/javascript"></script>
<script src="../sistem_funcoes/goURL.js" type="text/javascript"></script>
</head>

<body>
<form id="relatorio" name="relatorio" method="get" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="rel_table">
  <tr class="rel_informacoes">
    <td width="140" align="center">
    <img src="../empresa_logo/logo_cabanha-126x64.png" alt="" width="84" height="42" /><div style="font-size:9px; text-align:center; width:100%;"><b><?php echo $relatorio_titulo; ?></b></div></td>
    <td width="89" align="center" ><div style="width:80px;">
       <div title="EXPORTA XLS" id="divXls"  onclick="goToURL('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=xls&%d%s", $currentPage,$ordem , $queryString_1); ?>')"></div>
    <div id="divHtml" onClick="MM_openBrWindow('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=pri&%d%s", $currentPage,$ordem , $queryString_1); ?>','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,height=768')"></div></div></td>
    <td width="157" ><div style="height:45px; margin-top:5px;">
      <table width="100" border="0" cellspacing="0" cellpadding="0" class="rel_informacoes">
      <tr>
        <td align="center">MÊS</td>
        <td align="center">ANO</td>
        </tr>
      <tr>
        <td align="center"><select name="id_mes" id="id_mes"  style="width:70px;">
          <option value="1" <?php if (!(strcmp(1, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Janeiro</option>
          <option value="2" <?php if (!(strcmp(2, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Fevereiro</option>
          <option value="3" <?php if (!(strcmp(3, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Março</option>
          <option value="4" <?php if (!(strcmp(4, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Abril</option>
          <option value="5" <?php if (!(strcmp(5, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Maio</option>
          <option value="6" <?php if (!(strcmp(6, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Junho</option>
          <option value="7" <?php if (!(strcmp(7, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Julho</option>
          <option value="8" <?php if (!(strcmp(8, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Agosto</option>
          <option value="9" <?php if (!(strcmp(9, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Setembro</option>
          <option value="10" <?php if (!(strcmp(10, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Outubro</option>
          <option value="11" <?php if (!(strcmp(11, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Novembro</option>
          <option value="12" <?php if (!(strcmp(12, $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>>Dezembro</option>
        </select></td>
        <td align="center"><select name="id_ano" id="id_ano" style="width:50px;">
          <option value="2012" <?php if (!(strcmp(2012, $_GET['id_ano']))) {echo "selected=\"selected\"";} ?>>2012</option>
          <option value="2013" <?php if (!(strcmp(2013, $_GET['id_ano']))) {echo "selected=\"selected\"";} ?>>2013</option>
          <option value="2014" <?php if (!(strcmp(2014, $_GET['id_ano']))) {echo "selected=\"selected\"";} ?>>2014</option>
          <option value="2015" <?php if (!(strcmp(2015, $_GET['id_ano']))) {echo "selected=\"selected\"";} ?>>2015</option>
        </select></td>
        </tr>
    </table>
    </div>
</td>
    <td width="372" align="center" >
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="30%">Class</td>
          <td width="30%"><div class="rel_informacoes">LACTAÇÃO</div></td>
          <td width="28%" class="rel_informacoes">MÉTODO</td>
          <td width="42%" class="rel_informacoes">LOTE</td>
        </tr>
        <tr>
          <td>
            <select name="id_animal_class" id="id_animal_class" style="width:90px;">
              <option value="" <?php if (!(strcmp("", $_GET['id_animal_class']))) {echo "selected=\"selected\"";} ?>>Todos</option>
              <?php
do {  
?>
              <option value="<?php echo $row_list_animal_class['id_animal_class']?>"<?php if (!(strcmp($row_list_animal_class['id_animal_class'], $_GET['id_animal_class']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_animal_class['nome']?></option>
              <?php
} while ($row_list_animal_class = mysql_fetch_assoc($list_animal_class));
  $rows = mysql_num_rows($list_animal_class);
  if($rows > 0) {
      mysql_data_seek($list_animal_class, 0);
	  $row_list_animal_class = mysql_fetch_assoc($list_animal_class);
  }
?>
            </select></td>
          <td><select name="id_lactacao" id="id_lactacao" style="width:90px;">
            <option value="1" <?php if (!(strcmp(1, $_GET['id_lactacao']))) {echo "selected=\"selected\"";} ?>>Sem Lactação</option>
            <option value="2" <?php if (!(strcmp(2, $_GET['id_lactacao']))) {echo "selected=\"selected\"";} ?>>Com Lactação</option>
          </select></td>
          <td><select name="condicao" id="condicao" style="width:90px;">
            <option value="1" <?php if (!(strcmp(1, $_GET['condicao']))) {echo "selected=\"selected\"";} ?>>Soma</option>
            <option value="2" <?php if (!(strcmp(2, $_GET['condicao']))) {echo "selected=\"selected\"";} ?>>Média</option>
          </select></td>
          <td><label for="id_lote"></label>
            <?php
			$id_lote=$_GET['id_lote'];
			 include('../sma_lote/include_list_form.php');?></td>
        </tr>
    </table></td>
    <td width="376" ><input  name="cod_animal" type="text" class="form_pesquisa_input" id="cod_animal" value="<?php echo $_GET['cod_animal']; ?>" size="38" />
    <input type="submit" name="botao" id="botao" value="Pesquisar" /></td>
  </tr>
  <tr class="rel_informacoes">
    <td colspan="5" align="right"><br>
</td>
    </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="rel_table">
  <tr >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td class="coluna_titulo_pre_cinza"  >MÉDIA</td>
    <td >&nbsp;</td>
    <td colspan="7" align="center" class="coluna_titulo_pre_cinza" >alimentaÇÃo</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td class="coluna_titulo_pre_cinza" >MÉDIA</td>
    <td class="coluna_titulo_pre_cinza" >MÉDIA</td>
    <td class="coluna_titulo_pre_cinza" >TOTAL</td>
  </tr>
  <tr class="rel_opcoes" style="">
    <td width="3%" >COD </td>
    <td width="13%" class="coluna_titulo">QTDD/LISTROS </td>
    <td width="13%" class="coluna_titulo">V.VENDA/LITROS</td>
    <td width="13%" class="coluna_titulo">FATURADO</td>
    <td width="13%" class="coluna_titulo">QTD/CONCENTRADO</td>
    <td width="13%" class="coluna_titulo">CUSTO/CONCENTRADO</td>
    <td width="13%" class="coluna_titulo">QTD/VOLUMOSO</td>
    <td width="13%" class="coluna_titulo">CUSTO/VOLUMOSO</td>
    <td width="13%" class="coluna_titulo"> QTD/MINERAL</td>
    <td width="13%" class="coluna_titulo">CUSTO/MINERAL</td>
    <td width="13%" class="coluna_titulo">C.ALI</td>
    <td width="13%" class="coluna_titulo">C.MÃO/OBRA</td>
    <td width="13%" class="coluna_titulo">C.MED</td>
    <td width="13%" class="coluna_titulo">C.OUTROS</td>
    <td width="13%" class="coluna_titulo">TOTAL-CUST0 </td>
    <td width="13%" class="coluna_titulo">CUSTO/LITRO</td>
    <td width="13%" class="coluna_titulo">RETAB/LITROS</td>
    <td width="13%" class="coluna_titulo">RENTABILIDADE</td>
    </tr>
  <?php $l=1;?>
<?php do { ?>
  <?php  include ("../sma_relatorios_leite/relatorios_manejo_animal_diario_leite.php");
  $leite_qtdd_soma_op=$row_list_include['leite_qtdd_soma'];
  if($_GET['id_lactacao']=='1'){$leite_qtdd_soma_op=1;}
?>
  <tr class="linha<?php   echo $l;  ?>">
    <td align="center">
          <div class="rel_cod_animal"
      onClick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_animal_diario.php?cod_animal=<?php echo $row_list_acao['cod_animal']; ?>',
'','toolbar=no, location=no, menubar=no, status=yes, scrollbars=yes,  resizable=yes, width=1024, height=768, ')"
      >
	<?php $id_animais= $row_list_acao['id_animais'];
	 echo $row_list_acao['cod_animal']; 
	if($_GET['condicao']==2){
	include("../sma_relatorios_leite/relatorios_manejo_lista_animais_mensal_media.php"); 
	}else{
			include("../sma_relatorios_leite/relatorios_manejo_lista_animais_mensal_soma.php"); 

		}
	?>
    </div></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['leite_qtdd_litros_soma']); ?></td>
    
      <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['valor_venda_litros_soma']); ?></td>
      <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['faturado_soma']); ?></td>
     <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_concentrado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_concentrado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_volumoso_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_volumoso_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_mineral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_mineral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_total_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_mao_obra_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_medicamentos_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_outros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_total_geral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custo_litro_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_animal_soma']); ?></td>
    </tr> <?php   $l++; if($l>2){   $l=1;}?>
 
 <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
   
 <tr class="rel_info">
  <td colspan="18">&nbsp;</td>
  </tr>
</table>
<br>
<br>
<br>
<br>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="rel_table">
  <tr class="rel_opcoes">
    <td>&nbsp;</td>
    <td class="coluna_titulo">QTDD/LISTROS </td>
    <td class="coluna_titulo">V.VENDA/LITROS</td>
    <td class="coluna_titulo">FATURADO</td>
    <td class="coluna_titulo">QTD/CONCENTRADO</td>
    <td class="coluna_titulo">CUSTO/CONCENTRADO</td>
    <td class="coluna_titulo">QTD/VOLUMOSO</td>
    <td class="coluna_titulo">CUSTO/VOLUMOSO</td>
    <td class="coluna_titulo"> QTD/MINERAL</td>
    <td class="coluna_titulo">CUSTO/MINERAL</td>
    <td class="coluna_titulo">C.ALI</td>
    <td class="coluna_titulo">C.MÃO/OBRA</td>
    <td class="coluna_titulo">C.MED</td>
    <td class="coluna_titulo">C.OUTROS</td>
    <td class="coluna_titulo">TOTAL-CUST0 </td>
    <td class="coluna_titulo">CUSTO/LITRO</td>
    <td class="coluna_titulo">RETAB/LITROS</td>
    <td class="coluna_titulo">RENTABILIDADE</td>
    </tr>
    <?php include('../sma_relatorios_leite/relatorios_manejo_lista_animais_mensal_soma_grupo.php');
	
	
	$nAnimais=$totalRows_list_acao;
	 ?>
    
  <tr class="linha1">
    <td>&nbsp;&nbsp;MÉDIA&nbsp;&nbsp;</td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['leite_qtdd_litros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['valor_venda_litros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['faturado_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_concentrado_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_concentrado_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_volumoso_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_volumoso_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_mineral_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_mineral_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_total_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_mao_obra_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_medicamentos_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_outros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_total_geral_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custo_litro_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_litros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_animal_soma']/$nAnimais); ?></td>
    </tr>

  <tr class="linha2">
    <td>&nbsp;&nbsp;SOMA&nbsp;&nbsp;</td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['leite_qtdd_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['valor_venda_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['faturado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_concentrado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_concentrado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_volumoso_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_volumoso_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_mineral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_mineral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_total_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_mao_obra_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_medicamentos_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_outros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_total_geral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custo_litro_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_animal_soma']); ?></td>
    </tr>
  <tr >
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</body>
</html>
<?php
mysql_free_result($list_animal_class);

mysql_free_result($list_acao);
?>
