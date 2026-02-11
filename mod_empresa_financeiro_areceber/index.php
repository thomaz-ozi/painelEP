<?php require_once('../Connections/connection.php'); ?>


<?php
	include "../sistema_funcoes/converte_datas.php";
	include "../sistema_funcoes/converte_datas_horas.php";
	include("../sistema_funcoes/extrair_data.php");
	include "../sistema_funcoes/converter_numero_moeda.php"; 
	include "../sistema_funcoes/limit_txt.php"; 
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

mysql_select_db($database_connection, $connection);
$query_list_mes = "SELECT * FROM tbnext_sistem_data_mes ORDER BY id_mes ASC";
$list_mes = mysql_query($query_list_mes, $connection) or die(mysql_error());
$row_list_mes = mysql_fetch_assoc($list_mes);
$totalRows_list_mes = mysql_num_rows($list_mes);

mysql_select_db($database_connection, $connection);
$query_list_ano = "SELECT * FROM tbnext_sistem_data_ano ORDER BY ano DESC";
$list_ano = mysql_query($query_list_ano, $connection) or die(mysql_error());
$row_list_ano = mysql_fetch_assoc($list_ano);
$totalRows_list_ano = mysql_num_rows($list_ano);
?>
<script src="../mod_empresa_financeiro_areceber/script.js"></script>
<link rel="stylesheet" type="text/css" href="../mod_empresa_financeiro/stylo.css">
<?php include ("../sistema/index_content_head.php");?>



	<p>&nbsp;</p>
	<?php include ("../mod_empresa_financeiro_areceber/index_painel.php");?>
  
    <div>
    
    <input type="text" id="dataInicial" class="form-data col-md-2 col-sm-2 col-xs-12" placeholder="Data Inicial">
    <input type="text"  id="dataFinal" 	class="form-data col-md-2 col-sm-2 col-xs-12" placeholder="Data Final">
    <input type="text"  id="xPesq" 	class=" col-md-2 col-sm-2 col-xs-12" placeholder="ID ou nome do cliente">
    <select id="xPesqSelect" class="col-md-2 col-sm-2 col-xs-12">
    	<option value="0">---</option>
      	<option value="1">ID Parcela</option>
      	<option value="2">Nome Cliente</option>
      	<option value="3">Nº Cliente</option>
    </select>
    <button type="submit" id="pesqPediodo" class="btn btn-default col-md-2 col-sm-2 col-xs-12"><i class="fa fa-search"></i>   Pesquisar</button>
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>

    <div id="indexLoad" ><?php include "../mod_empresa_financeiro_areceber/index_load.php"; ?></div>
    <div id="LoadOpcoes"></div>
<?php
mysql_free_result($list_mes);

mysql_free_result($list_ano);
?>
<script type="text/javascript">
$(function() {
	$( "#RadioButtons1" ).buttonset(); 
});
</script>
<script>
      $(document).ready(function() {
        $('.form-data').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_2",
		  format: 'DD/MM/YYYY',
		  customRangeLabel: 'Custom',
		  daysOfWeek: ['dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab'],
          monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Juho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
       
        });	
		
		
      });
 </script>
 <script>
 $('#pesqPediodo').click(function(){
	 var dataInicial=$('#dataInicial').val();
	 var dataFinal=$('#dataFinal').val();
	 var xPesq=$('#xPesq').val();
	 var xPesqSelect= $("#xPesqSelect option:selected").val();
	 if(xPesqSelect!=''){
	loadsData('#indexLoad','../mod_empresa_financeiro_areceber/index_load.php',xPesqSelect+"&dataInicial="+dataInicial+"&dataFinal="+dataFinal+"&xPesq="+xPesq);
	 }
	 
});
 
 </script>