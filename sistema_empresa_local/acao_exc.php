<?php require_once('../Connections/connection.php'); ?>
 <?php 	if($row_perfusuario['id_usuario']==0){?>
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

if ((isset($_POST['id_local'])) && ($_POST['id_local'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_mod_empresa_local WHERE id_local=%s",
                       GetSQLValueString($_POST['id_local'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_local'])) {
  $colname_list_acao = $_GET['id_local'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_empresa_local WHERE id_local = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>
<form method="POST" name="acao" id="acao">
<table width="98%" border="0" cellpadding="0" cellspacing="1" class="texto">
          <tr>
            <td align="center" class="txt-Indece"><table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  align="left"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
                <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td  align="center"><img src="<?php echo "$local_icons"; ?>excluir-30.png" width="30" height="30" /></td>
                <td  align="left">&nbsp;&nbsp;&nbsp;Excluir</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr class="texto">
                  <td colspan="2" bgcolor="#FFFFFF" class="txt-Indece"><div align="center" class="txt-Indece">DADOS CADASTRAIS</div></td>
                </tr>
                <tr>
                  <td width="26%" align="left" class="txt-opcoes">Empresa
                    <input name="id_local" type="hidden" id="id_local" value="<?php echo $row_list_acao['id_local']; ?>" />
                  <input name="res" type="hidden" id="res" value="res" /></td>
                  <td width="74%" align="left" class="txt"><?php echo $row_list_acao['cliente']; ?></td>
                </tr>

                <tr>
                  <td align="left" class="txt-opcoes">CNPJ </td>
                  <td align="left" class="txt"><?php echo $row_list_acao['cnpj']; ?></td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">InscEstadual</td>
                  <td align="left" class="txt">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Atua&ccedil;&atilde;o</td>
                  <td align="left" class="txt"><label><?php echo $row_list_acao['atividade_economica']; ?></label></td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Responsavel</td>
                  <td align="left" class="txt"><label><?php echo $row_list_acao['responsavel']; ?></label></td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">CPF </td>
                  <td align="left" class="txt"><?php echo $row_list_acao['cpf_responsavel']; ?></td>
                </tr>
                <tr title=" DATA DE NASCIMENTO ">
                  <td align="left" class="txt-opcoes">Data Nasc</td>
                  <td align="left" class="txt"><?php echo $row_list_acao['data_nasc']; ?></td>
                </tr>
                <tr title=" DATA DE NASCIMENTO ">
                  <td colspan="2" align="left" class="txt"><div align="center"><br />
                    Tem certeza<span class="txt-Botao-Excluir"> da &quot;Excluis&atilde;o&quot; </span>destes dados<br />
                    <br />
                  </div></td>
                </tr>
            </table></td>
          </tr>

          <tr>
            <td align="center" valign="top"class="txt-Indece">
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
	include "res_exc.php";
}


?>
<?php
mysql_free_result($list_acao);
 }else {include "../sistema/sem_permissao.php"; }
?>
