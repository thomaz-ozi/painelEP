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
$query_list_lote_anterior = "SELECT * FROM vwnext_mod_sma_manejo_animais WHERE  id_manejo='".$row_acao_relatorios['id_manejo']."'  ORDER BY `id_manejo` DESC LIMIT 1, 2 ";
$list_lote_anterior = mysql_query($query_list_lote_anterior, $connection) or die(mysql_error());
$row_list_lote_anterior = mysql_fetch_assoc($list_lote_anterior);
$totalRows_list_lote_anterior = mysql_num_rows($list_lote_anterior);
?>
<div  class="rel_info2"> <b>Lote anterior:</b> 
<?php   $id_lote= $row_acao_relatorios['id_lote'];
  include ("../sma_lote/list_lote.php");  echo $row_list_filtro_lote['nome']; ?>
&nbsp;</div>
<?php
mysql_free_result($list_lote_anterior);
?>
