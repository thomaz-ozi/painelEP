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
	 $('#msn_load').show();
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
body{ background-color:#4F5118; font-family:Arial, Helvetica, sans-serif;} 
#otm_table{ width:98%; background-color:#FFF; box-shadow: 0 0 2px 2px #000;  margin:auto;}
#otm_title{ height:30px; font-weight:bold; text-align:center; background-image:url("../images/aparencia/cabanha/barra-indece.png");}
#otm_title_fim{ height:30px;  text-align:center; background-image:url("../images/aparencia/cabanha/barra-indece.png");}
#idDadoOtimizar{ font-size:12px; font-weight:normal; padding:10px;}
.divLoadData{ width:66px; height:66px; background-image:url("../images/carregando.gif");}
#msn_load{ display:none;}
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
mysql_select_db($database_connection, $connection);
$query_list_ultimo_inicio = "SELECT * FROM tbnext_mod_sma_otimizar_leite WHERE status_otimizar = 1 ORDER BY id_otimizar DESC";
$list_ultimo_inicio = mysql_query($query_list_ultimo_inicio, $connection) or die(mysql_error());
$row_list_ultimo_inicio = mysql_fetch_assoc($list_ultimo_inicio);
$totalRows_list_ultimo_inicio = mysql_num_rows($list_ultimo_inicio);
?>
<?php
mysql_select_db($database_connection, $connection);
$query_list_ultimo_fim = "SELECT * FROM tbnext_mod_sma_otimizar_leite  ORDER BY id_otimizar DESC";
$list_ultimo_fim = mysql_query($query_list_ultimo_fim, $connection) or die(mysql_error());
$row_list_ultimo_fim = mysql_fetch_assoc($list_ultimo_fim);
$totalRows_list_ultimo_fim = mysql_num_rows($list_ultimo_fim);

mysql_select_db($database_connection, $connection);
$query_list_manejo = "SELECT * FROM tbnext_mod_sma_manejo ORDER BY `data` ASC";
$list_manejo = mysql_query($query_list_manejo, $connection) or die(mysql_error());
$row_list_manejo = mysql_fetch_assoc($list_manejo);
$totalRows_list_manejo = mysql_num_rows($list_manejo);
?>
<table  border="0" cellspacing="0" cellpadding="0" id="otm_table">
  <tr id="otm_title">
    <td><a href="#"       onclick="MM_openBrWindow('../sma_relatorios_leite/otimizar.php','','status=yes,scrollbars=yes,resizable=yes,width=1024')" ><img src="../sma_relatorios_leite/icons/otimizar_relatorios.png" alt="" width="30" height="30" border="0" align="middle" /></a></td>
    <td>Otimização de Relatórios 2.1</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="font-size:12px;">
      &nbsp;&nbsp;&nbsp;<b> - Informações- </b><br>
      &nbsp;&nbsp;&nbsp;Ultimo manejo: <?php echo converte_datahoras($row_list_manejo['data']) ?><br>
      
	  &nbsp;&nbsp;&nbsp;Ultima data orimizada: <?php echo $row_list_ultimo_fim['data_otimizar_ultimo']; ?>
      <br /><br>

      <div class="txt-Indece">
      <a href="index_otimizar.php"        ><img src="../sma_relatorios_leite/icons/otimizar_relatorios_edit.png" alt="editar" width="30" height="30"  border="0" align="middle"  />
      </a>Editar</div>
      <br>
      <br>&nbsp;<br />
      &nbsp;
      <table width="400" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="10%" align="left"><?php if($row_list_ultimo_fim['data_otimizar_ultimo']==''){$data_inicial=$row_list_manejo['data'];}else{$data_inicial=$row_list_ultimo_fim['data_otimizar_ultimo'];}  ?></td>
          <td width="23%" align="left">&nbsp;&nbsp;Inicial:</td>
          <td width="67%" align="left"><input  name="data_otimizar_inicial" type="text" id="data_otimizar_inicial"  onClick="ds_sh(this);" value="<?php echo converte_datahoras($data_inicial); ?>" size="8" maxlength="10" required /></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;&nbsp;Final:</td>
          <td align="left"><input  name="data_otimizar_final" type="text" id="data_otimizar_final"  onClick="ds_sh(this);" size="8" maxlength="10" required /></td>
        </tr>
      </table>
    <br /></td>
  </tr>
  <tr>
    <td colspan="3"><br />
    &nbsp;<button   onClick="otimizar_data()">Inicar otimização</button>
    <br></td>
  </tr>
  <tr >
    <td colspan="3" align="center" id="msn_load" >
    <div class="divLoadData"></div></td>
  </tr>
  <tr >
    <td colspan="3" id="idDadoOtimizar" >&nbsp;</td>
  </tr>

</table>
<?php
mysql_free_result($list_ultimo_inicio);

mysql_free_result($list_ultimo_fim);

mysql_free_result($list_manejo);
?>
