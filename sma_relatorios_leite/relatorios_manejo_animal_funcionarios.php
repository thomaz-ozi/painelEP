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
$query_list_func = "SELECT * FROM tbnext_mod_sma_manejo_funcionarios WHERE id_manejo = '".$id_manejo."' ORDER BY x_manejo_funcionario ASC";
$list_func = mysql_query($query_list_func, $connection) or die(mysql_error());
$row_list_func = mysql_fetch_assoc($list_func);
$totalRows_list_func = mysql_num_rows($list_func);
?>
<?php if($totalRows_list_func!=0){ ?>
<table width="600" border="0" cellspacing="1" cellpadding="0">
  <tr class="rel_subtitulo">
    <td>Nome do(s)Funcionario(s) </td>
  </tr>
  <?php do { ?>
  <tr style="background-color:#FFF; border:#4F5118 solid 1px; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;" >
    
      <td class="rel_info"><?php echo $row_list_func['x_manejo_funcionario']; ?></td>
    </tr>
  <?php } while ($row_list_func = mysql_fetch_assoc($list_func)); ?>
</table>
<?php } ?>
<?php
mysql_free_result($list_func);
?>
