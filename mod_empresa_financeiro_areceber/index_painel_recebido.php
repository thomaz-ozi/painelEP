<?php require_once('../Connections/connection.php'); ?>
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
$query_list_recebido = "SELECT  SUM(a.parc_valor) AS total FROM tbnext_mod_empresa_financeiro_receita_parcelas a WHERE a.ativado='1' AND a.parc_pgto ='1'  AND a.data_vcto >".date(Y."/".m."/".d)."";
$list_recebido = mysql_query($query_list_recebido, $connection) or die(mysql_error());
$row_list_recebido = mysql_fetch_assoc($list_recebido);
$totalRows_list_recebido = mysql_num_rows($list_recebido);
?>
<?php //echo $row_list_recebido['total']; ?>
<?php
mysql_free_result($list_recebido);
?>
