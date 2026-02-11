<?php
$relatorio_titulo="RELATÓRIO DIARIO DO ANIMAL v: 3.5";

if($_GET['id_ano']==""){ $_GET['id_ano']=date(Y);}
$ano=$_GET['id_ano'];

if($_GET['id_mes']==""){ $_GET['id_mes']=date(n);}
$mes=$_GET['id_mes'];

if($_GET['id_lactacao']==""){ $_GET['id_lactacao']=1;}

switch($_GET['converter']){
	
	case 'xls':
		$filename='lista_animais_peso';
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
<?php // require_once("../sistema_funcoes/seguranca_usuario.php"); ?>
<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../sistema_funcoes/converter_numero_moeda_3.php'); ?>
<?php include("../sistema_funcoes/converte_datas.php"); ?>
<?php include "../sma_funcoes/calcular_idade.php"; ?>
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

$colname_list_acao = "-1";
if (isset($_GET['cod_animal'])) {
  $colname_list_acao = $_GET['cod_animal'];
}
mysql_select_db($database_connection, $connection);
 $query_list_acao = sprintf("SELECT * FROM vwnext_relatorio_cad_animais WHERE cod_animal = %s", GetSQLValueString($colname_list_acao, "text"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);$colname_list_acao = "-1";
if (isset($_GET['cod_animal'])) {
  $colname_list_acao = $_GET['cod_animal'];
}
mysql_select_db($database_connection, $connection);
 $query_list_acao = sprintf("SELECT * FROM vwnext_relatorio_cad_animais WHERE cod_animal = %s", GetSQLValueString($colname_list_acao, "text"));
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
<script src="../sistem_funcoes/openWindow.js" type="text/javascript"></script>
<script src="../sistem_funcoes/goURL.js" type="text/javascript"></script>
<?php }else{?>
<?php include('relatorios_estilo_imprimir.php');?>
<?php }?>





<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
</head>

<body>
<form id="relatorio" name="relatorio" method="get" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="rel_table">
  <tr class="rel_informacoes">
    <td width="128" align="center">
    <img src="../empresa_logo/logo_cabanha-126x64.png" alt="" width="84" height="42" /><div style="font-size:9px; text-align:center; width:100%;"><b><?php echo $relatorio_titulo; ?></b></div></td>
    <td width="117" align="center" ><div style="width:80px;">
       <span class="rel_cod_animal"></span>
       <div title="EXPORTA XLS" id="divXls"  onclick="goToURL('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=xls&%d%s", $currentPage,$ordem , $queryString_1); ?>')"></div>
    <div id="divHtml" onClick="MM_openBrWindow('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=pri&%d%s", $currentPage,$ordem , $queryString_1); ?>','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,height=768')"></div></div></td>
    <td width="211" ><div style="height:45px; margin-top:5px;">
      <table width="80%" border="0" cellspacing="0" cellpadding="0" class="rel_informacoes">
      <tr>
        <td align="center">MES</td>
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
    <td width="162" align="center" ><div class="rel_informacoes">OPÇÕES</div>
      <select name="id_lactacao" id="id_lactacao">
        <option value="1" <?php if (!(strcmp(1, $_GET['id_lactacao']))) {echo "selected=\"selected\"";} ?>>Sem Lactação</option>
        <option value="2" <?php if (!(strcmp(2, $_GET['id_lactacao']))) {echo "selected=\"selected\"";} ?>>Com Lactação</option>
      </select>
      </td>
    <td width="468" ><input  name="cod_animal" type="text" class="form_pesquisa_input" id="cod_animal" value="<?php echo $_GET['cod_animal']; ?>" size="38" />
    <input type="submit" name="botao" id="botao" value="Pesquisar" /></td>
  </tr>
  <tr class="rel_informacoes">
    <td colspan="5" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="rel_opcoes">
        <td align="center">Sexo</td>
        <td align="left" class="coluna_titulo">&nbsp;COD<?php   $id_animais=$row_list_acao['id_animais']; ?></td>
        <td align="left" class="coluna_titulo">&nbsp;Animal</td>
        <td align="center" class="coluna_titulo"><div style="width:100px;">&nbsp;Idade</div></td>
        <td align="left" class="coluna_titulo">&nbsp;Lote</td>
        <td align="left" class="coluna_titulo">&nbsp;Classificação</td>
        <td align="left" class="coluna_titulo">&nbsp;Raça</td>
        <td align="left" class="coluna_titulo">&nbsp;Parceiro</td>
        </tr>
      <tr class="rel_informacoes">
        <td align="center" ><?php echo $row_list_acao['nome_sexo']; ?></td>
        <td align="left" class="rel_info"> <div class="rel_cod_animal"
      onClick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_animal.php?cod_animal=<?php echo $row_list_acao['cod_animal']; ?>',
