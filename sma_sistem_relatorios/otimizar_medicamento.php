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

$maxRows_relatorio_list_acao = 1550;
$pageNum_relatorio_list_acao = 0;
if (isset($_GET['pageNum_relatorio_list_acao'])) {
  $pageNum_relatorio_list_acao = $_GET['pageNum_relatorio_list_acao'];
}
$startRow_relatorio_list_acao = $pageNum_relatorio_list_acao * $maxRows_relatorio_list_acao;

mysql_select_db($database_connection, $connection);
$query_relatorio_list_acao = "SELECT * FROM tbnext_mod_sma_cad_animais";
$query_limit_relatorio_list_acao = sprintf("%s LIMIT %d, %d", $query_relatorio_list_acao, $startRow_relatorio_list_acao, $maxRows_relatorio_list_acao);
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
    <td align="center">CUSTO DE MEDICAMENTO</td>
  </tr>
  <tr>
    <td width="193">ID</td>
    <td width="275">Custo Medicamento</td>
  </tr>
  
  <?php 
   $otimizar_data=date(Y.'_'.m.'-'.d);
  
  ?>
  <?php  do { ?>
  <tr>
    
      <td><?php echo $id_animais=$row_relatorio_list_acao['id_animais']; ?>
        <?php include ('../sma_sistem_relatorios/relatorios_manejo_animais_custo_med.php'); ?>
        
      </td>
      <td><?php  echo $soma_custo_medicamento= $row_list_manejo_animais_custo_med['soma_custo_medicamento']; ?></td>
    </tr>
  <?php
 



   $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_otimizar_medicamento (id_otimizar_medicamento, id_animais, soma_custo_medicamento) VALUES (%s,  %s, %s)",
                       GetSQLValueString($id_otimizar_medicamento, "int"),
                       GetSQLValueString($id_animais, "int"),
                       GetSQLValueString($soma_custo_medicamento, "double"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());



  
   ?>
  <?php } while ($row_relatorio_list_acao = mysql_fetch_assoc($relatorio_list_acao)); ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
SUCESSO!!!
<?php
mysql_free_result($relatorio_list_acao);
?>
