<?php require_once('../Connections/connection_user.php'); ?>
<?php 
// deixar em maiusla
$_POST['usuario']=strtolower($_POST['usuario']); 
//md5 senha
$_POST['senha']=md5(strtoupper($_POST['senha']));


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

$_POST['banco_dados']='gruponext12';


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
 $insertSQL = sprintf("INSERT INTO tbnext_usuario (id_usuario, usuario, senha, banco_dados, id_usuario_setor, nome, sobrenome, tratamento, email, celular, cor_txt_fundo, cor_titulo_txt, cor_subtitulo_txt, cor_data_horas, cor_botao_add, cor_botao_alterar, cor_botao_excluir, cor_botao_pesquisar, ap_icons_local, ap_skin, ap_plano_fundo, ap_tabela, cor_tb_opcoes, cor_tb_indece, cor_menu_txt, cor_menu_fundo, cor_menu_txt_down, cor_jqueryui_custom, cor_submenu_txt, cor_submenu_fundo, cor_submenu_txt_down, cor_form_txt, id_perm_status_usuario_perfil, id_perm_status_usuario_log, id_perm_status_usuario_aparencia, id_perm_status_usuario_estatistica, id_perm_status_usuario_contato) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['senha'], "text"),
					   GetSQLValueString($_POST['banco_dados'], "text"),
                       GetSQLValueString($_POST['id_usuario_setor'], "int"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['sobrenome'], "text"),
                       GetSQLValueString($_POST['tratamento'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
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
					   GetSQLValueString($_POST['cor_submenu_fundo'], "text"),
                       GetSQLValueString($_POST['cor_submenu_txt'], "text"),
                       
                       
					   GetSQLValueString($_POST['cor_jqueryui_custom'], "text"),
                       GetSQLValueString($_POST['cor_form_txt'], "text"),
                       GetSQLValueString($_POST['id_perm_status_usuario_perfil'], "int"),
					   
					   GetSQLValueString($_POST['cor_submenu_txt_down'], "text"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_log']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_aparencia']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_estatistica']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['id_perm_status_usuario_contato']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_connection_user, $connection_user);
  $Result1 = mysql_query($insertSQL, $connection_user) or die(mysql_error());
  
     include('../sistema_usuario/acao_add_local.php'); 
  
  
//---------------> tbnext_usuario_perm_site
 $insertSQL = sprintf("INSERT INTO tbnext_usuario_perm_site (id_usuario ) VALUES (%s)",
                       GetSQLValueString($row_list_usuario['id_usuario'], "int"));

mysql_select_db($database_connection_user, $connection_user);
$Result1 = mysql_query($insertSQL, $connection_user) or die(mysql_error());
  
  
//---------------> tbnext_usuario_perm_empresa
 $insertSQL = sprintf("INSERT INTO tbnext_usuario_perm_empresa (id_usuario ) VALUES (%s)",
                       GetSQLValueString($row_list_usuario['id_usuario'], "int"));

mysql_select_db($database_connection_user, $connection_user);
$Result1 = mysql_query($insertSQL, $connection_user) or die(mysql_error());
  

//---------------> tbnext_usuario_perm_financeiro
$insertSQL = sprintf("INSERT INTO tbnext_usuario_perm_financeiro (id_usuario ) VALUES (%s)",
                       GetSQLValueString($row_list_usuario['id_usuario'], "int"));

mysql_select_db($database_connection_user, $connection_user);
$Result1 = mysql_query($insertSQL, $connection_user) or die(mysql_error());
  
 
 //---------------> tbnext_usuario_perm_sac
$insertSQL = sprintf("INSERT INTO tbnext_usuario_perm_sac (id_usuario ) VALUES (%s)",
                       GetSQLValueString($row_list_usuario['id_usuario'], "int"));

mysql_select_db($database_connection_user, $connection_user);
$Result1 = mysql_query($insertSQL, $connection_user) or die(mysql_error());
  
  
 
 
  
//---------------> tbnext_usuario_perm_ecommerce
$insertSQL = sprintf("INSERT INTO tbnext_usuario_perm_ecommerce (id_usuario ) VALUES (%s)",
                       GetSQLValueString($row_list_usuario['id_usuario'], "int"));

mysql_select_db($database_connection_user, $connection_user);
$Result1 = mysql_query($insertSQL, $connection_user) or die(mysql_error());
  
  
  


  
  
  
}



mysql_select_db($database_connection_user, $connection_user);
$query_list_class = "SELECT * FROM tbnext_usuario_class ORDER BY xNome ASC";
$list_class = mysql_query($query_list_class, $connection_user) or die(mysql_error());
$row_list_class = mysql_fetch_assoc($list_class);
$totalRows_list_class = mysql_num_rows($list_class);

mysql_select_db($database_connection_user, $connection_user);
$query_list_status = "SELECT * FROM tbnext_usuario_perm_list ORDER BY id_perm_status ASC";
$list_status = mysql_query($query_list_status, $connection_user) or die(mysql_error());
$row_list_status = mysql_fetch_assoc($list_status);
$totalRows_list_status = mysql_num_rows($list_status);

mysql_select_db($database_connection_user, $connection_user);
$query_list_local = "SELECT id_local, razao_social, fantasia, endereco, cnpj FROM tbnext_mod_empresa_local ORDER BY razao_social ASC";
$list_local = mysql_query($query_list_local, $connection_user) or die(mysql_error());
$row_list_local = mysql_fetch_assoc($list_local);
$totalRows_list_local = mysql_num_rows($list_local);

mysql_select_db($database_connection_user, $connection_user);
$query_list_setor = "SELECT * FROM tbnext_usuario_setor ORDER BY xNome ASC";
$list_setor = mysql_query($query_list_setor, $connection_user) or die(mysql_error());
$row_list_setor = mysql_fetch_assoc($list_setor);
$totalRows_list_setor = mysql_num_rows($list_setor);


?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
<?php 
$acao_comum="Adicionar";
$acao_icons="add-30.png";
include ("../sistema/index_content_head.php");?>

  <table width="98%" border="0" cellspacing="1" cellpadding="0">

    <tr>
      <td colspan="2" align="center" class="txt-opcoes">Informa&ccedil;&otilde;es de acesso ao painel</td>
      <td>&nbsp;</td>
      <td colspan="2" align="center" class="txt-opcoes">Informa&ccedil;&otilde;es</td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Usuario*
        
        <input name="res" type="hidden" id="res" value="res" />
      <input name="id_usuario" type="hidden" id="id_usuario" />
      <input name="id_usuario_perm" type="hidden" id="id_usuario_perm" value="<?php echo $row_perfusuario['adm_perm_sistem_usuario_perfil']; ?>" /></td>
      <td align="left" class="txt">
       <div class="item form-group "><div class="col-md-5 col-sm-5 col-xs-12">
      <input name="usuario" type="text" required  id="usuario" tabindex="1" autocomplete="off" class="form-control col-md-6 col-sm-6 col-xs-12" data-validate-length-range="6" data-validate-words="1" />
     </div>
      </div>
      
        
      </td>
      <td align="left">&nbsp;</td>
      <td align="left" class="txt-opcoes">Tratamento</td>
      <td align="left" class="txt"><select tabindex="10" required name="tratamento" class="txt-form" id="tratamento" >
        <option value="" <?php if (!(strcmp("", $row_perfusuario['tratamento']))) {echo "selected=\"selected\"";} ?>>&nbsp;</option>
        <option value="Sr." <?php if (!(strcmp("Sr.", $row_perfusuario['tratamento']))) {echo "selected=\"selected\"";} ?>>Sr.</option>
        <option value="Sra." <?php if (!(strcmp("Sra.", $row_perfusuario['tratamento']))) {echo "selected=\"selected\"";} ?>>Sra.</option>
        <option value="Srta." <?php if (!(strcmp("Srta.", $row_perfusuario['tratamento']))) {echo "selected=\"selected\"";} ?>>Srta.</option>
      </select></td>
    </tr>
    <tr>
      <td width="12%" align="left" class="txt-opcoes">Senha*</td>
      <td width="36%" align="left" class="txt">
       <div class="item form-group "><div class="col-md-5 col-sm-5 col-xs-12">
          <input name="senha" type="password" required data-validate-length="6,8" class="form-control col-md-6 col-xs-12" id="senha" tabindex="2" autocomplete="off"/>
        </div></div>
      </td>
      <td width="3%" align="left">&nbsp;</td>
      <td width="13%" align="left" class="txt-opcoes">Nome*</td>
      <td width="36%" align="left" class="txt">
       <div class="item form-group "><div class="col-md-5 col-sm-5 col-xs-12">
        <input name="nome" type="text" class="txt-form" id="nome"  required tabindex="11" size="40"/>
      </div></div>
      </td>
    </tr>

    <tr>
      <td align="left" class="txt-opcoes">Confirmar a Senha *</td>
      <td align="left" class="txt">
       <div class="item form-group "><div class="col-md-5 col-sm-5 col-xs-12">
      <input name="senha2" type="password" required data-validate-linked="senha" class="form-control col-md-6 col-xs-12" id="senha2" tabindex="2" autocomplete="off"/>
      </div></div>
      </td>
      <td align="left">&nbsp;</td>
      <td align="left" class="txt-opcoes">Sobrenome</td>
      <td align="left" class="txt">
      <div class="col-md-5 col-sm-5 col-xs-12">
      <input name="sobrenome" type="text" class="txt-form" id="sobrenome"  tabindex="12" size="40"/>
      </div>
      </td>
    </tr>
    <tr >
    <?php if($totalRows_list_local>1){$ativo_local=1; $opcoes="-opcoes";} ?>
      <td align="left" class="txttxt-opcoes">Setor</td>
      <td align="left" class="txt">
        <select name="id_usuario_setor" required tabindex="3" id="id_usuario_setor" class="txt-form">
          <option value="">---</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_setor['id_usuario_setor']?>"><?php echo $row_list_setor['xNome']?></option>
          <?php
} while ($row_list_setor = mysql_fetch_assoc($list_setor));
  $rows = mysql_num_rows($list_setor);
  if($rows > 0) {
      mysql_data_seek($list_setor, 0);
	  $row_list_setor = mysql_fetch_assoc($list_setor);
  }
?>
        </select>
      </td>
      <td align="left">&nbsp;</td>
      <td align="left" class="txt-opcoes">E-mail</td>
      <td align="left" class="txt">
       <div class="item form-group ">
       <div class="col-md-5 col-sm-5 col-xs-12">
       <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">

      </div></div>
      </td>
    </tr>
    <tr >
      <td colspan="2" align="left" class="txt"><span class="txt<?php echo $opcoes; ?>">
        <?php if($ativo_local==1){ ?>
        Local onde o usuario irá trabalhar
        <?php }?>
      </span></td>
      <td align="left">&nbsp;</td>
      <td align="left" class="txt-opcoes"><span >Celular</span></td>
      <td align="left" class="txt">
      <div class="col-md-5 col-sm-5 col-xs-12">
        <input name="celular" type="tel" class="mask_cel" id="celular" tabindex="14" />
      
      </div>
      </td>
    </tr>
    <tr>
      <td colspan="5"><span class="txt">
        <?php if($ativo_local==1){ ?>
        <select name="id_local" id="id_local" tabindex="4" required style="width:410px;">
          <option value="">---</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_local['id_local']?>"><?php echo $row_list_local['fantasia']?>&nbsp;&nbsp;&nbsp;|&nbsp;CNPJ: <?php echo $row_list_local['cnpj']?></option>
          <?php
} while ($row_list_local = mysql_fetch_assoc($list_local));
  $rows = mysql_num_rows($list_local);
  if($rows > 0) {
      mysql_data_seek($list_local, 0);
	  $row_list_local = mysql_fetch_assoc($list_local);
  }
?>
        </select>
        <?php }else{?>
        <input name="id_local" type="hidden" id="id_local" value="<?php echo $row_list_local['id_local']; ?>">
        <?php }?>
      </span></td>
    </tr>
    <tr>
      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td colspan="4" align="left" class="txt-opcoes"><div align="center">PERMISS&Atilde;O DE USUARIO</div></td>
        </tr>
        <tr>
          <td colspan="4" align="left" class="txt"><button type="button" class="options_action_tips"></button>DICA:
            <div align="center"> Este sistema de permiss&atilde;o esta em ordem ao menu, assim tem mais  facilidade de delegar as fun&ccedil;&otilde;es especificas para cada usuario.<br />
              <br/>
            </div></td>
        </tr>
        <tr class="txt-opcoes" >
          <td colspan="4" align="left" >Painel de Controle</td>
        </tr>
        <tr>
          <td align="left" class="txt-opcoes">Contato</td>
          <td align="left" class="txt" ><label>
            <input <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_contato'],1))) {echo "checked=\"checked\"";} ?> name="id_perm_status_usuario_contato" type="checkbox" id="id_perm_status_usuario_contato3" value="1" class="flat" />
          </label>
            Ativado</td>
          <td align="left" class="txt" > contato para empresa e tambem para os web/sites</td>
          <td align="left" class="txt" >&nbsp;</td>
        </tr>
        <?php if ($row_perfusuario['id_perm_status_usuario_estatistica']==1){?>
        <tr>
          <td width="13%" height="23" align="left" class="txt-opcoes">Estat&iacute;stica</td>
          <td width="14%" align="left" class="txt"><label>
            <input <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_estatistica'],1))) {echo "checked=\"checked\"";} ?> name="id_perm_status_usuario_estatistica" type="checkbox" id="id_perm_status_usuario_estatistica" value="1" class="flat" />
          </label>
            Ativado</td>
          <td width="71%" align="left" class="txt">estatística de acesso</td>
          <td width="2%" align="left" class="txt">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" class="txt-opcoes">Log de usuario</td>
          <td align="left" class="txt"><label>
            <input name="id_perm_status_usuario_log" type="checkbox" id="id_perm_status_usuario_log" onclick="checkAll(this.form)" value="1" <?php if (!(strcmp($row_list_acao['id_perm_status_usuario_log'],1))) {echo "checked=\"checked\"";} ?> class="flat" />
          </label>
            Ativado</td>
          <td align="left" class="txt">ver e excluir loges de acesso do usuario</td>
          <td align="left" class="txt">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" class="txt-opcoes">*Classificar</td>
          <td align="left"  class="txt"><select name="id_perm_status_usuario_class" id="id_perm_status_usuario_class" class="txt-form">
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
          <td align="left" class="txt">tem permissao de criar e editar classicações do usuario</td>
          <td align="left" class="txt">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" class="txt-opcoes">*Perfil do Usuario</td>
          <td align="left" bgcolor="#990000" class="txt"><select name="id_perm_status_usuario_perfil" id="id_perm_status_usuario_perfil" class="txt-form">
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
 onclick="MM_openBrWindow('../sistema_usuario/imagens/perm_perfil_usuario.png','','toolbar=no, location=no ,menubar=no, status=yes, scrollbars=yes, resizable=yes, width=800,height=400')"></div></td>
        </tr>
        <?php }?>
      </table></td>
    </tr>
    <tr>
      <td colspan="5"><input name="id_usuario2" type="hidden"  id="id_usuario2" value="<?php echo $id_usuario_parencia; ?>" />
        <input name="res2" type="hidden" id="res2" value="res" />
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
      <input name="cor_jqueryui_custom" type="hidden" id="cor_jqueryui_custom" value="custom_blue/jquery-ui-1.10.3.custom.css" /></td>
    </tr>
    
    <tr>
      <td colspan="5" ><div align="center">
	
      </div></td>
    </tr>
  </table>
<div class="btn-group">
	<br>
<button type="button"  id="form_bt_voltar" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>     
	<button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> Salvar &nbsp;&nbsp;&nbsp;&nbsp;</button>
	<input type="hidden" name="MM_insert" value="acao">
</div>
</form>
<?php 
//envio de resposta do formulario
if ($_POST['res']=='res'){	include "res_add.php";}
?>
    <!-- validator -->
<script src="../vendors/validator/validator.min.js"></script>

    <!-- Custom Theme Scripts -->
<script src="js/custom.js"></script>

    <!-- validator -->
<script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->
<?php
mysql_free_result($list_class);

mysql_free_result($list_status);

mysql_free_result($list_local);

mysql_free_result($list_setor);
?>
