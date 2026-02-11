<?php require_once('../Connections/connection.php'); ?>
<?php include("../sistem_funcoes/include_formata_datahoras.php"); ?>
<?php include ("../sistem_funcoes/calendario_form.php"); ?>
&nbsp;
<script type="text/javascript"  src="../jquery/jquery-1.5.2.min.js"></script>
<script type="text/javascript"  src="../jquery/jquery_valida_form.js"></script>
<script type="text/javascript" src="../sistem_funcoes/carregandoDados.js"></script>
<script type="text/javascript" src="../sma_relatorios/otimizar_02_00_verificando.js"></script>
<script>
 function otimizar_data(){

	 data_otimizar_inicial=$('#data_otimizar_inicial').val();
	 data_otimizar_final=$('#data_otimizar_final').val();
	 loadsData('#idDadoOtimizar','otimizar_relatorios_manejo_animal_dias.php','&data_inicial='+data_otimizar_inicial+'&data_final='+data_otimizar_final+' ');
	 

};
</script>
<script src="../sistem_funcoes/goURL.js" type="text/javascript"></script>
<style>

.txt-Indece {
    background-color: #E4E4E4;
    background-image: url("../images/aparencia/cabanha/barra-indece.png");
    background-position: 30px center;
    color: #000000;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    font-weight: bold;
    line-height: 20px;
    text-indent: 5px;
}
.txt_hover{
	     background-image: url("../images/aparencia/cabanha/barra-indece.png");

	}
.msn_excluir{
	
	font-size:16px;
	color:#900;}	
body{ background-color:#4F5118; font-family:Arial, Helvetica, sans-serif;} 
#otm_table{ width:98%; background-color:#FFF; box-shadow: 0 0 2px 2px #000;  margin:auto;}
#otm_title{ height:30px; font-weight:bold; text-align:center; background-image:url("../images/aparencia/cabanha/barra-indece.png");}
#otm_title_fim{ height:30px;  text-align:center; background-image:url("../images/aparencia/cabanha/barra-indece.png");}
#idDadoOtimizar{ font-size:12px; font-weight:normal; padding:10px;}
</style>
<?php require_once('../Connections/connection.php'); 




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
?>
?>
<?php
$maxRows_list_acao = 10;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

$colname_list_acao = "-1";
if (isset($_GET['id_otimizar'])) {
  $colname_list_acao = $_GET['id_otimizar'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_sma_otimizar_leite WHERE id_otimizar = %s", GetSQLValueString($colname_list_acao, "int"));
$query_limit_list_acao = sprintf("%s LIMIT %d, %d", $query_list_acao, $startRow_list_acao, $maxRows_list_acao);
$list_acao = mysql_query($query_limit_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);

if (isset($_GET['totalRows_list_acao'])) {
  $totalRows_list_acao = $_GET['totalRows_list_acao'];
} else {
  $all_list_acao = mysql_query($query_list_acao);
  $totalRows_list_acao = mysql_num_rows($all_list_acao);
}
$totalPages_list_acao = ceil($totalRows_list_acao/$maxRows_list_acao)-1;
?>
<table width="95%"  border="0" cellpadding="0" cellspacing="0" id="otm_table">
  <tr id="otm_title">
    <td><a href="#"       onclick="MM_openBrWindow('../sma_relatorios_leite/otimizar.php','','status=yes,scrollbars=yes,resizable=yes,width=1024')" ><img src="../sma_relatorios_leite/icons/otimizar_relatorios_edit.png" alt="" width="30" height="30" border="0" align="middle" /></a></td>
    <td>Editar Manejo Otimizado 1.1</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="font-size:12px;"><br /></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><br />
      <span class="msn_excluir">Tem certeza em  <b>EXLUIR</b> este Manejo Otinizado?</span><br />
</td>
  </tr>
  <tr>
    <td colspan="3"><form id="form1" name="form1" method="post" action="">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>Data</td>
        <td><?php echo $row_list_acao['data_otimizar']; ?></td>
      </tr>
      <tr>
        <td width="14%">Data Inicial
          <input name="id_otimizar" type="hidden" id="id_otimizar" value="<?php echo $row_list_acao['id_otimizar']; ?>" />
          <input name="res" type="hidden" id="res" value="res" /></td>
        <td width="86%"><?php echo $row_list_acao['data_otimizar_inicial']; ?></td>
      </tr>
      <tr>
        <td>Data Final</td>
        <td><?php echo $row_list_acao['data_otimizar_ultimo']; ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="button" name="button" id="button" value="NÃO (voltar)" 
        
   onclick="MM_goToURL('parent','index_otimizar.php')"
        
         /><input type="submit" name="button" id="button" value="SIM (excluir)" /></td>
        </tr>
    </table>
       </form>
   </td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="3" id="idDadoOtimizar">&nbsp;</td>
  </tr>

</table>
<?php 
if ($_POST['res']==res){
	include "res_exc.php";
} 

?>
<?php
mysql_free_result($list_acao);
?>