'','toolbar=no, location=no, menubar=no, status=yes, scrollbars=yes,  resizable=yes, width=1024, height=768, ')"
      ><?php echo $row_list_acao['cod_animal']; ?></div></td>
        <td align="left" class="rel_info" style="width:200px;"><?php echo $row_list_acao['nome']; ?></td>
        <td align="center" class="rel_info"><?php
	 $data_nasc= $row_list_filtro_animais['data_nasc'];
	  echo CalculaIdade(''.$data_nasc.'',"amd","-"); // Separados - Ano/Mes/Dia
	  
	 
	  
	  ?></td>
        <td align="left" class="rel_info"><?php echo $row_list_acao['nome_lote']; ?></td>
        <td align="left" class="rel_info"><?php echo $row_list_acao['nome_class']; ?></td>
        <td align="left" class="rel_info"><?php echo $row_list_acao['nome_raca']; ?></td>
        <td align="left" class="rel_info"><span class="rel_info" style="width:200px;"><?php echo $row_list_acao['nome_parceiro']; ?></span></td>
        </tr>
    </table><br>
</td>
    </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="rel_table">
  <tr >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td  class="coluna_titulo_pre_cinza" >MÉDIA</td>
    <td >&nbsp;</td>
    <td colspan="7" align="center" class="coluna_titulo_pre_cinza" >alimentaÇÃo</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td class="coluna_titulo_pre_cinza" >MÉDIA</td>
    <td class="coluna_titulo_pre_cinza" >MÉDIA</td>
    <td class="coluna_titulo_pre_cinza"> TOTAL</td>
  </tr>
  <tr class="rel_opcoes" style="">
    <td width="3%" >DIA(S)</td>
    <td width="13%" class="coluna_titulo">QTDD/LISTROS</td>
    <td width="13%" class="coluna_titulo">V.VENDA/LITROS</td>
    <td width="13%" class="coluna_titulo">FATURADO</td>
    <td width="13%" class="coluna_titulo">QTD/CONCENTRADO</td>
    <td width="13%" class="coluna_titulo">CUSTO/CONCENTRADO</td>
    <td width="13%" class="coluna_titulo">QTD/VOLUMOSO</td>
    <td width="13%" class="coluna_titulo">CUSTO/VOLUMOSO</td>
    <td width="13%" class="coluna_titulo"> QTD/MINERAL</td>
    <td width="13%" class="coluna_titulo">CUSTO/MINERAL</td>
    <td width="13%" class="coluna_titulo">C.ALIMENTAÇÃO</td>
    <td width="13%" class="coluna_titulo">C.MÃO/OBRA</td>
    <td width="13%" class="coluna_titulo">C.MED</td>
    <td width="13%" class="coluna_titulo">C.OUTROS</td>
    <td width="13%" class="coluna_titulo">TOTAL-CUST0 </td>
    <td width="13%" class="coluna_titulo">CUSTO/LITRO</td>
    <td width="13%" class="coluna_titulo">RENTAB/LITROS</td>
    <td width="13%" class="coluna_titulo">RENTAB/DIA</td>
    </tr>
  <?php
  
  
   $l=1;?>
<?php
//lista em dias do ano e mes selecionado
;

