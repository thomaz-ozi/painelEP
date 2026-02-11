<?php require_once('../Connections/connection.php'); ?>
<?php
	include "../sistema_funcoes/converte_datas.php";
	include "../sistema_funcoes/converter_numero_moeda.php"; 
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
  $updateSQL = sprintf("UPDATE tbnext_mod_empresa_financeiro_receita_parcelas SET ativado=%s, ativado_descricao=%s WHERE id_receitas_parcelas=%s",
                       GetSQLValueString(2, "int"),
                       GetSQLValueString($_POST['ativado_descricao'], "text"),
                       GetSQLValueString($_POST['id_receitas_parcelas'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}



$colname_list_acao = "-1";
if (isset($_GET['id_receitas_parcelas'])) {
  $colname_list_acao = $_GET['id_receitas_parcelas'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM vwnext_mod_empresa_financeiro_receita_parc_rec WHERE id_receitas_parcelas = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

mysql_select_db($database_connection, $connection);
$query_list_forma_pgto = "SELECT * FROM tbnext_mod_empresa_financeiro_form_pgto";
$list_forma_pgto = mysql_query($query_list_forma_pgto, $connection) or die(mysql_error());
$row_list_forma_pgto = mysql_fetch_assoc($list_forma_pgto);
$totalRows_list_forma_pgto = mysql_num_rows($list_forma_pgto);


?>
<script src="../jQueryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../jQueryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<form action="<?php echo $editFormAction; ?>" name="acao" method="POST">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="3" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td  align="center"><img src="<?php echo "$local_icons"; ?>cancelar-30.png" width="30" height="30" /></td>
          <td align="left">Cancelar</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="top">
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="15%" align="left"  class="txt-opcoes">Nº Contato
              <input name="id_receitas_parcelas" type="hidden" id="id_receitas_parcelas" value="<?php echo $row_list_acao['id_receitas_parcelas']; ?>" />
              <input name="res" type="hidden" id="res" value="res" />
              <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>" /></td>
            <td width="25%" align="left"  class="txt"><span id="sprytextfield3"><span class="textfieldRequiredMsg">Campo Obrigat&oacute;rio</span></span><?php echo $row_list_acao['id_receita']; ?></td>
            <td width="15%" align="left"  class="txt-opcoes">ID Parcela</td>
            <td width="45%" align="left"  class="txt"><?php echo $row_list_acao['id_receitas_parcelas']; ?></td>
          </tr>
          <tr>
            <td align="left"  class="txt-opcoes">Cliente</td>
            <td colspan="3" align="left"  class="txt"><?php echo $row_list_acao['xNome_clientes']; ?></td>
          </tr>
          <tr>
            <td align="left"  class="txt-opcoes">Data Vcto</td>
            <td align="left"  class="txt"><input name="data_vcto" type="text" disabled class="form-datepicker mask_date" id="data_vcto" value="<?php echo converte_data($row_list_acao['data_vcto']); ?> ">
            </td>
            <td align="left"  class="txt-opcoes">Pago</td>
            <td align="left"  class="txt"><?php if($row_list_acao['parc_pgto']==1){echo "Pago";}else{echo "Não Pago";} ?></td>
          </tr>
          <tr>
            <td align="left"  class="txt-opcoes">Valor</td>
            <td align="left"  class="txt"><?php echo converter_numero_moeda($row_list_acao['parc_valor']); ?></td>
            <td align="left"  class="txt-opcoes">Data Pgto</td>
            <td align="left"  class="txt"><?php if(converte_data($row_list_acao['parc_pgto'])==1){  echo $row_list_acao['data_pgto'];}else{echo "é necessario ter sido pago";} ?></td>
          </tr>
          <tr>
            <td align="left"  class="txt-opcoes">&nbsp;</td>
            <td align="left"  class="txt">&nbsp;</td>
            <td align="left"  class="txt-opcoes">Forma de Pgto</td>
            <td align="left"  class="txt"><?php if($row_list_acao['parc_pgto']==1){ ?><select name="id_form_pgto" id="id_form_pgto">
              <option value=" " <?php if (!(strcmp(" ", $row_list_acao['id_form_pgto']))) {echo "selected=\"selected\"";} ?>>---</option>
              <?php
do {  
?>
              <option value="<?php echo $row_list_forma_pgto['id_form_pgto']?>"<?php if (!(strcmp($row_list_forma_pgto['id_form_pgto'], $row_list_acao['id_form_pgto']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_forma_pgto['xNome']?></option>
              <?php
} while ($row_list_forma_pgto = mysql_fetch_assoc($list_forma_pgto));
  $rows = mysql_num_rows($list_forma_pgto);
  if($rows > 0) {
      mysql_data_seek($list_forma_pgto, 0);
	  $row_list_forma_pgto = mysql_fetch_assoc($list_forma_pgto);
  }
?>
            </select><?php }else{echo "é necessario ter sido pago";} ?></td>
          </tr>
          <tr>
            <td colspan="4" align="center"  class="txt-opcoes">Descri&ccedil;&atilde;o - Motivo da Alteração</td>
          </tr>
          <tr>
            <td colspan="4" align="center"  class="txt">
            
              <textarea name="ativado_descricao" cols="90" rows="3" required class="txt-form" id="ativado_descricao"><?php echo $row_list_acao['ativado_descricao']; ?></textarea>
  
  <script>
    CKEDITOR.replace( 'ativado_descricao', {
    toolbar :'basic'
    });
    </script>
            
            
            </td>
          </tr>
        </table>
</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt-Indece">
        <input name="voltar" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="voltar" value="|&lt; Voltar" />
        <input name="Cancelar" type="submit" class="txt-Botao-Alterar" id="Cancelar" value="Cancelar">
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="acao" />
  <input type="hidden" name="MM_insert" value="acao">
</form>
<?php 
if ($_POST['res']==res){	include "res_alt.php";}


mysql_free_result($list_acao);

mysql_free_result($list_forma_pgto);



?>
<script type="text/javascript">
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
