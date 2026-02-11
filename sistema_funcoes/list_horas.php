<?php 
//verifica se é por formulario ou por texto<br />
//sabado- 17/04/2010
	if($formato_horas=='form'){
	$horas_SQL="SELECT * FROM tbnext_horas ORDER BY horas ASC";
	}elseif($formato_horas=='texto'){
		
	$horas_SQL= "SELECT * FROM tbnext_horas WHERE id_horas = '$id_horas'";
		
	}
		?>
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
$query_list_hora = $horas_SQL;
$list_hora = mysql_query($query_list_hora, $connection) or die(mysql_error());
$row_list_hora = mysql_fetch_assoc($list_hora);
$totalRows_list_hora = mysql_num_rows($list_hora);
?>
<?php if($formato_horas=='form'){?>
<label>
  <select name="id_horas" id="id_horas">
    <?php
do {  
?>
    <option value="<?php echo $row_list_hora['id_horas']?>"<?php if (!(strcmp($row_list_hora['id_horas'], $id_horas))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_hora['horas']?></option>
    <?php
} while ($row_list_hora = mysql_fetch_assoc($list_hora));
  $rows = mysql_num_rows($list_hora);
  if($rows > 0) {
      mysql_data_seek($list_hora, 0);
	  $row_list_hora = mysql_fetch_assoc($list_hora);
  }
?>
  </select>
</label>
<?php }elseif($formato_horas=='texto'){?>
<?php echo $row_list_hora['horas']; ?>
<?php }?>
<?php
mysql_free_result($list_hora);
?> 
