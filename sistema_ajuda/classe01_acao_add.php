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
  $insertSQL = sprintf("INSERT INTO tbnext_mod_site_texto_classe01 (nome, descricao, id_usuario) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
?>
<form action="<?php echo $editFormAction; ?>" name="acao" method="POST">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td ><img src="<?php echo "$local_icons"; ?>add-30.png" width="30" height="30" /></td>
          <td  align="left">Adicionar</td>
        </tr>
      </table></td>
    </tr><?php if($cliente_mod_produtos_setor==1){?><?php }?>
    <tr>
      <td width="12%" align="left" class="txt-opcoes">Nome:
        <input type="hidden" name="id_classe01" id="id_classe01" />
        <input name="res" type="hidden" id="res" value="res" />
      <input name="list" type="hidden" id="list" value="set" />
      <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
      </td>
      <td width="88%" align="left" class="txt"><label>
        <input name="nome" type="text" class="txt-form" id="nome"  required>
      </label></td>
    </tr>
    <tr>
      <td  colspan="2" align="center" valign="top" class="txt-opcoes"><div align="center">Descri&ccedil;&atilde;o</div></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="txt"><textarea name="descricao" cols="90" rows="3" class="txt-form" id="descricao"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="txt-Indece">
        <input name="Alterar" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar" value="|&lt; Voltar" />
        <input name="Adicionar" type="submit" class="txt-Botao-ADD" id="Adicionar" value="Adicionar">
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="acao" />
</form>
<?php 
//envio de resposta do formulario
$list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "res_add.php";
}
?>