$year=$ano; $month=$mes; $days = array(); $day_name_length = 3; $month_href = NULL; $first_day = 0; $pn = array();
$first_of_month = gmmktime(0,0,0,$month,1,$year);
for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){


?>
  <?php 
  $id_animais=$row_list_acao['id_animais'];
  
   include ("../sma_relatorios_leite/relatorios_manejo_animal_diario_leite.php");
  	if($row_list_include['leite_qtdd_soma']==0){$leite_qtdd_soma=1;}else{$leite_qtdd_soma=$row_list_include['leite_qtdd_soma'];}

  $leite_qtdd_soma_op=$row_list_include['leite_qtdd_soma'];
  //lactacao
  if($_GET['id_lactacao']=='1'){$leite_qtdd_soma_op=1;}
  
    if($leite_qtdd_soma_op >0){?>
  <tr class="linha<?php   echo $l;  ?>"  >
    <td align="center">&nbsp;<?php echo $day;?>
    
  
    
    </td>
    <td align="right">
	<?php  
		 echo converter_numero_moeda_3($qtdd_litros = $row_list_include['leite_qtdd_soma']);
	 	 $qtdd_litros_array[$day]=$qtdd_litros; ?></td>
    <td align="right">
	<?php echo converter_numero_moeda_3($vqtdd_litros = $row_list_include['leite_valor_estimado_soma']);
	 $vqtdd_litros_array[$day]=$vqtdd_litros; ?></td>
    <td align="right"><?php
	if($row_list_include['leite_valor_estimado_soma']==0){$leite_valor_estimado_soma=1;}else{$leite_valor_estimado_soma=$row_list_include['leite_valor_estimado_soma'];}
	
	echo  converter_numero_moeda_3($faturado = $receita=$row_list_include['leite_qtdd_soma']*$leite_valor_estimado_soma);
	  $faturado_array[$day]= $faturado;
	
	 ?></td>
    <td align="right">
    <?php include("../sma_relatorios_leite/relatorios_manejo_animal_diario_alimentacao_concentrado.php"); ?>
      <?php 
	  echo converter_numero_moeda_3($kilo_animal_soma=$row_list_alimentacao['kilo_animal_soma']);
	  $kilo_animal_soma_q_concentrado_array[$day]=$row_list_alimentacao['kilo_animal_soma']; 
	  ?>
    
    </td>
    <td align="right"><?php
	 echo converter_numero_moeda_3($valor_total_soma=$row_list_alimentacao['valor_total_soma']);
	 $valor_total_soma_c_concentrado_array[$day]=$valor_total_soma;
	  ?></td>
    <td align="right"><?php include("../sma_relatorios_leite/relatorios_manejo_animal_diario_alimentacao_volumoso.php"); ?>
      <?php 
	  echo converter_numero_moeda_3($kilo_animal_soma=$row_list_alimentacao['kilo_animal_soma']);
	   $kilo_animal_soma_q_volumoso_array[$day]=$kilo_animal_soma;?></td>
    <td align="right">
	<?php 
	echo converter_numero_moeda_3($valor_total_soma=$row_list_alimentacao['valor_total_soma']);
	$valor_total_soma_c_volumoso_array[$day]=$valor_total_soma ?>
    </td>
    <td align="right"><?php include("../sma_relatorios_leite/relatorios_manejo_animal_diario_alimentacao_mineral.php"); ?>
      <?php echo  converter_numero_moeda_3($row_list_alimentacao['kilo_animal_soma']);
	  $kilo_animal_soma__q_mineral_array[$day]=$row_list_alimentacao['kilo_animal_soma'] ?></td>
    <td align="right">
	<?php echo converter_numero_moeda_3($row_list_alimentacao['valor_total_soma']);
	$valor_total_soma_c_mineal_array[$day]=$row_list_alimentacao['valor_total_soma'] ?>
    </td>
    <td align="right"><?php include("relatorios_manejo_animal_diario_alimentacao.php"); ?>
      <?php echo converter_numero_moeda_3($row_list_alimentacao['valor_total_soma']);
	  $custo_alimentacao_array[$day]=$row_list_alimentacao['valor_total_soma'];
	  ?></td>
    <td align="right"><?php include("../sma_relatorios_leite/relatorios_manejo_animal_diario_custo_mao_obra.php"); ?>
	<?php echo converter_numero_moeda_3($row_list_custo_mo_mo['valor_animais_dia_soma']); 
	$custo_mao_obra_array[$day]=$row_list_custo_mo_mo['valor_animais_dia_soma'] ?></td>
    <td align="right"><?php include("../sma_relatorios_leite/relatorios_manejo_animal_diario_medicamento.php"); ?>
    <?php echo converter_numero_moeda_3($row_list_medicamento['custo_medicamento_soma']);
	$custo_medicamento_array[$day]=$row_list_medicamento['custo_medicamento_soma']; 
?></td>
    <td align="right"><?php include("../sma_relatorios_leite/relatorios_manejo_animal_diario_custo.php"); ?>
    <?php echo converter_numero_moeda_3($row_list_custo['valor_animais_dia_soma']); 
	
	$custo_outros_array[$day]=$row_list_custo['valor_animais_dia_soma'];
	?></td>
    <td align="right">
	<?php 
	/*
	echo $row_list_custo['valor_animais_dia_soma']."/";
	echo $row_list_custo_mo_mo['valor_animais_dia_soma']."/";
	echo $row_list_alimentacao['valor_total_soma']."/";
	echo $row_list_medicamento['custo_medicamento_soma']."/";
	*/
	
	  $total_custo= $row_list_custo['valor_animais_dia_soma']+ $row_list_custo_mo_mo['valor_animais_dia_soma'] +$row_list_alimentacao['valor_total_soma']+ $row_list_medicamento['custo_medicamento_soma']; ?>
	<?php
	echo converter_numero_moeda_3($total_custo); 
	$total_custo_array[$day]=$total_custo; 
	?></td>
    <td align="right">
	<?php

	 echo converter_numero_moeda_3($custo_litro=$total_custo/$leite_qtdd_soma); 
	 $custo_litro_array[$day]=$total_custo/$leite_qtdd_soma; ?>
    </td>
    <td align="right"><?php echo  converter_numero_moeda_3($relatorio_litros=$row_list_include['leite_valor_estimado_soma']-$custo_litro);
	$relatorio_litros_array[$day]=$relatorio_litros;
	 ?></td>
    <td align="right"><?php
	 echo  converter_numero_moeda_3($relatorio_dia=$receita-$total_custo); 
	 $relatorio_dia_array[$day]=$relatorio_dia;
	 ?></td>
    </tr> <?php   $l++; if($l>2){   $l=1;}?>
  <?php   $nDias++;  }?>
 
<?php  } ?> 
   
 <tr class="rel_info">
  <td colspan="18">&nbsp;</td>
  </tr>
