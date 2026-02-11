<?php require_once('../Connections/connection.php'); ?>
<?php
/*
  $SQLtable='tbnext_mod_sma_otimizar_peso';
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


<?php   do { ?>
  <?php  $id_animais=$row_relatorio_list_acao['id_animais']; ?>
  <?php   include("../sma_sistem_relatorios/relatorios_manejo_animais_peso.php");	?>
  <?php  $peso_atual= $row_relatorio_list_acao['peso']; ?>
  <?php  $primeira_data;?>
  <?php  $primeira_peso;?>
  <?php  $penultima_data;?>
  <?php  $penultima_peso;?>
  <?php  $ultima_data;?>
  <?php  $ultima_peso;?>
  <?php  $dias_interlado;?>
  <?php  $dias_total;?>
  <?php  $peso_media=($ultima_peso-$penultima_peso)/$dias_interlado; ?>
  <?php  $peso_media_geral=($ultima_peso-$primera_peso)/$dias_total; ?>
  <?php	    $peso_progessao_medio=$peso_media*$progessao_dias+$ultima_peso;	   ?>
  <?php    $peso_progessao_medio_geral=$peso_media_geral*$progessao_dias+$ultima_peso; ?>
<?php
$otimizar_data=$data_hoje;
  
  $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_otimizar_peso (id_otimizar_peso, otimizar_data, id_animais, peso_atual, primeira_data, primeira_peso, penultima_data, penultima_peso, ultima_data, ultima_peso, dias_interlado, dias_total, peso_media, peso_media_geral, peso_progessao_medio, peso_progessao_medio_geral) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($id_otimizar_peso, "int"),
                       GetSQLValueString($otimizar_data, "date"),
                       GetSQLValueString($id_animais, "int"),
                       GetSQLValueString($peso_atual, "double"),
                       GetSQLValueString($primeira_data, "date"),
                       GetSQLValueString($primeira_peso, "double"),
                       GetSQLValueString($penultima_data, "date"),
                       GetSQLValueString($penultima_peso, "double"),
                       GetSQLValueString($ultima_data, "date"),
                       GetSQLValueString($ultima_peso, "double"),
                       GetSQLValueString($dias_interlado, "int"),
                       GetSQLValueString($dias_total, "int"),
                       GetSQLValueString($peso_media, "double"),
                       GetSQLValueString($peso_media_geral, "double"),
                       GetSQLValueString($peso_progessao_medio, "double"),
                       GetSQLValueString($peso_progessao_medio_geral, "double"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  
  
   ?>
  <?php } while ($row_relatorio_list_acao = mysql_fetch_assoc($relatorio_list_acao)); ?>

SUCESSO!!!
<?php
mysql_free_result($relatorio_list_acao);
?>
