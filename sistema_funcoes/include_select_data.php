<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../Connections/connection.php'); ?>
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
$query_list_dias = "SELECT * FROM tbnext_sistem_data_dia ORDER BY id_dia ASC";
$list_dias = mysql_query($query_list_dias, $connection) or die(mysql_error());
$row_list_dias = mysql_fetch_assoc($list_dias);
$totalRows_list_dias = mysql_num_rows($list_dias);

mysql_select_db($database_connection, $connection);
$query_list_mes = "SELECT * FROM tbnext_sistem_data_mes ORDER BY id_mes ASC";
$list_mes = mysql_query($query_list_mes, $connection) or die(mysql_error());
$row_list_mes = mysql_fetch_assoc($list_mes);
$totalRows_list_mes = mysql_num_rows($list_mes);

mysql_select_db($database_connection, $connection);
$query_list_ano = "SELECT * FROM tbnext_sistem_data_ano ORDER BY id_ano DESC";
$list_ano = mysql_query($query_list_ano, $connection) or die(mysql_error());
$row_list_ano = mysql_fetch_assoc($list_ano);
$totalRows_list_ano = mysql_num_rows($list_ano);
?>

<select name="id_dia" id="id_dia" style="width:50px">
  <option value="" <?php if (!(strcmp("", $_GET['id_dia']))) {echo "selected=\"selected\"";} ?>>---</option>
  <?php
do {  
?>
  <option value="<?php echo $row_list_dias['id_dia']?>"<?php if (!(strcmp($row_list_dias['id_dia'], $_GET['id_dia']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_dias['dias']?></option>
  <?php
} while ($row_list_dias = mysql_fetch_assoc($list_dias));
  $rows = mysql_num_rows($list_dias);
  if($rows > 0) {
      mysql_data_seek($list_dias, 0);
	  $row_list_dias = mysql_fetch_assoc($list_dias);
  }
?>
</select>
<select name="id_mes" id="id_mes" style="width:100px">
  <?php
do {  
?>
  <option value="<?php echo $row_list_mes['mes_n']?>"<?php if (!(strcmp($row_list_mes['mes_n'], $_GET['id_mes']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_mes['mes']?></option>
  <?php
} while ($row_list_mes = mysql_fetch_assoc($list_mes));
  $rows = mysql_num_rows($list_mes);
  if($rows > 0) {
      mysql_data_seek($list_mes, 0);
	  $row_list_mes = mysql_fetch_assoc($list_mes);
  }
?>
</select>
<select name="id_ano" id="id_ano" style="width:70px">
  <?php
do {  
?>
  <option value="<?php echo $row_list_ano['ano']?>"<?php if (!(strcmp($row_list_ano['ano'], $_GET['id_ano']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_ano['ano']?></option>
  <?php
} while ($row_list_ano = mysql_fetch_assoc($list_ano));
  $rows = mysql_num_rows($list_ano);
  if($rows > 0) {
      mysql_data_seek($list_ano, 0);
	  $row_list_ano = mysql_fetch_assoc($list_ano);
  }
?>
</select>
<?php
mysql_free_result($list_dias);

mysql_free_result($list_mes);

mysql_free_result($list_ano);
?>
