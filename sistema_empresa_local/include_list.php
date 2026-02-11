<?php  require_once('../Connections/connection.php'); ?>
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
$query_list_acao_empresa_local = "SELECT id_local, razao_social, fantasia, endereco, cidade, estado, fone1, ramal1, cnpj FROM tbnext_mod_empresa_local WHERE id_local = '".$id_local."'";
$list_acao_empresa_local = mysql_query($query_list_acao_empresa_local, $connection) or die(mysql_error());
$row_list_acao_empresa_local = mysql_fetch_assoc($list_acao_empresa_local);
$totalRows_list_acao_empresa_local = mysql_num_rows($list_acao_empresa_local);
?>
<?php // echo $row_list_acao_empresa_local['id_local']; ?><?php //echo $row_list_acao_empresa_local['razao_social']; ?><?php //echo $row_list_acao_empresa_local['cnpj']; ?>
<?php
mysql_free_result($list_acao_empresa_local);
?>