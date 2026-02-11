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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
  $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_cad_setor (id_setor, id_local, id_usuario, nome, largura, altura, descricao) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_setor'], "int"),
                       GetSQLValueString($_POST['id_local'], "int"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['largura'], "double"),
                       GetSQLValueString($_POST['altura'], "double"),
                       GetSQLValueString($_POST['descricao'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
?>

<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

&nbsp;
<?php 
$ToolbarSet_editor = 'Default';
include "fckeditor/fckeditor.php";?>
<form action="<?php echo $editFormAction; ?>" method="POST" name="acao" id="acao">
<table width="98%" border="0" cellpadding="0" cellspacing="1" class="texto">
          <tr>
            <td colspan="2" align="center" class="txt-Indece"><table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="<?php echo "$local_icons"; ?><?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
                <td  align="left">&nbsp;&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;</td>
                <td ><img src="<?php echo "$local_icons"; ?>add-30.png" width="30" height="30" /></td>
                <td  align="left">&nbsp;&nbsp;&nbsp;Adicionar</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                  <td width="19%" class="txt-opcoes">Nome:
                    <input type="hidden" name="id_setor" id="id_setor" />
                  <input  type="hidden"name="id_usuario"  id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
                  <input type="hidden" name="id_local"  id="id_local" value="<?php echo  $_SESSION['LOCAL']; ?>" />
<input name="res" type="hidden" id="res" value="res" /></td>
                  <td width="81%" align="left" class="txt"><span id="sprytextfield1">
                    <label for="nome"></label>
                    <input name="nome" type="text" id="nome" size="50" maxlength="150" />
                  <span class="textfieldRequiredMsg"></span></span></td>
              </tr>
            <tr>
              <td class="txt-opcoes">Largura:</td>
              <td align="left" class="txt"><label for="largura"></label>
              <input name="largura" type="text" id="largura" size="50" maxlength="12" />
Ex: &quot;60&quot;</td>
            </tr>
            <tr>
              <td class="txt-opcoes">Altura:</td>
              <td align="left" class="txt"><input name="altura" type="text" id="altura" size="50" maxlength="12" />
Ex: &quot;60&quot;</td>
            </tr>
                <tr>
                  <td colspan="2" align="center" class="txt-opcoes">Descrição</td>
                </tr>
                <tr>
                  <td colspan="2" align="center" class="txt">
                  <input type="hidden" name="descricao1" id="descricao1" />
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
?>
                  
                  
                  </td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2" valign="top" class="txt-Indece"><div align="center"><a href="javascript:history.back()" class="texto"><img src="../icons/circulo_red/setas_esq.png" alt="voltar" width="37" height="23" border="0" /></a></div></td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><div align="center">
                <input name="adicionar" type="submit" class="txt-Botao-ADD" id="adicionar" value="Adicionar" />
            </div></td>
          </tr>
  </table>
<input type="hidden" name="MM_insert" value="acao" />
</form>
<?php 
// data de construcao 24/09/2009 - 20:32
//envio de resposta do formulario
$list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "res_add.php";
}

?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
