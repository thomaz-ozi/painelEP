<?php require_once('../../Connections/connection.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
  $updateSQL = sprintf("UPDATE tbnext_mod_empresa_clientes SET data_acao=%s, id_usuario=%s, id_local=%s, id_atuacao=%s, xNome=%s, xFan=%s, cpf_cnpj=%s, CNPJ=%s, IE=%s, responsavel=%s, CPF=%s, RG=%s, data_nasc=%s, descricao=%s WHERE id_clientes=%s",
                       GetSQLValueString($_POST['data_acao'], "date"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['id_local'], "int"),
                       GetSQLValueString($_POST['id_atuacao'], "int"),
                       GetSQLValueString($_POST['xNome'], "text"),
                       GetSQLValueString($_POST['xFan'], "text"),
                       GetSQLValueString($_POST['cpf_cnpj'], "int"),
                       GetSQLValueString($_POST['CNPJ'], "text"),
                       GetSQLValueString($_POST['IE'], "text"),
                       GetSQLValueString($_POST['responsavel'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['RG'], "text"),
                       GetSQLValueString($_POST['data_nasc'], "date"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['id_clientes'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}
?>

<form name="acao" method="POST" action="<?php echo $editFormAction; ?>">
<input name="id_clientes" type="hidden" value="">
<input name="data_acao" type="hidden" value="">
<input name="id_usuario" type="hidden" value="">
<input name="id_local" type="hidden" value="">
<input name="id_atuacao" type="hidden" value="">
<input name="xNome" type="hidden" value="">
<input name="xFan" type="hidden" value="">
<input name="cpf_cnpj" type="hidden" value="">
<input name="CNPJ" type="hidden" value="">
<input name="IE" type="hidden" value="">
<input name="responsavel" type="hidden" value="">
<input name="CPF" type="hidden" value="">
<input name="RG" type="hidden" value="">
<input name="data_nasc" type="hidden" value="">
<input name="descricao" type="hidden" value="">
<input type="hidden" name="MM_insert" value="acao">
<input type="hidden" name="MM_update" value="acao">

</form>
