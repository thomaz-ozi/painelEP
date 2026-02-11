<?php 	  require_once('../Connections/connection.php'); ?>
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
$query_list_manejo_alimentacao = "SELECT * FROM tbnext_mod_sma_manejo_alimentacao WHERE id_manejo = '".$id_manejo."'";
$list_manejo_alimentacao = mysql_query($query_list_manejo_alimentacao, $connection) or die(mysql_error());
$row_list_manejo_alimentacao = mysql_fetch_assoc($list_manejo_alimentacao);
$totalRows_list_manejo_alimentacao = mysql_num_rows($list_manejo_alimentacao);

mysql_select_db($database_connection, $connection);
$query_list_periodo = "SELECT * FROM tbnext_mod_sma_manejo_periodo WHERE id_manejo = '".$id_manejo."'";
$list_periodo = mysql_query($query_list_periodo, $connection) or die(mysql_error());
$row_list_periodo = mysql_fetch_assoc($list_periodo);
$totalRows_list_periodo = mysql_num_rows($list_periodo);





?><div class="rel_informacoes" style="width:600px;"><b>Pediodo Inicial:</b> <?php echo converte_data($row_list_periodo['data_inicial']); ?>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <b>Periodo Final:</b>  <?php echo converte_data($row_list_periodo['data_final']); ?></div>
  <table width="600" border="0" cellspacing="1" cellpadding="0">
    <tr class="rel_subtitulo">
    <td  >Classificação</td>
    <td align="center">Nome</td>
    <td align="center">Kilo/Animal</td>
    <td align="center">Valor/kilo</td>
    <td align="center">Total</td>
    </tr>
    <?php do { ?>
  <?php $id_alimentacao= $row_list_manejo_alimentacao['id_alimentacao']; 
  include("../sma_alimentacao/list_alimentacao.php");
  
  
  
  mysql_select_db($database_connection, $connection);
 $query_list_produtos = "SELECT id_produtos, id_categoria, id_subcategoria, nome_produto FROM tbnext_produtos WHERE id_produtos = '".$row_list_manejo_alimentacao['id_produtos']."'";
$list_produtos = mysql_query($query_list_produtos, $connection) or die(mysql_error());
$row_list_produtos = mysql_fetch_assoc($list_produtos);
$totalRows_list_produtos = mysql_num_rows($list_produtos);

mysql_select_db($database_connection, $connection);
 $query_list_produtos_class = "SELECT * FROM tbnext_produtos_subcategoria WHERE id_subcategoria = '".$row_list_produtos['id_subcategoria']."'";
$list_produtos_class = mysql_query($query_list_produtos_class, $connection) or die(mysql_error());
$row_list_produtos_class = mysql_fetch_assoc($list_produtos_class);
$totalRows_list_produtos_class = mysql_num_rows($list_produtos_class);

  
  
  ?>
  <tr style="background-color:#FFF; border:#4F5118 solid 1px; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;">
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_list_produtos_class['nome_subcategoria']; ?></td>
    <td align="center"><?php echo $row_list_manejo_alimentacao['nome_produto']; ?></td>
    <td align="center"><?php echo $row_list_manejo_alimentacao['kilo_animal']; ?></td>
    <td align="center"><?php echo $row_list_manejo_alimentacao['kilo_custo']; ?></td>
    <td align="center"><?php echo $row_list_manejo_alimentacao['valor_total']; ?></td>
  </tr>
    <?php } while ($row_list_manejo_alimentacao = mysql_fetch_assoc($list_manejo_alimentacao)); ?>
  <tr style="background-color:#FFF; border:#4F5118 solid 1px; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;">
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>

</table>

  
<?php
mysql_free_result($list_manejo_alimentacao);

mysql_free_result($list_periodo);

mysql_free_result($list_produtos_class);

mysql_free_result($list_produtos);
?>
