<?php require_once('../Connections/connection.php'); ?>
<?php
include ("../sistema_funcoes/converte_datas.php");
include "../sistema_funcoes/converter_numero_moeda.php"; 

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


mysql_select_db($database_connection, $connection);
$query_list_parc_pgn = "SELECT * FROM vwnext_mod_empresa_financeiro_receita_parc WHERE id_receitas_parcelas = '".$_POST['content']."'";
$list_parc_pgn = mysql_query($query_list_parc_pgn, $connection) or die(mysql_error());
$row_list_parc_pgn = mysql_fetch_assoc($list_parc_pgn);
$totalRows_list_parc_pgn = mysql_num_rows($list_parc_pgn);


	mysql_select_db($database_connection, $connection);
$query_list_ulti_cobranca = "SELECT * FROM tbnext_mod_empresa_financeiro_receita_parcelas_cobr WHERE id_receitas_parcelas='".$_POST['content']."' ORDER BY id_parcs_cobranca DESC";
$list_ulti_cobranca = mysql_query($query_list_ulti_cobranca, $connection) or die(mysql_error());
$row_list_ulti_cobranca = mysql_fetch_assoc($list_ulti_cobranca);
$totalRows_list_ulti_cobranca = mysql_num_rows($list_ulti_cobranca);

?>

<style onload="divLoadMsn('.divLoadMsn','options_fin_conbra','Cobrança','#LoadOpcoes')"></style> 


<div class="divLoadMsn">

<script>
$(function(){

$('#parc_pgto').click(function(){

	var parc_pgto=$("#parc_pgto").is(":checked");
	//alert(parc_pgto)
if(parc_pgto== true){
	$('#data_pgto').removeAttr('disabled','');
	$('#data_pgto').select();
	$('#adicionarPgn').show(500);
	}else{
	$('#data_pgto').val('');
	$('#data_pgto').attr('disabled','disabled');
	$('#adicionarPgn').hide(500);
	}
	
});



	
$("#bt_enviarCobranca").click(function(){
	var id_receitas_parcelas=$('#id_receitas_parcelas').val();
	var clientes=$('#xNome_clientes').val();
	var data_vcto=$('#data_vcto').val();
	var parc_valor=$('#parc_valor').val();
	
	var xcomunicacao=$("#id_comunicacao option:selected").html();
	loadsData('#loadEnviar','../mod_empresa_financeiro_areceber/acao_comum_email.php','&id_receitas_parcelas='+id_receitas_parcelas+'&email='+xcomunicacao+'&clientes='+clientes+'&data_vcto='+data_vcto+'&parc_valor='+parc_valor);

});	


$('.bt_detalhes').click(function(){
	var bt_detalhes=$(this).val();
	  loadsDataSimples('#loadCabr','../mod_empresa_financeiro_areceber/load_cobranca_inf.php',bt_detalhes);
   });	
	
});	
</script>



      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td width="18%" class="txt-opcoes">Nº Contrato</td>
            <td width="33%" align="left" class="txt"><?php echo $row_list_parc_pgn['id_receita']; ?></td>
            <td width="18%" class="txt-opcoes">ID Parcela
              <input type="hidden" name="id_receitas_parcelas" id="id_receitas_parcelas" value="<?php echo $row_list_parc_pgn['id_receitas_parcelas']; ?>">
              <input type="hidden" name="xNome_clientes" id="xNome_clientes" value="<?php echo $row_list_parc_pgn['xNome_clientes']; ?>">
              <input type="hidden" name="data_vcto" id="data_vcto" value="<?php echo converte_data($row_list_parc_pgn['data_vcto']); ?>">
              <input type="hidden" name="parc_valor" id="parc_valor" value="<?php echo $row_list_parc_pgn['parc_valor']; ?>">
            </td>
            <td width="31%" align="left" class="txt"><?php echo $row_list_parc_pgn['id_receitas_parcelas']; ?></td>
          </tr>
          <tr>
            <td class="txt-opcoes">Data Vcto</td>
            <td align="left" class="txt"><?php echo converte_data($row_list_parc_pgn['data_vcto']); ?></td>
            <td class="txt-opcoes">Valor</td>
            <td align="left" class="txt"><?php echo converter_numero_moeda($row_list_parc_pgn['parc_valor']); ?></td>
          </tr>
          <tr>
            <td class="txt-opcoes">Cliente</td>
            <td colspan="3" align="left" class="txt"><?php $id_clientes= $row_list_parc_pgn['id_clientes']; ?><?php echo $row_list_parc_pgn['xNome_clientes']; ?></td>
            </tr>
          <tr>
            <td class="txt-opcoes">Cobrança nº</td>
            <td colspan="2" align="left" class="txt"><?php echo $row_list_ulti_cobranca['cobr_n']; ?></td>
            <td align="left" class="txt">
            <button class="bt_detalhes btn btn-default" title=" DETALHES " value="<?php echo $row_list_parc_pgn['id_receitas_parcelas']; ?>" type="button"> <i class="fa fa-file-text-o"></i> Informações de Cobrança</button>
            
            </td>
          </tr>
          <tr>
            <td class="txt-opcoes">E-mail</td>
            <td colspan="2" align="left" class="txt"><?php include ("../mod_empresa_clientes/include_select_email.php");?></td>
            <td align="left" class="txt"><button title="Enviar" id="bt_enviarCobranca" type="button" class="btn btn-default"> <i class="fa fa-envelope"></i> ENVIAR COBRANÇA </button></td>
          </tr>
          <tr>
            <td colspan="4" align="center" class="txt">&nbsp;<div id="loadEnviar"></div></td>
            </tr>
        </tbody>
      </table>

      <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
		<center>
    	<button title=" FECHAR "  onclick="loadsDataClear('#LoadOpcoes')" class="btn btn-default"  type="button"><i class="fa fa-close"></i> FECHAR </button>
  		</center>
      </div>
    </div>
<span id="loadCabr"></span>
</div>
<?php
mysql_free_result($list_parc_pgn);
?>
