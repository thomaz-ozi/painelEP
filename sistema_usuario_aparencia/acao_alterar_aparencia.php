<?php $id_usuario_parencia=$row_perfusuario['id_usuario']; ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
  $updateSQL = sprintf("UPDATE tbnext_usuario SET cor_txt=%s, cor_txt_fundo=%s, cor_titulo_txt=%s, cor_subtitulo_txt=%s, cor_data_horas=%s, cor_botao_add=%s, cor_botao_alterar=%s, cor_botao_excluir=%s, cor_botao_pesquisar=%s, ap_icons_local=%s, ap_skin=%s, ap_plano_fundo=%s, ap_tabela=%s, cor_menu_txt=%s, cor_menu_fundo=%s, cor_menu_txt_down=%s, cor_submenu_txt=%s, cor_submenu_fundo=%s, cor_submenu_txt_down=%s, cor_form_txt=%s WHERE id_usuario=%s",
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
                       GetSQLValueString($_POST['cor_menu_txt'], "text"),
                       GetSQLValueString($_POST['cor_menu_fundo'], "text"),
                       GetSQLValueString($_POST['cor_menu_txt_down'], "text"),
                       GetSQLValueString($_POST['cor_submenu_txt'], "text"),
                       GetSQLValueString($_POST['cor_submenu_fundo'], "text"),
                       GetSQLValueString($_POST['cor_submenu_txt_down'], "text"),
                       GetSQLValueString($_POST['cor_form_txt'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao_sistem_35")) {
  $updateSQL = sprintf("UPDATE tbnext_usuario SET cor_txt=%s, cor_txt_fundo=%s, cor_titulo_txt=%s, cor_subtitulo_txt=%s, cor_data_horas=%s, cor_botao_add=%s, cor_botao_alterar=%s, cor_botao_excluir=%s, cor_botao_pesquisar=%s, ap_icons_local=%s, ap_skin=%s, ap_plano_fundo=%s, ap_tabela=%s, cor_menu_txt=%s, cor_menu_fundo=%s, cor_menu_txt_down=%s, cor_submenu_txt=%s, cor_submenu_fundo=%s, cor_submenu_txt_down=%s, cor_form_txt=%s WHERE id_usuario=%s",
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
                       GetSQLValueString($_POST['cor_menu_txt'], "text"),
                       GetSQLValueString($_POST['cor_menu_fundo'], "text"),
                       GetSQLValueString($_POST['cor_menu_txt_down'], "text"),
                       GetSQLValueString($_POST['cor_submenu_txt'], "text"),
                       GetSQLValueString($_POST['cor_submenu_fundo'], "text"),
                       GetSQLValueString($_POST['cor_submenu_txt_down'], "text"),
                       GetSQLValueString($_POST['cor_form_txt'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}
?><?php // include"../sistem_funcoes/perfusuario.php";?>
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
      <td colspan="2" ><div align="center"><span class="txt">
        </span>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><a href="?conteudo=uap-t"><img src="../sistema_aparencia/skin/aparencias.png" width="260" height="188" border="0" /></a></td>
              <td align="center"><a href="?conteudo=uap-w"><img src="../sistema_aparencia/wallpaper/wallpaper.png" width="260" height="188" border="0" /></a></td>
            </tr>
            <tr></tr>
          </table>
          <span class="txt">
          <input name="id_usuario" type="hidden"  id="id_usuario" value="<?php echo $row_list_usuario['id_usuario']; ?>" />
          </span>
          <label>
          <input name="res" type="hidden" id="res" value="res" />
          </label>
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
  <input type="hidden" name="MM_update" value="alterar" />

<?php 
//envio de resposta do formulario
$res=$_POST['res'];
if ($res==res){
	include "res_alt.php";
}
?>
