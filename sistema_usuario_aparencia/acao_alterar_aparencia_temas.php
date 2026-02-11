<?php require_once('../../Connections/connection.php'); ?>
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
 $updateSQL = sprintf("UPDATE tbnext_usuario SET cor_txt=%s, cor_txt_fundo=%s, cor_titulo_txt=%s, cor_subtitulo_txt=%s, cor_data_horas=%s, cor_botao_add=%s, cor_botao_alterar=%s, cor_botao_excluir=%s, cor_botao_pesquisar=%s, ap_icons_local=%s, ap_skin=%s, ap_plano_fundo=%s, ap_tabela=%s, cor_tb_opcoes=%s, cor_tb_indece=%s, cor_menu_txt=%s, cor_menu_fundo=%s, cor_menu_txt_down=%s, cor_submenu_txt=%s, cor_submenu_fundo=%s, cor_submenu_txt_down=%s,cor_jqueryui_custom=%s, cor_form_txt=%s WHERE id_usuario=%s",
                       GetSQLValueString($_POST['cor_txt'], "text"),
                       GetSQLValueString($_POST['cor_txt_fundo'], "text"),
                       GetSQLValueString($_POST['cor_titulo_txt'], "text"),
                       GetSQLValueString($_POST['cor_subtitulo_txt'], "text"),
                       GetSQLValueString($_POST['cor_data_horas'], "text"),
                       GetSQLValueString($_POST['cor_botao_add'], "text"),
                       GetSQLValueString($_POST['cor_botao_alterar'], "text"),
                       GetSQLValueString($_POST['cor_botao_excluir'], "text"),
                       GetSQLValueString($_POST['cor_botao_pesquisar'], "text"),
                       GetSQLValueString($_POST['ap_icons_local'], "text"),
                       GetSQLValueString($_POST['ap_skin'], "text"),
                       GetSQLValueString($_POST['ap_plano_fundo'], "text"),
                       GetSQLValueString($_POST['ap_tabela'], "text"),
                       GetSQLValueString($_POST['cor_tb_opcoes'], "text"),
                       GetSQLValueString($_POST['cor_tb_indece'], "text"),
                       GetSQLValueString($_POST['cor_menu_txt'], "text"),
                       GetSQLValueString($_POST['cor_menu_fundo'], "text"),
                       GetSQLValueString($_POST['cor_menu_txt_down'], "text"),
                       GetSQLValueString($_POST['cor_submenu_txt'], "text"),
                       GetSQLValueString($_POST['cor_submenu_fundo'], "text"),
                       GetSQLValueString($_POST['cor_submenu_txt_down'], "text"),
					   GetSQLValueString($_POST['cor_jqueryui_custom'], "text"),
                       GetSQLValueString($_POST['cor_form_txt'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}
 $id_usuario_parencia=$row_perfusuario['id_usuario']; ?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
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
      <td colspan="2" ><div align="center"><span class="txt">
        <input name="id_usuario" type="hidden"  id="id_usuario" value="<?php echo $row_list_usuario['id_usuario']; ?>" />
      </span>
        <label>
          <input name="res" type="hidden" id="res" value="res" />
          </label>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td width="50%" align="center">
              <form id="acao" name="acao" method="POST" action="<?php echo $editFormAction; ?>">
                <span class="txt">
                <input name="id_usuario" type="hidden"  id="id_usuario" value="<?php echo $id_usuario_parencia; ?>" />
                </span>
                <label>
                  <input name="res" type="hidden" id="res" value="res" />
                </label>
                <input name="ap_skin" type="hidden" id="ap_skin" value="cabanha" />
                <input name="ap_tabela" type="hidden" id="ap_tabela" value="cabanha" />
                <input name="ap_plano_fundo" type="hidden" id="ap_plano_fundo" value="next_v3_6-1920x1080.jpg" />
                <input name="cor_txt" type="hidden" id="cor_txt" value="#000000" />
                <input name="cor_txt_fundo" type="hidden" id="cor_txt_fundo" value=" " />
                <input name="cor_titulo_txt" type="hidden" id="cor_titulo_txt" value="#ffffff" />
                <input name="cor_subtitulo_txt" type="hidden" id="cor_subtitulo_txt" value="#ffffff" />
                <input name="cor_form_txt" type="hidden" id="cor_form_txt" value="#000000" />
                <input name="cor_data_horas" type="hidden" id="cor_data_horas" value="#000000" />
                <input name="cor_botao_add" type="hidden" id="cor_botao_add" value="#0000FF" />
                <input name="cor_botao_alterar" type="hidden" id="cor_botao_alterar" value="#006600" />
                <input name="cor_botao_excluir" type="hidden" id="cor_botao_excluir" value="#FF0000" />
                <input name="cor_botao_pesquisar" type="hidden" id="cor_botao_pesquisar" value="#FF9900" />
                <input name="cor_menu_txt" type="hidden" id="cor_menu_txt" value="#ffffff" />
                <input name="cor_menu_fundo" type="hidden" id="cor_menu_fundo" value="cabanha" />
                <input name="cor_menu_txt_down" type="hidden" id="cor_menu_txt_down" value="#000000" />
                <input name="cor_submenu_txt" type="hidden" id="cor_submenu_txt" value="#000000" />
                <input name="cor_submenu_fundo" type="hidden" id="cor_submenu_fundo" value="cabanha" />
                <input name="cor_submenu_txt_down" type="hidden" id="cor_submenu_txt_down" value="#000000" />
                <input name="ap_icons_local" type="hidden" id="ap_icons_local" value="../icons/circulo_red/" />
                <input name="cor_tb_indece" type="hidden" id="cor_tb_indece" value="#000" />
                <input name="cor_tb_opcoes" type="hidden" id="cor_tb_opcoes" value="#000" />
                <input name="cor_jqueryui_custom" type="hidden" id="cor_jqueryui_custom" value="base/jquery.ui.all.css" />
                <img src="../sistema_aparencia/skin/cabanha/exemplo.jpg" width="260" height="141" border="0" /> <br />
                <input type="submit" name="acao4" id="acao4" value="APARENCIA CABANHA" />
                <input name="MM_update" type="hidden" id="MM_update" value="acao" />
              </form></td>
              <td width="50%" align="center">
              <form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
                
                <input name="id_usuario" type="hidden"  id="id_usuario" value="<?php echo $id_usuario_parencia; ?>" />
               
                <label>
                  <input name="res" type="hidden" id="res" value="res" />
                </label>
                <input name="ap_skin" type="hidden" id="ap_skin" value="cinzento" />
                <input name="ap_tabela" type="hidden" id="ap_tabela" value="cinzento" />
                <input name="ap_plano_fundo" type="hidden" id="ap_plano_fundo" value="" />
                <input name="cor_data_horas" type="hidden" id="cor_data_horas" value="#000000" />
                <input name="cor_txt" type="hidden" id="cor_txt" value="#000000" />
                <input name="cor_txt_fundo" type="hidden" id="cor_txt_fundo" value=" " />
                <input name="cor_titulo_txt" type="hidden" id="cor_titulo_txt" value="#000000" />
                <input name="cor_subtitulo_txt" type="hidden" id="cor_subtitulo_txt" value="#000000" />
                <input name="cor_form_txt" type="hidden" id="cor_form_txt" value="#000000" />
                <input name="cor_botao_add" type="hidden" id="cor_botao_add" value="#0000FF" />
                <input name="cor_botao_alterar" type="hidden" id="cor_botao_alterar" value="#006600" />
                <input name="cor_botao_excluir" type="hidden" id="cor_botao_excluir" value="#FF0000" />
                <input name="cor_botao_pesquisar" type="hidden" id="cor_botao_pesquisar" value="#FF9900" />
                <input name="cor_menu_txt" type="hidden" id="cor_menu_txt" value="#000000" />
                <input name="cor_menu_fundo" type="hidden" id="cor_menu_fundo" value="sistemv3_5" />
                <input name="cor_menu_txt_down" type="hidden" id="cor_menu_txt_down" value="#000000" />
                <input name="cor_submenu_txt" type="hidden" id="cor_submenu_txt" value="#000000" />
                <input name="cor_submenu_fundo" type="hidden" id="cor_submenu_fundo" value="sistemv3_5" />
                <input name="cor_submenu_txt_down" type="hidden" id="cor_submenu_txt_down" value="#000000" />
                <input name="cor_tb_indece" type="hidden" id="cor_tb_indece" value="#000" />
                <input name="cor_tb_opcoes" type="hidden" id="cor_tb_opcoes" value="#000" />
                <input name="cor_jqueryui_custom" type="hidden" id="cor_jqueryui_custom" value="base/jquery.ui.all.css" />
                <img src="../sistema_aparencia/skin/cinzento/exemplo.jpg" width="260" height="141" />
                <label>
                  <br />
                  <input type="submit" name="acao" id="acao" value="APARENCIA CINZENTO " />
                </label>
                <input name="MM_update" type="hidden" id="MM_update3" value="acao" />
              </form></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">  <form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
                
                <input name="id_usuario" type="hidden"  id="id_usuario" value="<?php echo $id_usuario_parencia; ?>" />
               
                <label>
                  <input name="res" type="hidden" id="res" value="res" />
                </label>
                <input name="ap_skin" type="hidden" id="ap_skin" value="agua" />
                <input name="ap_tabela" type="hidden" id="ap_tabela" value="agua" />
                <input name="ap_plano_fundo" type="hidden" id="ap_plano_fundo" value="campo-wpp2_1280x800.jpg" />
                <input name="cor_txt" type="hidden" id="cor_txt" value="#000000" />
                <input name="cor_txt_fundo" type="hidden" id="cor_txt_fundo" value=" " />
                <input name="cor_titulo_txt" type="hidden" id="cor_titulo_txt" value="#ffffff" />
                <input name="cor_subtitulo_txt" type="hidden" id="cor_subtitulo_txt" value="#ffffff" />
                <input name="cor_form_txt" type="hidden" id="cor_form_txt" value="#000000" />
                <input name="cor_data_horas" type="hidden" id="cor_data_horas" value="#ffffff" />
                <input name="cor_botao_add" type="hidden" id="cor_botao_add" value="#0000FF" />
                <input name="cor_botao_alterar" type="hidden" id="cor_botao_alterar" value="#006600" />
                
				<input name="cor_botao_excluir" type="hidden" id="cor_botao_excluir" value="#FF0000" />
                <input name="cor_botao_pesquisar" type="hidden" id="cor_botao_pesquisar" value="#FF9900" />
                <input name="cor_menu_txt" type="hidden" id="cor_menu_txt" value="#ffffff" />
                <input name="cor_menu_fundo" type="hidden" id="cor_menu_fundo" value="agua" />
                <input name="cor_menu_txt_down" type="hidden" id="cor_menu_txt_down" value="#ffffff" />
                <input name="cor_submenu_txt" type="hidden" id="cor_submenu_txt" value="#ffffff" />
                <input name="cor_submenu_fundo" type="hidden" id="cor_submenu_fundo" value="agua" />
                <input name="cor_submenu_txt_down" type="hidden" id="cor_submenu_txt_down" value="#ffffff" />
                <input name="ap_icons_local" type="hidden" id="ap_icons_local" value="../icons/circulo_red/" />
                <input name="cor_tb_indece" type="hidden" id="cor_tb_indece" value="#000" />
                <input name="cor_tb_opcoes" type="hidden" id="cor_tb_opcoes" value="#000" />
                <img src="../sistema_aparencia/skin/agua/exemplo.jpg" width="260" height="141" />
                  <input name="cor_jqueryui_custom" type="hidden" id="cor_jqueryui_custom" value="custom_blue/jquery-ui-1.10.3.custom.css" />
                  <br />
                  <input type="submit" name="acao" id="acao" value="APARENCIA AGUA" />
                <input name="MM_update" type="hidden" id="MM_update4" value="acao" />
              </form></td>
              <td align="center"><form id="acao" name="acao" method="post" action="">
                <span class="txt">
                <input name="id_usuario" type="hidden"  id="id_usuario" value="<?php echo $id_usuario_parencia; ?>" />
                </span>
                <label>
                  <input name="res" type="hidden" id="res" value="res" />
                </label>
                <input name="ap_skin" type="hidden" id="ap_skin" value="black" />
                <input name="ap_tabela" type="hidden" id="ap_tabela" value="black" />
                <input name="ap_plano_fundo" type="hidden" id="ap_plano_fundo" value="next_v3_6-1920x1080.jpg" />
                <input name="cor_txt" type="hidden" id="cor_txt" value="#000000" />
                <input name="cor_txt_fundo" type="hidden" id="cor_txt_fundo" value=" " />
                <input name="cor_titulo_txt" type="hidden" id="cor_titulo_txt" value="#ffffff" />
                <input name="cor_subtitulo_txt" type="hidden" id="cor_subtitulo_txt" value="#ffffff" />
                <input name="cor_form_txt" type="hidden" id="cor_form_txt" value="#000000" />
                <input name="cor_data_horas" type="hidden" id="cor_data_horas" value="#ffffff" />
                <input name="cor_botao_add" type="hidden" id="cor_botao_add" value="#0000FF" />
                <input name="cor_botao_alterar" type="hidden" id="cor_botao_alterar" value="#006600" />
                <input name="cor_botao_excluir" type="hidden" id="cor_botao_excluir" value="#FF0000" />
                <input name="cor_botao_pesquisar" type="hidden" id="cor_botao_pesquisar" value="#FF9900" />
                <input name="cor_menu_txt" type="hidden" id="cor_menu_txt" value="#ffffff" />
                <input name="cor_menu_fundo" type="hidden" id="cor_menu_fundo" value="ap_v3.6-black" />
                <input name="cor_menu_txt_down" type="hidden" id="cor_menu_txt_down" value="#ffffff" />
                <input name="cor_submenu_txt" type="hidden" id="cor_submenu_txt" value="#ffffff" />
                <input name="cor_submenu_fundo" type="hidden" id="cor_submenu_fundo" value="ap_v3.6-black" />
                <input name="cor_submenu_txt_down" type="hidden" id="cor_submenu_txt_down" value="#ffffff" />
                <input name="ap_icons_local" type="hidden" id="ap_icons_local" value="../icons/circulo_red/" />
                <input name="cor_tb_indece" type="hidden" id="cor_tb_indece" value="#000" />
                <input name="cor_tb_opcoes" type="hidden" id="cor_tb_opcoes" value="#000" />
                <input name="cor_jqueryui_custom" type="hidden" id="cor_jqueryui_custom" value="base/jquery.ui.all.css" />
                <img src="../sistema_aparencia/skin/black/exemplo.jpg" width="260" height="181" border="0" /> <br />
                <input type="submit" name="acao2" id="acao2" value="APARENCIA BLACK " />
                <input name="MM_update" type="hidden" id="MM_update" value="acao" />
              </form></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><span class="txt">
                <form id="acao" name="acao" method="POST" action="<?php echo $editFormAction; ?>">
                  <input name="id_usuario" type="hidden"  id="id_usuario" value="<?php echo $id_usuario_parencia; ?>" />
                  
                  <input name="res" type="hidden" id="res" value="res" />
                  <input name="ap_skin" type="hidden" id="ap_skin" value="novatec" />
                  <input name="ap_tabela" type="hidden" id="ap_tabela" value="novatec" />
                  <input name="ap_plano_fundo" type="hidden" id="ap_plano_fundo" value="sistema4.jpg" />
                  <input name="cor_txt2" type="hidden" id="cor_txt2" value="#000000" />
                  <input name="cor_txt_fundo" type="hidden" id="cor_txt_fundo" value=" " />
                  <input name="cor_titulo_txt" type="hidden" id="cor_titulo_txt" value="#ffffff" />
                  <input name="cor_subtitulo_txt" type="hidden" id="cor_subtitulo_txt" value="#ffffff" />
                  <input name="cor_form_txt" type="hidden" id="cor_form_txt" value="#000000" />
                  <input name="cor_data_horas" type="hidden" id="cor_data_horas" value="#213D54" />
                  <input name="cor_botao_add" type="hidden" id="cor_botao_add" value="#0000FF" />
                  <input name="cor_botao_alterar" type="hidden" id="cor_botao_alterar" value="#006600" />
                  <input name="cor_botao_excluir" type="hidden" id="cor_botao_excluir" value="#FF0000" />
                  <input name="cor_botao_pesquisar" type="hidden" id="cor_botao_pesquisar" value="#FF9900" />
                  <input name="cor_menu_txt" type="hidden" id="cor_menu_txt" value="#ffffff" />
                   <input name="cor_menu_fundo" type="hidden" id="cor_menu_fundo" value="ap_v3.6-black" />
                  <input name="cor_menu_txt_down" type="hidden" id="cor_menu_txt_down" value="#ffffff" />
                  <input name="cor_submenu_txt" type="hidden" id="cor_submenu_txt" value="#ffffff" />
                  <input name="cor_submenu_fundo" type="hidden" id="cor_submenu_fundo" value="ap_v3.6-black" />
                  <input name="cor_submenu_txt_down" type="hidden" id="cor_submenu_txt_down" value="#ffffff" />
                  
                  <input name="ap_icons_local" type="hidden" id="ap_icons_local" value="../sistema_aparencia/icons/" />
                  
                  <input name="cor_tb_indece" type="hidden" id="cor_tb_indece" value="#ffffff" />
                  <input name="cor_tb_opcoes" type="hidden" id="cor_tb_opcoes" value="#000" />
                  <input name="cor_jqueryui_custom" type="hidden" id="cor_jqueryui_custom" value="custom_blue/jquery-ui-1.10.3.custom.css" />
                  <img src="../sistema_aparencia/skin/novatec/exemplo.jpg" width="260" height="181" border="0" /> <br />
                  <input type="submit" name="acao5" id="acao5" value="APARENCIA NOVATEC " />
                  <input name="MM_update" type="hidden" id="MM_update2" value="acao" />
                </form>              </td>
            </tr>
          </table>
      </div></td>
    </tr>
    <tr>
      <td colspan="2" align="left" >&nbsp;</td>
    </tr>
    <tr></tr>
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center">
        <input name="Alterar" type="submit" class="txt-Botao-ADD" id="Alterar" value="Alterar" />
      </div></td>
    </tr>
  </table>
<?php 
//envio de resposta do formulario
$res=$_POST['res'];
if ($res==res){
	include "res_alt.php";
}
?>
