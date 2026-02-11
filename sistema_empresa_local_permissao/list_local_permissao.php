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

$colname_list_acao_fazenda = "-1";
if (isset($_GET['id_local'])) {
  $colname_list_acao_fazenda = $_GET['id_local'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao_fazenda = sprintf("SELECT id_local, razao_social, fantasia, cnpj FROM tbnext_mod_empresa_local WHERE id_local = %s ORDER BY razao_social ASC", GetSQLValueString($colname_list_acao_fazenda, "int"));
$list_acao_fazenda = mysql_query($query_list_acao_fazenda, $connection) or die(mysql_error());
$row_list_acao_fazenda = mysql_fetch_assoc($list_acao_fazenda);
$totalRows_list_acao_fazenda = mysql_num_rows($list_acao_fazenda);
?>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
f
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
<span id="spryselect1">
<label for="id_fazenda"></label>
<select name="id_fazenda" id="id_fazenda">
  <?php
do {  
?>
  <option value="<?php echo $row_list_acao_fazenda['id_fazenda']?>"><?php echo $row_list_acao_fazenda['fantasia']?></option>
  <?php
} while ($row_list_acao_fazenda = mysql_fetch_assoc($list_acao_fazenda));
  $rows = mysql_num_rows($list_acao_fazenda);
  if($rows > 0) {
      mysql_data_seek($list_acao_fazenda, 0);
	  $row_list_acao_fazenda = mysql_fetch_assoc($list_acao_fazenda);
  }
?>
</select>
<span class="selectRequiredMsg">Please select an item.</span></span>
<?php
mysql_free_result($list_acao_fazenda);
?>
