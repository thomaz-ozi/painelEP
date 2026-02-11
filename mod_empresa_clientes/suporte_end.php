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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_clientes_endereco (id_cliente_enderecos, id_clientes, xLgr, nro, xBairro, xMun, cMun, UF, cUF, CEP, cPais, xPais, cmpto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_cliente_enderecos'], "int"),
                       GetSQLValueString($_POST['id_clientes'], "int"),
                       GetSQLValueString($_POST['xLgr'], "text"),
                       GetSQLValueString($_POST['nro'], "text"),
                       GetSQLValueString($_POST['xBairro'], "text"),
                       GetSQLValueString($_POST['xMun'], "text"),
                       GetSQLValueString($_POST['cMun'], "int"),
                       GetSQLValueString($_POST['UF'], "int"),
                       GetSQLValueString($_POST['cUF'], "text"),
                       GetSQLValueString($_POST['CEP'], "text"),
                       GetSQLValueString($_POST['cPais'], "int"),
                       GetSQLValueString($_POST['xPais'], "text"),
                       GetSQLValueString($_POST['cmpto'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}

if ((isset($_POST['id_cliente_enderecos'])) && ($_POST['id_cliente_enderecos'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_mod_empresa_clientes_endereco WHERE id_cliente_enderecos=%s",
                       GetSQLValueString($_POST['id_cliente_enderecos'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
}
?>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<input name="id_cliente_enderecos" type="hidden" value="">
<input name="id_clientes" type="hidden" value="">
<input name="xLgr" type="hidden" value="">
<input name="nro" type="hidden" value="">
<input name="xBairro" type="hidden" value="">
<input name="xMun" type="hidden" value="">
<input name="cMun" type="hidden" value="">
<input name="UF" type="hidden" value="">
<input name="cUF" type="hidden" value="">
<input name="CEP" type="hidden" value="">
<input name="cPais" type="hidden" value="">
<input name="xPais" type="hidden" value="">
<input name="cmpto" type="hidden" value="">
<input type="hidden" name="MM_insert" value="form1">

</form>
