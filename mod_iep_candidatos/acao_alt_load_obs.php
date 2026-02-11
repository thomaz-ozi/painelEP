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

 $Observacoes=" LIKE '%". $_POST[xPesq]."%' ";


mysql_select_db($database_connection, $connection);
$query_list_acao_obs = "SELECT * FROM tbMod_canditadosObser WHERE Observacoes  ".$Observacoes." ORDER BY Codigo DESC";
$list_acao_obs = mysql_query($query_list_acao_obs, $connection) or die(mysql_error());
$row_list_acao_obs = mysql_fetch_assoc($list_acao_obs);
$totalRows_list_acao_obs = mysql_num_rows($list_acao_obs);

 $_POST[PesquisaAvancadaColunas]='Codigo';
$_POST[xPesq]=$row_list_acao_obs['Codigo'];
?>
<?php
mysql_free_result($list_acao_obs);
?>


