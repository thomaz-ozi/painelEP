<?php require_once('../Connections/connection_user.php'); ?>

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
   $updateSQL = sprintf("UPDATE tbnext_usuario SET senha=%s WHERE id_usuario=%s",
                       GetSQLValueString(md5(strtoupper($_POST['senha'])), "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_connection_user, $connection_user);
  $Result1 = mysql_query($updateSQL, $connection_user) or die(mysql_error());
}

$colname_list_m5_help = "-1";
if (isset($_GET['usuario'])) {
  $colname_list_m5_help = $_GET['usuario'];
}
mysql_select_db($database_connection_user, $connection_user);
$query_list_m5_help = sprintf("SELECT id_usuario, usuario, senha FROM tbnext_usuario WHERE usuario = %s", GetSQLValueString($colname_list_m5_help, "text"));
$list_m5_help = mysql_query($query_list_m5_help, $connection_user) or die(mysql_error());
$row_list_m5_help = mysql_fetch_assoc($list_m5_help);
$totalRows_list_m5_help = mysql_num_rows($list_m5_help);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
<!--
.titulo {
	font-family: "Arial Black", Gadget, sans-serif;
	color: #FFF;
}
.opcoes {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #000;
}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="42%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" align="center" bgcolor="#000000" class="titulo">HELP Sitema MD5</td>
    </tr>
    <tr>
      <td width="21%" align="left" class="opcoes">Usuario:
      <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_m5_help['id_usuario']; ?>" /></td>
      <td width="79%"><label>
        &nbsp;&nbsp;&nbsp; <span class="opcoes"><?php echo $row_list_m5_help['usuario']; ?>
      </span></label></td>
    </tr>
    <tr>
      <td align="left" class="opcoes">Senha:</td>
      <td><?php if($_POST['senha']==''){ ?><input name="senha" id="senha" value="" /><?php }else{echo "senha alterada com sucesso!";} ?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#000000"><label>
         <input name="altera senha" type="submit" class="opcoes" id="altera senha" value="Altera Senha" />
      </label></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
</form>
</body>
</html>
<?php
mysql_free_result($list_m5_help);
?>
