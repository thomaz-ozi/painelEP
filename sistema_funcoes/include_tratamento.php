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
$query_list_tratamento = "SELECT * FROM tbnext_tratamento";
$list_tratamento = mysql_query($query_list_tratamento, $connection) or die(mysql_error());
$row_list_tratamento = mysql_fetch_assoc($list_tratamento);
$totalRows_list_tratamento = mysql_num_rows($list_tratamento);
?><label>
<select name="<?php echo $recebe_tratamento; ?>" id="<?php echo $recebe_tratamento; ?>">
  <option value="0" <?php if (!(strcmp(0, $select_value))) {echo "selected=\"selected\"";} ?>></option>
  <?php
do {  
?>
  <option value="<?php echo $row_list_tratamento['id_tratamento']?>"<?php if (!(strcmp($row_list_tratamento['id_tratamento'], $select_value))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_tratamento['tratamento']?></option>
  <?php
} while ($row_list_tratamento = mysql_fetch_assoc($list_tratamento));
  $rows = mysql_num_rows($list_tratamento);
  if($rows > 0) {
      mysql_data_seek($list_tratamento, 0);
	  $row_list_tratamento = mysql_fetch_assoc($list_tratamento);
  }
?>
</select>
</label>
<?php
mysql_free_result($list_tratamento);
?>
