8<?php require_once('../Connections/connection.php'); ?>
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
  $updateSQL = sprintf("UPDATE tbnext_mod_empresa_clientes_class SET id_usuario=%s, xNome=%s, descricao=%s WHERE id_class=%s",
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['xNome'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['id_class'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_class'])) {
  $colname_list_acao = $_GET['id_class'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_empresa_clientes_class WHERE id_class = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);$colname_list_acao = "-1";

?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<form action="<?php echo $editFormAction; ?>" name="acao" method="POST">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="3" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td  align="center"><img src="<?php echo "$local_icons"; ?>alt-30.png" width="30" height="30" /></td>
          <td align="left">Alterar</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>          </tr>
        <tr>          </tr>
        <tr>          </tr>
        <tr>          </tr>
      </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="16%" align="left"  class="txt-opcoes">Classifica&ccedil;&atilde;o*:
              <input name="id_class" type="hidden" id="id_class" value="<?php echo $row_list_acao['id_class']; ?>" />
              <input name="res" type="hidden" id="res" value="res" />
              <input name="list" type="hidden" id="list" value="set" />
              <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" /></td>
            <td width="84%" align="left"  class="txt"><span id="sprytextfield3">
              <input name="xNome" type="text" id="xNome" value="<?php echo $row_list_acao['xNome']; ?>" size="50" class="txt-form"/>
              <span class="textfieldRequiredMsg">Campo Obrigat&oacute;rio</span></span></td>
</tr>
          <tr>
            <td colspan="2" align="left"  class="txt-opcoes">Descri&ccedil;&atilde;o:</td>
          </tr>
          <tr>
            <td colspan="2" align="center"  class="txt"><label>
              <textarea name="descricao" id="descricao" cols="50" rows="3" class="txt-form"><?php echo $row_list_acao['descricao']; ?></textarea>
            </label></td>
          </tr>
          <tr> </tr>
        </table>
        </div>        
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt-Indece">
        <input name="Alterar2" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar2" value="|&lt; Voltar" />
        <input name="Alterar" type="submit" class="txt-Botao-Alterar" id="Alterar" value="Alterar">
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="acao" />
</form>
<?php 
//envio de resposta do formulario
$list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "res_alt.php";
}


mysql_free_result($list_acao);


?>
<script type="text/javascript">
<!--
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script>
