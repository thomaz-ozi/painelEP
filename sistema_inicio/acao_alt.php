<?php require_once('../Connections/connection_user.php'); ?>
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
  $updateSQL = sprintf("UPDATE tbnext_usuario SET texto=%s WHERE id_usuario=%s",
                       GetSQLValueString($_POST['texto'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_connection, $connection_user);
  $Result1 = mysql_query($updateSQL, $connection_user) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
	 include "../sistem_inicio/res_alt.php";
	exit;}
?>
<?php include "fckeditor/fckeditor.php";?>
<style type="text/css">
<!--
.style3 {font-size: 16px}
.style4 {	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>

  <div id="apDiv1" style="position:absolute;  left:1px; top:1px; width:100%; height:100%; z-index:1; background-image: url(../images/fundoBlackTransp.png); layer-background-image: url(../images/fundoBlackTransp.png); border: 1px none #000000;">
  
  <form action="<?php echo $editFormAction; ?>" name="acao" method="POST"><BR /><BR />
  <table width="780" border="0" cellspacing="0" cellpadding="0" align="center" class="txt">
    <tr>
      <td colspan="2" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="<?php echo "$local_icons"; ?><?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left"><?php echo "$sistema_nome"; ?></td>
          <td ><img src="<?php echo "$local_icons"; ?>alt-30.png" width="30" height="30" /></td>
          <td  align="left">Alterar</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="2" align="left" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" align="left" class="txt-opcoes">Personalize seu painel
            <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
            
            <input type="hidden" name="startmod" id="startmod" />
            <input name="conteudo" type="hidden" id="conteudo" value="inicio" /></td>
        </tr>
        <tr>
          <td align="center" class="txt"><span class="texto">
           <div style="width:778px;"> <?php
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
//caminhho da fckeditor
$sBasePath =  'fckeditor/' ;
$oFCKeditor = new FCKeditor('FCKeditor1') ;
//chama opcoes
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->ToolbarSet	= 'Default';
$oFCKeditor->InstanceName	= 'texto';
$oFCKeditor->Value	= $row_perfusuario['texto'];


//$oFCKeditor->Value		= 'This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.' ;
$oFCKeditor->Create() ;
?>
             <input name="texto1" type="hidden" id="texto1" value="1" />
           </div></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="right" class="txt-Indece"><a href="?usuario=&conteudo=inicio"><img src="../icons/circulo_red/botao_form_fechar.png" width="80" height="22" border="0" /></a></td>
      <td align="left" class="txt-Indece"><input name="botao" type="submit" class="txt-Botao-ADD" id="botao" value="ALTERAR" /></td>
      </tr>
  </table>
  <input type="hidden" name="MM_insert" value="acao_agenda" />
  <input type="hidden" name="MM_update" value="acao_agenda" />
  <input type="hidden" name="MM_update" value="acao" />
  </form>
  </div>
  <?php 
//envio de resposta do formulario
/* $list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "agenda_res_add.php";
} */

?>
