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
 $query_list_endereco = "SELECT * FROM tbnext_mod_empresa_clientes_endereco WHERE id_enderecos = '".$id_enderecos."'";
$list_endereco = mysql_query($query_list_endereco, $connection) or die(mysql_error());
$row_list_endereco = mysql_fetch_assoc($list_endereco);
$totalRows_list_endereco = mysql_num_rows($list_endereco);
?>
<?php // echo $row_list_endereco['xLgr']; ?><?php //echo $row_list_endereco['nro']; ?>
<?php //echo $row_list_endereco['xBairro']; ?><?php //echo $row_list_endereco['xMun']; ?>
<?php //echo $row_list_endereco['cMun']; ?><?php //echo $row_list_endereco['UF']; ?><?php // echo $row_list_endereco['cUF']; ?>
<?php //echo $row_list_endereco['CEP']; ?>
<?php //echo $row_list_endereco['cmpto']; ?>
<?php
mysql_free_result($list_endereco);
?>
