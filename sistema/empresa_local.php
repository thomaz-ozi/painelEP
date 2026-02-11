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
$query_list_painal_fazenda = "SELECT id_local, fantasia FROM tbnext_mod_empresa_local WHERE id_local ='".$_SESSION['LOCAL']."'";
$list_painal_fazenda = mysql_query($query_list_painal_fazenda, $connection) or die(mysql_error());
$row_list_painal_fazenda = mysql_fetch_assoc($list_painal_fazenda);
$totalRows_list_painal_fazenda = mysql_num_rows($list_painal_fazenda);

?>
PROPRIEDADE: <?php echo $row_list_painal_fazenda['fantasia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
<?php
mysql_free_result($list_painal_fazenda);
?>
