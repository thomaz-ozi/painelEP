<?php require_once('../Connections/connection.php'); ?>
<?php require_once ("../sistema_funcoes/converter_utf8.php");?>
<?php 
include ("../sistema_funcoes/calPediodoDatas.php");
include "../sistema_funcoes/converte_datas_horas.php";
?>

<?php 
	$_POST['id_usuario']= $_SESSION['MM_UserGroup'];
	
	$_POST['RegistroDataAlterado']=date(Y.'-'.m.'-'.d.' '.H.':'.i.':'.s);
	$_POST['DataRegistroFotos']=date(Y.'-'.m.'-'.d.' '.H.':'.i.':'.s);
	
	require_once ("../sistema_funcoes/converte_datas.php");
	$_POST['DataNascimento']=converte_data($_POST['DataNascimento']);

	

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
	 $updateSQL = sprintf("UPDATE tbMod_canditados SET Nome=%s, DataNascimento=%s, Objetivo=%s, NFilhos=%s, IdadeFilhos=%s, Escolaridade=%s, EstadoCivil=%s, Endereco=%s, Endereco_nro=%s, Bairro=%s, Cidade=%s, Estado=%s, CEP=%s, Telefone1=%s, Telefone2=%s, Telefone3=%s, EMail=%s, CPF=%s, RG=%s, CNH=%s, FaseProva=%s, FaseEntrevista=%s, FaseTreinamento=%s, FaseExIEP=%s, id_usuario=%s, RegistroDataAlterado=%s WHERE Codigo=%s",
                       GetSQLValueString($_POST['Nome'], "text"),
                       GetSQLValueString($_POST['DataNascimento'], "date"),
                       GetSQLValueString($_POST['Objetivo'], "text"),
                       GetSQLValueString($_POST['NFilhos'], "text"),
                       GetSQLValueString($_POST['IdadeFilhos'], "text"),
                       GetSQLValueString($_POST['Escolaridade'], "text"),
                       GetSQLValueString($_POST['EstadoCivil'], "text"),
                       GetSQLValueString($_POST['Endereco'], "text"),
					   GetSQLValueString($_POST['Endereco_nro'], "text"),
                       GetSQLValueString($_POST['Bairro'], "text"),
                       GetSQLValueString($_POST['Cidade'], "text"),
                       GetSQLValueString($_POST['Estado'], "text"),
                       GetSQLValueString($_POST['CEP'], "text"),
                       GetSQLValueString($_POST['Telefone1'], "text"),
                       GetSQLValueString($_POST['Telefone2'], "text"),
                       GetSQLValueString($_POST['Telefone3'], "text"),
                       GetSQLValueString($_POST['EMail'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['RG'], "text"),
                       GetSQLValueString($_POST['CNH'], "text"),
					   
					   GetSQLValueString($_POST['FaseProva'], "int"),
					   GetSQLValueString($_POST['FaseEntrevista'], "int"),
					   GetSQLValueString($_POST['FaseTreinamento'], "int"),
					   GetSQLValueString($_POST['FaseExIEP'], "int"),
					   
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['RegistroDataAlterado'], "date"),
                       GetSQLValueString($_POST['Codigo'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
   include ("../mod_iep_candidatos/fotos_acao_add.php");
}





 	//include ("../mod_iep_candidatos/acao_comum_emprego_add.php");
	include ("../mod_iep_candidatos/acao_comum_obser_add.php");

/*list_acao - inicio*/
//convertando para ajax
if($_POST[PesquisaAvancadaColunas]==''){$_POST[PesquisaAvancadaColunas]='Codigo';  $_POST[xPesq]=$_GET[Codigo];}	
	//opcoes de campos
	
	$colunaSQL;
	
	switch ($_POST[PesquisaAvancadaColunas]){
		case 'Observacoes':
			$tbSQL=vwnext_candidatosCompleto;
		break;
		case 'telefones':
			$tbSQL=vwnext_candidatosCompleto;
		break;
		case 'todos':
			$tbSQL=vwnext_candidatosCompleto;
		break;
		case 'Idade':
			$tbSQL=vwnext_candidatosCompleto;
		break;

		case 'RegistroData':
			$_POST['xPesq']=converte_data($_POST['xPesq']);
			$tbSQL='tbMod_canditados';
			$colunaSQL='data';
		break;
		
		case 'RegistroDataAlterado':
			$_POST['xPesq']=converte_data($_POST['xPesq']);
			$tbSQL='tbMod_canditados';
			$colunaSQL='data';
		break;


		default;
			$tbSQL='tbMod_canditados';

		break;
		}
	
switch ($colunaSQL){
	case 'ano':
 		$coluna=" YEAR(". $_POST[PesquisaAvancadaColunas].")='". $_POST[xPesq]."'";
		break;
	case 'data':
 		$coluna=" DATE(". $_POST[PesquisaAvancadaColunas].")='". $_POST[xPesq]."'";
		break;
	
	default;
 	$coluna=$_POST[PesquisaAvancadaColunas]." LIKE '%". $_POST[xPesq]."%' ";
 	break;
}


/*iniciando Pesquisa*/
$maxRows_list_acao = 1;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM ".$tbSQL." WHERE ".$coluna." ";
$query_limit_list_acao = sprintf("%s LIMIT %d, %d", $query_list_acao, $startRow_list_acao, $maxRows_list_acao);
$list_acao = mysql_query($query_limit_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);

if (isset($_GET['totalRows_list_acao'])) {
  $totalRows_list_acao = $_GET['totalRows_list_acao'];
} else {
  $all_list_acao = mysql_query($query_list_acao);
  $totalRows_list_acao = mysql_num_rows($all_list_acao);
}
$totalPages_list_acao = ceil($totalRows_list_acao/$maxRows_list_acao)-1;


/*list_acao - fim*/

$_GET['Codigo']=$row_list_acao['Codigo'];

/*list_objetivos - inicio*/
mysql_select_db($database_connection, $connection);
$query_list_objetivos = "SELECT * FROM tbMod_canditadosObjet ORDER BY Objetivo ASC";
$list_objetivos = mysql_query($query_list_objetivos, $connection) or die(mysql_error());
$row_list_objetivos = mysql_fetch_assoc($list_objetivos);
$totalRows_list_objetivos = mysql_num_rows($list_objetivos);

/*list_objetivos - fim*/




/*list_acao_observaca - inicio*/
$maxRows_list_acao_observacao = 10;
$pageNum_list_acao_observacao = 0;
if (isset($_GET['pageNum_list_acao_observacao'])) {
  $pageNum_list_acao_observacao = $_GET['pageNum_list_acao_observacao'];
}
$startRow_list_acao_observacao = $pageNum_list_acao_observacao * $maxRows_list_acao_observacao;

$colname_list_acao_observacao = "-1";
if (isset($_GET['Codigo'])) {
  $colname_list_acao_observacao = $_GET['Codigo'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao_observacao = sprintf("SELECT * FROM tbMod_canditadosObser WHERE Codigo = %s", GetSQLValueString($colname_list_acao_observacao, "int"));
$query_limit_list_acao_observacao = sprintf("%s LIMIT %d, %d", $query_list_acao_observacao, $startRow_list_acao_observacao, $maxRows_list_acao_observacao);
$list_acao_observacao = mysql_query($query_limit_list_acao_observacao, $connection) or die(mysql_error());
$row_list_acao_observacao = mysql_fetch_assoc($list_acao_observacao);

if (isset($_GET['totalRows_list_acao_observacao'])) {
  $totalRows_list_acao_observacao = $_GET['totalRows_list_acao_observacao'];
} else {
  $all_list_acao_observacao = mysql_query($query_list_acao_observacao);
  $totalRows_list_acao_observacao = mysql_num_rows($all_list_acao_observacao);
}
$totalPages_list_acao_observacao = ceil($totalRows_list_acao_observacao/$maxRows_list_acao_observacao)-1;
/*list_acao_observaca - fim*/

/*list_acao_emprego - inicio*/
$colname_list_acao_emprego = "-1";
if (isset($_GET['Codigo'])) {
  $colname_list_acao_emprego = $_GET['Codigo'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao_emprego = sprintf("SELECT * FROM tbMod_canditadosEmprego WHERE Codigo = %s ORDER BY EmpregoDataSaida ASC", GetSQLValueString($colname_list_acao_emprego, "int"));
$list_acao_emprego = mysql_query($query_list_acao_emprego, $connection) or die(mysql_error());
$row_list_acao_emprego = mysql_fetch_assoc($list_acao_emprego);
$totalRows_list_acao_emprego = mysql_num_rows($list_acao_emprego);


/*list_acao_emprego - fim*/





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>print_ex.jpg</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">td img {display: block;}</style>
<!--Fireworks CS6 Dreamweaver CS6 target.  Created Wed Dec 06 09:35:02 GMT-0200 2017-->
<link rel="stylesheet" type="text/css" href="print.css"/>
<script>
function myFunction() {
    window.print();
}
</script>
</head>
<body bgcolor="#ffffff" onload="myFunction()">
<table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="703">
<!-- fwtable fwsrc="print_doc2.fw.png" fwpage="Page 1" fwbase="print_ex.jpg" fwstyle="Dreamweaver" fwdocid = "1132624875" fwnested="0" -->
  <tr>
   <td><img src="print/spacer.gif" width="12" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="63" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="16" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="12" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="30" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="3" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="19" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="10" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="18" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="10" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="26" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="8" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="11" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="18" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="17" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="21" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="19" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="5" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="8" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="5" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="5" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="6" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="6" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="33" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="22" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="7" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="29" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="5" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="9" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="5" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="16" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="19" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="23" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="3" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="10" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="8" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="67" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="60" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="14" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="10" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
  </tr>

  <tr>
   <td colspan="50"><img name="print_ex_r1_c1" src="print/print_ex_r1_c1.jpg" width="703" height="123" id="print_ex_r1_c1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="123" alt="" /></td>
  </tr>
  <tr>
   <td colspan="3" rowspan="24" valign="top"><img name="print_ex_r2_c1" src="print/print_ex_r2_c1.jpg" width="77" height="453" id="print_ex_r2_c1" alt="" /></td>
   <td colspan="3"><?php echo $row_list_acao['Codigo'];  ?></td>
   <td rowspan="2" colspan="6"><img name="print_ex_r2_c7" src="print/print_ex_r2_c7.jpg" width="62" height="31" id="print_ex_r2_c7" alt="" /></td>
   <td colspan="31">&nbsp;<?php echo convert_utf8($row_list_acao['Nome']); ?></td>
   <td rowspan="12"><img name="print_ex_r2_c44" src="print/print_ex_r2_c44.jpg" width="10" height="206" id="print_ex_r2_c44" alt="" /></td>
   <td rowspan="9" colspan="5">            
   <img src="../mod_iep_candidatos/acao_imagem.php?codigo=<?php echo $_GET['Codigo']; ?>" class="img-responsive img-thumbnail " alt="Imagem do Cantidato" width="151" ></div>
</td>
   <td rowspan="26"><img name="print_ex_r2_c50" src="print/print_ex_r2_c50.jpg" width="10" height="480" id="print_ex_r2_c50" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="3"><img name="print_ex_r3_c4" src="print/print_ex_r3_c4.jpg" width="58" height="8" id="print_ex_r3_c4" alt="" /></td>
   <td colspan="31"><img name="print_ex_r3_c13" src="print/print_ex_r3_c13.jpg" width="335" height="8" id="print_ex_r3_c13" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="16">&nbsp; <?php echo $row_list_acao['Objetivo'];?></td>
   <td rowspan="2" colspan="10"><img name="print_ex_r4_c20" src="print/print_ex_r4_c20.jpg" width="84" height="31" id="print_ex_r4_c20" alt="" /></td>
   <td colspan="4">&nbsp;<?php echo $DataNascimento=converte_data($row_list_acao['DataNascimento']); ?></td>
   <td rowspan="4" colspan="5"><img name="print_ex_r4_c34" src="print/print_ex_r4_c34.jpg" width="51" height="62" id="print_ex_r4_c34" alt="" /></td>
   <td colspan="5">&nbsp;<?php $dataAgora=date(Y."-".m."-".d); echo periodoDataAno($row_list_acao['DataNascimento'],$dataAgora); ?></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="16"><img name="print_ex_r5_c4" src="print/print_ex_r5_c4.jpg" width="187" height="8" id="print_ex_r5_c4" alt="" /></td>
   <td rowspan="3" colspan="4"><img name="print_ex_r5_c30" src="print/print_ex_r5_c30.jpg" width="67" height="39" id="print_ex_r5_c30" alt="" /></td>
   <td rowspan="5" colspan="5"><img name="print_ex_r5_c39" src="print/print_ex_r5_c39.jpg" width="66" height="70" id="print_ex_r5_c39" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2">&nbsp;<?php echo $row_list_acao['NFilhos'];?></td>
   <td rowspan="2" colspan="5"><img name="print_ex_r6_c6" src="print/print_ex_r6_c6.jpg" width="64" height="31" id="print_ex_r6_c6" alt="" /></td>
   <td colspan="14">&nbsp;<?php echo $row_list_acao['IdadeFilhos']; ?></td>
   <td rowspan="2" colspan="5"><img name="print_ex_r6_c25" src="print/print_ex_r6_c25.jpg" width="25" height="31" id="print_ex_r6_c25" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2"><img name="print_ex_r7_c4" src="print/print_ex_r7_c4.jpg" width="28" height="8" id="print_ex_r7_c4" alt="" /></td>
   <td colspan="14"><img name="print_ex_r7_c11" src="print/print_ex_r7_c11.jpg" width="154" height="8" id="print_ex_r7_c11" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="13">&nbsp;<?php echo  convert_utf8($row_list_acao['Escolaridade']); ?></td>
   <td rowspan="2" colspan="5"><img name="print_ex_r8_c17" src="print/print_ex_r8_c17.jpg" width="69" height="31" id="print_ex_r8_c17" alt="" /></td>
   <td colspan="16">&nbsp;<?php echo convert_utf8($row_list_acao['EstadoCivil']); ?></td>
   <td rowspan="2"><img name="print_ex_r8_c38" src="print/print_ex_r8_c38.jpg" width="9" height="31" id="print_ex_r8_c38" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="13"><img name="print_ex_r9_c4" src="print/print_ex_r9_c4.jpg" width="156" height="8" id="print_ex_r9_c4" alt="" /></td>
   <td colspan="16"><img name="print_ex_r9_c22" src="print/print_ex_r9_c22.jpg" width="155" height="8" id="print_ex_r9_c22" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="8">&nbsp;<?php echo $row_list_acao['CPF']; ?></td>
   <td rowspan="4" colspan="6"><img name="print_ex_r10_c12" src="print/print_ex_r10_c12.jpg" width="57" height="82" id="print_ex_r10_c12" alt="" /></td>
   <td colspan="13">&nbsp;<?php echo $row_list_acao['RG']; ?></td>
   <td rowspan="4" colspan="5"><img name="print_ex_r10_c31" src="print/print_ex_r10_c31.jpg" width="69" height="82" id="print_ex_r10_c31" alt="" /></td>
   <td colspan="8">&nbsp;<?php echo $row_list_acao['CNH']; ?></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="8"><img name="print_ex_r11_c4" src="print/print_ex_r11_c4.jpg" width="110" height="28" id="print_ex_r11_c4" alt="" /></td>
   <td rowspan="3" colspan="13"><img name="print_ex_r11_c18" src="print/print_ex_r11_c18.jpg" width="110" height="59" id="print_ex_r11_c18" alt="" /></td>
   <td rowspan="3" colspan="8"><img name="print_ex_r11_c36" src="print/print_ex_r11_c36.jpg" width="109" height="59" id="print_ex_r11_c36" alt="" /></td>
   <td rowspan="3" colspan="5"><img name="print_ex_r11_c45" src="print/print_ex_r11_c45.jpg" width="151" height="59" id="print_ex_r11_c45" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="28" alt="" /></td>
  </tr>
  <tr>
   <td colspan="8">&nbsp;<?php echo $row_list_acao['CEP']; ?></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="8"><img name="print_ex_r13_c4" src="print/print_ex_r13_c4.jpg" width="110" height="8" id="print_ex_r13_c4" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="17">&nbsp;<?php echo convert_utf8($row_list_acao['Endereco']); ?></td>
   <td rowspan="2" colspan="11"><img name="print_ex_r14_c21" src="print/print_ex_r14_c21.jpg" width="79" height="31" id="print_ex_r14_c21" alt="" /></td>
   <td>&nbsp;<?php echo convert_utf8($row_list_acao['Endereco_nro']); ?></td>
   <td rowspan="4" colspan="7"><img name="print_ex_r14_c33" src="print/print_ex_r14_c33.jpg" width="78" height="83" id="print_ex_r14_c33" alt="" /></td>
   <td colspan="7">&nbsp;<?php echo convert_utf8($row_list_acao['Bairro']); ?></td>
   <td rowspan="8" colspan="3"><img name="print_ex_r14_c47" src="print/print_ex_r14_c47.jpg" width="76" height="166" id="print_ex_r14_c47" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="17"><img name="print_ex_r15_c4" src="print/print_ex_r15_c4.jpg" width="204" height="8" id="print_ex_r15_c4" alt="" /></td>
   <td rowspan="7"><img name="print_ex_r15_c32" src="print/print_ex_r15_c32.jpg" width="33" height="143" id="print_ex_r15_c32" alt="" /></td>
   <td rowspan="3" colspan="7"><img name="print_ex_r15_c40" src="print/print_ex_r15_c40.jpg" width="146" height="60" id="print_ex_r15_c40" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="10">&nbsp;<?php echo convert_utf8($row_list_acao['Cidade']); ?></td>
   <td rowspan="2" colspan="9"><img name="print_ex_r16_c14" src="print/print_ex_r16_c14.jpg" width="80" height="52" id="print_ex_r16_c14" alt="" /></td>
   <td colspan="4">&nbsp;<?php echo convert_utf8($row_list_acao['Estado']); ?></td>
   <td rowspan="6" colspan="5"><img name="print_ex_r16_c27" src="print/print_ex_r16_c27.jpg" width="24" height="135" id="print_ex_r16_c27" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="10"><img name="print_ex_r17_c4" src="print/print_ex_r17_c4.jpg" width="146" height="29" id="print_ex_r17_c4" alt="" /></td>
   <td colspan="4"><img name="print_ex_r17_c23" src="print/print_ex_r17_c23.jpg" width="33" height="29" id="print_ex_r17_c23" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="29" alt="" /></td>
  </tr>
  <tr>
   <td colspan="6">&nbsp;<?php echo $row_list_acao['Telefone1']; ?></td>
   <td rowspan="2" colspan="9"><img name="print_ex_r18_c10" src="print/print_ex_r18_c10.jpg" width="79" height="35" id="print_ex_r18_c10" alt="" /></td>
   <td colspan="8">&nbsp;<?php echo $row_list_acao['Telefone2']; ?></td>
   <td rowspan="4" colspan="2"><img name="print_ex_r18_c33" src="print/print_ex_r18_c33.jpg" width="23" height="83" id="print_ex_r18_c33" alt="" /></td>
   <td colspan="7">&nbsp;<?php echo $row_list_acao['Telefone3']; ?></td>
   <td rowspan="4" colspan="5"><img name="print_ex_r18_c42" src="print/print_ex_r18_c42.jpg" width="111" height="83" id="print_ex_r18_c42" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="6"><img name="print_ex_r19_c4" src="print/print_ex_r19_c4.jpg" width="90" height="12" id="print_ex_r19_c4" alt="" /></td>
   <td colspan="8"><img name="print_ex_r19_c19" src="print/print_ex_r19_c19.jpg" width="90" height="12" id="print_ex_r19_c19" alt="" /></td>
   <td rowspan="3" colspan="7"><img name="print_ex_r19_c35" src="print/print_ex_r19_c35.jpg" width="90" height="60" id="print_ex_r19_c35" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="12" alt="" /></td>
  </tr>
  <tr>
   <td colspan="23">&nbsp;<?php echo $row_list_acao['EMail']; ?></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="23"><img name="print_ex_r21_c4" src="print/print_ex_r21_c4.jpg" width="259" height="25" id="print_ex_r21_c4" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="25" alt="" /></td>
  </tr>
  <tr>
   <td colspan="17">&nbsp;<?php echo convert_utf8($row_list_acao_emprego['EmpregoEmpresa']); ?></td>
   <td rowspan="2" colspan="7"><img name="print_ex_r22_c21" src="print/print_ex_r22_c21.jpg" width="60" height="31" id="print_ex_r22_c21" alt="" /></td>
   <td colspan="13">&nbsp;<?php echo convert_utf8($row_list_acao_emprego['EmpregoCargo']); ?></td>
   <td rowspan="2" colspan="5"><img name="print_ex_r22_c41" src="print/print_ex_r22_c41.jpg" width="63" height="31" id="print_ex_r22_c41" alt="" /></td>
   <td colspan="4">&nbsp;</td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="17"><img name="print_ex_r23_c4" src="print/print_ex_r23_c4.jpg" width="204" height="8" id="print_ex_r23_c4" alt="" /></td>
   <td colspan="13"><img name="print_ex_r23_c28" src="print/print_ex_r23_c28.jpg" width="146" height="8" id="print_ex_r23_c28" alt="" /></td>
   <td rowspan="5" colspan="4"><img name="print_ex_r23_c46" src="print/print_ex_r23_c46.jpg" width="143" height="85" id="print_ex_r23_c46" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="6">&nbsp;<?php echo $row_list_acao_emprego['EmpregoCidade']; ?></td>
   <td rowspan="2" colspan="9"><img name="print_ex_r24_c10" src="print/print_ex_r24_c10.jpg" width="79" height="50" id="print_ex_r24_c10" alt="" /></td>
   <td colspan="8">&nbsp;<?php echo converte_data($row_list_acao_emprego['EmpregoDataEntreda']); ?></td>
   <td rowspan="2" colspan="8"><img name="print_ex_r24_c27" src="print/print_ex_r24_c27.jpg" width="80" height="50" id="print_ex_r24_c27" alt="" /></td>
   <td colspan="7">&nbsp;<?php echo converte_data($row_list_acao_emprego['EmpregoDataSaida']); ?></td>
   <td rowspan="4" colspan="4"><img name="print_ex_r24_c42" src="print/print_ex_r24_c42.jpg" width="44" height="77" id="print_ex_r24_c42" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="6"><img name="print_ex_r25_c4" src="print/print_ex_r25_c4.jpg" width="90" height="27" id="print_ex_r25_c4" alt="" /></td>
   <td colspan="8"><img name="print_ex_r25_c19" src="print/print_ex_r25_c19.jpg" width="90" height="27" id="print_ex_r25_c19" alt="" /></td>
   <td rowspan="3" colspan="7"><img name="print_ex_r25_c35" src="print/print_ex_r25_c35.jpg" width="90" height="54" id="print_ex_r25_c35" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="27" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="2"><img name="print_ex_r26_c1" src="print/print_ex_r26_c1.jpg" width="75" height="27" id="print_ex_r26_c1" alt="" /></td>
   <td colspan="2"><img name="print_ex_r26_c3" src="print/print_ex_r26_c3.jpg" width="18" height="18" id="print_ex_r26_c3" alt="" /></td>
   <td rowspan="2" colspan="3"><img name="print_ex_r26_c5" src="print/print_ex_r26_c5.jpg" width="45" height="27" id="print_ex_r26_c5" alt="" /></td>
   <td><img name="print_ex_r26_c8" src="print/print_ex_r26_c8.jpg" width="19" height="18" id="print_ex_r26_c8" alt="" /></td>
   <td rowspan="2" colspan="6"><img name="print_ex_r26_c9" src="print/print_ex_r26_c9.jpg" width="67" height="27" id="print_ex_r26_c9" alt="" /></td>
   <td colspan="3"><img name="print_ex_r26_c15" src="print/print_ex_r26_c15.jpg" width="20" height="18" id="print_ex_r26_c15" alt="" /></td>
   <td rowspan="2" colspan="8"><img name="print_ex_r26_c18" src="print/print_ex_r26_c18.jpg" width="84" height="27" id="print_ex_r26_c18" alt="" /></td>
   <td colspan="3"><img name="print_ex_r26_c26" src="print/print_ex_r26_c26.jpg" width="18" height="18" id="print_ex_r26_c26" alt="" /></td>
   <td rowspan="2" colspan="6"><img name="print_ex_r26_c29" src="print/print_ex_r26_c29.jpg" width="70" height="27" id="print_ex_r26_c29" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="18" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2"><img name="print_ex_r27_c3" src="print/print_ex_r27_c3.jpg" width="18" height="9" id="print_ex_r27_c3" alt="" /></td>
   <td><img name="print_ex_r27_c8" src="print/print_ex_r27_c8.jpg" width="19" height="9" id="print_ex_r27_c8" alt="" /></td>
   <td colspan="3"><img name="print_ex_r27_c15" src="print/print_ex_r27_c15.jpg" width="20" height="9" id="print_ex_r27_c15" alt="" /></td>
   <td colspan="3"><img name="print_ex_r27_c26" src="print/print_ex_r27_c26.jpg" width="18" height="9" id="print_ex_r27_c26" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="9" alt="" /></td>
  </tr>
  <tr>
   <td colspan="50"><img name="print_ex_r28_c1" src="print/print_ex_r28_c1.jpg" width="703" height="10" id="print_ex_r28_c1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="10" alt="" /></td>
  </tr>
  <?php do { ?>
  
   <?php
 $str = 'dfgdfgdfgdfgdfgdfgfdgdfgfdgfdgdfgdfgdfgdfgdfgsdfgsdfgdsfgndsfkjgkjdsfhgkjhdsfkjghdsfkjgh dfkjghkdfj hgkjsdfhgkjdsfh gkjdsfhkgjhdf kjghdfskljgh sdfkjghkjdsfhgkjdsfhgkjdsf gkjd sfkjghdfkjgh hdskfjghkjdf gkjdfshg kjdfsg dsfkgh dfkgdfkjg hkdjfhgkjdsfhgk kj dfgkjsd kg dkjg kjdfshh gkjdsfh hgkjdf kjg dfkjgdkjf kjdf gkd k dfkjg dfksjgh kjdfh gkjdf kjdfh kjdfh hgkj kdg kdjf gkjdfh ggkjsd hfgkjsdf kjghdfskjghkdfj kg sdkjhghkjdfh gkjhdf kjdhfkjg dfkjhg kjdf kjdf gkjh dfskj gdf hdfk ghdfkj dfkjgh kjdfhgkjdfs gkjsdfh gkjdf gkjd kjdfhgksjldhgkjjsdf ghkdjghkdsjfhgkjjsdfhgkjdsfhgkjdfhdfjkkdfkgsjdjgskfkgjfdhgklsdhgkjdjf kjdf kjdff kjdf kj gkjdsfhgkj dkjfgh dfkjh dfkg dfk dkfj gdkfj kdfj kdjf dkj kdjjf kjdf kd kjfdkgj sdfkhgskdjfh kdh dkh gkdfj hggkjd kjdf k df  kjhdsfkjhdfskj kjd fkjsd kjdfh kjdfh kjdjkfd';
 $text=strlen($str); // 7

switch ($text){

case ($text <= '100'):
	$textHeight='30';
break;
case ($text <= '200'):
	$textHeight='45';
break;
case ($text <= '400'):
	$textHeight='80';
break;
case ($text <= '800'):
	$textHeight='160';
break;
	
}
?>
  
  
  <tr>
   <td rowspan="2" ><img name="print_ex_r30_c1" src="print/print_ex_r30_c1.jpg" width="12" height="<?php echo $textHeight; ?>" id="print_ex_r30_c1" alt="" /></td>
   <td rowspan="2" colspan="47"><?php echo converte_data_horas($row_list_acao_observacao['DataRegistroObs']); ?> | <?php $id_usuario= $row_list_acao_observacao['id_usuario']; include "../sistema_usuario/list_usuario.php"; ?> <?php  echo $row_list_acao_usuario['nome']; ?> | <?php  //echo convert_utf8($row_list_acao_observacao['Observacoes']); ?> 
 <?php
echo $str;?>

   </td>
   <td colspan="2" rowspan="2"><img name="print_ex_r30_c49" src="print/print_ex_r30_c49.jpg" width="12" height="<?php echo $textHeight; ?>" id="print_ex_r30_c49" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
  <?php } while ($row_list_acao_observacao = mysql_fetch_assoc($list_acao_observacao)); ?>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="50"><img name="print_ex_r31_c1" src="print/print_ex_r31_c1.jpg" width="703" height="10" id="print_ex_r31_c1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="10" alt="" /></td>
  </tr>
  <tr>
   <td colspan="50"><img name="print_ex_r32_c1" src="print/print_ex_r32_c1.jpg" width="703" height="4" id="print_ex_r32_c1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="4" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="3"><img name="print_ex_r33_c1" src="print/print_ex_r33_c1.jpg" width="77" height="44" id="print_ex_r33_c1" alt="" /></td>
   <td colspan="12">&nbsp;<?php echo converte_data_horas($row_list_acao['RegistroData']);?></td>
   <td rowspan="2" colspan="8"><img name="print_ex_r33_c16" src="print/print_ex_r33_c16.jpg" width="79" height="44" id="print_ex_r33_c16" alt="" /></td>
   <td colspan="13">&nbsp;<?php echo converte_data_horas($row_list_acao['RegistroDataAlterado']); ?></td>
   <td rowspan="2" colspan="6"><img name="print_ex_r33_c37" src="print/print_ex_r33_c37.jpg" width="77" height="44" id="print_ex_r33_c37" alt="" /></td>
   <td colspan="5"><?php $id_usuario= $row_list_acao['id_usuario']; include "../sistema_usuario/list_usuario.php"; ?> <?php  echo $row_list_acao_usuario['nome']; ?></td>
   <td rowspan="2" colspan="3"><img name="print_ex_r33_c48" src="print/print_ex_r33_c48.jpg" width="26" height="44" id="print_ex_r33_c48" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="12"><img name="print_ex_r34_c4" src="print/print_ex_r34_c4.jpg" width="148" height="21" id="print_ex_r34_c4" alt="" /></td>
   <td colspan="13"><img name="print_ex_r34_c24" src="print/print_ex_r34_c24.jpg" width="148" height="21" id="print_ex_r34_c24" alt="" /></td>
   <td colspan="5"><img name="print_ex_r34_c43" src="print/print_ex_r34_c43.jpg" width="148" height="21" id="print_ex_r34_c43" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="21" alt="" /></td>
  </tr>
</table>
<div class="PrintTexto">&nbsp;&nbsp; Data da impressão: <?php echo date(d.'-'.m.'-'.Y.' '.H.':'.i.':'.s); ?> - Usuario: <?php echo $_SESSION['MM_Username'] ?> </div>
</body>
</html>
  <?php
  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
	mysql_free_result($list_select);
  }
  mysql_free_result($list_objetivos);

mysql_free_result($list_acao);

mysql_free_result($list_acao_observacao);

mysql_free_result($list_acao_emprego);


//mysql_free_result($list_foto);
?>