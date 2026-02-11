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

if ((isset($_POST['id_class'])) && ($_POST['id_class'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_mod_empresa_clientes_class WHERE id_class=%s",
                       GetSQLValueString($_POST['id_class'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_class'])) {
  $colname_list_acao = $_GET['id_class'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_empresa_clientes_class WHERE id_class = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<form name="form1" method="POST">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="100%" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td  align="left"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left">&nbsp;&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td  align="center"><img src="<?php echo "$local_icons"; ?>excluir-30.png" width="30" height="30" /></td>
          <td  align="left">Excluir</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="32" align="left" bgcolor="#FFFFFF" class="txt"><p align="center" class="txt-Botao-Excluir style2">TEM CERTEZA EM EXCLUIR?</p></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="16%" align="left"  class="txt-opcoes">Classifica&ccedil;&atilde;o*:
            <input name="id_class" type="hidden" id="id_class" value="<?php echo $row_list_acao['id_class']; ?>" />
            <input name="res" type="hidden" id="res" value="res" />
            <input name="list" type="hidden" id="list" value="set" />
            <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" /></td>
          <td width="84%" align="left"  class="txt"><?php echo $row_list_acao['xNome']; ?></td>
</tr>
        <tr>
          <td colspan="2" align="left"  class="txt-opcoes">Descri&ccedil;&atilde;o:</td>
        </tr>
        <tr>
          <td colspan="2" align="center"  class="txt"><?php echo $row_list_acao['descricao']; ?></td>
        </tr>
        <tr> </tr>
        <tr> </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center" class="txt-Indece">
        <input name="Alterar" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar" value="|&lt; Voltar" />
        <input name="Excluir" type="submit" class="txt-Botao-Excluir" id="Excluir" value="Excluir">
      </td>
    </tr>
  </table>
    
  
</form>
<?php 
//envio de resposta do formulario
$list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "res_exc.php";
}


mysql_free_result($list_acao);
?>
