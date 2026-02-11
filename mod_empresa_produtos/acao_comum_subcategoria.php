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

$colname_list_subcategoria = "-1";
if (isset($_POST['id_categoria'])) {
  $colname_list_subcategoria = $_POST['id_categoria'];
}
mysql_select_db($database_connection, $connection);
$query_list_subcategoria = sprintf("SELECT * FROM tbnext_produtos_subcategoria WHERE id_categoria = %s ORDER BY nome_subcategoria ASC", GetSQLValueString($colname_list_subcategoria, "int"));
$list_subcategoria = mysql_query($query_list_subcategoria, $connection) or die(mysql_error());
$row_list_subcategoria = mysql_fetch_assoc($list_subcategoria);
$totalRows_list_subcategoria = mysql_num_rows($list_subcategoria);
?>

<select name="id_subcategoria" id="id_subcategoria" <?php if($totalRows_list_subcategoria!=0) {echo 'required';}?>
<?php echo $exc; ?> >
  <option value="" <?php if (!(strcmp("", $_POST['id_subcategoria']))) {echo "selected=\"selected\"";} ?>>---</option>
  <?php
do {  
?>
  <option value="<?php echo $row_list_subcategoria['id_subcategoria']?>"<?php if (!(strcmp($row_list_subcategoria['id_subcategoria'], $_POST['id_subcategoria']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_subcategoria['nome_subcategoria']?></option>
  <?php
} while ($row_list_subcategoria = mysql_fetch_assoc($list_subcategoria));
  $rows = mysql_num_rows($list_subcategoria);
  if($rows > 0) {
      mysql_data_seek($list_subcategoria, 0);
	  $row_list_subcategoria = mysql_fetch_assoc($list_subcategoria);
  }
?>
</select>

<?php
mysql_free_result($list_subcategoria);
?>
