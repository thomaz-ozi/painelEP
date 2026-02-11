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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
	
	
$id_cliente_comunicacao=$_POST['id_cliente_comunicacao'];
$id_cliente_comunicacao_tipo= $_POST['id_cliente_comunicacao_tipo'];
$id_class=$_POST['id_class'];
$id_clientes= $_POST['id_clientes'];
$data_acao= $_POST['data_acao'];
$xNome_contato= $_POST['xNome_contato'];
$xNome_contato_2= $_POST['xNome_contato_2'];
	
	
	
	
for($c = 0; $c < sizeof($xNome_contato); $c++) {	
  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_clientes_comunicacao (id_cliente_comunicacao, id_cliente_comunicacao_tipo, id_class, id_clientes, data_acao, xNome_contato, xNome_contato_2) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($id_cliente_comunicacao[$c], "int"),
                       GetSQLValueString($id_cliente_comunicacao_tipo[$c], "int"),
                       GetSQLValueString($id_class[$c], "int"),
                       GetSQLValueString($id_clientes[$c], "int"),
                       GetSQLValueString($data_acao, "date"),
                       GetSQLValueString($xNome_contato[$c], "text"),
                       GetSQLValueString($xNome_contato_2[$c], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
}
?>
<form name="form" action="<?php echo $editFormAction; ?>" method="POST">
<input name="id_cliente_comunicacao" type="hidden" value="">
<input name="id_cliente_comunicacao_tipo" type="hidden" value="">
<input name="id_class" type="hidden" value="">
<input name="id_clientes" type="hidden" value="">
<input name="xNome_contato" type="hidden" value="">
<input name="xNome_contato_2" type="hidden" value="">
<input name="data_acao" type="hidden" value="">
<input type="hidden" name="MM_insert" value="form">

</form>