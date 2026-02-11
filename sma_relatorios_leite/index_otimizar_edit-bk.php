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

$maxRows_acao_otimizar = 10;
$pageNum_acao_otimizar = 0;
if (isset($_GET['pageNum_acao_otimizar'])) {
  $pageNum_acao_otimizar = $_GET['pageNum_acao_otimizar'];
}
$startRow_acao_otimizar = $pageNum_acao_otimizar * $maxRows_acao_otimizar;

mysql_select_db($database_connection, $connection);
$query_acao_otimizar = "SELECT * FROM tbnext_mod_sma_otimizar_leite ORDER BY id_otimizar ASC";
$query_limit_acao_otimizar = sprintf("%s LIMIT %d, %d", $query_acao_otimizar, $startRow_acao_otimizar, $maxRows_acao_otimizar);
$acao_otimizar = mysql_query($query_limit_acao_otimizar, $connection) or die(mysql_error());
$row_acao_otimizar = mysql_fetch_assoc($acao_otimizar);

if (isset($_GET['totalRows_acao_otimizar'])) {
  $totalRows_acao_otimizar = $_GET['totalRows_acao_otimizar'];
} else {
  $all_acao_otimizar = mysql_query($query_acao_otimizar);
  $totalRows_acao_otimizar = mysql_num_rows($all_acao_otimizar);
}
$totalPages_acao_otimizar = ceil($totalRows_acao_otimizar/$maxRows_acao_otimizar)-1;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#333333" style="color:#FFF; font-family:Arial, Helvetica, sans-serif;">
    <td width="20%">&nbsp;&nbsp;Data Inicial</td>
    <td width="72%">&nbsp;&nbsp;Data Final</td>
    <td width="8%">&nbsp;</td>
  </tr><?php do { ?>
  <tr>
    
      <td><?php echo $row_acao_otimizar['data_otimizar']; ?></td>
      <td><?php echo $row_acao_otimizar['data_otimizar_ultimo']; ?></td>
      <td><button style="color:#900;">X</button></td>
      
  </tr>
  <tr><?php } while ($row_acao_otimizar = mysql_fetch_assoc($acao_otimizar)); ?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
mysql_free_result($acao_otimizar);
?>
