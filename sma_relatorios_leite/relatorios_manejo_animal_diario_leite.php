<?php
 require_once('../Connections/connection.php'); ?>
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
   $query_list_include = "SELECT  SUM( a.leite_valor_estimado)AS leite_valor_estimado_soma, SUM( a.leite_qtdd)AS leite_qtdd_soma  FROM vwnext_relatorio_manejo_leite_periodo a
  WHERE    a.id_animais='".$id_animais."' AND '".$ano."-".$mes."-".$day."' BETWEEN a.data_inicial AND a.data_final";
$list_include = mysql_query($query_list_include, $connection) or die(mysql_error());
$row_list_include = mysql_fetch_assoc($list_include);
$totalRows_list_include = mysql_num_rows($list_include);
?>

<?php
mysql_free_result($list_include);
?>
