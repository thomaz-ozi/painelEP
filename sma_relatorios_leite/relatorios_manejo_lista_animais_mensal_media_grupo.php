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
  $query_list_soma = "SELECT 
 						AVG(leite_qtdd_litros)AS leite_qtdd_litros_soma,
						AVG(valor_venda_litros_soma)AS valor_venda_litros_soma,
						AVG(faturado)AS faturado_soma,
						AVG(alimentacao_qtdd_concentrado)AS alimentacao_qtdd_concentrado_soma,
						AVG(alimentacao_custo_concentrado)AS alimentacao_custo_concentrado_soma,
						AVG(alimentacao_qtdd_volumoso)AS alimentacao_qtdd_volumoso_soma,
						AVG(alimentacao_custo_volumoso)AS alimentacao_custo_volumoso_soma,
						
						AVG(alimentacao_qtdd_mineral)AS alimentacao_qtdd_mineral_soma,
						AVG(alimentacao_custo_mineral)AS alimentacao_custo_mineral_soma,
						
						AVG(alimentacao_custo_total)AS alimentacao_custo_total_soma,
						
						AVG(custos_mao_obra)AS custos_mao_obra_soma,
						AVG(custos_outros)AS custos_outros_soma,
						
						AVG(custos_medicamentos)AS custos_medicamentos_soma,
						AVG(custos_total_geral)AS custos_total_geral_soma,
						AVG(custo_litro)AS custo_litro_soma,
						AVG(rentabilidade_litros)AS rentabilidade_litros_soma,
						AVG(rentabilidade_animal)AS rentabilidade_animal_soma
						
					FROM tbnext_mod_sma_otimizar_leite_relatorio 
					WHERE
					
					
					". $SQLlactacao."
					YEAR(data_registro)='".$ano."' AND
					MONTH(data_registro)='".$mes."' 
					";
$list_soma = mysql_query($query_list_soma, $connection) or die(mysql_error());
$row_list_soma = mysql_fetch_assoc($list_soma);
$totalRows_list_soma = mysql_num_rows($list_soma);
?>
<?php // echo $row_list_soma['leite_qtdd_litros_soma']; ?>
<?php
mysql_free_result($list_soma);
?>
