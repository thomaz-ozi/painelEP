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
  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_clientes_class (id_class, id_usuario, xNome, descricao) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_class'], "int"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['xNome'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<form action="<?php echo $editFormAction; ?>" name="acao" method="POST">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="100%" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td ><img src="<?php echo "$local_icons"; ?>add-30.png" width="30" height="30" /></td>
          <td  align="left">Adicionar</td>
        </tr>
      </table></td>
    </tr><?php if($cliente_mod_produtos_setor==1){?><?php }?>
    <tr>
      <td align="center" class="txt"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="16%" align="left"  class="txt-opcoes">Classifica&ccedil;&atilde;o*:
            <input name="id_class" type="hidden" id="id_class" />
            <input name="res" type="hidden" id="res" value="res" />
            <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" /></td>
          <td width="84%" align="left"  class="txt"><span id="sprytextfield3">
            <input name="xNome" type="text" id="xNome" value="" size="50" class="txt-form"/>
            <span class="textfieldRequiredMsg">Campo Obrigat&oacute;rio</span></span></td>
</tr>
        <tr>
          <td colspan="2" align="left"  class="txt-opcoes">Descri&ccedil;&atilde;o:</td>
          </tr>
        <tr>
          <td colspan="2" align="center"  class="txt"><label>
            <textarea name="descricao" id="descricao" cols="50" rows="3" class="txt-form"></textarea>
          </label></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center" class="txt-Indece">
        <input name="Alterar" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar" value="|&lt; Voltar" />
        <input name="Adicionar" type="submit" class="txt-Botao-ADD" id="Adicionar" value="Adicionar">
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="acao" />
</form>
<?php 
//Resposta do formulario
if ($_POST['res']=='res'){include "../sistema/res_add.php";}
?>
<script type="text/javascript">
<!--
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script>
