<?php require_once('../Connections/connection.php'); ?>
<?php
/*
  $SQLtable='tbnext_mod_sma_otimizar_alimentacao';
mysql_select_db($database_connection, $connection);
echo $sql = "TRUNCATE  `$SQLtable`";
mysql_query($sql);
echo "Table Deleted";
mysql_close($connection);
*/
//sleep(10);
 ?>

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

$maxRows_relatorio_list_acao = 1555;
$pageNum_relatorio_list_acao = 0;
if (isset($_GET['pageNum_relatorio_list_acao'])) {
  $pageNum_relatorio_list_acao = $_GET['pageNum_relatorio_list_acao'];
}
$startRow_relatorio_list_acao = $pageNum_relatorio_list_acao * $maxRows_relatorio_list_acao;

mysql_select_db($database_connection, $connection);
$query_relatorio_list_acao = "SELECT * FROM tbnext_mod_sma_cad_animais";
echo $query_limit_relatorio_list_acao = sprintf("%s LIMIT %d, %d", $query_relatorio_list_acao, $startRow_relatorio_list_acao, $maxRows_relatorio_list_acao);
$relatorio_list_acao = mysql_query($query_limit_relatorio_list_acao, $connection) or die(mysql_error());
$row_relatorio_list_acao = mysql_fetch_assoc($relatorio_list_acao);

if (isset($_GET['totalRows_relatorio_list_acao'])) {
  $totalRows_relatorio_list_acao = $_GET['totalRows_relatorio_list_acao'];
} else {
  $all_relatorio_list_acao = mysql_query($query_relatorio_list_acao);
  $totalRows_relatorio_list_acao = mysql_num_rows($all_relatorio_list_acao);
}
$totalPages_relatorio_list_acao = ceil($totalRows_relatorio_list_acao/$maxRows_relatorio_list_acao)-1;
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Qtdd:<?php echo $totalRows_relatorio_list_acao; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Custo alimentação</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="193">ID</td>
    <td width="195">Kilo animal</td>
    <td width="275">Custo </td>
    <td width="275">Custo - extra</td>
    <td width="275">Custo alimentacao</td>
    <td width="275">total dias</td>
  </tr>
  
  <?php 
   $otimizar_data=date(Y.'_'.m.'-'.d);
  
  ?>
  <?php  do { ?>
  <tr>
    
      <td><?php echo $id_animais=$row_relatorio_list_acao['id_animais']; ?>
      <?php include ('../sma_sistem_relatorios/include_animais_alimentacao_soma.php'); ?>

      </td>
      <td><?php echo $kilo_soma_animal=$row_list_acao['soma_kilo_animal'] ?></td>
      <td><?php echo $custo_kilo=$row_list_acao['kilo_custo']; ?></td>
      <td><?php echo $custo_extra= $row_list_acao['extra_custo']; ?></td>
      <td><?php echo $custo_alimentacao= $row_list_acao['custo_alimentacao']; ?></td>
      <td><?php echo $periodo_total_dias=$row_list_acao['periodo_total_dias']; ?></td>
    </tr>
  <?php
 

/*

  
  $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_otimizar_alimentacao (id_otimizar_alimentacao, otimizar_data, id_animais, kilo_soma_animal, custo_kilo, custo_extra, custo_alimentacao, periodo_total_dias) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($id_otimizar_alimentacao, "int"),
                       GetSQLValueString($otimizar_data, "date"),
                       GetSQLValueString($id_animais, "int"),
                       GetSQLValueString($kilo_soma_animal, "double"),
                       GetSQLValueString($custo_kilo, "double"),
                       GetSQLValueString($custo_extra, "double"),
                       GetSQLValueString($custo_alimentacao, "double"),
                       GetSQLValueString($periodo_total_dias, "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());


*/
  
   ?>
  <?php } while ($row_relatorio_list_acao = mysql_fetch_assoc($relatorio_list_acao)); ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
SUCESSO!!!
<?php
mysql_free_result($relatorio_list_acao);
?>
