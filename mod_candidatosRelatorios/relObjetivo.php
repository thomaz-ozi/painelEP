<?php require_once('../Connections/connection.php'); ?>
<?php
	include ("../mod_iep_candidatos/periodoData.php");
	require_once "../sistema_funcoes/converter_utf8.php"; 
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

$maxRows_list_acao = 10;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

$colname_list_acao = "-1";
if (isset($_GET['Nome'])) {
  $colname_list_acao = $_GET['Nome'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM tbMod_canditados  ORDER BY Nome ASC";
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

mysql_select_db($database_connection, $connection);
$query_list_objetivo = "SELECT * FROM tbMod_canditadosObjet ORDER BY Objetivo ASC";
$list_objetivo = mysql_query($query_list_objetivo, $connection) or die(mysql_error());
$row_list_objetivo = mysql_fetch_assoc($list_objetivo);
$totalRows_list_objetivo = mysql_num_rows($list_objetivo);

mysql_select_db($database_connection, $connection);
$query_List_objetivo_janela = "SELECT * FROM tbMod_canditadosObjet ORDER BY Objetivo ASC";
$List_objetivo_janela = mysql_query($query_List_objetivo_janela, $connection) or die(mysql_error());
$row_List_objetivo_janela = mysql_fetch_assoc($List_objetivo_janela);
$totalRows_List_objetivo_janela = mysql_num_rows($List_objetivo_janela);

//tbmod_canditadosobjet
//tbMod_canditadosObjet
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
	MM_openBrWindow('../mod_candidatosRelatorios/relObjetivo_load.php',
'','toolbar=yes,location=yes ,menubar=yes, status=yes, scrollbars=yes,  resizable=yes, width=1024,height=768')
 });	
 	
});

function relatorio(opcao){
		loadsData('#loadDiv','../mod_candidatosRelatorios/relObjetivo_load.php?opcao='+opcao,'&cabecalho=1');

}
function relatorioJanela(opcao){
		MM_openBrWindow('../mod_candidatosRelatorios/relObjetivo_load.php?&opcao='+opcao,
		'','toolbar=yes,location=yes ,menubar=yes, status=yes, scrollbars=yes,  resizable=yes, width=1024,height=768')
}

</script>
<style>.dropdown-menu {
    left: 0px;
}</style>
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
      <td colspan="4" align="center"><h2>Relatório do  Objetivo</h2><br>
Quantidade de Registro: <?php echo $totalRows_list_acao; ?>
      <div class="ln_solid"></div></td>

    </tr>
    <tr>
      <td colspan="4" align="center">
                
      <div class="btn-group">
          <div class="btn-group">
                         <div class="btn-group">
                          <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Relatórios <span class="caret"></span> </button>
                          <ul class="dropdown-menu">
                     		<?php do { ?>
                              <li><a href="#" onClick="relatorio('<?php echo convert_utf8($row_list_objetivo['Objetivo']); ?>')"><?php echo convert_utf8($row_list_objetivo['Objetivo']); ?></a> </li>
                            <?php } while ($row_list_objetivo = mysql_fetch_assoc($list_objetivo)); ?>
                          </ul>
                          </div>
                          <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Relatórios como Janela <span class="caret"></span> </button>
                          <ul class="dropdown-menu">
                            <?php do { ?>
                              <li><a href="#" onClick="relatorioJanela('<?php echo convert_utf8($row_List_objetivo_janela['Objetivo']); ?>')"><?php echo convert_utf8($row_List_objetivo_janela['Objetivo']); ?></a> </li>
                            <?php } while ($row_List_objetivo_janela = mysql_fetch_assoc($List_objetivo_janela)); ?>
                          </ul>
                        </div>
                    </div>    
                        
           
          </div>
     	</td>
    </tr>
  </tbody>
</table>
<div id="loadDiv"></div>
<?php
mysql_free_result($list_acao);

mysql_free_result($list_objetivo);

mysql_free_result($List_objetivo_janela);
?>
