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
$query_list_med = "SELECT * FROM tbnext_mod_sma_manejo_medicamentos WHERE id_manejo = '".$id_manejo."' ";
$list_med = mysql_query($query_list_med, $connection) or die(mysql_error());
$row_list_med = mysql_fetch_assoc($list_med);
$totalRows_list_med = mysql_num_rows($list_med);
?>

<table width="600" border="0" cellspacing="1" cellpadding="0">
  <tr class="rel_subtitulo" >
    <td width="0" >&nbsp;Nome</td>
    <td >&nbsp;Princípio Ativo</td>
    <td >Restrição(dias)</td>
    <td align="center">Qtdd</td>
    <td align="center" >Valor</td>
    <td align="center" >Custo</td>
  </tr>
  <?php do { ?>
  <tr class="rel_info" style="background-color:#FFF; border:#4F5118 solid 1px; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;">
    <td><b>&nbsp;&nbsp;<?php echo $row_list_med['nome_produto']; ?></b></td>
    <td>&nbsp;&nbsp;<?php echo $row_list_med['principio_ativo']; ?>
    
    </td>
    <td align="center"><?php echo $row_list_med['restricao']; ?></td>
    <td align="center"><?php echo $row_list_med['qtdd']; ?></td>
    <td align="center"><?php echo $row_list_med['valor_custo']; ?></td>
    <td align="center"><?php echo $row_list_med['valor_total']; ?></td>
  </tr>
   <?php } while ($row_list_med = mysql_fetch_assoc($list_med)); ?>
</table>

 

<?php
mysql_free_result($list_med);
?>
