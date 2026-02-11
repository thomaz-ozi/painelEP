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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_otimizar_leite_relatorio (id_animais, cod_animal, data_registro, leite_qtdd_litros, valor_venda_litros, faturado, alimentacao_qtdd_concentrado, alimentacao_custo_concentrado, alimentacao_qtdd_volumoso, alimentacao_custo_columoso, alimentacao_qtdd_mineral, alimentacao_custo_mineral, alimentacao_custo_total, custos_mao_obra, custos_outros, custos_medicamentos, custos_total_geral, custo_litro, rentabilidade_litros, rentabilidade_animal) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_animais'], "int"),
                       GetSQLValueString($_POST['cod_animal'], "text"),
                       GetSQLValueString($_POST['data_registro'], "date"),
                       GetSQLValueString($_POST['leite_qtdd_litros'], "double"),
                       GetSQLValueString($_POST['valor_venda_litros'], "double"),
                       GetSQLValueString($_POST['faturado'], "double"),
                       GetSQLValueString($_POST['alimentacao_qtdd_concentrado'], "double"),
                       GetSQLValueString($_POST['alimentacao_custo_concentrado'], "double"),
                       GetSQLValueString($_POST['alimentacao_qtdd_volumoso'], "double"),
                       GetSQLValueString($_POST['alimentacao_custo_columoso'], "double"),
                       GetSQLValueString($_POST['alimentacao_qtdd_mineral'], "double"),
                       GetSQLValueString($_POST['alimentacao_custo_mineral'], "double"),
                       GetSQLValueString($_POST['alimentacao_custo_total'], "double"),
                       GetSQLValueString($_POST['custos_mao_obra'], "double"),
                       GetSQLValueString($_POST['custos_outros'], "double"),
                       GetSQLValueString($_POST['custos_medicamentos'], "double"),
                       GetSQLValueString($_POST['custos_total_geral'], "double"),
                       GetSQLValueString($_POST['custo_litro'], "double"),
                       GetSQLValueString($_POST['rentabilidade_litros'], "double"),
                       GetSQLValueString($_POST['rentabilidade_animal'], "double"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <input type="text" name="id_animais" id="id_animais">
  <input type="text" name="cod_animal" id="cod_animal">
  <input type="text" name="data_registro" id="data_registro">
  <input type="text" name="leite_qtdd_litros" id="leite_qtdd_litros">
  <input type="text" name="valor_venda_litros" id="valor_venda_litros">
  <input type="text" name="faturado" id="faturado">
  <input type="text" name="alimentacao_qtdd_concentrado" id="alimentacao_qtdd_concentrado">
  <input type="text" name="alimentacao_custo_concentrado" id="alimentacao_custo_concentrado">
  <input type="text" name="alimentacao_qtdd_volumoso" id="alimentacao_qtdd_volumoso">
  <input type="text" name="alimentacao_custo_columoso" id="alimentacao_custo_columoso">
  <input type="text" name="alimentacao_qtdd_mineral" id="alimentacao_qtdd_mineral">
  <input type="text" name="alimentacao_custo_mineral" id="alimentacao_custo_mineral">
  <input type="text" name="alimentacao_custo_total" id="alimentacao_custo_total">
  <input type="text" name="custos_mao_obra" id="custos_mao_obra">
  <input type="text" name="custos_outros" id="custos_outros">
  <input type="text" name="custos_medicamentos" id="custos_medicamentos">
  <input type="text" name="custos_total_geral" id="custos_total_geral">
  <input type="text" name="custo_litro" id="custo_litro">
  <input type="text" name="rentabilidade_litros" id="rentabilidade_litros">
  <input type="text" name="rentabilidade_animal" id="rentabilidade_animal">
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
</html>