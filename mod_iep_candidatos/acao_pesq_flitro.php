teste<?php require_once('../Connections/connection.php'); ?>fs
<?php require_once ("../sistema_funcoes/masc_clear_cpf_rg_cnh.php");?>
<?php
$_POST['acaoCPF']=$_POST['xPesq'];
$_POST['xPesq']=masc_clear_cpf($_POST['xPesq']);
 if($_POST['xPesq']==NULL){exit;}

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

$colname_pesq_flitro = "-1";
if (isset($_POST['xPesq'])) {
  $colname_pesq_flitro = $_POST['xPesq'];
}
mysql_select_db($database_connection, $connection);
$query_pesq_flitro = sprintf("SELECT Codigo, CPF FROM tbMod_canditados WHERE CPF = %s ORDER BY Codigo DESC", GetSQLValueString($colname_pesq_flitro, "text"));
$pesq_flitro = mysql_query($query_pesq_flitro, $connection) or die(mysql_error());
$row_pesq_flitro = mysql_fetch_assoc($pesq_flitro);
$totalRows_pesq_flitro = mysql_num_rows($pesq_flitro);

?>
<?php  $row_pesq_flitro['Codigo'];

if($row_pesq_flitro['Codigo']!=''){ 
	/*
$_POST['xPesq']=$row_pesq_flitro['CPF'];
$_POST['PesquisaAvancadaColunas']='CPF';
echo "achou";
*/
include("../mod_iep_candidatos/acao_alt_load.php");
}else{ 
echo "não encontrou";

include("../mod_iep_candidatos/acao_add_load.php");
} ?>

<?php
mysql_free_result($pesq_flitro);
?>