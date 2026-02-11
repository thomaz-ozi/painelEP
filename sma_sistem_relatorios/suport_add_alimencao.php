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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
  $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_otimizar_alimentacao (id_animais, kilo_soma_animal, custo_kilo, custo_extra, custo_alimentacao, periodo_total_dias) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_animais'], "int"),
                       GetSQLValueString($_POST['kilo_soma_animal'], "double"),
                       GetSQLValueString($_POST['custo_kilo'], "double"),
                       GetSQLValueString($_POST['custo_extra'], "double"),
                       GetSQLValueString($_POST['custo_alimentacao'], "double"),
                       GetSQLValueString($_POST['periodo_total_dias'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
?>

<form name="acao" method="POST" action="<?php echo $editFormAction; ?>">
  <label for="kilo_soma_animal"></label>
  <input type="text" name="kilo_soma_animal" id="kilo_soma_animal">
  <label for="otimizar_data"></label>
  <input type="text" name="otimizar_data" id="otimizar_data">
  <label for="id_animais"></label>
  <input type="text" name="id_animais" id="id_animais">
  <label for="soma_kilo_animal"></label>
  <input type="text" name="soma_kilo_animal" id="soma_kilo_animal">
  <label for="custo_kilo"></label>
  <input type="text" name="custo_kilo" id="custo_kilo">
  <label for="custo_extra"></label>
  <input type="text" name="custo_extra" id="custo_extra">
  <label for="custo_alimentacao"></label>
  <input type="text" name="custo_alimentacao" id="custo_alimentacao">
  <label for="periodo_total_dias"></label>
  <input type="text" name="periodo_total_dias" id="periodo_total_dias">
  <input type="hidden" name="MM_insert" value="acao">
</form>
