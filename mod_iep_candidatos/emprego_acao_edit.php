<?php require_once('../Connections/connection.php'); ?>
<?php require_once ("../sistema_funcoes/converter_utf8.php"); require_once ("../sistema_funcoes/converte_datas.php");?>
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

$maxRows_list_acao_edit_emprego = 10;
$pageNum_list_acao_edit_emprego = 0;
if (isset($_GET['pageNum_list_acao_edit_emprego'])) {
  $pageNum_list_acao_edit_emprego = $_GET['pageNum_list_acao_edit_emprego'];
}
$startRow_list_acao_edit_emprego = $pageNum_list_acao_edit_emprego * $maxRows_list_acao_edit_emprego;

$colname_list_acao_edit_emprego = "-1";
if (isset($_GET['Codigo'])) {
  $colname_list_acao_edit_emprego = $_GET['Codigo'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao_edit_emprego = sprintf("SELECT * FROM tbMod_canditadosEmprego WHERE Codigo = %s ORDER BY EmpregoDataEntreda DESC", GetSQLValueString($colname_list_acao_edit_emprego, "int"));
$query_limit_list_acao_edit_emprego = sprintf("%s LIMIT %d, %d", $query_list_acao_edit_emprego, $startRow_list_acao_edit_emprego, $maxRows_list_acao_edit_emprego);
$list_acao_edit_emprego = mysql_query($query_limit_list_acao_edit_emprego, $connection) or die(mysql_error());
$row_list_acao_edit_emprego = mysql_fetch_assoc($list_acao_edit_emprego);

if (isset($_GET['totalRows_list_acao_edit_emprego'])) {
  $totalRows_list_acao_edit_emprego = $_GET['totalRows_list_acao_edit_emprego'];
} else {
  $all_list_acao_edit_emprego = mysql_query($query_list_acao_edit_emprego);
  $totalRows_list_acao_edit_emprego = mysql_num_rows($all_list_acao_edit_emprego);
}
$totalPages_list_acao_edit_emprego = ceil($totalRows_list_acao_edit_emprego/$maxRows_list_acao_edit_emprego)-1;
?>

<script src="../sistema_funcoes/jq_mascaras.js"></script>
<script>



$(function(){
	$(".mask_date_ma").mask("99/99/9999");

	});
	

</script>

<script>

var n_ln='1';
function addtableEmpresa(){
			//adicionar valor do form na linha	
			var loadEmprego_empresa = $('#loadEmprego_empresa').val();
			var loadEmprego_cargo = $('#loadEmprego_cargo').val();
			var loadEmprego_motivo = $('#loadEmprego_motivo').val();
			var loadEmprego_cidade = $('#loadEmprego_cidade').val();
			var loadEmprego_data_entrada = $('#loadEmprego_data_entrada').val();
			var loadEmprego_data_saida = $('#loadEmprego_data_saida').val();
			
		
			
			/*capsular dados*/
			var f= '<input name="EmpregoEmpresa_insert[]" type="hidden"  value="'+loadEmprego_empresa+'">';
			f+= '<input name="EmpregoCargo_insert[]" type="hidden" value="'+loadEmprego_cargo+'">';
			f+= '<input name="EmpregoMotivoSaida_insert[]" type="hidden" value="'+loadEmprego_motivo+'">';
			f+= '<input name="EmpregoCidade_insert[]" type="hidden" value="'+loadEmprego_cidade+'">';
			f+= '<input name="EmpregoDataEntreda_insert[]" type="hidden" value="'+loadEmprego_data_entrada+'">';
			f+= '<input name="EmpregoDataSaida_insert[]" type="hidden" value="'+loadEmprego_data_saida+'">';
			
		var	t ='  <tr  id="trEmprego'+n_ln+'" class="PrintTexto" scope="row">';
    		t += '<td align="left">'+f+'&nbsp;'+loadEmprego_empresa+'</td>';
			t += '<td align="left">&nbsp;'+loadEmprego_cargo+'</td>';
			t += '<td align="left">&nbsp;'+loadEmprego_motivo+'</td>';
			t += '<td align="left">&nbsp;'+loadEmprego_cidade+'</td>';
			t += '<td align="left">&nbsp;'+loadEmprego_data_entrada+'</td>';
			t += '<td align="left">&nbsp;'+loadEmprego_data_saida+'</td>';
	 		t += '<td align="right"><button  onclick="end_excluir('+n_ln+')" class="options_action_del_sec oculPrint" title=" EXCLUIR "></button></td>';
			t += '</tr>';
	if(loadEmprego_empresa!=''){
			$('#tableEmprego  > tbody:last-child').append(t);
			//$('#avancar').css('display','block');
			
			n_ln++;

			//Limpar
			$('#loadEmprego_empresa').val('');
			$('#loadEmprego_cargo').val('');
			$('#loadEmprego_motivo').val('');
			$('#loadEmprego_cidade').val('');
			$('#loadEmprego_data_entrada').val('');
			$('#loadEmprego_data_saida').val('');
			
			
	}else{ alert('Preencha o campo "Empresa"')}
}



//excluir linha da tabela
function end_excluir(n,val_id){
	$('#trEmprego'+n).remove();
//	$('#end_tr2'+n).remove();
	//loadsDataAbsoluto('#msn','../mod_empresa_clientes/acao_comum_end_excluir.php',val_id);

}




</script>



<style onload="divLoadMsn('.divLoadMsnlocalEmprego','options_action_add_sec','','#')"></style> 
<div class="divLoadMsnlocalEmprego PrintOculta">

<div class="col-md-12 col-sm-12 col-xs-12 PrintOculta"> 
        <div class="col-md-12 col-sm-12 col-xs-12 PrintOculta">
          <h2> Emprego</h2>
    </div>
       <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-md-4 col-sm-4 col-xs-12">
        <input name="loadEmprego_empresa[]" type="text" class="form-control col-md-7 col-xs-12" id="loadEmprego_empresa" placeholder="Empresa">
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="loadEmprego_cargo[]" type="text" class="form-control col-md-7 col-xs-12" id="loadEmprego_cargo" placeholder="Cargo">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="loadEmprego_notivo[]" type="text" class="form-control col-md-7 col-xs-12" id="loadEmprego_motivo" placeholder="Motivo da saída">
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="loadEmprego_cidade[]" type="text" class="form-control col-md-7 col-xs-12" id="loadEmprego_cidade" placeholder="Cidade">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="loadEmprego_data_entrada[]" type="text" class="mask_date_ma form-control col-md-7 col-xs-12" id="loadEmprego_data_entrada" placeholder="Data Entada">
        </div>
         <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="loadEmprego_data_saida[]" type="text" class="mask_date_ma form-control col-md-7 col-xs-12" id="loadEmprego_data_saida" placeholder="Data saida">
        </div>
        <div class="col-md-1 col-sm-1 col-xs-12">
          <button class="options_action_add_sec oculPrint" title=" ADICIONAR "  onClick="addtableEmpresa()" type="button"> </button>
        </div>
      </div>
 </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12 PrintOculta" for="first-name"><h2>Lista</h2>  </label>

	            <table class="table table-hover" width="100%">
                      <thead>
                        <tr class="PrintTexto">
                          <th width="22%" align="left">Empresa</th>
                          <th width="10%" align="left">Cargo</th>
                          <th width="10%" align="left">Motivo</th>
                          <th width="20%" align="left">Cidade</th>
                          <th width="13%" align="right">Data de Entrada</th>
                          <th width="16%" align="right">Data de Saída</th>
                          <th width="9%">Opções</th>
                        </tr>
                      </thead>
                 </table>
    
    
    	<div class="col-md-12 col-sm-12 col-xs-12 overflow">

            
            <table class="table table-hover1" id="tableEmprego">
                           <tr class="PrintOculta" style="display:none;">
                          <th width="22%"></th>
                          <th width="10%"></th>
                          <th width="10%"></th>
                          <th width="20%"></th>
                          <th width="13%"> </th>
                          <th width="16%"></th>
                          <th width="9%"></th>
                        </tr>
                      <tbody>
                      <?php if( $totalRows_list_acao_edit_emprego >=1){ do { ?>
                        <tr class="PrintTexto">
                          <th align="left" scope="row"><?php echo $row_list_acao_edit_emprego['EmpregoEmpresa']; ?></th>
                          <td align="left"><?php echo $row_list_acao_edit_emprego['EmpregoCargo']; ?></td>
                          <td align="left"><?php echo $row_list_acao_edit_emprego['EmpregoMotivoSaida']; ?></td>
                          <td align="left"><?php echo $row_list_acao_edit_emprego['EmpregoCidade']; ?></td>
                          <td align="right"><?php echo $row_list_acao_edit_emprego['EmpregoDataEntreda']; ?></td>
                          <td align="right"><?php echo $row_list_acao_edit_emprego['EmpregoDataSaida']; ?></td>
                          <td>&nbsp;</td>
                        </tr>
                       <?php } while ($row_list_acao_edit_emprego = mysql_fetch_assoc($list_acao_edit_emprego)); }?>
                      </tbody>
                    </table>
        </div>
 
 <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group PrintOculta">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default" id="empregoEditFechar" onclick="empregoEditFecharAgora()"  ><i class="fa fa-caret-down"></i>&nbsp; Ocultar</button>
        <span id="concluir_verificar">
        </span>
      </div>
    </div>
</div>


<?php
mysql_free_result($list_acao_edit_emprego);
?>
