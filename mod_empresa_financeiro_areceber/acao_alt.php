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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_financeiro_receita_parcelas (id_usuario,  id_receita, id_form_pgto, parc_valor, data_vcto, ativado) VALUES (%s,  %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_usuario'], "int"),
					   GetSQLValueString($_POST['id_receita'], "int"),
                       GetSQLValueString($_POST['id_form_pgto'], "int"),
					   GetSQLValueString(converter_numero_moeda($_POST['parc_valor']), "int"),
                       GetSQLValueString(converte_data($_POST['data_vcto']), "date"),
                       GetSQLValueString(1, "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  
$SQL_Select="SELECT * FROM vwnext_mod_empresa_financeiro_receita_parc ORDER BY id_receitas_parcelas DESC";

}else{

$SQL_Select="SELECT * FROM vwnext_mod_empresa_financeiro_receita_parc WHERE id_receitas_parcelas = %s";

}
$colname_list_acao = "-1";
if (isset($_GET['id_receitas_parcelas'])) {
  $colname_list_acao = $_GET['id_receitas_parcelas'];

mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf($SQL_Select, GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
}
mysql_select_db($database_connection, $connection);
$query_list_forma_pgto = "SELECT * FROM tbnext_mod_empresa_financeiro_form_pgto";
$list_forma_pgto = mysql_query($query_list_forma_pgto, $connection) or die(mysql_error());
$row_list_forma_pgto = mysql_fetch_assoc($list_forma_pgto);
$totalRows_list_forma_pgto = mysql_num_rows($list_forma_pgto);


?>
<script>
$(function(){
$('.bt_pgn').click(function(){
	var bt_pgn=$(this).val();
	  loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_pgn_alt.php',bt_pgn);
   });   
 $('.bt_pg').click(function(){
	var bt_pg=$(this).val();
	  loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_pg.php',bt_pg);
   });   
$('.bt_can').click(function(){
	var bt_can=$(this).val();
	  loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_cobranca.php',bt_can);
   });   
});



</script>
<form action="<?php echo $editFormAction; ?>" name="acao" method="POST">
<?php 
$acao_comum="Alterar";
$acao_icons="alt-30.png";
include ("../sistema/index_content_head.php");?>

  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    
    <tr>
      <td colspan="3" align="center" valign="top">
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="15%" align="left"  class="txt-opcoes">Nº Contato
              <input name="id_receitas_parcelas" type="hidden" id="id_receitas_parcelas" value="<?php echo $row_list_acao['id_receitas_parcelas']; ?>" />
              <input name="id_receita" type="hidden" id="id_receita" value="<?php echo $row_list_acao['id_receita']; ?>" />
              <input name="res" type="hidden" id="res" value="res" />
              <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>" /></td>
            <td width="25%" align="left"  class="txt"><?php echo $row_list_acao['id_receita']; ?></td>
            <td width="15%" align="left"  class="txt-opcoes">ID Parcela</td>
            <td width="45%" align="left"  class="txt"><?php echo $row_list_acao['id_receitas_parcelas']; ?></td>
          </tr>
          <tr>
            <td align="left"  class="txt-opcoes">Cliente</td>
            <td colspan="3" align="left"  class="txt"><?php echo $row_list_acao['xNome_clientes']; ?></td>
          </tr>
          <tr>
            <td align="left"  class="txt-opcoes">Data Vcto</td>
            <td align="left"  class="txt"><input name="data_vcto" type="date" class="form-datepicker mask_date" required id="data_vcto" value="<?php echo converte_data($row_list_acao['data_vcto']); ?> ">
            </td>
            <td align="left"  class="txt-opcoes">Pago</td>
            <td align="left"  class="txt" id="LoadCondPgtoStatus">
            <?php 
	  if($row_list_acao['parc_pgto']==1){
	  	echo '<button class="options_fin_pg bt_pg" title=" PAGO " value="'.$row_list_acao['id_receitas_parcelas'].'" type="button" > </button>';
	  }else{
		echo '<button class="options_fin_pgn bt_pgn" title=" NÃO PAGO "  value="'.$row_list_acao['id_receitas_parcelas'].'"  type="button"> </button>';
		echo '<button class="options_fin_conbra bt_can" title=" COBRANÇA "  value="'.$row_list_acao['id_receitas_parcelas'].'"  type="button"> </button>';

	  }
	  
	  ?>
            </td>
          </tr>
          <tr>
            <td align="left"  class="txt-opcoes">Valor</td>
            <td align="left"  class="txt"><input name="parc_valor" type="text"  class="msk_money_br" required id="parc_valor" value="<?php echo converter_numero_moeda($row_list_acao['parc_valor']); ?>" ></td>
            <td align="left"  class="txt-opcoes">Data Pgto</td>
            <td align="left"  class="txt"><?php echo converte_data($row_list_acao['data_pgto']); ?></td>
          </tr>
          <tr>
            <td align="left"  class="txt-opcoes">&nbsp;</td>
            <td align="left"  class="txt">&nbsp;</td>
            <td align="left"  class="txt-opcoes">Forma de Pgto</td>
            <td align="left"  class="txt"><?php echo $row_list_acao['xNome_forma_pgto']; ?></td>
          </tr>
          <tr>
            <td colspan="4" align="center"  class="txt-opcoes">Descri&ccedil;&atilde;o - Motivo da Alteração</td>
          </tr>
          <tr>
            <td colspan="4" align="center"  class="txt">

 
            
            
            <span id="sprytextarea1">
            <span class="textareaRequiredMsg">&nbsp;&nbsp;Descreva a alteração que fez&nbsp;&nbsp;</span>
            <textarea name="ativado_descricao" id="ativado_descricao" cols="45" rows="5"></textarea>
            </span>
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
 </table>
  <input type="hidden" name="MM_update" value="acao" />
  <input type="hidden" name="MM_insert" value="acao">
  
  <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
      </div>
    </div>
</form>
<div id="LoadOpcoes"></div>
<?php 
if ($_POST['res']==res){	include "res_alt.php";}


mysql_free_result($list_acao);

mysql_free_result($list_forma_pgto);



?>

<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
</script>
