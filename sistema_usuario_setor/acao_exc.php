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

if ((isset($_POST['id_usuario_setor'])) && ($_POST['id_usuario_setor'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_usuario_setor WHERE id_usuario_setor=%s",
                       GetSQLValueString($_POST['id_usuario_setor'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
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
?>


<form id="form1" name="form1" method="POST">
  <table width="98%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="2" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td  align="left"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left"><?php echo "$sistema_nome"; ?></td>
          <td  align="center"><img src="<?php echo "$local_icons"; ?>excluir-30.png" width="30" height="30" /></td>
          <td  align="left">Excluir</td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center"></div></td>
    </tr>
    <tr>
      <td width="20%" align="left" class="txt-opcoes"><label for="checkbox_row_7">Setor:
          <input name="id_usuario_setor" type="hidden"  id="id_usuario_setor" value="<?php echo $row_list_acao['id_usuario_setor']; ?>" />
          <input name="res" type="hidden" id="res" value="res" />
      </label></td>
      <td width="80%" align="left" class="txt"><?php echo $row_list_acao['xNome']; ?></td>
    </tr>
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center"></div></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="txt-opcoes">Descri&ccedil;&atilde;o:</td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="txt"><?php echo $row_list_acao['descricao']; ?></td>
    </tr>
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center">
        <input name="Alterar2" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar2" value="|&lt; Voltar" />
        <input name="Excluir" type="submit" class="txt-Botao-Excluir" id="Excluir" value="Excluir" />
      </div></td>
    </tr>
  </table>  
  
  
  
  
</form>
<?php 
//envio de resposta do formulario
$res=$_POST['res'];
if ($res==res){
	include "res_exc.php";
}


mysql_free_result($list_acao);
?>
