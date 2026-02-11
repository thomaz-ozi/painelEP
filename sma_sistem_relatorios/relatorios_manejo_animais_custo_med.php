<?php require_once("../sistem_funcoes/seguranca_usuario.php"); ?>
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
 $query_list_manejo_animais_custo_med = "SELECT qtdd ,  valor_custo, SUM(custo_medicamento) AS soma_custo_medicamento FROM `vwnext_mod_sma_manejo_animais_custo_medicamentos` WHERE id_animais='".$id_animais."'";
$list_manejo_animais_custo_med = mysql_query($query_list_manejo_animais_custo_med, $connection) or die(mysql_error());
$row_list_manejo_animais_custo_med = mysql_fetch_assoc($list_manejo_animais_custo_med);
$totalRows_list_manejo_animais_custo_med = mysql_num_rows($list_manejo_animais_custo_med);
?>
<?php // echo $row_list_manejo_animais_custo_med['soma_custo_medicamento']; ?>
<?php
mysql_free_result($list_manejo_animais_custo_med);
?>
