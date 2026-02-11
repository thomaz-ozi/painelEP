<?php
$relatorio_titulo="RELATÓRIO ANIMAIS RESTRITOS v:1.0";

if($_GET['id_ano']==""){ $_GET['id_ano']=date(Y);}
$ano=$_GET['id_ano'];

if($_GET['id_mes']==""){ $_GET['id_mes']=date(n);}
$mes=$_GET['id_mes'];


if($_GET['id_lactacao']==""){ $_GET['id_lactacao']=1;  }
if($_GET['id_lactacao']==2){ $SQLlactacao= "  lactacao='2' AND";}


switch($_GET['converter']){
	
	case 'xls':
		$filename='relatorio_c_restricao';
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

//------------------------------------------------->DATA DE HOJE
$ano=date(Y);
$mes=date(m);
$dia=date(d);
$data_resticao=$ano.$mes.$dia;

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

mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT 
a.cod_animal,
a.data,
a.restricao,
a.data_restricao
	FROM vwnext_relatorio_manejo_medicamento_restrito a 
	WHERE
 a.data_restricao>=".$data_resticao;
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
    <td width="128" align="center">
    <img src="../empresa_logo/logo_cabanha-126x64.png" alt="" width="84" height="42" /><div style="font-size:9px; text-align:center; width:100%;"><b><?php echo $relatorio_titulo; ?></b></div></td>
    <td width="117" align="center" ><div style="width:80px;">
       <div title="EXPORTA XLS" id="divXls"  onclick="goToURL('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=xls&%d%s", $currentPage,$ordem , $queryString_1); ?>')"></div>
    <div id="divHtml" onClick="MM_openBrWindow('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=pri&%d%s", $currentPage,$ordem , $queryString_1); ?>','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,height=768')"></div></div></td>
    <td >&nbsp;</td>
    <td width="468" ><input  name="cod_animal" type="text" class="form_pesquisa_input" id="cod_animal" value="<?php echo $_GET['cod_animal']; ?>" size="38" />
      <input type="submit" name="botao" id="botao" value="Pesquisar" /></td>
  </tr>
  <tr class="rel_informacoes">
    <td colspan="4" align="right"><br>
</td>
    </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="rel_table">
  <tr class="rel_opcoes" style="">
    <td width="19%" >COD</td>
    <td width="17%" class="coluna_titulo">DATA</td>
    <td width="27%" class="coluna_titulo">QTDD DIAS</td>
    <td width="37%" class="coluna_titulo">TERMINO DA RESTRIÇÃO</td>
    </tr>
  <?php $l=1;?>
<?php do { ?>
  <?php  include ("../sma_relatorios_leite/relatorios_manejo_animal_diario_leite.php");
  $leite_qtdd_soma_op=$row_list_include['leite_qtdd_soma'];
  if($_GET['id_lactacao']=='1'){$leite_qtdd_soma_op=1;}
?>
  <tr class="linha<?php   echo $l;  ?>">
    <td align="left">
          <div class="rel_cod_animal"
      onClick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_animal.php?cod_animal=<?php echo $row_list_acao['cod_animal']; ?>',
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
    <td align="right"><?php echo $row_list_acao['data']; ?></td>
    
      <td align="right"><?php echo $row_list_acao['restricao']; ?></td>
      <td align="right"><?php  $row_list_acao['data_restricao'];
	  
	echo  $ano = substr($row_list_acao['data_restricao'],0 ,4);
	echo "-";
	echo  $ano = substr($row_list_acao['data_restricao'],4 ,2);
	echo "-";
	echo  $ano = substr($row_list_acao['data_restricao'],6 ,2);
	  
	   ?></td>
     </tr> <?php   $l++; if($l>2){   $l=1;}?>
 
 <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
   
 <tr class="rel_info">
  <td colspan="4">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<?php
mysql_free_result($list_acao);
?>
