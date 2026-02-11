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

$colname_list_categoria = "-1";
if (isset($_POST['id_setor'])) {
  $colname_list_categoria = $_POST['id_setor'];
}
mysql_select_db($database_connection, $connection);
$query_list_categoria = sprintf("SELECT * FROM tbnext_produtos_categoria WHERE id_setor = %s ORDER BY nome_categoria ASC", GetSQLValueString($colname_list_categoria, "int"));
$list_categoria = mysql_query($query_list_categoria, $connection) or die(mysql_error());
$row_list_categoria = mysql_fetch_assoc($list_categoria);
$totalRows_list_categoria = mysql_num_rows($list_categoria);
?>
<script>
$(function(){

$('#id_categoria').change(function(){
		var var_id=$('#id_categoria').val();
	loadsDataAbsoluto('#selec_subcategoria','../mod_empresa_produtos/acao_comum_subcategoria.php','&id_categoria='+var_id);
});
});

</script>

<select name="id_categoria" id="id_categoria" required <?php echo $exc; ?>>
  <option value="" <?php if (!(strcmp("", $_POST['id_categoria']))) {echo "selected=\"selected\"";} ?>>---</option>
  <?php
do {  
?>
  <option value="<?php echo $row_list_categoria['id_categoria']?>"<?php if (!(strcmp($row_list_categoria['id_categoria'], $_POST['id_categoria']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_categoria['nome_categoria']?></option>
  <?php
} while ($row_list_categoria = mysql_fetch_assoc($list_categoria));
  $rows = mysql_num_rows($list_categoria);
  if($rows > 0) {
      mysql_data_seek($list_categoria, 0);
	  $row_list_categoria = mysql_fetch_assoc($list_categoria);
  }
?>
</select>

<?php
mysql_free_result($list_categoria);
?>
