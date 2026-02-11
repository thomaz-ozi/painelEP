<div style="display:none;"><?php require_once('../Connections/connection.php'); ?>
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
 $query_list_ibge = "SELECT * FROM tbnext_mod_ibge WHERE xMun = '".utf8_encode($xMun)."'";
$list_ibge = mysql_query($query_list_ibge, $connection) or die(mysql_error());
$row_list_ibge = mysql_fetch_assoc($list_ibge);
$totalRows_list_ibge = mysql_num_rows($list_ibge);
?>
<?php //echo $row_list_ibge['xMun']; ?>
<?php //echo $row_list_ibge['cMun']; ?>
<?php
mysql_free_result($list_ibge);
?>
</div>