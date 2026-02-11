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

if ((isset($_POST['id_setor'])) && ($_POST['id_setor'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_mod_sma_cad_setor WHERE id_setor=%s",
                       GetSQLValueString($_POST['id_setor'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_setor'])) {
  $colname_list_acao = $_GET['id_setor'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_sma_cad_setor WHERE id_setor = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
&nbsp;
<form method="POST" name="acao" id="acao">
<table width="98%" border="0" cellpadding="0" cellspacing="1" class="texto">
          <tr>
            <td align="center" class="txt-Indece"><table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  align="left"><img src="<?php echo "$local_icons"; ?><?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
                <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td  align="center"><img src="<?php echo "$local_icons"; ?>excluir-30.png" width="30" height="30" /></td>
                <td  align="left">&nbsp;&nbsp;&nbsp;Excluir</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="19%" class="txt-opcoes">Nome
                  <input name="id_setor" type="hidden" id="id_setor" value="<?php echo $row_list_acao['id_setor']; ?>" />
                  <input  type="hidden"name="id_usuario"  id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>" />
                  <input type="hidden" name="id_fazenda"  id="id_fazenda" value="<?php echo $row_list_acao['id_fazenda']; ?>" />
                  <input name="res" type="hidden" id="res" value="res" /></td>
                <td width="81%" align="left" class="txt"><span id="sprytextfield1">
                <?php echo $row_list_acao['nome']; ?></td>
</tr>
              <tr>
                <td class="txt-opcoes">Largurar</td>
                <td align="left" class="txt"><?php echo $row_list_acao['largura']; ?></td>
              </tr>
              <tr>
                <td class="txt-opcoes">Altura</td>
                <td align="left" class="txt"><?php echo $row_list_acao['altura']; ?></td>
              </tr>
              <tr>
                <td colspan="2" align="center" class="txt-opcoes">Descrição</td>
              </tr>
              <tr>
                <td colspan="2" align="left" class="txt"><?php echo $row_list_acao['descricao']; ?></td>
              </tr>
              <tr> </tr>
              <tr> </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top" class="txt-Indece"><div align="center"><a href="javascript:history.back()" class="texto"><img src="../icons/circulo_red/setas_esq.png" alt="voltar" width="37" height="23" border="0" /></a></div></td>
          </tr>
          <tr>
            <td valign="top"><div align="center">
              <input name="Excluir" type="submit" class="txt-Botao-Excluir" id="Excluir" value="Excluir" />
            </div></td>
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
?>