</table>
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="rel_table">
  <tr class="rel_opcoes">
    <td  title="MÉTODO" width="3%">M</td>
    <td  class="coluna_titulo" width="13%" >QTDD/LISTROS</td>
    <td  class="coluna_titulo" width="13%" >V.VENDA/LITROS</td>
    <td  class="coluna_titulo" width="13%" >FATURADO</td>
    <td  class="coluna_titulo" width="13%">QTD/CONCENTRADO</td>
    <td  class="coluna_titulo" width="13%" >CUSTO/CONCENTRADO</td>
    <td  class="coluna_titulo" width="13%" >QTD/VOLUMOSO</td>
    <td  class="coluna_titulo" width="13%">CUSTO/VOLUMOSO</td>
    <td  class="coluna_titulo" width="13%" >QTD/MINERAL</td>
    <td  class="coluna_titulo" width="13%" >CUSTO/MINERAL</td>
    <td  class="coluna_titulo" width="13%" >C.ALIMENTAÇÃO</td>
    <td  class="coluna_titulo" width="13%" >C.MÃO/OBRA</td>
    <td  class="coluna_titulo" width="13%" >C.MED</td>
    <td  class="coluna_titulo" width="13%" >C.OUTROS</td>
    <td  class="coluna_titulo" width="13%" >TOTAL-CUST0 </td>
    <td  class="coluna_titulo" width="13%" >CUSTO/LITRO</td>
    <td  class="coluna_titulo" width="13%">RENTAB/LITRO</td>
    <td  class="coluna_titulo" width="13%" >RENTAB/DIAS</td>
  </tr>
  <tr class="linha1">
    <td title="SOMA">&nbsp;&nbsp;S</td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($qtdd_litros_array));?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($vqtdd_litros_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($faturado_array));?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($kilo_animal_soma_q_concentrado_array)); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($valor_total_soma_c_concentrado_array)); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($kilo_animal_soma_q_volumoso_array)); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($valor_total_soma_c_volumoso_array)); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($kilo_animal_soma__q_mineral_array));?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($valor_total_soma_c_mineal_array)); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_alimentacao_array));?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_mao_obra_array));?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_medicamento_array));?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_outros_array));?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($total_custo_array));?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_litro_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($relatorio_litros_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($relatorio_dia_array));?></td>
  </tr>
  <tr class="linha2" title="MÉDIA POR <?php echo $nDias; ?>DIAS">
    <td>&nbsp;&nbsp;M</td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($qtdd_litros_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($vqtdd_litros_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($faturado_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($kilo_animal_soma_q_concentrado_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($valor_total_soma_c_concentrado_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($kilo_animal_soma_q_volumoso_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($valor_total_soma_c_volumoso_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($kilo_animal_soma__q_mineral_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($valor_total_soma_c_mineal_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_alimentacao_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_mao_obra_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_medicamento_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_outros_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($total_custo_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($custo_litro_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($relatorio_litros_array)/$nDias);?></td>
    <td align="right"><?php echo converter_numero_moeda_3(array_sum($relatorio_dia_array)/$nDias);?></td>
  </tr>
  <tr>
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
</body>
</html>
<?php
mysql_free_result($list_acao);
?>
