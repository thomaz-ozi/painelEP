<?php require_once('../Connections/connection.php'); ?>
<?php require_once ("../sistema_funcoes/converter_utf8.php");?>
<?php 
include ("../sistema_funcoes/calPediodoDatas.php");
include "../sistema_funcoes/converte_datas_horas.php";
?>
<?php include ("../sistema_funcoes/agoraDataHoras.php");?>
<?php include ("../sistema_funcoes/mask.php");?>
<?php 
	
	if (!isset($_SESSION)) {
  session_start();
 }
	
	$_POST['id_usuario']= $_SESSION['MM_UserGroup'];
	
	$_POST['RegistroDataAlterado']=agoraDataHoras();
	$_POST['DataRegistroFotos']=agoraDataHoras();
	
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
$query_list_acao_observacao = sprintf("SELECT * FROM tbMod_canditadosObser WHERE Codigo = %s ORDER BY DataRegistroObs DESC", GetSQLValueString($colname_list_acao_observacao, "int"));
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
<title>Candidato</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">td img {display: block;}</style>
<!-- Pluging css-->
<link rel="stylesheet" type="text/css" href="print.css"/>
<script>
function myPrint() {
    window.print();
}
</script>
</head>
<body bgcolor="#ffffff" onload="myPrint()">
<table style="display: inline-table; font-size: 12px;" border="0" cellpadding="0" cellspacing="0" width="703">
<!-- fwtable fwsrc="print_doc2.fw.png" fwpage="Page 1" fwbase="print_ex.jpg" fwstyle="Dreamweaver" fwdocid = "1132624875" fwnested="0" -->
  <tr>
   <td><img src="print/spacer.gif" width="12" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="63" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="16" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="12" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="33" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="17" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="12" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="21" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="7" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="9" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="18" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="8" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="11" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="16" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="42" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="19" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="5" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="8" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="10" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="5" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="22" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="24" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="19" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="10" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="14" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="10" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="5" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="9" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="40" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="5" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="18" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="3" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="10" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="13" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="48" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="74" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="14" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="2" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="9" height="1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="1" alt="" /></td>
  </tr>

  <tr>
   <td colspan="46"><img name="print_ex_r1_c1" src="print/print_ex_r1_c1.jpg" width="703" height="115" id="print_ex_r1_c1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="115" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="31" colspan="3"><img name="print_ex_r2_c1" src="print/print_ex_r2_c1.jpg" width="77" height="544" id="print_ex_r2_c1" alt="" /></td>
   <td colspan="4"><?php echo $Codigo=$row_list_acao['Codigo'];  ?></td>
   <td rowspan="3" colspan="4"><img name="print_ex_r2_c8" src="print/print_ex_r2_c8.jpg" width="57" height="56" id="print_ex_r2_c8" alt="" /></td>
   <td colspan="27" rowspan="2" align="left" valign="top"><?php echo convert_utf8($row_list_acao['Nome']); ?></td>
   <td rowspan="10"><img name="print_ex_r2_c39" src="print/print_ex_r2_c39.jpg" width="10" height="155" id="print_ex_r2_c39" alt="" /></td>
   <td rowspan="9" colspan="6">
	   		<?php 	
            
				mysql_select_db($database_connection, $connection);
				$query_list_fotos = "SELECT Foto,tipo FROM tbMod_canditadosFotos WHERE codigo ='". $Codigo ."'";
				$list_fotos = mysql_query($query_list_fotos, $connection) or die(mysql_error());
				$row_list_fotos = mysql_fetch_assoc($list_fotos);
				$totalRows_list_fotos = mysql_num_rows($list_fotos);

				if($row_list_fotos['tipo']!=""){

				// echo base64_encode($row_list_fotos['Foto']);	

					echo '<img src="data:' . $row_list_fotos['tipo'] . ';base64,'.base64_encode( $row_list_fotos['Foto'] ).'" class="img-responsive img-thumbnail " alt="Imagem do Cantidato" width="151px" style="width="151px"; height:auto; float:right;"/>';
				}

				mysql_free_result($list_fotos);
				
				?></td>
   <td rowspan="33"><img name="print_ex_r2_c46" src="print/print_ex_r2_c46.jpg" width="9" height="572" id="print_ex_r2_c46" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="4"><img name="print_ex_r3_c4" src="print/print_ex_r3_c4.jpg" width="63" height="33" id="print_ex_r3_c4" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="25" alt="" /></td>
  </tr>
  <tr>
   <td colspan="27"><img name="print_ex_r4_c12" src="print/print_ex_r4_c12.jpg" width="335" height="8" id="print_ex_r4_c12" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="16"><?php echo $row_list_acao['Objetivo'];?></td>
   <td rowspan="2" colspan="6"><img name="print_ex_r5_c20" src="print/print_ex_r5_c20.jpg" width="48" height="31" id="print_ex_r5_c20" alt="" /></td>
   <td colspan="4"><?php echo $DataNascimento=converte_data($row_list_acao['DataNascimento']); ?></td>
   <td rowspan="4" colspan="5"><img name="print_ex_r5_c30" src="print/print_ex_r5_c30.jpg" width="48" height="62" id="print_ex_r5_c30" alt="" /></td>
   <td colspan="4"><?php $dataAgora=date(Y."-".m."-".d); echo periodoDataAno($row_list_acao['DataNascimento'],$dataAgora); ?></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="16"><img name="print_ex_r6_c4" src="print/print_ex_r6_c4.jpg" width="226" height="8" id="print_ex_r6_c4" alt="" /></td>
   <td rowspan="3" colspan="4"><img name="print_ex_r6_c26" src="print/print_ex_r6_c26.jpg" width="67" height="39" id="print_ex_r6_c26" alt="" /></td>
   <td rowspan="6" colspan="4"><img name="print_ex_r6_c35" src="print/print_ex_r6_c35.jpg" width="66" height="76" id="print_ex_r6_c35" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2"><?php echo $row_list_acao['NFilhos'];?></td>
   <td rowspan="2" colspan="4"><img name="print_ex_r7_c6" src="print/print_ex_r7_c6.jpg" width="64" height="31" id="print_ex_r7_c6" alt="" /></td>
   <td colspan="12"><?php echo $row_list_acao['IdadeFilhos']; ?></td>
   <td rowspan="2" colspan="4"><img name="print_ex_r7_c22" src="print/print_ex_r7_c22.jpg" width="28" height="31" id="print_ex_r7_c22" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2"><img name="print_ex_r8_c4" src="print/print_ex_r8_c4.jpg" width="28" height="8" id="print_ex_r8_c4" alt="" /></td>
   <td colspan="12"><img name="print_ex_r8_c10" src="print/print_ex_r8_c10.jpg" width="154" height="8" id="print_ex_r8_c10" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="12"><?php echo  convert_utf8($row_list_acao['Escolaridade']); ?></td>
   <td rowspan="3" colspan="3"><img name="print_ex_r9_c16" src="print/print_ex_r9_c16.jpg" width="69" height="37" id="print_ex_r9_c16" alt="" /></td>
   <td colspan="15"><?php echo convert_utf8($row_list_acao['EstadoCivil']); ?></td>
   <td rowspan="3"><img name="print_ex_r9_c34" src="print/print_ex_r9_c34.jpg" width="9" height="37" id="print_ex_r9_c34" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="12"><img name="print_ex_r10_c4" src="print/print_ex_r10_c4.jpg" width="156" height="14" id="print_ex_r10_c4" alt="" /></td>
   <td rowspan="2" colspan="15"><img name="print_ex_r10_c19" src="print/print_ex_r10_c19.jpg" width="155" height="14" id="print_ex_r10_c19" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="6" alt="" /></td>
  </tr>
  <tr>
   <td colspan="6"><img name="print_ex_r11_c40" src="print/print_ex_r11_c40.jpg" width="152" height="8" id="print_ex_r11_c40" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><span class="mask_cpf"><?php echo mask($row_list_acao['CPF'],'###.###.###-##'); ?></span></td>
   <td rowspan="2" colspan="7"><img name="print_ex_r12_c11" src="print/print_ex_r12_c11.jpg" width="70" height="51" id="print_ex_r12_c11" alt="" /></td>
   <td colspan="9"><span class="mask_rg"><?php echo mask($row_list_acao['RG'],'##.###.###-#'); ?></span></td>
   <td rowspan="4" colspan="5"><img name="print_ex_r12_c27" src="print/print_ex_r12_c27.jpg" width="69" height="82" id="print_ex_r12_c27" alt="" /></td>
   <td colspan="9"><span class="mask_cnh"><?php echo  mask($row_list_acao['CNH'],'##.###.###-#') ?></span></td>
   <td rowspan="4" colspan="5"><img name="print_ex_r12_c41" src="print/print_ex_r12_c41.jpg" width="139" height="82" id="print_ex_r12_c41" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><img name="print_ex_r13_c4" src="print/print_ex_r13_c4.jpg" width="113" height="28" id="print_ex_r13_c4" alt="" /></td>
   <td rowspan="3" colspan="9"><img name="print_ex_r13_c18" src="print/print_ex_r13_c18.jpg" width="113" height="59" id="print_ex_r13_c18" alt="" /></td>
   <td rowspan="3" colspan="9"><img name="print_ex_r13_c32" src="print/print_ex_r13_c32.jpg" width="113" height="59" id="print_ex_r13_c32" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="28" alt="" /></td>
  </tr>
  <tr>
   <td colspan="9"><span class="mask_cep"><?php echo mask($row_list_acao['CEP'],'#####-###')?></span></td>
   <td rowspan="2" colspan="5"><img name="print_ex_r14_c13" src="print/print_ex_r14_c13.jpg" width="54" height="31" id="print_ex_r14_c13" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="9"><img name="print_ex_r15_c4" src="print/print_ex_r15_c4.jpg" width="129" height="8" id="print_ex_r15_c4" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="24"><?php echo convert_utf8($row_list_acao['Endereco']); ?></td>
   <td rowspan="2" colspan="3"><img name="print_ex_r16_c28" src="print/print_ex_r16_c28.jpg" width="31" height="31" id="print_ex_r16_c28" alt="" /></td>
   <td colspan="4"><?php echo convert_utf8($row_list_acao['Endereco_nro']); ?></td>
   <td rowspan="2" colspan="2"><img name="print_ex_r16_c35" src="print/print_ex_r16_c35.jpg" width="45" height="31" id="print_ex_r16_c35" alt="" /></td>
   <td colspan="8"><?php echo convert_utf8($row_list_acao['Bairro']); ?></td>
   <td rowspan="19"><img name="print_ex_r16_c45" src="print/print_ex_r16_c45.jpg" width="1" height="335" id="print_ex_r16_c45" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="24"><img name="print_ex_r17_c4" src="print/print_ex_r17_c4.jpg" width="320" height="8" id="print_ex_r17_c4" alt="" /></td>
   <td colspan="4"><img name="print_ex_r17_c31" src="print/print_ex_r17_c31.jpg" width="38" height="8" id="print_ex_r17_c31" alt="" /></td>
   <td rowspan="5" colspan="8"><img name="print_ex_r17_c37" src="print/print_ex_r17_c37.jpg" width="182" height="88" id="print_ex_r17_c37" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="33"><?php echo convert_utf8($row_list_acao['Complemento']); ?></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="33"><img name="print_ex_r19_c4" src="print/print_ex_r19_c4.jpg" width="434" height="8" id="print_ex_r19_c4" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="24"><?php echo convert_utf8($row_list_acao['Cidade']); ?></td>
   <td rowspan="4" colspan="3"><img name="print_ex_r20_c28" src="print/print_ex_r20_c28.jpg" width="31" height="80" id="print_ex_r20_c28" alt="" /></td>
   <td colspan="4"><?php echo convert_utf8($row_list_acao['Estado']); ?></td>
   <td rowspan="2" colspan="2"><img name="print_ex_r20_c35" src="print/print_ex_r20_c35.jpg" width="45" height="49" id="print_ex_r20_c35" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="24"><img name="print_ex_r21_c4" src="print/print_ex_r21_c4.jpg" width="320" height="26" id="print_ex_r21_c4" alt="" /></td>
   <td colspan="4"><img name="print_ex_r21_c31" src="print/print_ex_r21_c31.jpg" width="38" height="26" id="print_ex_r21_c31" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="26" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><?php echo $row_list_acao['Telefone1']; ?></td>
   <td rowspan="2" colspan="7"><img name="print_ex_r22_c11" src="print/print_ex_r22_c11.jpg" width="70" height="31" id="print_ex_r22_c11" alt="" /></td>
   <td colspan="9"><?php echo $row_list_acao['Telefone2']; ?></td>
   <td rowspan="2"><img name="print_ex_r22_c27" src="print/print_ex_r22_c27.jpg" width="24" height="31" id="print_ex_r22_c27" alt="" /></td>
   <td rowspan="4"><img name="print_ex_r22_c31" src="print/print_ex_r22_c31.jpg" width="14" height="83" id="print_ex_r22_c31" alt="" /></td>
   <td colspan="9"><?php echo $row_list_acao['Telefone3']; ?></td>
   <td rowspan="4" colspan="4"><img name="print_ex_r22_c41" src="print/print_ex_r22_c41.jpg" width="138" height="83" id="print_ex_r22_c41" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><img name="print_ex_r23_c4" src="print/print_ex_r23_c4.jpg" width="113" height="8" id="print_ex_r23_c4" alt="" /></td>
   <td colspan="9"><img name="print_ex_r23_c18" src="print/print_ex_r23_c18.jpg" width="113" height="8" id="print_ex_r23_c18" alt="" /></td>
   <td rowspan="3" colspan="9"><img name="print_ex_r23_c32" src="print/print_ex_r23_c32.jpg" width="113" height="60" id="print_ex_r23_c32" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="25"><?php echo $row_list_acao['EMail']; ?></td>
   <td rowspan="2" colspan="2"><img name="print_ex_r24_c29" src="print/print_ex_r24_c29.jpg" width="12" height="52" id="print_ex_r24_c29" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="25"><img name="print_ex_r25_c4" src="print/print_ex_r25_c4.jpg" width="339" height="29" id="print_ex_r25_c4" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="29" alt="" /></td>
  </tr>
  <tr>
   <td colspan="20" rowspan="3" valign="top"><?php echo convert_utf8($row_list_acao_emprego['EmpregoEmpresa']); ?></td>
   <td rowspan="7" colspan="5"><img name="print_ex_r26_c24" src="print/print_ex_r26_c24.jpg" width="80" height="113" id="print_ex_r26_c24" alt="" /></td>
   <td colspan="16"><?php echo convert_utf8($row_list_acao_emprego['EmpregoCargo']); ?></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="16"><img name="print_ex_r27_c29" src="print/print_ex_r27_c29.jpg" width="277" height="7" id="print_ex_r27_c29" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="7" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="16"><?php echo $row_list_acao_emprego['EmpregoMotivoSaida']; ?></td>
   <td><img src="print/spacer.gif" width="1" height="18" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="20"><img name="print_ex_r29_c4" src="print/print_ex_r29_c4.jpg" width="259" height="14" id="print_ex_r29_c4" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="6" alt="" /></td>
  </tr>
  <tr>
   <td colspan="16"><img name="print_ex_r30_c29" src="print/print_ex_r30_c29.jpg" width="277" height="8" id="print_ex_r30_c29" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="8" alt="" /></td>
  </tr>
  <tr>
   <td colspan="20"><?php echo $row_list_acao_emprego['EmpregoCidade']; ?></td>
   <td colspan="7"><?php echo converte_data($row_list_acao_emprego['EmpregoDataEntreda']); ?></td>
   <td rowspan="4" colspan="6"><img name="print_ex_r31_c36" src="print/print_ex_r31_c36.jpg" width="97" height="79" id="print_ex_r31_c36" alt="" /></td>
   <td colspan="3"><?php echo converte_data($row_list_acao_emprego['EmpregoDataSaida']); ?></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="20"><img name="print_ex_r32_c4" src="print/print_ex_r32_c4.jpg" width="259" height="28" id="print_ex_r32_c4" alt="" /></td>
   <td rowspan="3" colspan="7"><img name="print_ex_r32_c29" src="print/print_ex_r32_c29.jpg" width="90" height="56" id="print_ex_r32_c29" alt="" /></td>
   <td rowspan="3" colspan="3"><img name="print_ex_r32_c42" src="print/print_ex_r32_c42.jpg" width="90" height="56" id="print_ex_r32_c42" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="28" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="2"><img name="print_ex_r33_c1" src="print/print_ex_r33_c1.jpg" width="75" height="28" id="print_ex_r33_c1" alt="" /></td>
   <td colspan="2"><?php if (!(strcmp($row_list_acao['FaseProva'],1))) { //abilitado
	 	echo '<img name="print_ex_r31_c23" src="print/print_ex_r33_c23.jpg" width="18" height="18" id="print_ex_r33_c7" alt="" />';
	 		}else{ //desabilitado
	 	echo '<img name="print_ex_r31_c3" src="print/print_ex_r33_c7.jpg" width="18" height="18" id="print_ex_r31_c3" alt="" />'; } ?></td>
   <td rowspan="2" colspan="2"><img name="print_ex_r33_c5" src="print/print_ex_r33_c5.jpg" width="45" height="28" id="print_ex_r33_c5" alt="" /></td>
   <td colspan="2"><?php if (!(strcmp($row_list_acao['FaseEntrevista'],1))) { //abilitado
	 	echo '<img name="print_ex_r31_c23" src="print/print_ex_r33_c23.jpg" width="18" height="18" id="print_ex_r33_c7" alt="" />';
	 		}else{ //desabilitado
	 	echo '<img name="print_ex_r31_c3" src="print/print_ex_r33_c7.jpg" width="18" height="18" id="print_ex_r31_c3" alt="" />'; } ?></td>
   <td rowspan="2" colspan="5"><img name="print_ex_r33_c9" src="print/print_ex_r33_c9.jpg" width="67" height="28" id="print_ex_r33_c9" alt="" /></td>
   <td colspan="3"><?php if (!(strcmp($row_list_acao['FaseTreinamento'],1))) { //abilitado
	 	echo '<img name="print_ex_r31_c23" src="print/print_ex_r33_c23.jpg" width="18" height="18" id="print_ex_r33_c7" alt="" />';
	 		}else{ //desabilitado
	 	echo '<img name="print_ex_r31_c3" src="print/print_ex_r33_c7.jpg" width="18" height="18" id="print_ex_r31_c3" alt="" />'; } ?></td>
   <td rowspan="2" colspan="6"><img name="print_ex_r33_c17" src="print/print_ex_r33_c17.jpg" width="84" height="28" id="print_ex_r33_c17" alt="" /></td>
   <td colspan="2"><?php if (!(strcmp($row_list_acao['FaseExIEP'],1))) { //abilitado
	 	echo '<img name="print_ex_r31_c23" src="print/print_ex_r33_c23.jpg" width="18" height="18" id="print_ex_r33_c7" alt="" />';
	 		}else{ //desabilitado
	 	echo '<img name="print_ex_r31_c3" src="print/print_ex_r33_c7.jpg" width="18" height="18" id="print_ex_r31_c3" alt="" />'; } ?></td>
   <td rowspan="2" colspan="4"><img name="print_ex_r33_c25" src="print/print_ex_r33_c25.jpg" width="70" height="28" id="print_ex_r33_c25" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="18" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2"><img name="print_ex_r34_c3" src="print/print_ex_r34_c3.jpg" width="18" height="10" id="print_ex_r34_c3" alt="" /></td>
   <td colspan="2"><img name="print_ex_r34_c7" src="print/print_ex_r34_c7.jpg" width="19" height="10" id="print_ex_r34_c7" alt="" /></td>
   <td colspan="3"><img name="print_ex_r34_c14" src="print/print_ex_r34_c14.jpg" width="20" height="10" id="print_ex_r34_c14" alt="" /></td>
   <td colspan="2"><img name="print_ex_r34_c23" src="print/print_ex_r34_c23.jpg" width="18" height="10" id="print_ex_r34_c23" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="10" alt="" /></td>
  </tr>
  <tr>
   <td colspan="46"><img name="print_ex_r35_c1" src="print/print_ex_r35_c1.jpg" width="703" height="10" id="print_ex_r35_c1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="10" alt="" /></td>
  </tr>








