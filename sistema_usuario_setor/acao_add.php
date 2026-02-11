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
  $insertSQL = sprintf("INSERT INTO tbnext_usuario_setor (id_usuario_setor, xNome, descricao, id_class_categoria) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_usuario_setor'], "int"),
                       GetSQLValueString($_POST['xNome'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['id_class_categoria'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}


 // include "../funcoes/estilo.php"; ?>
<?php  include "conf.php"; ?>
<?php include "fckeditor/fckeditor.php";?>
<form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="3" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left"><?php echo "$sistema_nome"; ?></td>
          <td ><img src="<?php echo "$local_icons"; ?>add-30.png" width="30" height="30" /></td>
          <td  align="left">Adicionar</td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center"></div></td>
    </tr>
    <tr>
      <td width="20%" align="left" class="txt-opcoes"><label for="checkbox_row_7">Setor:
          <input name="id_usuario_setor" type="hidden" id="id_usuario_setor" />
<input name="res" type="hidden" id="res" value="res" />
      </label></td>
      <td width="38%" align="left" class="txt"><label>
        <input name="xNome" type="text" class="txt-form" id="xNome" size="50" maxlength="30" />
      </label></td>
      <td width="42%" align="left" class="txt"><span class="texto">&quot;maximo de 30 caracteres&quot;</span></td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt-opcoes">Descri&ccedil;&atilde;o
      <input name="texto1" type="hidden" id="texto1" value="" />
&quot;maximo de 255 caracteres&quot; </td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#FFFFFF" class="txt"><textarea name="descricao" id="descricao" cols="85" rows="3"></textarea></td>
    </tr>
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center">
        <input name="Alterar2" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar2" value="|&lt; Voltar" />
        <input name="Adicionar" type="submit" class="txt-Botao-ADD" id="Adicionar" value="Adicionar" />
      </div></td>
    </tr>
  </table>  
  
  
  
  
  <input type="hidden" name="MM_insert" value="form1" />
  <input type="hidden" name="MM_insert" value="acao" />
</form>
<?php 
//envio de resposta do formulario
$res=$_POST['res'];
if ($res==res){
	include "res_add.php";
}

mysql_free_result($list_acao_posicao);
?>
