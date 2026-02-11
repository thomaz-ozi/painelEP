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
$query_list_estado = "SELECT * FROM btnext_uf";
$list_estado = mysql_query($query_list_estado, $connection) or die(mysql_error());
$row_list_estado = mysql_fetch_assoc($list_estado);
$totalRows_list_estado = mysql_num_rows($list_estado);
?><label>
<select name="<?php echo $recebe_estado; ?>" id="<?php echo $recebe_estado; ?>">
  <option value="0" <?php if (!(strcmp(0, $select_value_estado))) {echo "selected=\"selected\"";} ?>></option><?php
do {  
?>
  <option value="<?php echo $row_list_estado['value_uf']?>"<?php if (!(strcmp($row_list_estado['value_uf'], $select_value_estado))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_estado['label_uf']?></option>
  <?php
} while ($row_list_estado = mysql_fetch_assoc($list_estado));
  $rows = mysql_num_rows($list_estado);
  if($rows > 0) {
      mysql_data_seek($list_estado, 0);
	  $row_list_estado = mysql_fetch_assoc($list_estado);
  }
?>
</select>
</label>
<?php
mysql_free_result($list_estado);
?>
