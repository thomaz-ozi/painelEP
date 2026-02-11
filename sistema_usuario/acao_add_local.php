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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

mysql_select_db($database_connection_user, $connection);
$query_list_acao_local = "SELECT id_local FROM tbnext_mod_empresa_local";
$list_acao_local = mysql_query($query_list_acao_local, $connection) or die(mysql_error());
$row_list_acao_local = mysql_fetch_assoc($list_acao_local);
$totalRows_list_acao_local = mysql_num_rows($list_acao_local);


// tabela do Usuario
mysql_select_db($database_connection_user, $connection_user);
$query_list_usuario = "SELECT id_usuario FROM tbnext_usuario ORDER BY id_usuario DESC";
$list_usuario = mysql_query($query_list_usuario, $connection_user) or die(mysql_error());
$row_list_usuario = mysql_fetch_assoc($list_usuario);
$totalRows_list_usuario = mysql_num_rows($list_usuario);



  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_local_usuario_permisao (id_local_permissao, id_usuario, id_local) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id_local_permissao'], "int"),
                       GetSQLValueString($row_list_usuario['id_usuario'], "int"),
                       GetSQLValueString($_POST['id_local'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());



mysql_free_result($list_acao_local);

mysql_free_result($list_usuario);
?>
