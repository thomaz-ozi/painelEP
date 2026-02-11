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
 $query_list_include = "SELECT * FROM tbnext_mod_sma_manejo_custo WHERE id_manejo = '".$id_manejo."' AND  id_animais ='".$row_relatorio_list_acao['id_animais']."'";
$list_include = mysql_query($query_list_include, $connection) or die(mysql_error());
$row_list_include = mysql_fetch_assoc($list_include);
$totalRows_list_include = mysql_num_rows($list_include);
?>
<table width="600" border="0" cellspacing="1" cellpadding="0">
  <tr class="rel_subtitulo" >
    <td width="0" >&nbsp;Data Inicial</td>
    <td >&nbsp;Data Final</td>
    <td align="center">Tempo de serviço</td>
  </tr>
  <tr class="rel_info" style="background-color:#FFF; border:#4F5118 solid 1px; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;">
    <td>&nbsp;&nbsp;<?php echo $row_list_include['data_inicial']; ?></td>
    <td>&nbsp;&nbsp;<?php echo $row_list_include['data_final']; ?></td>
    <td align="center"><?php echo $row_list_include['periodo_dias']; ?></td>
  </tr>
  <tr class="rel_subtitulo" >
    <td>Quantidade de Animais</td>
    <td>Valor</td>
    <td align="center">Valor animal por dia </td>
  </tr>
  <tr class="rel_info" style="background-color:#FFF; border:#4F5118 solid 1px; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;">
    <td><?php echo $row_list_include['qtdd_animais']; ?></td>
    <td><?php echo $row_list_include['valor_custo']; ?></td>
    <td align="center"><?php echo $row_list_include['valor_animais_dia']; ?></td>
  </tr>
</table>
<?php
mysql_free_result($list_include);

?>
