<?php require_once('../Connections/connection.php'); ?>

 <?php 	if($row_perfusuario['id_usuario']==0){?>

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_local (id_local, razao_social, fantasia, endereco, cidade, estado, fone1, fone2, email1, ramal1, ramal2, bairro, cep, complemento, cnpj) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_local'], "int"),
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
                       GetSQLValueString($_POST['cnpj'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}?>
&nbsp;<script src="script_endereco.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<form action="<?php echo $editFormAction; ?>" method="POST" name="acao" id="acao">
<table width="98%" border="0" cellpadding="0" cellspacing="1" class="texto">
          <tr>
            <td colspan="2" align="center" class="txt-Indece"><table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
                <td  align="left">&nbsp;&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;</td>
                <td ><img src="<?php echo "$local_icons"; ?>add-30.png" width="30" height="30" /></td>
                <td  align="left">&nbsp;&nbsp;&nbsp;Adicionar</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="361" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr class="texto">
                  <td colspan="2" bgcolor="#FFFFFF" class="txt-Indece"><div align="center" class="txt-Indece">DADOS CADASTRAIS</div></td>
                </tr>
                <tr>
                  <td width="26%" align="left" class="txt-opcoes">Razão Social
                    <input type="hidden" name="id_local" id="id_local" />
                  <input name="res" type="hidden" id="res" value="res" /></td>
                  <td width="74%" align="left" class="txt"><span id="sprytextfield2">
                  <label>
                    <input name="razao_social" type="text" class="txt-form" id="razao_social"  tabindex="1" />
                    </label>
                  </span></td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">N Fantasia</td>
                  <td align="left" class="txt"><span id="sprytextfield5">
                    <label for="fantasia"></label>
                    <input type="text" name="fantasia" id="fantasia" class="txt-form"  />
                  </span></td>
                </tr>

                <tr>
                  <td align="left" class="txt-opcoes">CNPJ </td>
                  <td align="left" class="txt"><span id="sprytextfield3">
                  <label>
                    <input name="cnpj" type="text" class="mask_cnpj" id="cnpj" tabindex="2" />
                    </label>
                  </span></td>
                </tr>
                <tr>
                  <td align="left">&nbsp;</td>
                  <td align="left" >&nbsp;</td>
                </tr>
                <tr align="left">
                  <td colspan="2" class="txt-opcoes"><div align="center" class="txt-Indece">COMUNI&Ccedil;&Atilde;O </div></td>
                </tr>
                <tr class="texto">
                  <td align="left" bgcolor="#E7E6EB" class="txt-opcoes">Fone</td>
                  <td align="left" class="txt"><input name="fone1" type="text" class="txt-form" tabindex="10" id="fone4" size="40" /></td>
                </tr>
                <tr class="texto">
                  <td align="left" bgcolor="#E7E6EB" class="txt-opcoes">Ramal</td>
                  <td align="left" class="txt"><input name="ramal1" tabindex="11" type="text" class="txt-form" id="ramal4" size="40" /></td>
                </tr>
                <tr class="texto">
                  <td align="left" bgcolor="#E7E6EB" class="txt-opcoes">Fone2</td>
                  <td align="left" class="txt"><input name="fone2" type="text" class="txt-form" tabindex="12" id="fone2" size="40" /></td>
                </tr>
                <tr class="texto">
                  <td align="left" bgcolor="#E7E6EB" class="txt-opcoes">Rama2</td>
                  <td align="left" class="txt"><input name="ramal2" type="text" class="txt-form" id="ramal2" tabindex="13" size="40" /></td>
                </tr>
                <tr class="texto">
                  <td colspan="2" align="left" class="txt">&nbsp;</td>
                </tr>
            </table></td>
            <td width="396" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td colspan="2" class="txt-Indece"><div align="center">ENDERE&Ccedil;O</div></td>
                </tr>
                <tr>
                  <td width="24%" align="left" class="txt-opcoes">CEP</td>
                  <td width="76%" align="left" class="txt"><input name="end_CEP" type="text"  id="end_CEP"   class="mask_cep" style="width:100px;" /></td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Bairro</td>
                  <td align="left" class="txt"><input name="bairro" type="text" class="txt-form" id="bairro"  tabindex="15" size="40"/></td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Cidade</td>
                  <td align="left" class="txt"><input name="cidade" type="text" class="txt-form" id="cidade" tabindex="16" size="40" />                  </td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Estado</td>
                  <td align="left" class="txt"><select name="estado" class="txt-form" tabindex="17" id="estado">
                    <option selected="selected" value="" <?php if (!(strcmp("", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>==&nbsp;&nbsp;&nbsp;&nbsp;</option>
                    <option value="AC" <?php if (!(strcmp("AC", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>AC</option>
                    <option value="AL" <?php if (!(strcmp("AL", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>AL</option>
                    <option value="AM" <?php if (!(strcmp("AM", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>AM</option>
<option value="AP" <?php if (!(strcmp("AP", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>AP</option>
                    <option value="BA" <?php if (!(strcmp("BA", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>BA</option>
                    <option value="CE" <?php if (!(strcmp("CE", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>CE</option>
                    <option value="DF" <?php if (!(strcmp("DF", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>DF</option>
                    <option value="ES" <?php if (!(strcmp("ES", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>ES</option>
                    <option value="GO" <?php if (!(strcmp("GO", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>GO</option>
                    <option value="MA" <?php if (!(strcmp("MA", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>MA</option>
                    <option value="MG" <?php if (!(strcmp("MG", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>MG</option>
                    <option value="MS" <?php if (!(strcmp("MS", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>MS</option>
<option value="MT" <?php if (!(strcmp("MT", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>MT</option>
                    <option value="PA" <?php if (!(strcmp("PA", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>PA</option>
                    <option value="PB" <?php if (!(strcmp("PB", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>PB</option>
                    <option value="RJ" <?php if (!(strcmp("RJ", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>RJ</option>
                    <option value="RN" <?php if (!(strcmp("RN", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>RN</option>
                    <option value="RO" <?php if (!(strcmp("RO", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>RO</option>
                    <option value="RR" <?php if (!(strcmp("RR", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>RR</option>
                    <option value="RS" <?php if (!(strcmp("RS", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>RS</option>
                    <option value="SC" <?php if (!(strcmp("SC", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>SC</option>
<option value="SE" <?php if (!(strcmp("SE", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>SE</option>
                    <option value="SP" <?php if (!(strcmp("SP", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>SP</option>
<option value="TO" <?php if (!(strcmp("TO", $row_list_alt['estado']))) {echo "selected=\"selected\"";} ?>>TO</option>
                  </select></td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">CEP</td>
                  <td align="left" class="txt"><input name="cep" type="text" class="txt-form" id="cep" tabindex="18" size="40" />                  </td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Complemento</td>
                  <td align="left" class="txt"><input name="complemento" type="text" class="txt-form" id="complemento" tabindex="19" size="40" />                  </td>
                </tr>
                <tr>
                  <td align="left">&nbsp;</td>
                  <td align="left" >&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" class="txt-Indece"><div align="center">INTERNET</div></td>
                </tr>
                <tr class="texto">
                  <td align="left" bgcolor="#E7E6EB" class="txt-opcoes">Email </td>
                  <td align="left" class="txt"><input name="email1" type="text" class="txt-form-Minusculos" tabindex="20" id="email1" size="40" /></td>
                </tr>


            </table></td>
          </tr>

          <tr>
            <td colspan="2" align="center" valign="top"class="txt-Indece">
                <input name="Alterar2" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar2" value="|&lt; Voltar" />
                <input name="adicionar" type="submit" class="txt-Botao-ADD" id="adicionar" value="Adicionar" />
            </td>
          </tr>
  </table>
<input type="hidden" name="MM_insert" value="acao" />
</form>
<?php 
// data de construcao 24/09/2009 - 20:32
//envio de resposta do formulario
$list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "res_add.php";
}
 }else { include "../sistema/sem_permissao.php"; }
?>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
//-->
</script>
