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
$query_list_ano = "SELECT * FROM tbnext_data_ano ORDER BY id_ano ASC";
$list_ano = mysql_query($query_list_ano, $connection) or die(mysql_error());
$row_list_ano = mysql_fetch_assoc($list_ano);
$totalRows_list_ano = mysql_num_rows($list_ano);
?><label>
<select name="<?php echo $recebe_ano; ?>" id="<?php echo $recebe_ano; ?>">
  <option value="" <?php if (!(strcmp("", $select_value_ano))) {echo "selected=\"selected\"";} ?>>ano</option>
  <?php
do {  
?>
  <option value="<?php echo $row_list_ano['id_ano']?>"<?php if (!(strcmp($row_list_ano['id_ano'], $select_value_ano))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_ano['ano']?></option>
  <?php
} while ($row_list_ano = mysql_fetch_assoc($list_ano));
  $rows = mysql_num_rows($list_ano);
  if($rows > 0) {
      mysql_data_seek($list_ano, 0);
	  $row_list_ano = mysql_fetch_assoc($list_ano);
  }
?>
</select>
</label>
<?php
mysql_free_result($list_ano);
?>
