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
$query_list_filtro_setor = "SELECT * FROM tbnext_mod_sma_cad_setor WHERE id_setor = '".$id_setor."'";
$list_filtro_setor = mysql_query($query_list_filtro_setor, $connection) or die(mysql_error());
$row_list_filtro_setor = mysql_fetch_assoc($list_filtro_setor);
$totalRows_list_filtro_setor = mysql_num_rows($list_filtro_setor);
?>
<?php // echo $row_list_filtro_setor['nome']; ?><?php // echo $row_list_filtro_setor['largura']; ?><?php // echo $row_list_filtro_setor['altura']; ?>
<?php
mysql_free_result($list_filtro_setor);
?>
