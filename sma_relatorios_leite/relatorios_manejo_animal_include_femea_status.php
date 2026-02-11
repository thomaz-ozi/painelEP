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
$query_list_femea_status = "SELECT * FROM tbnext_mod_sma_manejo_femea_status WHERE id_manejo ='".$id_manejo."'";
$list_femea_status = mysql_query($query_list_femea_status, $connection) or die(mysql_error());
$row_list_femea_status = mysql_fetch_assoc($list_femea_status);
$totalRows_list_femea_status = mysql_num_rows($list_femea_status);
?>
<?php $id_femea_status_tipo= $row_list_femea_status['id_femea_status_tipo']; 
include ('../sma_animais/list_femea_status.php');
?><b><?php  echo $row_list_femea_status['name']; ?> </b> - <?php  echo $row_list_femea_status['descricao']; ?>



<?php
//mysql_free_result($list_femea_status);
?>
