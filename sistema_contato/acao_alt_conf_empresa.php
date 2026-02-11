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
  $updateSQL = sprintf("UPDATE tbnext_sistem_contato SET inf_nome_fantasia=%s, inf_nome_fantasia_ocultar=%s, inf_razao_social=%s, inf_razao_social_ocultar=%s, inf_cnpj=%s, inf_cnpj_ocultar=%s, inf_email=%s, inf_email_ocultar=%s, inf_email2=%s, inf_email2_ocultar=%s, inf_email3=%s, inf_email3_ocultar=%s, inf_email4=%s, inf_email4_ocultar=%s, inf_email5=%s, inf_email5_ocultar=%s, inf_msn=%s, inf_msn_ocultar=%s, inf_skype=%s, inf_skype_ocultar=%s, inf_endereco=%s, inf_bairro=%s, inf_cidade=%s, inf_estado=%s, inf_pais=%s, inf_cep=%s, inf_fone1=%s, inf_fone1_ocultar=%s, inf_fone2=%s, inf_fone2_ocultar=%s, inf_fone3=%s, inf_fone3_ocultar=%s, inf_fone4=%s, inf_fone4_ocultar=%s, inf_fax=%s, inf_fax_ocultar=%s, inf_celular=%s, inf_celular_ocultar=%s, inf_celular2=%s, inf_celular2_ocultar=%s, inf_celular3=%s, inf_celular3_ocultar=%s, inf_celular4=%s, inf_celular4_ocultar=%s, form_mail=%s, form_mensagem=%s, inf_pesquia_empresa=%s, inf_pesquia_empresa_url=%s, inf_pesquia_produtos=%s, inf_pesquia_produtos_url=%s, inf_pesquia_contatos=%s, inf_pesquia_contatos_url=%s, inf_pesquia_adicionais=%s, inf_pesquia_adicionais_url=%s WHERE id_contato=%s",
                       GetSQLValueString($_POST['inf_nome_fantasia'], "text"),
                       GetSQLValueString(isset($_POST['inf_nome_fantasia_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_razao_social'], "text"),
                       GetSQLValueString(isset($_POST['inf_razao_social_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_cnpj'], "text"),
                       GetSQLValueString(isset($_POST['inf_cnpj_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_email'], "text"),
                       GetSQLValueString(isset($_POST['inf_email_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_email2'], "text"),
                       GetSQLValueString(isset($_POST['inf_email2_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_email3'], "text"),
                       GetSQLValueString(isset($_POST['inf_email3_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_email4'], "text"),
                       GetSQLValueString(isset($_POST['inf_email4_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_email5'], "text"),
                       GetSQLValueString(isset($_POST['inf_email5_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_msn'], "text"),
                       GetSQLValueString(isset($_POST['inf_msn_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_skype'], "text"),
                       GetSQLValueString(isset($_POST['inf_skype_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_endereco'], "text"),
                       GetSQLValueString($_POST['inf_bairro'], "text"),
                       GetSQLValueString($_POST['inf_cidade'], "text"),
                       GetSQLValueString($_POST['inf_estado'], "text"),
                       GetSQLValueString($_POST['inf_pais'], "text"),
                       GetSQLValueString($_POST['inf_cep'], "text"),
                       GetSQLValueString($_POST['inf_fone1'], "text"),
                       GetSQLValueString(isset($_POST['inf_fone1_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_fone2'], "text"),
                       GetSQLValueString(isset($_POST['inf_fone2_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_fone3'], "text"),
                       GetSQLValueString(isset($_POST['inf_fone3_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_fone4'], "text"),
                       GetSQLValueString(isset($_POST['inf_fone4_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_fax'], "text"),
                       GetSQLValueString(isset($_POST['inf_fax_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_celular'], "text"),
                       GetSQLValueString(isset($_POST['inf_celular_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_celular2'], "text"),
                       GetSQLValueString(isset($_POST['inf_celular2_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_celular3'], "text"),
                       GetSQLValueString(isset($_POST['inf_celular3_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['inf_celular4'], "text"),
                       GetSQLValueString(isset($_POST['inf_celular4_ocultar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['form_mail'], "text"),
                       GetSQLValueString($_POST['form_mensagem'], "text"),
                       GetSQLValueString($_POST['inf_pesquia_empresa'], "text"),
                       GetSQLValueString($_POST['inf_pesquia_empresa_url'], "text"),
                       GetSQLValueString($_POST['inf_pesquia_produtos'], "text"),
                       GetSQLValueString($_POST['inf_pesquia_produtos_url'], "text"),
                       GetSQLValueString($_POST['inf_pesquia_contatos'], "text"),
                       GetSQLValueString($_POST['inf_pesquia_contatos_url'], "text"),
                       GetSQLValueString($_POST['inf_pesquia_adicionais'], "text"),
                       GetSQLValueString($_POST['inf_pesquia_adicionais_url'], "text"),
                       GetSQLValueString($_POST['id_contato'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

mysql_select_db($database_connection, $connection);
$query_list_empresa = "SELECT * FROM tbnext_sistem_contato";
$list_empresa = mysql_query($query_list_empresa, $connection) or die(mysql_error());
$row_list_empresa = mysql_fetch_assoc($list_empresa);
$totalRows_list_empresa = mysql_num_rows($list_empresa);
?>
<?php  include "conf.php"; ?>
<?php // include "../sistem_funcoes/perfusuario.php"; ?>
<style type="text/css">
<!--
.txt-Titulo-Botoes {	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: <?php echo $row_aparenciaEstilo['corTxtBotoes']; ?>;
	text-indent: 5px;
	font-weight: bold;
	text-transform: capitalize;
	background-image: url(../images/aparencia/<?php echo $row_aparenciaEstilo['barra']; ?>/barra-botao.png);
	background-color: #CCCCCC;
	line-height: 30px;
}
.txt-Titulo-Tabela {	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: <?php echo $row_aparenciaEstilo['corTituloTabela']; ?>;
	text-indent: 5px;
	font-weight: bold;
	text-transform: capitalize;
	background-image: url(../images/aparencia/<?php echo $row_aparenciaEstilo['barra']; ?>/barra-titulo.png);
}
-->
</style>
<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
  <table width="98%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="100%" align="center" class="txt-indece-titulo"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="60" align="center"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
            <td width="276"><?php echo "$sistema_nome"; ?> &nbsp;<?php echo "$versao"; ?></td>
          </tr>
      </table></td>
    </tr>
    
    <tr>
      <td >
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr class="texto">
            <td><div id="Accordion1" class="Accordion" tabindex="0">
              <div class="AccordionPanel">
                <div class="AccordionPanelTab">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="30" align="left"><img src="<?php echo "$local_icons"; ?>info_empresa-30.png" width="30" height="30"  title="  Personalize as informa&ccedil;&otilde;es da sua empresa "/></td>
                      <td width="1015" align="left" class="txt-Indece">Empresa
                        <input name="id_contato" type="hidden" id="id_contato" value="<?php echo $row_list_empresa['id_contato']; ?>" />
                        <input name="res" type="hidden" id="res" value="res" /></td>
                    </tr>
                  </table>
                </div>
                <div class="AccordionPanelContent">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="texto"></tr>
                    <tr class="texto">
                      <td width="20%" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Raz&atilde;o Social:</div></td>
                      <td width="26%" align="left" class="txt"><input name="inf_razao_social" type="text" class="txt-form" id="inf_razao_social" tabindex="8" value="<?php echo $row_list_empresa['inf_razao_social']; ?>" size="40" /></td>
                      <td width="54%" align="left" class="txt"><label>
                        <input <?php if (!(strcmp($row_list_empresa['inf_nome_fantasia_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_nome_fantasia_ocultar" type="checkbox" id="inf_nome_fantasia_ocultar"  />
                        Ocultar
                      </label></td>
                    </tr>
                    <tr class="texto">
                      <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Nome Fantasia:</div></td>
                      <td align="left" class="txt"><input name="inf_nome_fantasia" type="text" class="txt-form" id="inf_nome_fantasia" tabindex="8" value="<?php echo $row_list_empresa['inf_nome_fantasia']; ?>" size="40" /></td>
                      <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_razao_social_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_razao_social_ocultar" type="checkbox" id="inf_razao_social_ocultar" />
Ocultar </td>
                    </tr>
                    <tr class="texto">
                      <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">CNPJ:</div></td>
                      <td align="left" class="txt"><input name="inf_cnpj" type="text" class="txt-form" id="inf_cnpj" tabindex="8" value="<?php echo $row_list_empresa['inf_cnpj']; ?>" size="40" /></td>
                      <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_cnpj_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_cnpj_ocultar" type="checkbox" id="inf_cnpj_ocultar" />
Ocultar  | XXX.XXX.XXX/XXXX-XX</td>
                    </tr>
                  </table>
                </div>
              </div>
<div class="AccordionPanel">
  <div class="AccordionPanelTab">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="30" align="left"><img src="<?php echo "$local_icons"; ?>info_end-30.png" width="30" height="30"  title="  Personalize as informa&ccedil;&otilde;es da sua empresa "/></td>
        <td width="1015" align="left" class="txt-Indece">Informa&ccedil;&otilde;es de endere&ccedil;os:google</td>
      </tr>
    </table>
  </div>
                <div class="AccordionPanelContent">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr class="texto">
                      <td width="22%" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Endere&ccedil;o:</div></td>
                      <td width="38%" align="left" class="txt"><label>
                        <input name="inf_endereco" type="text" class="txt-form" id="inf_endereco" value="<?php echo $row_list_empresa['inf_endereco']; ?>" size="40" />
                      </label></td>
                      <td width="40%" class="txt">&nbsp;</td>
                    </tr>
                    <tr class="texto">
                      <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Bairro:</div></td>
                      <td align="left" class="txt"><label>
                        <input name="inf_bairro" type="text" class="txt-form" id="inf_bairro" value="<?php echo $row_list_empresa['inf_bairro']; ?>" size="40" />
                      </label></td>
                      <td class="txt">&nbsp;</td>
                    </tr>
                    <tr class="texto">
                      <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Cidade:</div></td>
                      <td align="left" class="txt"><input name="inf_cidade" type="text" class="txt-form" id="inf_cidade" value="<?php echo $row_list_empresa['inf_cidade']; ?>" size="40" /></td>
                      <td class="txt">&nbsp;</td>
                    </tr>
                    <tr class="texto">
                      <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Estado:</div></td>
                      <td align="left" class="txt"><label class="texto">
                        <select name="inf_estado" class="txt-form" id="inf_estado">
                          <option selected="selected" value="" <?php if (!(strcmp("", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>==&nbsp;&nbsp;&nbsp;&nbsp;</option>
                          <option value="AC" <?php if (!(strcmp("AC", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>AC</option>
                          <option value="AL" <?php if (!(strcmp("AL", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>AL</option>
                          <option value="AM" <?php if (!(strcmp("AM", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>AM</option>
                          <option value="AP" <?php if (!(strcmp("AP", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>AP</option>
                          <option value="BA" <?php if (!(strcmp("BA", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>BA</option>
                          <option value="CE" <?php if (!(strcmp("CE", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>CE</option>
                          <option value="DF" <?php if (!(strcmp("DF", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>DF</option>
                          <option value="ES" <?php if (!(strcmp("ES", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>ES</option>
                          <option value="GO" <?php if (!(strcmp("GO", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>GO</option>
                          <option value="MA" <?php if (!(strcmp("MA", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>MA</option>
                          <option value="MG" <?php if (!(strcmp("MG", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>MG</option>
                          <option value="MS" <?php if (!(strcmp("MS", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>MS</option>
                          <option value="MT" <?php if (!(strcmp("MT", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>MT</option>
                          <option value="PA" <?php if (!(strcmp("PA", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>PA</option>
                          <option value="PB" <?php if (!(strcmp("PB", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>PB</option>
                          <option value="RJ" <?php if (!(strcmp("RJ", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>RJ</option>
                          <option value="RN" <?php if (!(strcmp("RN", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>RN</option>
                          <option value="RO" <?php if (!(strcmp("RO", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>RO</option>
                          <option value="RR" <?php if (!(strcmp("RR", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>RR</option>
                          <option value="RS" <?php if (!(strcmp("RS", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>RS</option>
                          <option value="SC" <?php if (!(strcmp("SC", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>SC</option>
                          <option value="SE" <?php if (!(strcmp("SE", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>SE</option>
                          <option value="SP" <?php if (!(strcmp("SP", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>SP</option>
                          <option value="TO" <?php if (!(strcmp("TO", $row_list_empresa['inf_estado']))) {echo "selected=\"selected\"";} ?>>TO</option>
                        </select>
                      </label></td>
                      <td class="txt">&nbsp;</td>
                    </tr>
                    <tr class="texto">
                      <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Pais:</div></td>
                      <td align="left" class="txt"><input name="inf_pais" type="text" class="txt-form" id="inf_pais" value="<?php echo $row_list_empresa['inf_pais']; ?>" size="40" /></td>
                      <td class="txt">&nbsp;</td>
                    </tr>
                    <tr class="texto">
                      <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">CEP:</div></td>
                      <td align="left" class="txt"><label>
                        <input name="inf_cep" type="text" class="txt-form" id="inf_cep" value="<?php echo $row_list_empresa['inf_cep']; ?>" size="40" />
                      </label></td>
                      <td class="txt">&nbsp;</td>
                    </tr>
                  </table>
                </div>
              </div>
<div class="AccordionPanel">
  <div class="AccordionPanelTab">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="32" align="left"><img src="<?php echo "$local_icons"; ?>conf_pagina_pesq-30.png" width="30" height="30"  title="  Personalize as informa&ccedil;&otilde;es da sua empresa "/></td>
        <td width="1013" align="left" class="txt-Indece">Sistema de Pesquisa -                      &quot;Ex: , Yahoo, Bing, ...&quot;<a href="javascript:;" onclick="javascript:window.open('../info_empresa/ex_pesq_google.png' , 'Boleto','width=450,height=250,status=no, resizable=yes,scrollbars=yes,top=50,left=50')"> &quot;veja exemplo&quot;</a></td>
      </tr>
    </table>
  </div>
  <div class="AccordionPanelContent">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="texto"></tr>
      <tr class="texto">
        <td width="27%" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Informa&ccedil;&otilde;es Empresa:</div></td>
        <td width="24%" align="left" class="txt"><input name="inf_pesquia_empresa" type="text" class="txt-form" id="inf_pesquia_empresa" tabindex="8" value="<?php echo $row_list_empresa['inf_pesquia_empresa']; ?>" size="40" maxlength="50" /></td>
        <td width="49%" align="left" class="txt">informe em 50 caracter</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Informa&ccedil;&otilde;es Empresa URL:</div></td>
        <td align="left" class="txt"><input name="inf_pesquia_empresa_url" type="text" class="txt-form" id="inf_pesquia_empresa_url" tabindex="8" value="<?php echo $row_list_empresa['inf_pesquia_empresa_url']; ?>" size="40" maxlength="90" /></td>
        <td align="left" class="txt">http://www.minhaempresa.com.br/pg=empresa</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Informa&ccedil;&otilde;es Produtos:</div></td>
        <td align="left" class="txt"><input name="inf_pesquia_produtos" type="text" class="txt-form" id="inf_pesquia_produtos" tabindex="8" value="<?php echo $row_list_empresa['inf_pesquia_produtos']; ?>" size="40" maxlength="50" /></td>
        <td align="left" class="txt">informe em 50 caracter</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Informa&ccedil;&otilde;es Produtos URL:</div></td>
        <td align="left" class="txt"><input name="inf_pesquia_produtos_url" type="text" class="txt-form" id="inf_pesquia_produtos_url" tabindex="8" value="<?php echo $row_list_empresa['inf_pesquia_produtos_url']; ?>" size="40" maxlength="90" /></td>
        <td align="left" class="txt">http://www.minhaempresa.com.br/pg=produtos</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Informa&ccedil;&otilde;es Contatos:</div></td>
        <td align="left" class="txt"><input name="inf_pesquia_contatos" type="text" class="txt-form" id="inf_pesquia_contatos" tabindex="8" value="<?php echo $row_list_empresa['inf_pesquia_contatos']; ?>" size="40" maxlength="50" /></td>
        <td align="left" class="txt">informe em 50 caracter</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Informa&ccedil;&otilde;es contatos URL:</div></td>
        <td align="left" class="txt"><input name="inf_pesquia_contatos_url" type="text" class="txt-form" id="inf_pesquia_contatos_url" tabindex="8" value="<?php echo $row_list_empresa['inf_pesquia_contatos_url']; ?>" size="40" maxlength="90" /></td>
        <td align="left" class="txt">http://www.minhaempresa.com.br/pg=contatos</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Informa&ccedil;&otilde;es Adicionais:</div></td>
        <td align="left" class="txt"><input name="inf_pesquia_adicionais" type="text" class="txt-form" id="inf_pesquia_adicionais" tabindex="8" value="<?php echo $row_list_empresa['inf_pesquia_adicionais']; ?>" size="40" maxlength="50" /></td>
        <td align="left" class="txt">informe em 50 caracter</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Informa&ccedil;&otilde;es Adicionais URL:</div></td>
        <td align="left" class="txt"><input name="inf_pesquia_adicionais_url" type="text" class="txt-form" id="inf_pesquia_adicionais_url" tabindex="8" value="<?php echo $row_list_empresa['inf_pesquia_adicionais_url']; ?>" size="40" maxlength="90" /></td>
        <td align="left" class="txt">http://www.minhaempresa.com.br/pg=informacoes</td>
      </tr>
    </table>
  </div>
</div>
<div class="AccordionPanel">
  <div class="AccordionPanelTab">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="30"><img src="<?php echo "$local_icons"; ?>conf_pagina_contato-30.png" width="30" height="30"  title="  Personalize as informa&ccedil;&otilde;es da sua empresa "/></td>
        <td width="1015" align="left" class="txt-Indece">Email de Apresenta&ccedil;&atilde;o</td>
      </tr>
    </table>
  </div>
  <div class="AccordionPanelContent">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="texto">
        <td width="17%" align="left" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">E-mail:</div></td>
        <td width="44%" align="left" class="txt"><label>
          <input name="inf_email" type="text" class="txt-form-Minusculos" id="inf_email" tabindex="8" value="<?php echo $row_list_empresa['inf_email']; ?>" size="40" />
          </label></td>
        <td width="39%" align="left" class="txt"><div align="left">
          <input <?php if (!(strcmp($row_list_empresa['inf_email_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_email_ocultar" type="checkbox" id="inf_email_ocultar" />
          Ocultar</div></td>
      </tr>
      <tr class="texto">
        <td align="left" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">E-mail2:</div></td>
        <td align="left" class="txt"><label>
          <input name="inf_email2" type="text" class="txt-form-Minusculos" id="inf_email2" tabindex="8" value="<?php echo $row_list_empresa['inf_email2']; ?>" size="40" />
        </label></td>
        <td align="left" class="txt"><div align="left">
          <input <?php if (!(strcmp($row_list_empresa['inf_email2_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_email2_ocultar" type="checkbox" id="inf_email2_ocultar" />
Ocultar</div></td>
      </tr>
      <tr class="texto">
        <td align="left" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">E-mail3:</div></td>
        <td align="left" class="txt"><label>
          <input name="inf_email3" type="text" class="txt-form-Minusculos" id="inf_email3" tabindex="8" value="<?php echo $row_list_empresa['inf_email3']; ?>" size="40" />
        </label></td>
        <td align="left" class="txt"><div align="left">
          <input <?php if (!(strcmp($row_list_empresa['inf_email3_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_email3_ocultar" type="checkbox" id="inf_cnpj_ocultar6" />
          Ocultar</div></td>
      </tr>
      <tr class="texto">
        <td align="left" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">E-mail4:</div></td>
        <td align="left" class="txt"><label>
          <input name="inf_email4" type="text" class="txt-form-Minusculos" id="inf_email4" tabindex="8" value="<?php echo $row_list_empresa['inf_email4']; ?>" size="40" />
        </label></td>
        <td align="left" class="txt"><div align="left">
          <input <?php if (!(strcmp($row_list_empresa['inf_email4_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_email4_ocultar" type="checkbox" id="inf_cnpj_ocultar7" />
          Ocultar</div></td>
      </tr>
      <tr class="texto">
        <td align="left" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">E-mail5:</div></td>
        <td align="left" class="txt"><label>
          <input name="inf_email5" type="text" class="txt-form-Minusculos" id="inf_email5" tabindex="8" value="<?php echo $row_list_empresa['inf_email5']; ?>" size="40" />
        </label></td>
        <td align="left" class="txt"><div align="left">
          <input <?php if (!(strcmp($row_list_empresa['inf_email5_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_email5_ocultar" type="checkbox" id="inf_cnpj_ocultar8" />
          Ocultar</div></td>
      </tr>
      <tr class="texto">
        <td align="left" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">MSN:</div></td>
        <td align="left" class="txt"><label>
          <input name="inf_msn" type="text" class="txt-form-Minusculos" id="inf_msn" value="<?php echo $row_list_empresa['inf_msn']; ?>" size="40" />
          </label></td>
        <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_msn_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_msn_ocultar" type="checkbox" id="inf_msn_ocultar" />
          Ocultar</td>
      </tr>
      <tr class="texto">
        <td align="left" bgcolor="#E7E6EB" class="txt-opcoes">Skype:</td>
        <td align="left" class="txt"><label>
          <input name="inf_skype" type="text" class="txt-form" id="inf_skype" value="<?php echo $row_list_empresa['inf_skype']; ?>" size="40" />
        </label></td>
        <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_skype_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_skype_ocultar" type="checkbox" id="inf_skype_ocultar" />
Ocultar</td>
      </tr>
    </table>
  </div>
</div>
<div class="AccordionPanel">
  <div class="AccordionPanelTab">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="30"><img src="<?php echo "$local_icons"; ?>info_fone-30.png" width="30" height="30"  title="  Personalize as informa&ccedil;&otilde;es da sua empresa "/></td>
        <td width="1021" align="left" class="txt-Indece">Informa&ccedil;&otilde;es Telefones</td>
      </tr>
    </table>
  </div>
  <div class="AccordionPanelContent">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="texto">
        <td width="18%" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Fone1:</div></td>
        <td width="34%" align="left" class="txt"><label>
          <input name="inf_fone1" type="text" class="txt-form" id="inf_fone6"  tabindex="9" value="<?php echo $row_list_empresa['inf_fone1']; ?>" size="40"/>
        </label></td>
        <td width="48%" align="left" class="txt"><div align="left">
          <input <?php if (!(strcmp($row_list_empresa['inf_fone1_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_fone1_ocultar" type="checkbox" id="inf_fone1_ocultar" />
          Ocultar | (011) 555-555</div></td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Fone2:</div></td>
        <td align="left" class="txt"><input name="inf_fone2" type="text" class="txt-form" id="inf_fone5"  tabindex="9" value="<?php echo $row_list_empresa['inf_fone2']; ?>" size="40"/></td>
        <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_fone2_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_fone2_ocultar" type="checkbox" id="inf_fone2_ocultar" />
          Ocultar</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Fone3:</div></td>
        <td align="left" class="txt"><input name="inf_fone3" type="text" class="txt-form" id="inf_fone"  tabindex="9" value="<?php echo $row_list_empresa['inf_fone3']; ?>" size="40"/></td>
        <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_fone3_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_fone3_ocultar" type="checkbox" id="inf_fone3_ocultar" />
          Ocultar</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Fone4:</div></td>
        <td align="left" class="txt"><input name="inf_fone4" type="text" class="txt-form" id="inf_fone2"  tabindex="9" value="<?php echo $row_list_empresa['inf_fone4']; ?>" size="40"/></td>
        <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_fone4_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_fone4_ocultar" type="checkbox" id="inf_fone4_ocultar" />
          Ocultar</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Fax:</div></td>
        <td align="left" class="txt"><input name="inf_fax" type="text" class="txt-form" id="inf_fax3"  tabindex="9" value="<?php echo $row_list_empresa['inf_fax']; ?>" size="40"/></td>
        <td align="left" class="txt"><div align="left">
          <input <?php if (!(strcmp($row_list_empresa['inf_fax_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_fax_ocultar" type="checkbox" id="inf_fax_ocultar" />
          Ocultar</div></td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Celular:</div></td>
        <td align="left" class="txt"><input name="inf_celular" type="text" class="txt-form" id="inf_celular3"  tabindex="9" value="<?php echo $row_list_empresa['inf_celular']; ?>" size="40"/></td>
        <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_celular_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_celular_ocultar" type="checkbox" id="inf_celular_ocultar" />
          Ocultar</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Celular2:</div></td>
        <td align="left" class="txt"><input name="inf_celular2" type="text" class="txt-form" id="inf_celular2"  tabindex="9" value="<?php echo $row_list_empresa['inf_celular2']; ?>" size="40"/></td>
        <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_celular2_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_celular2_ocultar" type="checkbox" id="inf_celular2_ocultar" />
          Ocultar</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Celular3:</div></td>
        <td align="left" class="txt"><input name="inf_celular3" type="text" class="txt-form" id="inf_celular3"  tabindex="9" value="<?php echo $row_list_empresa['inf_celular3']; ?>" size="40"/></td>
        <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_celular3_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_celular3_ocultar" type="checkbox" id="inf_celular3_ocultar" />
          Ocultar</td>
      </tr>
      <tr class="texto">
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Celular4:</div></td>
        <td align="left" class="txt"><input name="inf_celular4" type="text" class="txt-form" id="inf_celular3"  tabindex="9" value="<?php echo $row_list_empresa['inf_celular4']; ?>" size="40"/></td>
        <td align="left" class="txt"><input <?php if (!(strcmp($row_list_empresa['inf_celular4_ocultar'],1))) {echo "checked=\"checked\"";} ?> name="inf_celular4_ocultar" type="checkbox" id="inf_celular4_ocultar" />          
          Ocultar</td>
      </tr>
    </table>
    <br />
  </div>
</div>
<div class="AccordionPanel">
  <div class="AccordionPanelTab">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="30" align="left"><img src="<?php echo "$local_icons"; ?>conf_pagina_contato-30.png" width="30" height="30"  title="  Personalize as informa&ccedil;&otilde;es da sua empresa "/></td>
        <td width="1021" align="left" class="txt-Indece">Formulario de emails</td>
      </tr>
    </table>
  </div>
  <div class="AccordionPanelContent">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr></tr>
      <tr>
        <td width="38%" bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Formulario de email:</div></td>
        <td width="20%" align="left" class="txt"><label>
          <input name="form_mail" type="text" class="txt-form" id="form_mail" tabindex="7" value="<?php echo $row_list_empresa['form_mail']; ?>" size="40" />
        </label></td>
        <td width="42%" class="txt"><span >Direciona para onde ir&aacute; o Formulario preenchido</span></td>
      </tr>
      <tr>
        <td bgcolor="#E7E6EB" class="txt-opcoes"><div align="left">Mensagem de resposta ao envio do formulario:</div></td>
        <td align="left" class="txt"><label>
          <input name="form_mensagem" type="text" class="txt-form" id="form_mensagem" value="<?php echo $row_list_empresa['form_mensagem']; ?>" size="40" />
        </label></td>
        <td class="txt">&nbsp;</td>
      </tr>
    </table>
  </div>
</div>
            </div></td>
          </tr>
      
    
        </table>
      </div></td>
    </tr>
    <tr>
      <td class="txt-Indece"><div align="center">
        <input name="Alterar" type="submit" class="txt-Botao-Alterar" id="Alterar" value="Alterar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="acao" />
</form>
<?php 
//envio de resposta do formulario
if ($_POST['res']=='res'){include "../sistema/res_alt.php";} 

mysql_free_result($list_empresa);
?>
<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
</script>
