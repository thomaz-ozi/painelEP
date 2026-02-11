<?php require_once('../Connections/connection.php'); ?>
<?php require_once ("../sistema_funcoes/converter_utf8.php");?>
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

mysql_select_db($database_connection, $connection);
$query_list_objetivos = "SELECT * FROM tbMod_canditadosObjet ORDER BY Objetivo ASC";
$list_objetivos = mysql_query($query_list_objetivos, $connection) or die(mysql_error());
$row_list_objetivos = mysql_fetch_assoc($list_objetivos);
$totalRows_list_objetivos = mysql_num_rows($list_objetivos);
?>

<script>
	
$(function(){


//----------------------------> Filtro Pesquisa 
$('#xPesq').keyup(function(){
	var xPesq = $(this).val();
	var qtdd = $(this).val().length;
	
	var dataNascimento = $("#dataNascimento").val();
	var Objetivo= $("#Objetivo option:selected").val();
	var xRua = $('#xRua').val();
	
	if(qtdd>='4'){
		loadsData('#indexLoad','../mod_iep_candidatos/index_load.php','&xPesq='+xPesq+'&dataNascimento='+dataNascimento+'&Objetivo='+Objetivo+'&xRua='+xRua);
	}

	});
$('#xRua').change(function(){
	var xPesq = $("#xPesq").val();
	var xRua = $(this).val();
	var xBairro = $('#xBairro').val();
	var Objetivo= $("#Objetivo option:selected").val();
	var dataNascimento = $('#dataNascimento').val();

		loadsData('#indexLoad','../mod_iep_candidatos/index_load.php','&xPesq='+xPesq+'&dataNascimento='+dataNascimento+'&Objetivo='+Objetivo+'&xRua='+xRua+'&xBairro='+xBairro);

	});		

$('#xBairro').change(function(){
	var xPesq = $("#xPesq").val();
	var xRua = $('#xRua').val();
	var xBairro = $(this).val();
	var dataNascimento = $("#dataNascimento").val();
	var Objetivo= $("#Objetivo option:selected").val();
	
		loadsData('#indexLoad','../mod_iep_candidatos/index_load.php','&xPesq='+xPesq+'&dataNascimento='+dataNascimento+'&Objetivo='+Objetivo+'&xRua='+xRua+'&xBairro='+xBairro);
	});	

$('#dataNascimento').change(function(){
	var xPesq = $("#xPesq").val();
	var xRua = $('#xRua').val();
	var xBairro = $('#xBairro').val();
	var Objetivo= $("#Objetivo option:selected").val();
	var dataNascimento = $(this).val();
	loadsData('#indexLoad','../mod_iep_candidatos/index_load.php','&xPesq='+xPesq+'&dataNascimento='+dataNascimento+'&Objetivo='+Objetivo+'&xRua='+xRua+'&xBairro='+xBairro);

	});
	


$('#Objetivo').change(function(){
	var xPesq = $("#xPesq").val();
	var xRua = $('#xRua').val();
	var xBairro = $('#xBairro').val();
	var Objetivo= $("#Objetivo option:selected").val();
	var dataNascimento = $('#dataNascimento').val();

		loadsData('#indexLoad','../mod_iep_candidatos/index_load.php','&xPesq='+xPesq+'&dataNascimento='+dataNascimento+'&Objetivo='+Objetivo+'&xRua='+xRua+'&xBairro='+xBairro);

	});

});


</script>

<?php include ("../sistema/index_content_head.php");?>



  
    <div>
      <select id="Objetivo" class="col-md-2 col-sm-2 col-xs-12" placeholder="Objetivo">
        <option value="">Objetivo</option>
          <?php
do {  
?>
          <option value="<?php echo convert_utf8($row_list_objetivos['Objetivo'])?>"><?php echo convert_utf8($row_list_objetivos['Objetivo'])?></option>
          <?php
} while ($row_list_objetivos = mysql_fetch_assoc($list_objetivos));
  $rows = mysql_num_rows($list_objetivos);
  if($rows > 0) {
      mysql_data_seek($list_objetivos, 0);
	  $row_list_objetivos = mysql_fetch_assoc($list_objetivos);
  }
?>
      </select>
      <input name="xBairro" type="text"  	class=" col-md-2 col-sm-2 col-xs-12"  id="xBairro" placeholder="Bairro" value="<?php echo $_POST['xBairro']=$_GET['xBairro'];?> <?php $_POST['Objetivo']=$_GET['Objetivo'];?>">

    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>

    <div id="indexLoad" >
		<?php  include "../mod_iep_candidatos/index_load.php"; ?>
     </div>
    <div id="LoadOpcoes"></div>
<?php
mysql_free_result($list_mes);

mysql_free_result($list_ano);

mysql_free_result($list_objetivos);
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