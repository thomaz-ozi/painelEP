<?php
//transforma
$_POST['usuario'] = strtolower($_POST['usuario']);
$_POST['nome'] =	ucwords($_POST['nome']);
$_POST['sobrenome'] = ucwords($_POST['sobrenome']);
$_GET['id_usuario']=base64_decode( $_GET['id_usuario']); //---> 23/10/22017

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

if ((isset($_POST['id_usuario'])) && ($_POST['id_usuario'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_usuario WHERE id_usuario=%s",
                       GetSQLValueString($_GET['id_usuario'], "int"));

  mysql_select_db($database_connection_user, $connection_user);
  $Result1 = mysql_query($deleteSQL, $connection_user) or die(mysql_error());
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

mysql_select_db($database_connection_user, $connection_user);
 $query_list_setor = "SELECT * FROM tbnext_usuario_setor";
$list_setor = mysql_query($query_list_setor, $connection_user) or die(mysql_error());
$row_list_setor = mysql_fetch_assoc($list_setor);
$totalRows_list_setor = mysql_num_rows($list_setor);

mysql_select_db($database_connection_user, $connection_user);
 $query_list_status = "SELECT * FROM tbnext_usuario_perm_list ORDER BY id_perm_status ASC";
$list_status = mysql_query($query_list_status, $connection_user) or die(mysql_error());
$row_list_status = mysql_fetch_assoc($list_status);
$totalRows_list_status = mysql_num_rows($list_status);
/*
mysql_select_db($database_connection, $connection);
 $query_list_cliente = "SELECT * FROM tbnext_mod_empresa_clientes WHERE id_usuario ='".$row_list_acao['id_usuario']."'";
$list_cliente = mysql_query($query_list_cliente, $connection) or die(mysql_error());
$row_list_cliente = mysql_fetch_assoc($list_cliente);
$totalRows_list_cliente = mysql_num_rows($list_cliente);
*/
?>
<form id="acao" name="acao" method="POST">

<?php 
$acao_comum="Excluir";
$acao_icons="excluir-30.png";
$msn='<div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>   </button>
           <strong><center>TEM CERTEZA EM EXCLUIR ESSAS INFORMAÇÕES?</center></strong>
      </div>';
include ("../sistema/index_content_head.php");?>

  <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td colspan="3" align="center" class="txt-opcoes">Informa&ccedil;&otilde;es de acesso ao painel</td>
              <td align="center" >&nbsp;</td>
              <td colspan="2" align="center" class="txt-opcoes">Informa&ccedil;&otilde;es</td>
            </tr>
            <tr>
              <td colspan="3" align="left" class="txt-opcoes">Sistema de usuario integrado</td>
              <td align="left">&nbsp;</td>
              <td align="left" class="txt-opcoes">Tratamento</td>
              <td align="left" class="txt"><select name="tratamento" disabled id="tratamento" tabindex="4">
                <option value="" <?php if (!(strcmp("", $row_list_acao['tratamento']))) {echo "selected=\"selected\"";} ?>>&nbsp;</option>
                <option value="Sr." <?php if (!(strcmp("Sr.", $row_list_acao['tratamento']))) {echo "selected=\"selected\"";} ?>>Sr.</option>
                <option value="Sra." <?php if (!(strcmp("Sra.", $row_list_acao['tratamento']))) {echo "selected=\"selected\"";} ?>>Sra.</option>
                <option value="Srta." <?php if (!(strcmp("Srta.", $row_list_acao['tratamento']))) {echo "selected=\"selected\"";} ?>>Srta.</option>
              </select></td>
            </tr>
            <tr>
              <td align="left" class="txt-opcoes"><div align="left">Usuario:
                <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>" />
                <input name="id_usuario_perm" type="hidden" id="id_usuario_perm" value="<?php echo $row_perfusuario['id_perm_status_usuario_perfil']; ?>" />
                <input name="res" type="hidden" id="res" value="res" />
              </div></td>
              <td colspan="2" align="left" class="txt"><label>
                <input name="usuario" type="text" disabled  id="usuario" value="<?php echo $row_list_acao['usuario']; ?>" />
              </label></td>
              <td align="left">&nbsp;</td>
              <td align="left" class="txt-opcoes">Nome</td>
              <td align="left" class="txt"><input name="nome" type="text" disabled class="txt-form" id="nome"  tabindex="3" value="<?php echo $row_list_acao['nome']; ?>" size="40"/></td>
            </tr>
            <tr>
              <td width="10%" align="left" class="txt-opcoes"><div align="left">Senha:</div></td>
              <td colspan="2" align="left" class="txt">&nbsp;</td>
              <td width="1%" align="left">&nbsp;</td>
              <td width="13%" align="left" class="txt-opcoes">Sobrenome</td>
              <td width="36%" align="left" class="txt"><input name="sobrenome" type="text" disabled class="txt-form" id="sobrenome"  tabindex="3" value="<?php echo $row_list_acao['sobrenome']; ?>" size="40"/></td>
            </tr>
            <tr>
              <td align="left" class="txt-opcoes">Setor:</td>
              <td width="27%" align="left" class="txt"><span id="spryselect1">
        <label>
          <select name="id_usuario_setor" id="id_usuario_setor"  disabled>
            <option value="" <?php if (!(strcmp("", $row_list_acao['id_usuario_setor']))) {echo "selected=\"selected\"";} ?>>---</option>
            <?php
do {  
?>
            <option value="<?php echo $row_list_setor['id_usuario_setor']?>"<?php if (!(strcmp($row_list_setor['id_usuario_setor'], $row_list_acao['id_usuario_setor']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_setor['xNome']?></option>
            <?php
} while ($row_list_setor = mysql_fetch_assoc($list_setor));
  $rows = mysql_num_rows($list_setor);
  if($rows > 0) {
      mysql_data_seek($list_setor, 0);
	  $row_list_setor = mysql_fetch_assoc($list_setor);
  }
?>
          </select>
        </label>
      </span></td>
              <td width="13%" align="center" class="txt-opcoes">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left" class="txt-opcoes">E-mail</td>
              <td align="left" class="txt"><input name="email"type="text" disabled class="txt-form" id="email"  tabindex="6" value="<?php echo $row_list_acao['email']; ?>" size="40" /></td>
            </tr>
            <tr>
              <td colspan="3" rowspan="2" >&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left" class="txt-opcoes">Celular</td>
              <td align="left" class="txt"><input name="celular" type="text" disabled class="mask_cel" id="celular" tabindex="5" value="<?php echo $row_list_acao['celular']; ?>" /></td>
            </tr>
            <tr></tr>
            <?php if ($row_perfusuario['id_perm_status_usuario_perfil']==1){?>
              <?php } ?>
            <tr>
              <td colspan="6" align="center"><table width="98%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td colspan="4" align="left" class="txt-opcoes"><div align="center">PERMISS&Atilde;O DE USUARIO</div></td>
                </tr>
                <tr>
                  <td colspan="4" align="left" class="txt"><div class="options_action_tips" title=" DICAS " ></div>
                    DICA:
                    <div align="center"> Este sistema de permiss&atilde;o esta em ordem ao menu, assim tem mais  facilidade de delegar as fun&ccedil;&otilde;es especificas para cada usuario.<br />
                      <br/>
                    </div></td>
                </tr>
                <tr class="txt-opcoes" >
                  <td colspan="4" align="left" >Painel de Controle</td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Aparencia</td>
                  <td align="left" class="txt">
                    <input disabled name="id_perm_status_usuario_aparencia" type="checkbox" id="id_perm_status_usuario_aparencia" onClick="checkAll(this.form)" value="1" <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_aparencia'],1))) {echo "checked=\"checked\"";} ?> />

                    Ativado</td>
                  <td align="left" class="txt">aparencia do usuriario </td>
                  <td align="left" class="txt">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Contato</td>
                  <td align="left" class="txt" >
                    <input <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_contato'],1))) {echo "checked=\"checked\"";} ?> name="id_perm_status_usuario_contato" type="checkbox" id="id_perm_status_usuario_contato3" value="1" disabled />
                    Ativado</td>
                  <td align="left" class="txt" > contato para empresa e tambem para os web/sites</td>
                  <td align="left" class="txt" >&nbsp;</td>
                </tr>
                <?php if ($row_perfusuario['id_perm_status_usuario_estatistica']==1){?>
                <tr>
                  <td width="12%" align="left" class="txt-opcoes">Estat&iacute;stica</td>
                  <td width="17%" align="left" class="txt"><label>
                    <input <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_estatistica'],1))) {echo "checked=\"checked\"";} ?> name="id_perm_status_usuario_estatistica" type="checkbox" id="id_perm_status_usuario_estatistica" value="1" disabled />
                  </label>
                    Ativado</td>
                  <td width="68%" align="left" class="txt">estatística de acesso</td>
                  <td width="3%" align="left" class="txt">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Log de usuario</td>
                  <td align="left" class="txt">
                    <input name="id_perm_status_usuario_log" type="checkbox" id="id_perm_status_usuario_log" onClick="checkAll(this.form)" value="1" <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_log'],1))) {echo "checked=\"checked\"";} ?> disabled />
                  
                    Ativado</td>
                  <td align="left" class="txt">ver e excluir loges de acesso do usuario</td>
                  <td align="left" class="txt">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Setor</td>
                  <td align="left"  class="txt"><select disabled name="id_perm_status_usuario_setor" id="id_perm_status_usuario_setor" >
                    <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_usuario_class']))) {echo "selected=\"selected\"";} ?>>---</option>
                    <?php
do {  
?>
                    <option value="<?php echo $row_list_status['id_perm_status']?>"<?php if (!(strcmp($row_list_status['id_perm_status'], $row_list_acao['id_perm_status_usuario_class']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_status['xNome']?></option>
                    <?php
} while ($row_list_status = mysql_fetch_assoc($list_status));
  $rows = mysql_num_rows($list_status);
  if($rows > 0) {
      mysql_data_seek($list_status, 0);
	  $row_list_status = mysql_fetch_assoc($list_status);
  }
?>
                  </select></td>
                  <td align="left" class="txt">tem permissao de criar e editar setor do usuario</td>
                  <td align="left" class="txt">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">*Perfil do Usuario</td>
                  <td align="left" bgcolor="#990000" class="txt"><select name="id_perm_status_usuario_perfil" id="id_perm_status_usuario_perfil" disabled>
                    <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_usuario_perfil']))) {echo "selected=\"selected\"";} ?>>---</option>
                    <?php
do {  
?>
                    <option value="<?php echo $row_list_status['id_perm_status']?>"<?php if (!(strcmp($row_list_status['id_perm_status'], $row_list_acao['id_perm_status_usuario_perfil']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_status['xNome']?></option>
                    <?php
} while ($row_list_status = mysql_fetch_assoc($list_status));
  $rows = mysql_num_rows($list_status);
  if($rows > 0) {
      mysql_data_seek($list_status, 0);
	  $row_list_status = mysql_fetch_assoc($list_status);
  }
?>
                  </select></td>
                  <td align="left" class="txt">&quot;CUIDADO!&quot; Ao dar poderes de &quot;administrador&quot; para o usuario, pois terar permiss&otilde;es total ao sistema.</td>
                  <td align="left" class="txt"><div class="options_action_link" title=" LINK "


 onClick="MM_openBrWindow('../sistema_usuario/imagens/perm_perfil_usuario.png','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,height=400')"></div></td>
                </tr>
                <?php }?>
              </table></td>
            </tr>

          </table>
        </div></td>
        </tr>
    </table></td>
  </tr>
  </table>
  <div class="btn-group">
<br><br><br>
        <button type="button" class="btn btn-default"  id="form_bt_voltar" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>
        <button type="submit" class="btn btn-danger" >&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i> Excluir &nbsp;&nbsp;&nbsp;&nbsp;</button>

</div>
</form>
<?php 
//envio de resposta do formulario
$res=$_POST['res'];

if ($res==res){
	include "res_exc.php";
}
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
<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
//-->
</script>
<?php
		
mysql_free_result($list_acao);

mysql_free_result($list_setor);

mysql_free_result($list_status);

?>
