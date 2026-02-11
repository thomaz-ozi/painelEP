<span style="display:none"><?php

//initialize the session
if (!isset($_SESSION)) {
  session_start();
  //ativo=021;
 }?></span><?php
 $usuario=md5($_SESSION['MM_UserGroup']);
 $local=md5($_SESSION['LOCAL']);
 $parcela=md5($_POST['id_receitas_parcelas']);
 $url_formapgto= $usuario.$local.$parcela;

 ?>
<span style="display:none"><?php require_once('../Connections/connection.php');  ?></span>
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
$query_list_msn = "SELECT * FROM tbnext_mod_empresa_email_msn WHERE id_class = '1'";
$list_msn = mysql_query($query_list_msn, $connection) or die(mysql_error());
$row_list_msn = mysql_fetch_assoc($list_msn);
$totalRows_list_msn = mysql_num_rows($list_msn);



 
$msg  = '<div style=" margin:auto; width:750px;  font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#666;  ">';
	;
	$msg .= $row_list_msn['msn_cabecalho'];
	$msg .= ' <p align="center">_______________________________________________</p><br>';
	$msg .= $row_list_msn['msn_texto'];
	$msg .= "<br>";
	$msg .= "Date de vencimento:".$_POST['data_vcto'];
	$msg .= "<br>";
	$msg .= "Valor a pagar R$ ".$_POST['parc_valor'];
	$msg .= "<br>";
	$msg .= '<p align="center"><a href="http://www.gruponext.com.br/formapgto/?'.$url_formapgto.'" target="_blank" >http://www.gruponext.com.br/formapgto/?'.$url_formapgto.'</a></p>';
	$msg .= "<br>";
	$msg .= "<br>";
	$msg .= "<br>";
	$msg .= "<br>";

	$msg .= '<p align="center">_______________________________________________</p><br>';
	$msg .= $row_list_msn['msn_idenX1'];
	$msg .= "<br>";
	$msg .= "</div >";

//echo $msg;

 $_POST['assunto']=$row_list_msn['xNome'];
include('../mod_empresa_email/acao_comum_email.php');



mysql_free_result($list_msn);

?>
