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
  $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_otimizar_peso (id_otimizar_peso, otimizar_data, id_animais, peso_atual, primeira_data, primeira_peso, penultima_data, penultima_peso, ultima_data, ultima_peso, dias_interlado, dias_total, peso_media, peso_media_geral, peso_progessao_medio, peso_progessao_medio_geral) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_otimizar_peso'], "int"),
                       GetSQLValueString($_POST['otimizar_data'], "date"),
                       GetSQLValueString($_POST['id_animais'], "int"),
                       GetSQLValueString($_POST['peso_atual'], "double"),
                       GetSQLValueString($_POST['primeira_data'], "date"),
                       GetSQLValueString($_POST['primeira_peso'], "double"),
                       GetSQLValueString($_POST['penultima_data'], "date"),
                       GetSQLValueString($_POST['penultima_peso'], "double"),
                       GetSQLValueString($_POST['ultima_data'], "date"),
                       GetSQLValueString($_POST['ultima_peso'], "double"),
                       GetSQLValueString($_POST['dias_interlado'], "int"),
                       GetSQLValueString($_POST['dias_total'], "int"),
                       GetSQLValueString($_POST['peso_media'], "double"),
                       GetSQLValueString($_POST['peso_media_geral'], "double"),
                       GetSQLValueString($_POST['peso_progessao_medio'], "double"),
                       GetSQLValueString($_POST['peso_progessao_medio_geral'], "double"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <label for="id_otimizar_peso"></label>
  <input type="text" name="id_otimizar_peso" id="id_otimizar_peso" />
  <label for="otimizar_data"></label>
  <input type="text" name="otimizar_data" id="otimizar_data" />
  <label for="id_animais"></label>
  <input type="text" name="id_animais" id="id_animais" />
  <label for="peso_atual"></label>
  <input type="text" name="peso_atual" id="peso_atual" />
  <label for="primeira_data"></label>
  <input type="text" name="primeira_data" id="primeira_data" />
  <label for="primeira_peso"></label>
  <input type="text" name="primeira_peso" id="primeira_peso" />
  <label for="penultima_data"></label>
  <input type="text" name="penultima_data" id="penultima_data" />
  <label for="penultima_peso"></label>
  <input type="text" name="penultima_peso" id="penultima_peso" />
  <label for="ultima_data"></label>
  <input type="text" name="ultima_data" id="ultima_data" />
  <label for="ultima_peso"></label>
  <input type="text" name="ultima_peso" id="ultima_peso" />
  <label for="dias_interlado"></label>
  <input type="text" name="dias_interlado" id="dias_interlado" />
  <label for="dias_total"></label>
  <input type="text" name="dias_total" id="dias_total" />
  <label for="peso_media"></label>
  <input type="text" name="peso_media" id="peso_media" />
  <label for="peso_media_geral"></label>
  <input type="text" name="peso_media_geral" id="peso_media_geral" />
  <label for="peso_progessao_medio"></label>
  <input type="text" name="peso_progessao_medio" id="peso_progessao_medio" />
  <label for="peso_progessao_medio_geral"></label>
  <input type="text" name="peso_progessao_medio_geral" id="peso_progessao_medio_geral" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</body>
</html>