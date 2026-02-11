<?php require_once('../Connections/connection.php'); ?>
<?php include ("../mod_iep_candidatos/periodoData.php");?>
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

$colname_list_acao = "-1";
if (isset($_GET['Nome'])) {
  $colname_list_acao = $_GET['Nome'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM tbmod_canditados  ORDER BY Nome ASC";
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

?>
<style>
.linha1 {background-color:#FFF; padding:0px 5px;}
.linha2 {background-color:#E9EAF1; padding:0px 5px;}
.dados{font-weight:bolder; font-size:16px; }
</style>
<script>
$(function(){
 $('#LoadRelatorios').click(function(){
	loadsData('#loadDiv','../mod_candidatosRelatorios/relNome_load.php','&cabecalho=1');
 });
 $('#LoadRelatoriosJanelas').click(function(){
	MM_openBrWindow('../mod_candidatosRelatorios/relNome_load.php',
'','toolbar=yes,location=yes ,menubar=yes, status=yes, scrollbars=yes,  resizable=yes, width=1024,height=768')
 });	
 	
});

</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center"><h2>Relatório do Ordem por Nome</h2><br>
Quantidade de Registro: <?php echo $totalRows_list_acao; ?>
      <div class="ln_solid"></div></td>

    </tr>
    <tr>
      <td colspan="4" align="center">
      <div class="btn-group">
          <button class="btn btn-default" type="button" id="LoadRelatorios">Relatório</button>
          <button class="btn btn-default" type="button" id="LoadRelatoriosJanelas">Relatório como Janela</button>
          <button class="btn btn-default" type="button">Option </button>
          </div>
     	</td>
    </tr>
  </tbody>
</table>
<div id="loadDiv"></div>
<?php
mysql_free_result($list_acao);
?>
