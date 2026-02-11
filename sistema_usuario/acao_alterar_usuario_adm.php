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
  $updateSQL = sprintf("UPDATE tbnext_usuario SET usuario=%s, id_usuario_setor=%s, nome=%s, sobrenome=%s, tratamento=%s, email=%s, celular=%s, id_perm_status_usuario_perfil=%s, id_perm_status_usuario_local=%s, id_perm_status_usuario_setor=%s, id_perm_status_usuario_log=%s, id_perm_status_usuario_aparencia=%s, id_perm_status_usuario_estatistica=%s, id_perm_status_usuario_contato=%s, id_perm_status_usuario_ajuda=%s, id_perm_status_usuario_versao=%s, perm_limit_local=%s, perm_limit_setor=%s, perm_limit_usuario=%s WHERE id_usuario=%s",
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['id_usuario_setor'], "int"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['sobrenome'], "text"),
                       GetSQLValueString($_POST['tratamento'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['id_perm_status_usuario_perfil'], "int"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_local']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_perm_status_usuario_setor'], "int"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_log']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_aparencia']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_estatistica']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_contato']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_perm_status_usuario_ajuda'], "int"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_versao']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['perm_limit_local'], "int"),
                       GetSQLValueString($_POST['perm_limit_setor'], "int"),
                       GetSQLValueString($_POST['perm_limit_usuario'], "int"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_connection_user, $connection_user);
  $Result1 = mysql_query($updateSQL, $connection_user) or die(mysql_error());
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
mysql_select_db($database_connection_user, $connection_user);
$query_list_cliente = "SELECT * FROM tbnext_mod_empresa_clientes WHERE id_usuario =".$row_list_acao['id_usuario'];
$list_cliente = mysql_query($query_list_cliente, $connection_user) or die(mysql_error());
$row_list_cliente = mysql_fetch_assoc($list_cliente);
$totalRows_list_cliente = mysql_num_rows($list_cliente);
*/
?>
<style>
.box_permissao{width:600px; margin:auto;}
.ativacao_permisao{ width:180px; height:80px; float:left; text-align:center;}
</style>
<form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
<?php 
$acao_comum="Alterar";
$acao_icons="alt-30.png";
include ("../sistema/index_content_head.php");?>
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td colspan="6" align="center">
    <table width="98%" border="0" cellspacing="1" cellpadding="0">
      <tr>
            
            <tr>
              <td colspan="3" align="center" class="txt-opcoes">Informa&ccedil;&otilde;es de acesso ao painel</td>
              <td align="center" >&nbsp;</td>
              <td colspan="2" align="center" class="txt-opcoes">Informa&ccedil;&otilde;es</td>
            </tr>
            <tr>
              <td colspan="3" align="left" class="txt-opcoes">Sistema de usuario integrado</td>
              <td align="left">&nbsp;</td>
              <td align="left" class="txt-opcoes">Tratamento</td>
              <td align="left" class="txt"><select name="tratamento"  id="tratamento" tabindex="4">
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
                <input name="usuario" type="text" id="usuario"  value="<?php echo $row_list_acao['usuario']; ?>" />
              </label></td>
              <td align="left">&nbsp;</td>
              <td align="left" class="txt-opcoes">Nome</td>
              <td align="left" class="txt"><input name="nome" type="text"  id="nome"  tabindex="3" value="<?php echo $row_list_acao['nome']; ?>" size="40"/></td>
            </tr>
            <tr>
              <td width="10%" align="left" class="txt-opcoes"><div align="left">Senha:</div></td>
              <td colspan="2" align="left" class="txt"><button type="button" class="btn btn-default" onClick="MM_goToURL('parent','?&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>&conteudo=uu-alt&uu_s=uu_s');return document.MM_returnValue"> <i class="fa fa-unlock-alt"></i> &nbsp;Alterar Senha</button></td>
      <td width="36%" align="left" class="txt">         </td>
      <td width="13%" align="left" class="txt-opcoes">Sobrenome</td>
              <td width="36%" align="left" class="txt"><input name="sobrenome" type="text"  id="sobrenome"  tabindex="3" value="<?php echo $row_list_acao['sobrenome']; ?>" size="40"/></td>
            </tr>
            <tr>
              <td align="left" class="txt-opcoes">Setor:</td>
              <td width="27%" align="left" class="txt"><span id="spryselect1">
        <label>
          <select name="id_usuario_setor" id="id_usuario_setor" >
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
              <td align="left" class="txt"><input name="email"type="text"  id="email"  tabindex="6" value="<?php echo $row_list_acao['email']; ?>" size="40" /></td>
            </tr>
            <tr>
              <td colspan="3" rowspan="2" >&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left" class="txt-opcoes">Celular</td>
              <td align="left" class="txt"><input name="celular" type="text" class="mask_cel" id="celular" tabindex="5" value="<?php echo $row_list_acao['celular']; ?>" /></td>
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
                    <td colspan="4" align="left" class="txt"><div class="options_action_tips" title=" DICAS " ></div>DICA:
                      <div align="center"> Este sistema de permiss&atilde;o esta em ordem ao menu, assim tem mais  facilidade de delegar as fun&ccedil;&otilde;es especificas para cada usuario.<br />
                        <br/>
                      </div></td>
                  </tr>
                  <tr class="txt-opcoes" >
                    <td colspan="4" align="left" >Painel de Controle</td>
                    </tr>
                  <tr>
                    <td align="left" class="txt-opcoes">Aparencia</td>
                    <td align="left" class="txt"><label>
                      <input name="id_perm_status_usuario_aparencia" type="checkbox" id="id_perm_status_usuario_aparencia" class="flat"  value="1" <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_aparencia'],1))) {echo "checked=\"checked\"";} ?> />
                      
                      
                    </label></td>
                    <td align="left" class="txt">aparencia do usuriario </td>
                    <td align="left" class="txt">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" class="txt-opcoes">Contato</td>
                    <td align="left" class="txt" ><label>
                      <input <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_contato'],1))) {echo "checked=\"checked\"";} ?> name="id_perm_status_usuario_contato" class="flat"  type="checkbox" id="id_perm_status_usuario_contato3" value="1" />
                    </label></td>
                    <td align="left" class="txt" > contato para empresa e tambem para os web/sites</td>
                    <td align="left" class="txt" >&nbsp;</td>
                  </tr>
                  <?php if ($row_perfusuario['id_perm_status_usuario_estatistica']==1){?>
                  <tr>
                    <td width="12%" align="left" class="txt-opcoes">Estat&iacute;stica</td>
                    <td width="17%" align="left" class="txt"><label>
                      <input <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_estatistica'],1))) {echo "checked=\"checked\"";} ?> name="id_perm_status_usuario_estatistica" type="checkbox" class="flat" id="id_perm_status_usuario_estatistica" value="1" />
                    </label></td>
                    <td width="68%" align="left" class="txt">estatística de acesso</td>
                    <td width="3%" align="left" class="txt">&nbsp;</td>
                    </tr>
                  <tr>
                    <td align="left" class="txt-opcoes">Log de usuario</td>
                    <td align="left" class="txt"><label>
                      <input name="id_perm_status_usuario_log" type="checkbox" class="flat"  id="id_perm_status_usuario_log" onclick="checkAll(this.form)" value="1" <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_log'],1))) {echo "checked=\"checked\"";} ?> />
                      </label>
                      </td>
                    <td align="left" class="txt">ver e excluir loges de acesso do usuario</td>
                    <td align="left" class="txt">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" class="txt-opcoes">Setor</td>
                    <td align="left"  class="txt"><select name="id_perm_status_usuario_setor" id="id_perm_status_usuario_setor" >
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
                    <td align="left" bgcolor="#990000" class="txt"><select name="id_perm_status_usuario_perfil" id="id_perm_status_usuario_perfil" >
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
                    <td align="left" class="txt">
                    
                    
                  
                    
<div class="options_action_link" title=" LINK "


 onclick="MM_openBrWindow('../sistema_usuario/imagens/perm_perfil_usuario.png','','toolbar=no, location=no ,menubar=no, status=yes, scrollbars=yes, resizable=yes, width=800,height=400')"></div>
                    
                    </td>
                  </tr>
                  <?php }?>
                  
                  <?php if ($row_perfusuario['id_perm_status_usuario_perfil']==1){?>

                  <tr class="txt-opcoes">
                    <td colspan="4" align="center" >PERMISSÃO DOS MODULOS<script type="text/javascript">

//-->
                  </script></td>
                  </tr>
                   <tr>
                    <td colspan="4" align="left" class="txt">
                    <?php  ?>
                    <div class="box_permissao">
                      <?php   if ($row_perfusuario['ativo_site']==1) {//MÓDULO SITE ?>
                      <div class="ativacao_permisao"> 
                        	<a href="?conteudo=perm_site&id_usuario=<?php echo base64_encode( $row_list_acao['id_usuario']); ?>"><img src="../mod_site/icons/default.png" width="48" height="42" alt="SITE"></a><br>
                        	<a href="?conteudo=perm_site&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>">Modulo de Site</a>
                    </div> 
					<?php }?>
					<?php   if ($row_perfusuario['ativo_empresa']==1) {//MÓDULO EMPRESA?>
                    <div class="ativacao_permisao">
                          <a href="?conteudo=perm_empresa&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>"><img src="../mod_empresa/icons/default.png" width="48" height="42" alt="SITE"></a><br>
                          <a href="?conteudo=perm_empresa&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>">Modulo Empresa</a>
                    </div>
					<?php }?>
					<?php   if ($row_perfusuario['ativo_financeiro']==1) {//MÓDULO EMPRESA?>
                    <div class="ativacao_permisao">
                          <a href="?conteudo=perm_empresa&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>"><img src="../mod_empresa_finance/icons/default.png" width="48" height="42" alt="SITE"></a><br>
                          <a href="?conteudo=perm_empresa_financeiro&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>">Modulo Financeiro</a>
                    </div> 
					<?php }?>
					<?php   if ($row_perfusuario['ativo_sac']==1) {//MÓDULO EMPRESA?>
                    <div class="ativacao_permisao">
                            <a href="?conteudo=perm_empresa&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>"><img src="../mod_empresa_sac/icons/logo_sac_icon.fw.png" width="48" height="42" alt="SITE"></a><br>
                             <a href="?conteudo=perm_empresa&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>">SAC</a>
                    </div>
					<?php }?>
					<?php   if ($row_perfusuario['ativo_sma']==1) {//MÓDULO EMPRESA?>
                    <div class="ativacao_permisao">
                            <a href="?conteudo=perm_empresa&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>"><img src="../sma/icons/default.png" width="48" height="42" alt="SITE"></a><br>
							<a href="?conteudo=perm_empresa&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>">SMA</a>
                    </div>
					<?php }?>
					<?php   if ($row_perfusuario['ativo_empresa']==1) {//MÓDULO EMPRESA?>
                    <div class="ativacao_permisao">
                            <a href="?conteudo=perm_ecommerce&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>"><img src="../mod_empresa_ecommerce/icons/default.png" width="48" height="42" alt="SITE"></a><br>
                            <a href="?conteudo=perm_ecommerce&id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>">Modulo Ecommerce</a>
                    </div>
                    <?php }?>                 
                    <div style="clear:both;"></div>
                  </div>
				  
				  <?php ?>
				  </td>
                    </tr>
                    <?php if ((($row_perfusuario['id_perm_status_usuario_ajuda']==1)and($row_perfusuario['id_perm_status_usuario_versao']==1)and($row_perfusuario['id_perm_status_usuario_local']==1))){?>
                   <tr>
                     <td colspan="4" align="center" class="txt-opcoes">FERRAMENTO DE DESENVOLVEDORES</td>
                   </tr>
                   <?php if ($row_perfusuario['id_perm_status_usuario_ajuda']==1){?>
                   <tr>
                     <td colspan="3" align="left" class="txt">
                     <div class="options_action_tips" title=" DICAS " ></div>DICA:
                      <div align="center"> Para ativar a &quot;Ferramenta de Desenvolvimento&quot; é necessario ativar as 3 aplicativos e dar permissão de administrador.<br>
                        Ex:
                        &quot;Ajuda, Versão e locais;&quot; </div>
                     </td>
                     <td align="left" class="txt">&nbsp;</td>
                   </tr>
                   <tr>
                     <td align="left" class="txt-opcoes">Ajuda</td>
                     <td align="left" class="txt">
                       <select name="id_perm_status_usuario_ajuda" id="id_perm_status_usuario_ajuda">
                         <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_usuario_ajuda']))) {echo "selected=\"selected\"";} ?>>---</option>
                         <?php
do {  
?>
                         <option value="<?php echo $row_list_status['id_perm_status']?>"<?php if (!(strcmp($row_list_status['id_perm_status'], $row_list_acao['id_perm_status_usuario_ajuda']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_status['xNome']?></option>
                         <?php
} while ($row_list_status = mysql_fetch_assoc($list_status));
  $rows = mysql_num_rows($list_status);
  if($rows > 0) {
      mysql_data_seek($list_status, 0);
	  $row_list_status = mysql_fetch_assoc($list_status);
  }
?>
                       </select></td>
                     <td align="left" class="txt">o seu nome ja diz aplicatido de ajuda </td>
                     <td align="left" class="txt">&nbsp;</td>
                   </tr>
                   <?php }?>
                   <?php if ($row_perfusuario['id_perm_status_usuario_versao']==1){?>
                   <tr>
                     <td align="left" class="txt-opcoes">Versão</td>
                     <td align="left" class="txt"><label>
                       <input name="id_perm_status_usuario_versao" class="flat"  type="checkbox" id="id_perm_status_usuario_versao" onclick="checkAll(this.form)" value="1" <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_versao'],1))) {echo "checked=\"checked\"";} ?> />
                     </label></td>
                     <td align="left" class="txt">Ferramenta analista do sistema</td>
                     <td align="left" class="txt">&nbsp;</td>
                   </tr>
                   <?php }?>
                   <?php if ($row_perfusuario['id_perm_status_usuario_local']==1){?>
                   <tr>
                     <td align="left" class="txt-opcoes">Locais</td>
                     <td align="left" class="txt" ><label>
                       <input <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_local'],1))) {echo "checked=\"checked\"";} ?> name="id_perm_status_usuario_local" type="checkbox" id="id_perm_status_usuario_local" value="1" class="flat"  />
                     </label></td>
                     <td align="left" class="txt" >tem  permissão de criar locais para os usuarios</td>
                     <td align="left" class="txt" >&nbsp;</td>
                   </tr>
                   <tr>
                     <td align="left" class="txt-opcoes">Usuario</td>
                     <td align="left" class="txt" >
                       <input name="perm_limit_usuario" type="text" id="perm_limit_usuario" style="width:50px;" value="<?php echo $row_list_acao['perm_limit_usuario']; ?>" maxlength="3"></td>
                     <td align="left" class="txt" >&quot;0&quot; não tem limite de usuario, apartir do &quot;1&quot; é feito a limitação aplicativo.</td>
                     <td align="left" class="txt" >&nbsp;</td>
                   </tr>
                   <tr>
                     <td align="left" class="txt-opcoes">Setor</td>
                     <td align="left" class="txt" ><input name="perm_limit_setor" type="text" id="perm_limit_setor" style="width:50px;" value="<?php echo $row_list_acao['perm_limit_setor']; ?>" maxlength="3"></td>
                     <td align="left" class="txt" >&quot;0&quot; não tem limite de setor, apartir do &quot;1&quot; é feito a limitação aplicativo.</td>
                     <td align="left" class="txt" >&nbsp;</td>
                   </tr>
                   <tr>
                     <td align="left" class="txt-opcoes">Local</td>
                     <td align="left" class="txt" ><input name="perm_limit_local" type="text" id="perm_limit_local" style="width:50px;" value="<?php echo $row_list_acao['perm_limit_local']; ?>" maxlength="2"></td>
                     <td align="left" class="txt" >&quot;0&quot; não tem limite de local, apartir do &quot;1&quot;  é feito a limitação aplicativo.</td>
                     <td align="left" class="txt" >&nbsp;</td>
                   </tr>
                   <tr>
                     <td colspan="4" align="left" class="txt">&nbsp;</td>
                   </tr>
                 <?php }//local?>
                  <?php }//Ferramenta?>

                  <?php }//perfil do usuario?>
              </table>
               </td>
            </tr>

          </table>
        </div></td>
        </tr>
    </table></td>
  </tr>
  </table>
  
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

mysql_free_result($list_setor);

mysql_free_result($list_status);

?>
