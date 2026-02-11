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

$maxRows_list_m5_help = 10;
$pageNum_list_m5_help = 0;
if (isset($_GET['pageNum_list_m5_help'])) {
  $pageNum_list_m5_help = $_GET['pageNum_list_m5_help'];
}
$startRow_list_m5_help = $pageNum_list_m5_help * $maxRows_list_m5_help;

$colname_list_m5_help = "-1";
if (isset($_POST['usuario'])) {
  $colname_list_m5_help = $_POST['usuario'];
}
mysql_select_db($database_connection_user, $connection_user);
$query_list_m5_help = sprintf("SELECT id_usuario, usuario, senha FROM tbnext_usuario WHERE usuario = %s", GetSQLValueString($colname_list_m5_help, "text"));
$query_limit_list_m5_help = sprintf("%s LIMIT %d, %d", $query_list_m5_help, $startRow_list_m5_help, $maxRows_list_m5_help);
$list_m5_help = mysql_query($query_limit_list_m5_help, $connection_user) or die(mysql_error());
$row_list_m5_help = mysql_fetch_assoc($list_m5_help);

if (isset($_GET['totalRows_list_m5_help'])) {
  $totalRows_list_m5_help = $_GET['totalRows_list_m5_help'];
} else {
  $all_list_m5_help = mysql_query($query_list_m5_help);
  $totalRows_list_m5_help = mysql_num_rows($all_list_m5_help);
}
$totalPages_list_m5_help = ceil($totalRows_list_m5_help/$maxRows_list_m5_help)-1;
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
<form id="form1" name="form1" method="POST">
  <table width="42%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" align="center" bgcolor="#000000" class="titulo">HELP Sitema MD5</td>
    </tr>
    <tr>
      <td width="21%" align="left" class="opcoes">Usuario:
      <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_m5_help['id_usuario']; ?>" /></td>
      <td width="79%"><label>
        &nbsp;&nbsp;&nbsp; <input name="usuario" type="text" class="opcoes" id="usuario" value="<?php echo $row_list_m5_help['usuario']; ?>" />
      </label></td>
    </tr>
    <tr bgcolor="#E8E8E8">
      <td align="left" class="opcoes">&nbsp;</td>
      <td><label>
      &nbsp;&nbsp;&nbsp;Lista de usuario</label></td>
    
    </tr>
    <?php do { ?>
      <tr>
        <td align="left" class="opcoes">&nbsp;</td>
        <td> <a href="md5_help_adm_res.php?usuario=<?php echo $row_list_m5_help['usuario']; ?>"><?php echo $row_list_m5_help['usuario']; ?></a></td>
      </tr>
       <?php } while ($row_list_m5_help = mysql_fetch_assoc($list_m5_help)); ?>
    <tr> 
	
      <td colspan="2" align="center" bgcolor="#000000"><label>
         <input name="altera senha" type="submit" class="opcoes" id="pesquisar" value="pesquisar" />
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($list_m5_help);
?>
