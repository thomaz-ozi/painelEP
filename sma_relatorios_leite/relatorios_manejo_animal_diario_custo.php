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
   $query_list_custo = "SELECT  SUM(a.valor_animais_dia)AS valor_animais_dia_soma FROM vwnext_relatorio_manejo_custo a WHERE a.id_animais='".$id_animais."' AND a.id_tipo_custo!='1'   AND '".$ano."-".$mes."-".$day."'  BETWEEN a.data_inicial AND a.data_final ";
$list_custo = mysql_query($query_list_custo, $connection) or die(mysql_error());
$row_list_custo = mysql_fetch_assoc($list_custo);
$totalRows_list_custo = mysql_num_rows($list_custo);
?>

<?php
mysql_free_result($list_custo);
?>
