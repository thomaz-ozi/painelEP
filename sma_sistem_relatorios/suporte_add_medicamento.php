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
  $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_otimizar_medicamento (id_otimizar_medicamento, otimizar_data, id_animais, soma_custo_medicamento) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_otimizar_medicamento'], "int"),
                       GetSQLValueString($_POST['otimizar_data'], "date"),
                       GetSQLValueString($_POST['id_animais'], "int"),
                       GetSQLValueString($_POST['soma_custo_medicamento'], "double"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
?>
<form name="acao" method="POST" action="<?php echo $editFormAction; ?>">
  <label for="id_otimizar_medicamento"></label>
  <input type="text" name="id_otimizar_medicamento" id="id_otimizar_medicamento">
  <label for="id_animais"></label>
  <input type="text" name="id_animais" id="id_animais">
  <label for="soma_custo_medicamento"></label>
  <input type="text" name="soma_custo_medicamento" id="soma_custo_medicamento">
  <label for="otimizar_data"></label>
  <input type="text" name="otimizar_data" id="otimizar_data">
  <input type="hidden" name="MM_insert" value="acao">
</form>
