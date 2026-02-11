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
$query_list_usuario = "SELECT * FROM tbnext_usuario WHERE id_usuario = '$id_usuario' ORDER BY nome ASC";
$list_usuario = mysql_query($query_list_usuario, $connection) or die(mysql_error());
$row_list_usuario = mysql_fetch_assoc($list_usuario);
$totalRows_list_usuario = mysql_num_rows($list_usuario);
?>
<?php $tratamento=$row_list_usuario['tratamento']; ?>
<?php $nome =$row_list_usuario['nome']; ?> 
<?php $usuario= $row_list_usuario['usuario']; ?>
<?php
mysql_free_result($list_usuario);
?>
