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
$query_list_acao = "SELECT * FROM tbnext_mod_sma_manejo_escore ORDER BY id_escore ASC";
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Lista Escore </title>
<link href="relatorios_estilo.css" rel="stylesheet" type="text/css" />

</head>

<body><br />

<table width="800" border="0" cellspacing="1" cellpadding="0" class="rel_table" >
  <tr class="rel_opcoes">
    <td width="122" align="center">Escore</td>
    <td width="193" align="center">Codição</td>
    <td width="745">Descrição</td>
  </tr>
   <?php $l=1;?>
  <?php do { ?>
  <tr class="linha<?php   echo $l;  ?>">
    
      <td align="center"><?php echo $row_list_acao['id_escore']; ?></td>
      <td align="center"><?php echo $row_list_acao['condicao']; ?></td>
      <td style="padding:5px;"><?php echo $row_list_acao['descricao']; ?></td>
      
  </tr>
    <?php   $l++; if($l>2){   $l=1;}?>
  <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  <tr class="rel_titulo_fim">
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($list_acao);
?>
