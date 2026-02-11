<?php require_once('../Connections/connection_user.php'); ?>
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

mysql_select_db($database_connection_user, $connection_user);
$query_list_acao_usuario = "SELECT * FROM tbnext_usuario WHERE id_usuario = '".$id_usuario."' ";
$list_acao_usuario = mysql_query($query_list_acao_usuario, $connection_user) or die(mysql_error());
$row_list_acao_usuario = mysql_fetch_assoc($list_acao_usuario);
$totalRows_list_acao_usuario = mysql_num_rows($list_acao_usuario);
?>
<?php // echo $row_list_acao_usuario['usuario']; ?> <?php // echo $row_list_acao_usuario['nome']; ?>
<?php
mysql_free_result($list_acao_usuario);
?>
