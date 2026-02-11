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
<script src="../mod_iep_candidatos/script.js"></script>


<?php include ("../sistema/index_content_head.php");?>



  
    <div>
    
    <input name="dataNascimento" type="text" class=" col-md-2 col-sm-2 col-xs-12" id="dataNascimento" placeholder="ano">

        <select id="EstadoCivil" class="col-md-2 col-sm-2 col-xs-12" placeholder="EstadoCivil">
    	<option value="">Estado Civil</option>
      	<option value="1">casado</option>
      	<option value="2">Solteiro</option>
        <option value="2">Amigado</option>
      	<option value="3">Divociado</option>
        <option value="3">Viuvo</option>
      	<option value="3">Outros</option>

    </select>
    <input name="xPesq" type="text"  	class=" col-md-2 col-sm-2 col-xs-12"  id="xPesq" placeholder="Candidato">
        <input name="xRua" type="text"  	class=" col-md-2 col-sm-2 col-xs-12"  id="xRua" placeholder="Endereço">
          <input name="xBairro" type="text"  	class=" col-md-2 col-sm-2 col-xs-12"  id="xBairro" placeholder="Bairro">

    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>

    <div id="indexLoad" ><?php  include "../mod_iep_candidatos/index_load.php"; ?></div>
    <div id="LoadOpcoes"></div>
<?php
mysql_free_result($list_mes);

mysql_free_result($list_ano);
?>

<script>
$(function (){
$(".form-datepicke").datepicker({
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
});
</script>