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
body{ background-color:#4F5118; font-family:Arial, Helvetica, sans-serif;} 
#otm_table{ width:98%; background-color:#FFF; box-shadow: 0 0 2px 2px #000;  margin:auto;}
#otm_title{ height:30px; font-weight:bold; text-align:center; background-image:url("../images/aparencia/cabanha/barra-indece.png");}
#otm_title_fim{ height:30px;  text-align:center; background-image:url("../images/aparencia/cabanha/barra-indece.png");}
#idDadoOtimizar{ font-size:12px; font-weight:normal; padding:10px;}

.divLoadData{ width:66px; height:66px; background-image:url("../images/carregando.gif");}
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

<?php
$maxRows_list_acao = 10;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM tbnext_mod_sma_otimizar_leite";
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
    <td colspan="3"><br />
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr class="texto">
          <td width="44%" align="left" bgcolor="#FFFFFF" class="txt-Indece">Dia que foi otimizado</td>
          <td width="22%" align="left" bgcolor="#FFFFFF" class="txt-Indece">Data Inicial</td>
          <td width="22%" align="left" bgcolor="#FFFFFF" class="txt-Indece">Data Final</td>
          <td width="8%" bgcolor="#FFFFFF" class="txt-Indece"><div align="center">Op&ccedil;&otilde;es</div></td>
          <td width="4%" bgcolor="#FFFFFF" class="txt-Indece"><a href="otimizar.php?<?php echo $usuario_get; ?>&amp;conteudo=<?php echo $conteudo_inf; ?>-add"><img src="../icons/circulo_red/add-25.png" width="25" height="25" border="0"  title=" ADICIONAR "/></a></td>
        </tr><?php do { ?>
        <tr  class="txt" 
  			onmouseout="this.className='txt';" 
            onmouseover="this.className='txt_hover';">
          
            <td align="left" >&nbsp;&nbsp;<?php echo $row_list_acao['data_otimizar']; ?></td>
            <td align="left" ><?php echo $row_list_acao['data_otimizar_inicial']; ?></td>
            <td align="left" ><?php echo $row_list_acao['data_otimizar_ultimo']; ?></td>
            <td colspan="2" align="center" bgcolor="#FFFFFF" class="txt-Indece" ><a href="index_otimizar_del.php?id_otimizar=<?php echo $row_list_acao['id_otimizar']; ?>"><img src="../icons/circulo_red/excluir-25.png" width="25" height="25" border="0" /></a></td>
           
        </tr> <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
    </table></td>
  </tr>
  <tr >
    <td colspan="3" id="idDadoOtimizar"><table border="0">
      <tr>
        <td><?php if ($pageNum_list_acao > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, 0, $queryString_list_acao); ?>">|&lt;Inicio</a>
          <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_list_acao > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, max(0, $pageNum_list_acao - 1), $queryString_list_acao); ?>">&lt;&lt; Voltar</a>
          <?php } // Show if not first page ?></td>
        <td>&nbsp;
          lista <?php echo ($startRow_list_acao + 1) ?> de <?php echo min($startRow_list_acao + $maxRows_list_acao, $totalRows_list_acao) ?> para <?php echo $totalRows_list_acao ?></td>
        <td><?php if ($pageNum_list_acao < $totalPages_list_acao) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, min($totalPages_list_acao, $pageNum_list_acao + 1), $queryString_list_acao); ?>">Avan&ccedil;ar &gt;&gt;</a>
          <?php } // Show if not last page ?></td>
        <td><?php if ($pageNum_list_acao < $totalPages_list_acao) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, $totalPages_list_acao, $queryString_list_acao); ?>">Fim&gt;  |</a>
          <?php } // Show if not last page ?></td>
      </tr>
    </table></td>
  </tr>

</table>
<?php
mysql_free_result($list_acao);
?>
