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
$query_list_periodo = "SELECT * FROM vwnext_relatorio_manejo_leite_periodo WHERE id_manejo = '".$id_manejo."' AND id_animais='".$id_animais."'";
$list_periodo = mysql_query($query_list_periodo, $connection) or die(mysql_error());
$row_list_periodo = mysql_fetch_assoc($list_periodo);
$totalRows_list_periodo = mysql_num_rows($list_periodo);
?>
<table width="600" border="0" cellspacing="1" cellpadding="0">
  <tr class="rel_subtitulo" >
    <td >Data Inicial</td>
    <td style="background-color:#FFF;  font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;"><?php echo converte_data($row_list_periodo['data_inicial']); ?></td>
    <td >Data Final</td>
    <td align="center" style="background-color:#FFF;  font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;"><?php echo converte_data($row_list_periodo['data_final']); ?></td>
  </tr>
  <tr class="rel_subtitulo" >
    <td width="160" >Periodo</td>
    <td width="154" >Valor (R$)</td>
    <td width="108" >&nbsp;Qtdd de Leite</td>
    <td width="173" align="center">&nbsp;&nbsp;Faturamento(R$)</td>
  </tr>
  <tr class="rel_info" style="background-color:#FFF; border:#4F5118 solid 1px; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;">
    <td align="center"><span style="background-color:#FFF;  font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;"><?php echo $row_list_periodo['periodo_total_dias']; ?></span></td>
    <td><b>&nbsp;&nbsp;<span style="padding:5px;"><?php echo $row_list_periodo['leite_valor_estimado']; ?></span></b></td>
    <td>&nbsp;&nbsp;<b><span style="padding:5px;"><?php echo $row_list_periodo['leite_qtdd']; ?></span></b></td>
    <td align="center"><?php echo $row_list_periodo['leite_qtdd']*$row_list_periodo['leite_valor_estimado']; ?></td>
  </tr>
  <tr class="rel_subtitulo">
    <td>Proteina (%)</td>
    <td>Gordura (%)</td>
    <td>CCS</td>
    <td align="center" title="">CBT</td>
  </tr>
  <tr class="rel_info" style="background-color:#FFF; border:#4F5118 solid 1px; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;">
    <td><?php echo $row_list_periodo['leite_proteina']; ?></td>
    <td><b><span style="padding:5px;"><?php echo $row_list_periodo['leite_gordura']; ?></span></b></td>
    <td><b><span style="padding:5px;"><?php echo $row_list_periodo['leite_ccs']; ?></span></b></td>
    <td align="center"><b><span style="padding:5px;"><?php echo $row_list_periodo['leite_cbt']; ?></span></b></td>
  </tr>
</table>
<?php

mysql_free_result($list_periodo);
?>