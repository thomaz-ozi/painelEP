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
 $query_list_animais_cruzamento = "SELECT * FROM vwnext_mod_sma_manejo_animais_cad_animais WHERE  id_manejo ='".$row_relatorio_list_acao['id_manejo']."'   AND sexo =  '1'  ORDER BY cod_animal ASC";
$list_animais_cruzamento = mysql_query($query_list_animais_cruzamento, $connection) or die(mysql_error());
$row_list_animais_cruzamento = mysql_fetch_assoc($list_animais_cruzamento);
$totalRows_list_animais_cruzamento = mysql_num_rows($list_animais_cruzamento);

?>
<?php do { ?>
  <div  class="rel_info2"><b>Reprotutor COD:</b> &nbsp;
  
  <span class="rel_cod_animal" onClick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_animal.php?cod_animal=<?php  echo strtolower($row_list_animais_cruzamento['cod_animal']); ?>',
'','toolbar=no, location=no, menubar=no, status=yes, scrollbars=yes,  resizable=yes, width=1024, height=768, ')"> 
  

  
  <?php echo strtolower( $row_list_animais_cruzamento['cod_animal']); ?></span>&nbsp;&nbsp;<b> | Lote:</b> <?php  $id_local= $row_list_animais_cruzamento['id_local']; include("../sma_lote/list_lote.php"); ?> <?php  echo $row_list_filtro_lote['nome']; ?>&nbsp;<b>| Classificação: </b><?php $id_animal_class= $row_list_animais_cruzamento['id_animal_class'];
  include ("../sma_animais/list_animais_class.php");  echo $row_list_filtro_animais_class['nome']; ?>
  &nbsp;&nbsp;<b>| Parceiro: </b>
  <?php $id_usuario=$row_list_animais_cruzamento['id_usuario']; include ("../sistem_usuario/list_usuario.php");  echo $row_list_acao_usuario['nome']; ?></div>

  
  <?php
  
  //barrega barriga de aluguel
     include ("../sma_relatorios_leite/relatorios_manejo_animal_include_cruzamento_matriz_barriga_aluguel.php");?>
  <?php } while ($row_list_animais_cruzamento = mysql_fetch_assoc($list_animais_cruzamento)); ?>
<?php
mysql_free_result($list_animais_cruzamento);
?>
