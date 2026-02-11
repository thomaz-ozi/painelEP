<?php require_once('../Connections/connection.php'); ?>
 <?php
 include ("../sistema_funcoes/maiuscola_minuscola.php");
  ?>
  
 <?php $_POST['razao_social']=convertem(strtoupper($_POST['razao_social']), 1);?>
<?php $_POST['fantasia']=convertem(strtoupper ($_POST['fantasia']), 1);?>
<?php $_POST['responsavel']=convertem(strtoupper ($_POST['responsavel']), 1);?>
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
  $updateSQL = sprintf("UPDATE tbnext_mod_empresa_local SET razao_social=%s, fantasia=%s, endereco=%s, cidade=%s, estado=%s, fone1=%s, fone2=%s, email1=%s, ramal1=%s, ramal2=%s, bairro=%s, cep=%s, complemento=%s, cnpj=%s WHERE id_local=%s",
                       GetSQLValueString($_POST['razao_social'], "text"),
                       GetSQLValueString($_POST['fantasia'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['cidade'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['fone1'], "text"),
                       GetSQLValueString($_POST['fone2'], "text"),
                       GetSQLValueString($_POST['email1'], "text"),
                       GetSQLValueString($_POST['ramal1'], "text"),
                       GetSQLValueString($_POST['ramal2'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['cep'], "text"),
                       GetSQLValueString($_POST['complemento'], "text"),
                       GetSQLValueString($_POST['cnpj'], "text"),
                       GetSQLValueString($_POST['id_local'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_local'])) {
  $colname_list_acao = $_GET['id_local'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_empresa_local WHERE id_local = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>

<?php 
$acao_comum="Alterar";
$acao_icons="alt-30.png";
include ("../sistema/index_content_head.php");?>
<script src="../jQueryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../jQueryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">




<form action="<?php echo $editFormAction; ?>" method="POST" name="acao" id="acao">



<div class="tabs">
	<ul>
		<li><a href="#tabs-1">Dados Cadastrais</a></li>
        <li><a href="#tabs-2">Endereço</a></li>
        <li><a href="#tabs-3">Comunicação</a></li>
        <li><a href="#tabs-4">Descrição</a></li>
	</ul>
	<div id="tabs-1">    
	  <table width="99%" border="0" cellspacing="1" cellpadding="0">
	      <tr>
	      <td width="26%" align="left" class="txt-opcoes">Empresa
	        *
	        <input name="id_local" type="hidden" id="id_local" value="<?php echo $row_list_acao['id_local']; ?>" />
	        <input name="res" type="hidden" id="res" value="res" /></td>
	      <td width="74%" align="left" class="txt"><span id="sprytextfield2">
	        
	          <input name="razao_social" type="text" class="form-control" id="razao_social"  tabindex="1" value="<?php echo $row_list_acao['razao_social']; ?>" />
            
	        </span></td>
</tr>
        <tr>
          <td align="left" class="txt-opcoes">N Fantasia</td>
          <td align="left" class="txt"><span id="sprytextfield5">
             <input name="fantasia" type="text" class="form-control" id="fantasia" value="<?php echo $row_list_acao['fantasia']; ?>"  />
          </span></td>
</tr>
        <tr>
          <td align="left" class="txt-opcoes">CNPJ *</td>
          <td align="left" class="txt"><span id="sprytextfield3">
            
              <input name="cnpj" type="text" class="mask_cnpj" id="cnpj" tabindex="2" value="<?php echo $row_list_acao['cnpj']; ?>" />
            
          </span></td>
</tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left" >&nbsp;</td>
        </tr>
      </table>
	</div> 
	
    <div id="tabs-2">    
      <table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td align="left" class="txt-opcoes">CEP</td>
          <td align="left" class="txt"><input name="cep" type="text" class="mask_cep" id="cep" tabindex="18" value="<?php echo $row_list_acao['cep']; ?>" size="40" /></td>
        </tr>
        <tr>
          <td width="24%" align="left" class="txt-opcoes">Endereço</td>
          <td width="76%" align="left" class="txt"><input name="endereco" type="text" class="form-control" id="endereco"  tabindex="14" value="<?php echo $row_list_acao['endereco']; ?>" size="40"/></td>
        </tr>
        <tr>
          <td align="left" class="txt-opcoes">Bairro</td>
          <td align="left" class="txt"><input name="bairro" type="text" class="form-control" id="bairro"  tabindex="15" value="<?php echo $row_list_acao['bairro']; ?>" size="40"/></td>
        </tr>
        <tr>
          <td align="left" class="txt-opcoes">Cidade</td>
          <td align="left" class="txt"><input name="cidade" type="text" class="form-control" id="cidade" tabindex="16" value="<?php echo $row_list_acao['cidade']; ?>" size="40" /></td>
        </tr>
        <tr>
          <td align="left" class="txt-opcoes">Estado</td>
          <td align="left" class="txt"><select name="estado" class="form-control" tabindex="17" id="estado">
            <option selected="selected" value="" <?php if (!(strcmp("", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>==&nbsp;&nbsp;&nbsp;&nbsp;</option>
            <option value="AC" <?php if (!(strcmp("AC", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>AC</option>
            <option value="AL" <?php if (!(strcmp("AL", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>AL</option>
            <option value="AM" <?php if (!(strcmp("AM", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>AM</option>
            <option value="AP" <?php if (!(strcmp("AP", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>AP</option>
            <option value="BA" <?php if (!(strcmp("BA", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>BA</option>
            <option value="CE" <?php if (!(strcmp("CE", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>CE</option>
            <option value="DF" <?php if (!(strcmp("DF", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>DF</option>
            <option value="ES" <?php if (!(strcmp("ES", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>ES</option>
            <option value="GO" <?php if (!(strcmp("GO", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>GO</option>
            <option value="MA" <?php if (!(strcmp("MA", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>MA</option>
            <option value="MG" <?php if (!(strcmp("MG", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>MG</option>
            <option value="MS" <?php if (!(strcmp("MS", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>MS</option>
            <option value="MT" <?php if (!(strcmp("MT", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>MT</option>
            <option value="PA" <?php if (!(strcmp("PA", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>PA</option>
            <option value="PB" <?php if (!(strcmp("PB", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>PB</option>
            <option value="RJ" <?php if (!(strcmp("RJ", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>RJ</option>
            <option value="RN" <?php if (!(strcmp("RN", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>RN</option>
            <option value="RO" <?php if (!(strcmp("RO", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>RO</option>
            <option value="RR" <?php if (!(strcmp("RR", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>RR</option>
            <option value="RS" <?php if (!(strcmp("RS", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>RS</option>
            <option value="SC" <?php if (!(strcmp("SC", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>SC</option>
            <option value="SE" <?php if (!(strcmp("SE", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>SE</option>
            <option value="SP" <?php if (!(strcmp("SP", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>SP</option>
            <option value="TO" <?php if (!(strcmp("TO", $row_list_acao['estado']))) {echo "selected=\"selected\"";} ?>>TO</option>
          </select></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </div>
    
    <div id="tabs-3">    
      <table width="99%" border="0" cellpadding="0" cellspacing="1">
        <tr class="texto">
          <td align="left"  class="txt-opcoes">Celular</td>
          <td align="left" class="txt"><input name="fone1" type="text" class="mask_cel" id="fone4" tabindex="10" value="<?php echo $row_list_acao['fone1']; ?>" size="40" /></td>
        </tr>
        <tr class="texto">
          <td align="left"  class="txt-opcoes">Fone</td>
          <td align="left" class="txt"><input name="fone2" type="text" class="mask_fone" id="fone2" tabindex="12" value="<?php echo $row_list_acao['fone2']; ?>" size="40" /></td>
        </tr>
        <tr class="texto">
          <td align="left"  class="txt-opcoes">Rama2</td>
          <td align="left" class="txt"><input name="ramal2" type="text" class="form-control" id="ramal2" tabindex="13" value="<?php echo $row_list_acao['ramal2']; ?>" size="40" /></td>
        </tr>
        <tr class="texto">
          <td align="left"  class="txt-opcoes">Email</td>
          <td align="left" class="txt"><input name="email1" type="email" class="form-control-Minusculos" id="email1" tabindex="20" value="<?php echo $row_list_acao['email']; ?>" size="40" /></td>
        </tr>
        <tr class="texto">
          <td colspan="2" align="left" class="txt">&nbsp;</td>
        </tr>
      </table>
    </div>
    
    <div id="tabs-4">    TESTE 04    
      <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td colspan="2" align="left"><textarea name="complemento" id="complemento" type="text" style=" width:300px;" > <?php echo $row_list_acao['complemento']; ?></textarea>
            <script>
    CKEDITOR.replace( 'complemento', {
    toolbar :'clear'
    });
            </script></td>
        </tr>
      </table>
    </div>
</div>




<table width="100%" border="0" cellpadding="0" cellspacing="1" class="texto">
          <tr>
            <td width="361" valign="top"><table width="99%" border="0" cellspacing="1" cellpadding="0">
              <tr>              </tr>
              <tr>                </tr>
              <tr>                </tr>
            </table></td>
            <td width="396" valign="top">&nbsp;</td>
          </tr>
          </table>
          <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
      </div>
    </div>
<input type="hidden" name="MM_update" value="acao" />
</form>
<?php 
// data de construcao 24/09/2009 - 20:32
//envio de resposta do formulario
$list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "res_alt.php";
}

?>
<?php
mysql_free_result($list_acao);
?>
<script type="text/javascript">
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
</script>
