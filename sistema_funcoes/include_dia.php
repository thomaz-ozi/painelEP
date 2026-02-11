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
$query_list_dia = "SELECT * FROM tbnext_data_dia";
$list_dia = mysql_query($query_list_dia, $connection) or die(mysql_error());
$row_list_dia = mysql_fetch_assoc($list_dia);
$totalRows_list_dia = mysql_num_rows($list_dia);
?><label>
<select name="<?php echo $recebe_dia; ?>" id="<?php echo $recebe_dia; ?>">
  <option value="" <?php if (!(strcmp("", $select_value_dia))) {echo "selected=\"selected\"";} ?>>dia</option>
  <?php
do {  
?>
  <option value="<?php echo $row_list_dia['id_dia']?>"<?php if (!(strcmp($row_list_dia['id_dia'], $select_value_dia))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_dia['dias']?></option>
  <?php
} while ($row_list_dia = mysql_fetch_assoc($list_dia));
  $rows = mysql_num_rows($list_dia);
  if($rows > 0) {
      mysql_data_seek($list_dia, 0);
	  $row_list_dia = mysql_fetch_assoc($list_dia);
  }
?>
</select>
</label>
<?php
mysql_free_result($list_dia);
?>
