<?php require_once('../Connections/connection.php'); ?>
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

if ((isset($_POST['id_local_permissao'])) && ($_POST['id_local_permissao'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_mod_empresa_local_usuario_permisao WHERE id_local_permissao=%s",
                       GetSQLValueString($_POST['id_local_permissao'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_local_permissao'])) {
  $colname_list_acao = $_GET['id_local_permissao'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_empresa_local_usuario_permisao WHERE id_local_permissao = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);


?>
<form action="" method="POST" name="acao" id="acao">

<?php 
$acao_comum="Excluir";
$acao_icons="excluir-30.png";
$msn='<div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>   </button>
           <strong><center>TEM CERTEZA EM EXCLUIR ESSAS INFORMAÇÕES?</center></strong>
      </div>';
include ("../sistema/index_content_head.php");?>

<table width="98%" border="0" cellpadding="0" cellspacing="1" class="texto">
          <tr>
            <td valign="top"><?php
		  $id_usuario=$row_list_acao['id_usuario'];
		   include("../sistema_usuario/list_usuario.php"); ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="20%" bgcolor="#FFFFFF" class="txt-opcoes">Usuario:</td>
                  <td width="80%" class="txt"><?php  echo $row_list_acao_usuario['usuario']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="txt-opcoes">Nome:</td>
                  <td class="txt"><?php  echo $row_list_acao_usuario['nome']; ?>
                    <?php  echo $row_list_acao_usuario['sobrenome']; ?></td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="36%" class="txt-opcoes">Empresa
                    <input name="id_fazenda_permissao" type="hidden" id="id_fazenda_permissao" value="<?php echo $row_list_acao['id_fazenda_permissao']; ?>" />
                    <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>" />
                    <input name="res" type="hidden" id="res" value="res" />
                    <input name="id_local_permissao" type="hidden" id="id_local_permissao" value="<?php echo $row_list_acao['id_local_permissao']; ?>" /></td>
                  <td width="64%" class="txt">
                  
                  
                  	 <?php $id_local= $row_list_acao['id_local']; 
					 include ("../sistema_empresa_local/list_local.php");
					 ?>
                     <?php  $row_list_acao_empresa_local['id_local']; ?><?php echo $row_list_acao_empresa_local['fantasia']; ?>&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;CNJP:<?php echo $row_list_acao_empresa_local['cnpj']; ?></td>
                </tr>

            </table></td>
          </tr>

          <tr>
            <td align="center" valign="top" >
              <input name="Alterar2" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar2" value="|&lt; Voltar" />
              <input name="Excluir" type="submit" class="txt-Botao-Excluir" id="Excluir" value="Excluir" />
            </td>
          </tr>
      </table>
  <input type="hidden" name="MM_update" value="acao" />
</form>
<?php 
// data de construcao 24/09/2009 - 20:32
//envio de resposta do formulario
$list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "../sistema_empresa_local_permissao/res_exc.php";
}

?>
<?php
mysql_free_result($list_acao);

?>
