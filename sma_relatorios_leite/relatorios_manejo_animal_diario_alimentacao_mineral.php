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
  $query_list_alimentacao = "SELECT SUM(a.valor_total)AS valor_total_soma, SUM(kilo_animal)AS kilo_animal_soma FROM vwnext_relariotio_manejo_alimentacao a WHERE a.id_tipo='2' AND  a.id_animais='".$id_animais."' AND '".$ano."-".$mes."-".$day."'  BETWEEN a.data_inicial AND a.data_final ";
$list_alimentacao = mysql_query($query_list_alimentacao, $connection) or die(mysql_error());
$row_list_alimentacao = mysql_fetch_assoc($list_alimentacao);
$totalRows_list_alimentacao = mysql_num_rows($list_alimentacao);
?>

<?php
mysql_free_result($list_alimentacao);
?>
