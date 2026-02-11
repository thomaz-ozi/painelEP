<?php require_once('../Connections/connection.php'); ?>
<?php 
//CONVERTER

include ("../sistema_funcoes/maiuscola_minuscola.php");
	$_POST['xNome']= convertem($_POST['xNome'], 1);
	$_POST['xFan']= convertem($_POST['xFan'], 1);
	$_POST['responsavel']= convertem($_POST['responsavel'], 1);
	$_POST['data_acao']=date(Y.'-'.m.'-'.d.' '.H.':'.m.':'.s);
include ("../sistema_funcoes/converte_datas.php");
	$_POST['data_nasc']=converte_data($_POST['data_nasc']);


include("../sistema_funcoes/converter_numero_banco.php");
include("../sistema_funcoes/converter_numero_moeda_3.php");


$_POST['limite_valores']=converte_numero_banco($_POST['limite_valores']);
//limites
if($_POST['xNome']==""){$_POST['xNome']=0; }
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
  $updateSQL = sprintf("UPDATE tbnext_mod_empresa_clientes SET data_acao=%s, id_usuario=%s, id_local=%s, id_nivel=%s,  id_atuacao=%s, xNome=%s, xFan=%s, cpf_cnpj=%s, CNPJ=%s, IE=%s, responsavel=%s, CPF=%s, RG=%s, data_nasc=%s, descricao=%s WHERE id_clientes=%s",
                       GetSQLValueString($_POST['data_acao'], "date"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['id_local'], "int"),
					   GetSQLValueString($_POST['id_nivel'], "int"),
                       GetSQLValueString($_POST['id_atuacao'], "int"),
                       GetSQLValueString($_POST['xNome'], "text"),
                       GetSQLValueString($_POST['xFan'], "text"),
                       GetSQLValueString($_POST['cpf_cnpj'], "int"),
                       GetSQLValueString($_POST['CNPJ'], "text"),
                       GetSQLValueString($_POST['IE'], "text"),
                       GetSQLValueString($_POST['responsavel'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['RG'], "text"),
                       GetSQLValueString($_POST['data_nasc'], "date"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['id_clientes'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

$data_acao=date('Y-m-d') ;
include("../mod_empresa_clientes/acao_comum.php");

}

$colname_list_acao = "-1";
if (isset($_GET['id_clientes'])) {
  $colname_list_acao = $_GET['id_clientes'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_empresa_clientes WHERE id_clientes = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

mysql_select_db($database_connection, $connection);
$query_list_class = "SELECT * FROM tbnext_mod_empresa_clientes_class ORDER BY xNome ASC";
$list_class = mysql_query($query_list_class, $connection) or die(mysql_error());
$row_list_class = mysql_fetch_assoc($list_class);
$totalRows_list_class = mysql_num_rows($list_class);

mysql_select_db($database_connection, $connection);
$query_list_comunicacao_tipo = "SELECT * FROM tbnext_mod_empresa_clientes_comunicacao_tipo ORDER BY xNome ASC";
$list_comunicacao_tipo = mysql_query($query_list_comunicacao_tipo, $connection) or die(mysql_error());
$row_list_comunicacao_tipo = mysql_fetch_assoc($list_comunicacao_tipo);
$totalRows_list_comunicacao_tipo = mysql_num_rows($list_comunicacao_tipo);

mysql_select_db($database_connection, $connection);
$query_list_atuacao = "SELECT * FROM tbnext_mod_empresa_clientes_atuacao ORDER BY xNome ASC";
$list_atuacao = mysql_query($query_list_atuacao, $connection) or die(mysql_error());
$row_list_atuacao = mysql_fetch_assoc($list_atuacao);
$totalRows_list_atuacao = mysql_num_rows($list_atuacao);

mysql_select_db($database_connection, $connection);
$query_list_nivel = "SELECT * FROM tbnext_mod_empresa_clientes_nivel ORDER BY id_nivel ASC";
$list_nivel = mysql_query($query_list_nivel, $connection) or die(mysql_error());
$row_list_nivel = mysql_fetch_assoc($list_nivel);
$totalRows_list_nivel = mysql_num_rows($list_nivel);
?>


<script src="../mod_empresa_clientes/script.js"></script>
<script src="../mod_empresa_clientes/script_comunicacao.js"></script>
<script src="../mod_empresa_clientes/script_endereco.js"></script>

<form action="<?php echo $editFormAction; ?>" method="POST" name="acao" id="acao">
<?php 
$acao_comum="Alterar";
$acao_icons="alt-30.png";
include ("../sistema/index_content_head.php");?>

<table width="100%" border="0" cellpadding="0" cellspacing="1" class="texto" >

          <tr>
            <td colspan="2" align="left" valign="top">
                  
   <div id="tabs">
	<ul>
		<li><a href="#tabs-1">Dados Cadastrais</a></li>
        <li><a href="#tabs-2">Comunicação </a></li>
        <li><a href="#tabs-3">Endereço</a></li>
        <li><a href="#tabs-4">Descri&ccedil;&atilde;o</a></li>
		

	</ul>
	<div id="tabs-1">
    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                
                <tr>
                  <td align="left" class="txt-opcoes">Atuação:</td>
                  <td width="34%" align="left" class="txt"><select name="id_atuacao" id="id_atuacao" tabindex="1">
                    <option value="" <?php if (!(strcmp("", $row_list_acao['id_atuacao']))) {echo "selected=\"selected\"";} ?>>---</option>
                    <?php
do {  
?>
                    <option value="<?php echo $row_list_atuacao['id_atuacao']?>"<?php if (!(strcmp($row_list_atuacao['id_atuacao'], $row_list_acao['id_atuacao']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_atuacao['xNome']?></option>
                    <?php
} while ($row_list_atuacao = mysql_fetch_assoc($list_atuacao));
  $rows = mysql_num_rows($list_atuacao);
  if($rows > 0) {
      mysql_data_seek($list_atuacao, 0);
	  $row_list_atuacao = mysql_fetch_assoc($list_atuacao);
  }
?>
                  </select></td>
                  <td align="left" class="txt-opcoes">Nascimento</td>
                  <td align="left" class="txt"><input name="data_nasc" type="text"  class="form-datepicker mask_date" id="data_nasc" tabindex="9" value="<?php echo converte_data($row_list_acao['data_nasc']); ?>"></td>
                </tr>
                <tr>
                  <td align="left" class="txt-opcoes">Nivel</td>
                  <td width="34%" align="left" class="txt">
                    <select name="id_nivel" required id="id_nivel">
                      <option value="" <?php if (!(strcmp("", $row_list_acao['id_nivel']))) {echo "selected=\"selected\"";} ?>>---</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_list_nivel['id_nivel']?>"<?php if (!(strcmp($row_list_nivel['id_nivel'], $row_list_acao['id_nivel']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_nivel['xNome']?></option>
                      <?php
} while ($row_list_nivel = mysql_fetch_assoc($list_nivel));
  $rows = mysql_num_rows($list_nivel);
  if($rows > 0) {
      mysql_data_seek($list_nivel, 0);
	  $row_list_nivel = mysql_fetch_assoc($list_nivel);
  }
?>
                  </select></td>
                  <td align="left" class="txt">&nbsp;</td>
                  <td align="left" class="txt">&nbsp;</td>
                </tr>
                <tr>
                  <td width="26%" align="left" class="txt-opcoes">CPF/CNPJ
                    *
                      <input name="id_clientes" type="hidden" id="id_clientes" value="<?php echo $id_clientes= $row_list_acao['id_clientes']; ?>" />
                  <input name="res" type="hidden" id="res" value="res" />
                  <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>" />
                  <input name="id_local" type="hidden" id="id_local" value="<?php echo $row_list_acao['id_local']; ?>" /></td>
                  <td colspan="3" align="left" class="txt"><select id="cpf_cnpj" required name="cpf_cnpj" style="z-index: 110;">
                    <option selected="selected" value="" <?php if (!(strcmp("", $row_list_acao['cpf_cnpj']))) {echo "selected=\"selected\"";} ?>>-----</option>
                    <option id="cpf"   value="0" <?php if (!(strcmp(0, $row_list_acao['cpf_cnpj']))) {echo "selected=\"selected\"";} ?>>CPF</option>
                    <option id="cnpj"  value="1" <?php if (!(strcmp(1, $row_list_acao['cpf_cnpj']))) {echo "selected=\"selected\"";} ?>>CNPJ</option>
                  </select></td>
                </tr>

                <tr>
                  <td colspan="4" align="left" ><div id="div_cnpj_cpf">
                  
                  
                  <?php
				  $_POST['content']=$row_list_acao['id_clientes'];
				   switch($row_list_acao['cpf_cnpj']){
					  case 0:
					  	include ("../mod_empresa_clientes/acao_comum_cpf.php");
					  break;
					  case 1:
					  	include ("../mod_empresa_clientes/acao_comum_cnpj.php");
					  break;
					  } ?>
                  
                  </div></td>
            </table>
    </div>
 	<div id="tabs-2">
 	  <table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr class="txt-opcoes">
          <td width="15%">Classificação</td>
          <td width="15%">Tipo</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td><select name="comunicacao_id_class" id="comunicacao_id_class" style="width:100px;">
            <option value="">---</option>
            <?php
do {  
?>
            <option value="<?php echo $row_list_class['id_class']?>"><?php echo $row_list_class['xNome']?></option>
            <?php
} while ($row_list_class = mysql_fetch_assoc($list_class));
  $rows = mysql_num_rows($list_class);
  if($rows > 0) {
      mysql_data_seek($list_class, 0);
	  $row_list_class = mysql_fetch_assoc($list_class);
  }
?>
          </select></td>
          <td><select name="comunicacao_id_comunicacao_tipo"  style="width:100px;" id="comunicacao_id_comunicacao_tipo">
            <option value="">---</option>
            <?php
do {  
?>
            <option value="<?php echo $row_list_comunicacao_tipo['id_comunicacao_tipo']?>"><?php echo $row_list_comunicacao_tipo['xNome']?></option>
            <?php
} while ($row_list_comunicacao_tipo = mysql_fetch_assoc($list_comunicacao_tipo));
  $rows = mysql_num_rows($list_comunicacao_tipo);
  if($rows > 0) {
      mysql_data_seek($list_comunicacao_tipo, 0);
	  $row_list_comunicacao_tipo = mysql_fetch_assoc($list_comunicacao_tipo);
  }
?>
          </select></td>
          <td width="65%" id="comunicacao_valor">&nbsp;</td>
          <td width="5%">
          <button  type="button" tabindex="26" 
          class="options_action_add_sec" id="comunicacao_id_add" title=" ADICIONAR ">
          </button>
          
          </td>
        </tr>
      </table>
      <br>
	<?php include('../mod_empresa_clientes/acao_comum_comun_tabela.php'); ?>
 	</div>
	<div id="tabs-3">
    
    <table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr class="txt-opcoes">
          <td width="12%">Classificação</td>
          <td width="7%" align="center">CEP</td>
          <td width="11%" align="center"><div class="bt_cep" title=" localizar o CEP  "></div></td>
          <td width="36%" align="center">Rua</td>
          <td width="7%" align="center">Nro</td>
          <td width="19%" align="center">Cidade</td>
          <td width="3%" align="center">UF</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><select name="end_id_class" id="end_id_class" style="width:100px;">
            <option value="0">---</option>
            <?php
do {  
?>
            <option value="<?php echo $row_list_class['id_class']?>"><?php echo $row_list_class['xNome']?></option>
            <?php
} while ($row_list_class = mysql_fetch_assoc($list_class));
  $rows = mysql_num_rows($list_class);
  if($rows > 0) {
      mysql_data_seek($list_class, 0);
	  $row_list_class = mysql_fetch_assoc($list_class);
  }
?>
          </select></td>
          <td colspan="2" valign="top"><span class="txt">
            <input name="end_CEP" type="text"  id="end_CEP"   class="mask_cep" style="width:100px;" />
          </span></td>
          <td colspan="4" ><div style="height:60px;" id="div_endereco"></div></td>
          <td width="5%" valign="top"> 
          <button  type="button" tabindex="36" 
          class="options_action_add_sec" id="end_id_add" title=" ADICIONAR " >
          </button></td>
        </tr>
      </table>
      <br>
<?php include('../mod_empresa_clientes/acao_comum_end_tabela.php'); ?>
    
    
    
    
    </div>
	<div id="tabs-4">
    	<div id="loadDescricaolist">
    		<?php include ("../mod_empresa_clientes/index_descricao.php");?>
 		</div>
    </div>   
  </table>  
  <input type="hidden" name="MM_update" value="acao" />
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
      </div>
    </div>
</form>
<div id="msn"></div>
<div id="loadDescricao"></div>
<?php 
if ($_POST['res']=='res'){include "res_alt.php";}
?>


<?php
mysql_free_result($list_class);

mysql_free_result($list_comunicacao_tipo);

mysql_free_result($list_atuacao);


mysql_free_result($list_nivel);

?>
  	