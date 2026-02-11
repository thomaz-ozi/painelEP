<?php
//transforma
$_POST['usuario'] = strtolower($_POST['usuario']);
$_POST['nome'] =	ucwords($_POST['nome']);
$_POST['sobrenome'] = ucwords($_POST['sobrenome']);

?>
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
  $updateSQL = sprintf("UPDATE tbnext_usuario SET nome=%s, sobrenome=%s, tratamento=%s, email=%s, celular=%s WHERE id_usuario=%s",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['sobrenome'], "text"),
                       GetSQLValueString($_POST['tratamento'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_connection_user, $connection_user);
  $Result1 = mysql_query($updateSQL, $connection_user) or die(mysql_error());
}

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

$colname_list_acao = "-1";
if (isset($_GET['id_usuario'])) {
  $colname_list_acao = $_GET['id_usuario'];
}
mysql_select_db($database_connection_user, $connection_user);
$query_list_acao = sprintf("SELECT * FROM tbnext_usuario WHERE id_usuario = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection_user) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>
<form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
<?php 
$acao_comum="Alterar";
$acao_icons="alt-30.png";
include ("../sistema/index_content_head.php");?>
<div class="col-md-6 col-sm-6 col-xs-12">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="2" align="center" class="txt-opcoes">Informa&ccedil;&otilde;es de acesso ao painel</td>
      </tr>
    <tr>
      <td align="left" class="txt-opcoes"><div align="left">Usuario:
          <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>" />
          <input name="id_usuario_perm" type="hidden" id="id_usuario_perm" value="<?php echo $row_perfusuario['adm_perm_sistem_usuario_perfil']; ?>" />
          <input name="res" type="hidden" id="res" value="res" />
      </div></td>
      <td align="left" class="txt">
        <label>
          
          <input name="usuario" type="text" disabled id="usuario" value="<?php echo $row_list_acao['usuario']; ?>" />
        </label></td>
      </tr>
    <tr>
      <td width="12%" align="left" class="txt-opcoes"><div align="left">Senha:</div></td>
      <td width="36%" align="left" class="txt">         <button type="button" class="btn btn-default" onClick="MM_goToURL('parent','?&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>&conteudo=uu-alt&uu_s=uu_s');return document.MM_returnValue"> <i class="fa fa-unlock-alt"></i> &nbsp;Alterar Senha</button>
        
      </td>
      </tr>
    <tr>
      <td colspan="2" align="center" >&nbsp;</td>
      </tr>
  </table>
  
  
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" >&nbsp;</td>
    <td colspan="2" align="center" class="txt-opcoes">Informa&ccedil;&otilde;es</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left" class="txt-opcoes">Tratamento</td>
    <td align="left" class="txt"><select name="tratamento" class="txt-form" id="tratamento3" tabindex="4">
      <option value="" <?php if (!(strcmp("", $row_list_acao['tratamento']))) {echo "selected=\"selected\"";} ?>>&nbsp;</option>
      <option value="Sr." <?php if (!(strcmp("Sr.", $row_list_acao['tratamento']))) {echo "selected=\"selected\"";} ?>>Sr.</option>
      <option value="Sra." <?php if (!(strcmp("Sra.", $row_list_acao['tratamento']))) {echo "selected=\"selected\"";} ?>>Sra.</option>
      <option value="Srta." <?php if (!(strcmp("Srta.", $row_list_acao['tratamento']))) {echo "selected=\"selected\"";} ?>>Srta.</option>
    </select></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left" class="txt-opcoes">Nome:</td>
    <td align="left" class="txt"><span class="txt">
      <input name="nome" type="text" class="txt-form" id="nome3"  tabindex="3" value="<?php echo $row_list_acao['nome']; ?>" size="40"/>
    </span></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left" class="txt-opcoes">Sobrenome:</td>
    <td align="left" class="txt"><input name="sobrenome" type="text" class="txt-form" id="sobrenome3"  tabindex="3" value="<?php echo $row_list_acao['sobrenome']; ?>" size="40"/></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left" class="txt-opcoes">E-mail:</td>
    <td align="left" class="txt"><input name="email"type="text" class="txt-form" id="email3"  tabindex="6" value="<?php echo $row_list_acao['email']; ?>" size="40" /></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left" class="txt-opcoes">Celular:</td>
    <td align="left" class="txt"><input name="celular" type="text" class="txt-form" id="celular3" tabindex="5" value="<?php echo $row_list_acao['celular']; ?>" /></td>
  </table>
  </div>
  
  <div class="btn-group">
<br>

<br><br>
        <button type="button"  id="form_bt_voltar" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>

        <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> Salvar &nbsp;&nbsp;&nbsp;&nbsp;</button>

</div>
  
  <input type="hidden" name="MM_update" value="acao">
</form>
<?php 
//envio de resposta do formulario


if ($_POST['res']==res){	include "res_alt.php";}

$uu_s=$_GET['uu_s'];
if ($uu_s==uu_s){
			include $modulo_local=$conf_url."acao_alterar_senha.php";}
			
$alt_class=$_GET['alt_class'];
if ($alt_class==open){
			include $modulo_local=$conf_url."acao_alterar_usuario_adm_class.php";}

$alt_funcao=$_GET['alt_funcao'];
if ($alt_funcao==open){
			include $modulo_local=$conf_url."acao_alterar_usuario_adm_funcoes.php";}


?>
<?php
mysql_free_result($list_acao);
?>