<?php 
//Inicio

do { ?>
  
   <?php
 $str = convert_utf8($row_list_acao_observacao['Observacoes']);
 $ntext=strlen($str); // 7

switch ($ntext){

case ($ntext == '0'):
	$textHeight='30';
break;
case ($ntext <= '100'):
	$textHeight='30';
break;
case ($ntext <= '200'):
	$textHeight='45';
break;
case ($ntext <= '400'):
	$textHeight='80';
break;
case ($ntext <= '800'):
	$textHeight='160';
break;
	
}
?>
  

  <tr>
   <td>
      <img name="print_ex_r34_c1" src="print/print_ex_r36_c1.jpg" width="12" height="<?php  if($textHeight==''){echo "30";}else{echo $textHeight;} ?>" id="print_ex_r36_c1" alt="" />
      </td>
   <td colspan="42">
       <?php 
	   //TEXTO
	   echo converte_data_horas($row_list_acao_observacao['DataRegistroObs']); ?> | <?php $id_usuario= $row_list_acao_observacao['id_usuario']; include "../sistema_usuario/list_usuario.php"; ?> <?php  echo $row_list_acao_usuario['nome']; ?> | <?php  //echo convert_utf8($row_list_acao_observacao['Observacoes']); 
	    echo $str; ?>
   
   </td>
   <td colspan="3">
        <img name="print_ex_r34_c44" src="print/print_ex_r36_c44.jpg" width="12" height="<?php  if($textHeight==''){echo "30";}else{echo $textHeight;} ?>" id="print_ex_r34_c44" alt="" />
   </td>
   <td><img src="print/spacer.gif" width="1" height="<?php echo $textHeight; ?>" alt="" /></td>
  </tr>
  <?php } while ($row_list_acao_observacao = mysql_fetch_assoc($list_acao_observacao)); 
  
  //FIM
 
  ?>










  <tr>
   <td colspan="46"><img name="print_ex_r37_c1" src="print/print_ex_r37_c1.jpg" width="703" height="10" id="print_ex_r37_c1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="10" alt="" /></td>
  </tr>
  <tr>
   <td colspan="46"><img name="print_ex_r38_c1" src="print/print_ex_r38_c1.jpg" width="703" height="4" id="print_ex_r38_c1" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="4" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="3"><img name="print_ex_r39_c1" src="print/print_ex_r39_c1.jpg" width="77" height="41" id="print_ex_r39_c1" alt="" /></td>
   <td colspan="11"><?php echo converte_data_horas($row_list_acao['RegistroData']);?></td>
   <td rowspan="2" colspan="6"><img name="print_ex_r39_c15" src="print/print_ex_r39_c15.jpg" width="79" height="41" id="print_ex_r39_c15" alt="" /></td>
   <td colspan="12"><?php echo converte_data_horas($row_list_acao['RegistroDataAlterado']); ?></td>
   <td rowspan="2" colspan="5"><img name="print_ex_r39_c33" src="print/print_ex_r39_c33.jpg" width="77" height="41" id="print_ex_r39_c33" alt="" /></td>
   <td colspan="5"><?php $id_usuario= $row_list_acao['id_usuario']; include "../sistema_usuario/list_usuario.php"; ?>
    <?php  echo $row_list_acao_usuario['nome']; ?></td>
   <td rowspan="2" colspan="4"><img name="print_ex_r39_c43" src="print/print_ex_r39_c43.jpg" width="26" height="41" id="print_ex_r39_c43" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="23" alt="" /></td>
  </tr>
  <tr>
   <td colspan="11"><img name="print_ex_r40_c4" src="print/print_ex_r40_c4.jpg" width="148" height="18" id="print_ex_r40_c4" alt="" /></td>
   <td colspan="12"><img name="print_ex_r40_c21" src="print/print_ex_r40_c21.jpg" width="148" height="18" id="print_ex_r40_c21" alt="" /></td>
   <td colspan="5"><img name="print_ex_r40_c38" src="print/print_ex_r40_c38.jpg" width="148" height="18" id="print_ex_r40_c38" alt="" /></td>
   <td><img src="print/spacer.gif" width="1" height="18" alt="" /></td>
  </tr>
</table>
<div class="PrintTexto">&nbsp;&nbsp; Data da impressão: <?php echo date(d.'-'.m.'-'.Y.' '.H.':'.i.':'.s); ?> - Usuario: <?php echo $_SESSION['MM_Username'] ?></div>
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