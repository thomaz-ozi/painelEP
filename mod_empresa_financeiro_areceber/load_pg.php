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
?>

<style onload="divLoadMsn('.divLoadMsn','options_fin_pg','Opção de Pago','#LoadOpcoes')"></style> 


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



$(".mask_date").mask("99/99/9999");

$(".form-datepicker").datepicker({
		buttonImageOnly: true,
 		dateFormat: 'dd/mm/yy',
   		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
   		dayNamesMin: ['dom','seg','ter','qua','qui','sex','sab','dom'],
   		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
   		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
   		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
   		nextText: 'Próximo',
   		prevText: 'Anterior',
   		closeText : "Fechar",
   		currentText : "Hoje"
  });
	
$("#adicionarPgn").click(function(){
	
	var id_receitas_parcelas=$('#id_receitas_parcelas').val();
	var parc_pgto=$('#parc_pgto').val();
	var data_pgto=$('#data_pgto').val();
	var MM_update=$('#MM_update').val();
	alert(parc_pgto);
	if(parc_pgto=='1'){
	loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_pgn.php','&id_receitas_parcelas='+id_receitas_parcelas+'&parc_pgto='+parc_pgto+'&data_pgto='+data_pgto+'&MM_update='+MM_update);
	}
});		
	
});	
</script>



      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td width="18%" class="txt-opcoes">Nº Contrato</td>
            <td width="33%" align="left" class="txt"><?php echo $row_list_parc_pgn['id_receita']; ?></td>
            <td width="18%" class="txt-opcoes">ID Parcela</td>
            <td width="31%" align="left" class="txt"><?php echo $row_list_parc_pgn['id_receitas_parcelas']; ?></td>
          </tr>
          <tr>
            <td class="txt-opcoes">Cliente</td>
            <td align="left" class="txt"><?php echo $row_list_parc_pgn['xNome_clientes']; ?></td>
            <td class="txt">&nbsp;</td>
            <td align="left" class="txt">&nbsp;</td>
            </tr>
          <tr>
            <td class="txt-opcoes">Data Vcto</td>
            <td align="left" class="txt"><?php echo converte_data($row_list_parc_pgn['data_vcto']); ?></td>
            <td class="txt-opcoes">Data Pgto</td>
            <td align="left"><span><?php echo converte_data($row_list_parc_pgn['data_pgto']); ?></span></td>
          </tr>
          <tr>
            <td class="txt-opcoes">Valor</td>
            <td align="left" class="txt"><?php echo converter_numero_moeda($row_list_parc_pgn['parc_valor']); ?></td>
            <td class="txt-opcoes">Forma Pgto</td>
            <td align="left"><?php echo $row_list_parc_pgn['xNome_forma_pgto']; ?></td>
          </tr>
        </tbody>
      </table>
<div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default"  onclick="loadsDataClear('#LoadOpcoes')"><i class="fa fa-times"></i> FECHAR</button>
        
      </div>
    </div>

</div>
<?php
mysql_free_result($list_parc_pgn);
?>
