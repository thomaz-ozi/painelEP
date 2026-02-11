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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
  $updateSQL = sprintf("UPDATE tbnext_mod_site_texto_classe01 SET nome=%s, descricao=%s, id_usuario=%s WHERE id_classe01=%s",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['id_classe01'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_classe01'])) {
  $colname_list_acao = $_GET['id_classe01'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_site_texto_classe01 WHERE id_classe01 = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>
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
      <td width="14%" align="left" class="txt-opcoes">Nome:
        <input name="id_classe01" type="hidden" id="id_classe01" value="<?php echo $row_list_acao['id_classe01']; ?>" />
      <input name="res" type="hidden" id="res" value="res" />
      <input name="list" type="hidden" id="list" value="set" />
      <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" /></td>
      <td width="86%" colspan="2" align="left" class="txt">
        <input name="nome" type="text" class="txt-form" id="nome" value="<?php echo $row_list_acao['nome']; ?>"  required>
   </td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="top" class="txt-opcoes"><div align="center">Descri&ccedil;&atilde;o</div>        <table width="100%" border="0" cellspacing="0" cellpadding="0">
         
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt"><textarea name="descricao" cols="70" rows="5" class="txt-form" id="descricao"><?php echo $row_list_acao['descricao']; ?></textarea></td>
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
