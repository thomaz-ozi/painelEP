<?php require_once('../Connections/connection.php'); ?>
<?php 
if($_GET['id_usuario']=='ativo'){
	$_GET['id_usuario']=$row_perfusuario['id_usuario'];}
?>
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

if ((isset($_GET["MM_update"])) && ($_GET["MM_update"] == "acao")) {
echo  $updateSQL = sprintf("UPDATE tbnext_usuario SET ap_plano_fundo=%s WHERE id_usuario=%s",
                       GetSQLValueString($_GET['ap_plano_fundo'], "text"),
                       GetSQLValueString($_GET['id_usuario'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}
 $id_usuario_parencia=$row_perfusuario['id_usuario']; ?>
<?php // include"../sistem_funcoes/perfusuario.php";?>
<table width="99%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="2"><div align="center" class="txt-indece-titulo">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  align="center"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
            <td ><?php echo "$sistema_nome"; ?> &nbsp;<?php echo "$versao"; ?></td>
          </tr>
        </table>
      </div></td>
    </tr>
    <tr>
      <td width="23%" align="left" class="txt">&nbsp;</td>
      <td width="77%" align="left" class="txt"><a href="?startmod=usuario_aparencia&amp;conteudo=uap_person">Personalizar</a></td>
    </tr>
    <tr>
      <td colspan="2" >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" ><div align="center"><span class="txt">
      </span>
        <form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="GET">
          <span class="txt">
            <input name="id_usuario" type="hidden"  id="id_usuario" value="<?php echo $id_usuario_parencia; ?>" />
            <input name="ap_plano_fundo" type="hidden" id="ap_plano_fundo" value="next_v2-1280x768.jpg" />
          <input name="res" type="hidden" id="res" value="res" />
            <input type="hidden" name="MM_update2" value="form1" />
          <img src="../sistema_aparencia/wallpaper/wallpaper-full.jpg" width="782" height="618" border="0" usemap="#Map" />
            
          </span>
        </form>
      </div></td>
    </tr>
    <tr>
      <td colspan="2" align="left" >&nbsp;</td>
    </tr>
    <tr></tr>
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center"></div></td>
    </tr>
</table>
  <input type="hidden" name="MM_update" value="alterar" />
  <?php 
//envio de resposta do formulario
$res=$_GET['res'];
if ($res==res){
	include "res_alt.php";
}

?>
  <map name="Map"><area shape="rect" coords="570,425,664,516" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=sistema4.jpg&res=res&MM_update=acao"><area shape="rect" coords="457,426,551,517" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=efeito-vermelho-1024x768.jpg&res=res&MM_update=acao"><area shape="rect" coords="347,424,441,515" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=efeito-verde-1024x768.jpg&res=res&MM_update=acao"><area shape="rect" coords="235,423,329,514" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=efeito-rosa-1024x768.jpg&res=res&MM_update=acao"><area shape="rect" coords="121,421,215,512" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=efeito-preto-1024x768.jpg&res=res&MM_update=acao"><area shape="rect" coords="9,420,103,511" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=efeito-laranja-1024x768.jpg&res=res&MM_update=acao"><area shape="rect" coords="680,315,774,406" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=efeito-azul-1024x768.jpg&res=res&MM_update=acao"><area shape="rect" coords="573,316,667,407" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=digital_world-1920x1080.jpg&res=res&MM_update=acao"><area shape="rect" coords="458,314,552,405" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=desgner-v3_51-1280x960.jpg&res=res&MM_update=acao"><area shape="rect" coords="346,313,440,404" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=desgner-technology_1920x1080.jpg&res=res&MM_update=acao"><area shape="rect" coords="233,313,327,404" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=desgner-mustang-1920x1200.jpg&res=res&MM_update=acao"><area shape="rect" coords="121,311,215,402" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=desgner-creative_abstract-1280x1024.jpg&res=res&MM_update=acao"><area shape="rect" coords="9,311,103,402" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=cor-rosa.png&res=res&MM_update=acao"><area shape="rect" coords="680,218,774,309" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=cor-preto.png&res=res&MM_update=acao"><area shape="rect" coords="572,218,666,309" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=cor-branco.png&res=res&MM_update=acao"><area shape="rect" coords="459,220,553,311" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=cor-azul.png&res=res&MM_update=acao"><area shape="rect" coords="346,219,440,310" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo-wpp2_1280x800.jpg&res=res&MM_update=acao"><area shape="rect" coords="233,219,327,310" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo-voo_balao_1280x960.jpg&res=res&MM_update=acao"><area shape="rect" coords="122,217,213,308" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo-vista-1280x855.jpg&res=res&MM_update=acao"><area shape="rect" coords="10,216,101,307" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo-trigo-1920x1080.jpg&res=res&MM_update=acao"><area shape="rect" coords="682,109,775,200" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo-trigo_montanha-1024x768.jpg&res=res&MM_update=acao"><area shape="rect" coords="570,109,663,200" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo-trigo_casa-1024x768.jpg&res=res&MM_update=acao"><area shape="rect" coords="458,109,551,200" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo-next_v3_6-1920x1080.jpg&res=res&MM_update=acao"><area shape="rect" coords="347,109,438,200" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo-next_v2-1280x768.jpg&res=res&MM_update=acao"><area shape="rect" coords="235,109,326,200" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo-horizote_1920x1080.jpg&res=res&MM_update=acao"><area shape="rect" coords="123,109,214,200" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=campo_1920x1020.jpg&res=res&MM_update=acao"><area shape="rect" coords="10,109,101,200" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=black-zeronix-1280x1024.jpg&res=res&MM_update=acao"><area shape="rect" coords="682,10,776,101" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=black-vista-1920x1080.jpg&res=res&MM_update=acao"><area shape="rect" coords="571,10,662,101" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=black-fantasy_1920x1080.jpg&res=res&MM_update=acao"><area shape="rect" coords="459,10,550,101" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=aguas-wpp1_1600x1200.jpg&res=res&MM_update=acao"><area shape="rect" coords="347,10,438,101" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=aguas-windows_dusk-1680x1050.jpg&res=res&MM_update=acao"><area shape="rect" coords="235,9,326,100" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=aguas-natureza_1920x1080.jpg&res=res&MM_update=acao">
    <area shape="rect" coords="123,9,214,100" href="?conteudo=uap-w&id_usuario=ativo&ap_plano_fundo=aguas-bosque-1600x1200.jpg&res=res&MM_update=acao">
  </map>
