
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
$query_list_complementar = "SELECT * FROM tbnext_mod_sma_manejo_animais_complementar WHERE id_manejo_animais = '".$id_manejo_animais."' ORDER BY id_complementar ASC";
$list_complementar = mysql_query($query_list_complementar, $connection) or die(mysql_error());
$row_list_complementar = mysql_fetch_assoc($list_complementar);
$totalRows_list_complementar = mysql_num_rows($list_complementar);
?>
<?php if($totalRows_list_complementar!='0'){  ?>
<table width="99%" border="0" align="right" cellpadding="0" cellspacing="1">
    <tr >
        <td><div style=" font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#666; font-weight:bold;">COMPLEMENTAR</div></td>
    </tr>
	<?php do { ?>
    <tr   >
      <td><div style=" font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#666;"> &nbsp;&nbsp;&nbsp;<?php $id_medicamentos= $row_list_complementar['id_medicamento']; 
	  include ("../sma_medicamentos/list_medicamento.php"); ?><?php echo $row_list_filtro_medicamento['nome']; ?>
        </div>
      </td>
    </tr>
    <tr
  class="txt" 
    >
      <td><div style=" font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#666; margin-left:15px;"><?php echo $row_list_complementar['descricao']; ?></div></td>
    </tr>
    <?php } while ($row_list_complementar = mysql_fetch_assoc($list_complementar)); ?>
  </table>
  <?php } ?>


<?php
mysql_free_result($list_complementar);
?>
