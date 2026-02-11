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
  $updateSQL = sprintf("UPDATE tbnext_usuario_setor SET xNome=%s, descricao=%s, id_class_categoria=%s WHERE id_usuario_setor=%s",
                       GetSQLValueString($_POST['xNome'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['id_class_categoria'], "int"),
                       GetSQLValueString($_POST['id_usuario_setor'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_usuario_setor'])) {
  $colname_list_acao = $_GET['id_usuario_setor'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_usuario_setor WHERE id_usuario_setor = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
// include "../funcoes/perfusuario.php"; ?>
<?php  include ("conf.php"); ?>

<?php include "fckeditor/fckeditor.php";?>
<form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
  <table width="98%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="3" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left"><?php echo "$sistema_nome"; ?></td>
          <td  align="center"><img src="<?php echo "$local_icons"; ?>alt-30.png" width="30" height="30" /></td>
          <td align="left">Alterar</td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center"></div></td>
    </tr>
    <tr>
      <td width="15%" align="left" class="txt-opcoes"><label for="checkbox_row_7">Setor:
          <input name="id_usuario_setor" type="hidden" id="id_usuario_setor" value="<?php echo $row_list_acao['id_usuario_setor']; ?>" />
          <input name="res" type="hidden" id="res" value="res" />
      </label></td>
      <td width="51%" align="left" class="txt"><label>
        <input name="xNome" type="text" class="txt-form" id="xNome" value="<?php echo $row_list_acao['xNome']; ?>" size="50" maxlength="30" />
      </label></td>
      <td width="34%" align="left" class="txt"><span class="texto">&quot;maximo de 30 caracteres&quot;</span></td>
    </tr>
  
    <tr>
      <td colspan="3" align="center" class="txt-opcoes">Descri&ccedil;&atilde;o&quot;maximo de 255 caracteres&quot;
      </td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="top" bgcolor="#FFFFFF" class="txt">
     
      <label>
        <textarea name="descricao" id="descricao" cols="85" rows="3"><?php echo $row_list_acao['descricao']; ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center">
        <input name="Alterar2" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar2" value="|&lt; Voltar" />
        <input name="Alterar" type="submit" class="txt-Botao-Alterar" id="Alterar" value="Alterar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="acao" />
</form>
<?php 
//envio de resposta do formulario
$res=$_POST['res'];
if ($res==res){
	include "res_alt.php";
} 

mysql_free_result($list_acao);
?>


