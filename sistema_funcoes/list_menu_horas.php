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
$query_list_horas = "SELECT * FROM tbnext_horas ORDER BY horas ASC";
$list_horas = mysql_query($query_list_horas, $connection) or die(mysql_error());
$row_list_horas = mysql_fetch_assoc($list_horas);
$totalRows_list_horas = mysql_num_rows($list_horas);
?>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<span id="spryselect1">
<label>
  <select name="<?php echo $formhoras; ?>" id="<?php echo $formhoras; ?>" class="txt-form">
    <option value="" <?php if (!(strcmp("", $selecione_horas))) {echo "selected=\"selected\"";} ?>>Seleione...</option>
    <?php
do {  
?>
    <option value="<?php echo $row_list_horas['id_horas']?>"<?php if (!(strcmp($row_list_horas['id_horas'], $selecione_horas))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_horas['horas']?></option>
    <?php
} while ($row_list_horas = mysql_fetch_assoc($list_horas));
  $rows = mysql_num_rows($list_horas);
  if($rows > 0) {
      mysql_data_seek($list_horas, 0);
	  $row_list_horas = mysql_fetch_assoc($list_horas);
  }
?>
  </select>
</label>
<span class="selectRequiredMsg">*</span></span>
<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
//-->
</script>
<?php
mysql_free_result($list_horas);
?>
