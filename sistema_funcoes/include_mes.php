<?php require_once('../Connections/connection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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
$query_list_mes = "SELECT * FROM tbnext_data_mes";
$list_mes = mysql_query($query_list_mes, $connection) or die(mysql_error());
$row_list_mes = mysql_fetch_assoc($list_mes);
$totalRows_list_mes = mysql_num_rows($list_mes);
?>
<select name="<?php echo $recebe_mes; ?>" id="<?php echo $recebe_mes; ?>">
  <option value="" <?php if (!(strcmp("", $select_value_mes))) {echo "selected=\"selected\"";} ?>>mes</option>
  <?php
do {  
?>
  <option value="<?php echo $row_list_mes['id_mes']?>"<?php if (!(strcmp($row_list_mes['id_mes'], $select_value_mes))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_mes['mes']?></option>
  <?php
} while ($row_list_mes = mysql_fetch_assoc($list_mes));
  $rows = mysql_num_rows($list_mes);
  if($rows > 0) {
      mysql_data_seek($list_mes, 0);
	  $row_list_mes = mysql_fetch_assoc($list_mes);
  }
?>
</select>

<?php
mysql_free_result($list_mes);
?>
