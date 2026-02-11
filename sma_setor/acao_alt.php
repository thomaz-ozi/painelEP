<?php require_once('../Connections/connection.php'); ?>
  <?php
 include ("../sistem_funcoes/maiuscola_minuscola.php");
  $_POST['nome']=convertem(strtoupper($_POST['nome']), 1);?>

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
  $updateSQL = sprintf("UPDATE tbnext_mod_sma_cad_setor SET id_local=%s, id_usuario=%s, nome=%s, largura=%s, altura=%s, descricao=%s WHERE id_setor=%s",
                       GetSQLValueString($_POST['id_local'], "int"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['largura'], "double"),
                       GetSQLValueString($_POST['altura'], "double"),
                       GetSQLValueString($_POST['tamanho'], "text"),
                       GetSQLValueString($_POST['id_setor'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
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
<?php 
$ToolbarSet_editor = 'Default';
include "fckeditor/fckeditor.php";?>
<form action="<?php echo $editFormAction; ?>" method="POST" name="acao" id="acao">
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="texto">
          <tr>
            <td width="757" align="center" class="txt-Indece"><table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><img src="<?php echo "$local_icons"; ?><?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
                <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td  align="center"><img src="<?php echo "$local_icons"; ?>alt-30.png" width="30" height="30" /></td>
                <td align="left">&nbsp;&nbsp;&nbsp;Alterar</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>                </tr>
            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="19%" class="txt-opcoes">Nome:
                    <input name="id_setor" type="hidden" id="id_setor" value="<?php echo $row_list_acao['id_setor']; ?>" />
                    <input  type="hidden"name="id_usuario"  id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>" />
                    <input type="hidden" name="id_local"  id="id_local" value="<?php echo $row_list_acao['id_local']; ?>" />
                  <input name="res" type="hidden" id="res" value="res" /></td>
                  <td width="81%" align="left" class="txt"><span id="sprytextfield1">
                    <label for="nome"></label>
                    <input name="nome" type="text" id="nome" value="<?php echo $row_list_acao['nome']; ?>" size="50" maxlength="150" />
                    <span class="textfieldRequiredMsg"></span></span></td>
</tr>
                <tr>
                  <td class="txt-opcoes">Largura:</td>
                  <td align="left" class="txt"><label for="largura"></label>
                  <input name="largura" type="text" id="largura" value="<?php echo $row_list_acao['largura']; ?>" size="50" maxlength="12" />
MetrosEx: &quot;80&quot;</td>
                </tr>
                <tr>
                  <td class="txt-opcoes">Altura:</td>
                  <td align="left" class="txt"><label for="altura"></label>
                    <input name="altura" type="text" id="altura" value="<?php echo $row_list_acao['altura']; ?>" size="50" maxlength="12" />
                  Metros Ex: &quot;50&quot;</td>
                </tr>
                <tr>
                  <td class="txt-opcoes">Area:</td>
                  <td align="left" class="txt"><?php echo $aera=$row_list_acao['altura'] *  $row_list_acao['largura']; ?>&nbsp;&nbsp;Metros&sup2;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center" class="txt-opcoes">Descrição</td>
                </tr>
                <tr>
                  <td colspan="2" align="center" class="txt"><input type="hidden" name="descricao" id="descricao" />
                    <?php
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
//caminhho da fckeditor
$sBasePath =  'fckeditor/' ;
$oFCKeditor = new FCKeditor('FCKeditor1') ;
//chama opcoes
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->ToolbarSet	= 'Default';
$oFCKeditor->InstanceName	= 'descricao';
$oFCKeditor->Value	= $row_list_acao['descricao']; 


//$oFCKeditor->Value		= 'This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.' ;
$oFCKeditor->Create() ;
?></td>
                </tr>
                <tr> </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top" class="txt-Indece"><div align="center"><a href="javascript:history.back()" class="texto"><img src="../icons/circulo_red/setas_esq.png" alt="voltar" width="37" height="23" border="0" /></a></div></td>
          </tr>
          <tr>
            <td valign="top"><div align="center">
                <input name="Alterar" type="submit" class="txt-Botao-Alterar" id="Alterar" value="Alterar" />
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
	include "res_alt.php";
}

?>
<?php
mysql_free_result($list_acao);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
