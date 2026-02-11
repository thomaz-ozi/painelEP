<span style="display:none;"><?php require_once('../Connections/connection.php'); ?></span>
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
$query_list_email = "SELECT * FROM tbnext_mod_empresa_clientes_comunicacao WHERE id_clientes = '".$id_clientes."' AND id_comunicacao_tipo='3' ORDER BY `xNome_contato` ASC ";
$list_email = mysql_query($query_list_email, $connection) or die(mysql_error());
$row_list_email = mysql_fetch_assoc($list_email);
$totalRows_list_email = mysql_num_rows($list_email);
?>
<select name="id_comunicacao" id="id_comunicacao" required  class="form-control">
  <option value="">---</option>
  <?php
do {  
?>
  <option value="<?php echo $row_list_email['id_comunicacao']?>"><?php echo $row_list_email['xNome_contato']; ?></option>
  <?php
} while ($row_list_email = mysql_fetch_assoc($list_email));
  $rows = mysql_num_rows($list_email);
  if($rows > 0) {
      mysql_data_seek($list_email, 0);
	  $row_list_email = mysql_fetch_assoc($list_email);
  }
?>
</select>
<?php
mysql_free_result($list_email);
?>
