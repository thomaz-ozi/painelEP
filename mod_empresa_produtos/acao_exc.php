<?php 

include ("../sistema_funcoes/converter_numero_moeda.php");
include ("../sistema_funcoes/converter_numero_banco.php");
   $_POST['peso'] = converte_numero_banco($_POST['peso']);
   $_POST['dim_alt_y'] = converte_numero_banco($_POST['dim_alt_y']);
   $_POST['dim_larg_x'] = converte_numero_banco($_POST['dim_larg_x']);
   $_POST['dim_prop_z'] = converte_numero_banco($_POST['dim_prop_z']);
   
   
   $_POST['valor'] = converte_numero_banco($_POST['valor']);
   $_POST['valor_promocao'] = converte_numero_banco($_POST['valor_promocao']);
   $_POST['valor_1'] = converte_numero_banco($_POST['valor_1']);
   $_POST['valor_2'] = converte_numero_banco($_POST['valor_2']);
   $_POST['valor_3'] = converte_numero_banco($_POST['valor_3']);
   $_POST['valor_4'] = converte_numero_banco($_POST['valor_4']);
   
include ("../sistema_funcoes/maiuscola_minuscola.php");
$_POST['nome_produto']= convertem($_POST['nome_produto'], 1);
 ?>
<?php require_once('../Connections/connection.php'); ?>
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

if ((isset($_POST['id_produtos'])) && ($_POST['id_produtos'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_produtos WHERE id_produtos=%s",
                       GetSQLValueString($_POST['id_produtos'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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
$query_list_cores = "SELECT * FROM tbnext_produtos_cores ORDER BY nome_cores ASC";
$list_cores = mysql_query($query_list_cores, $connection) or die(mysql_error());
$row_list_cores = mysql_fetch_assoc($list_cores);
$totalRows_list_cores = mysql_num_rows($list_cores);
$colname_list_setor = "-1";

  $colname_list_setor = $_GET['id_setor'];
mysql_select_db($database_connection, $connection);
$query_list_setor = "SELECT * FROM tbnext_produtos_setor ORDER BY nome_setor ASC";
$list_setor = mysql_query($query_list_setor, $connection) or die(mysql_error());
$row_list_setor = mysql_fetch_assoc($list_setor);
$totalRows_list_setor = mysql_num_rows($list_setor);

mysql_select_db($database_connection, $connection);
$query_list_volt = "SELECT * FROM tbnext_produtos_volt ORDER BY xNome ASC";
$list_volt = mysql_query($query_list_volt, $connection) or die(mysql_error());
$row_list_volt = mysql_fetch_assoc($list_volt);
$totalRows_list_volt = mysql_num_rows($list_volt);

mysql_select_db($database_connection, $connection);
$query_list_marcas = "SELECT * FROM tbnext_produtos_marca ORDER BY nome_marca ASC";
$list_marcas = mysql_query($query_list_marcas, $connection) or die(mysql_error());
$row_list_marcas = mysql_fetch_assoc($list_marcas);
$totalRows_list_marcas = mysql_num_rows($list_marcas);

$colname_list_acao = "-1";
if (isset($_GET['id_produtos'])) {
  $colname_list_acao = $_GET['id_produtos'];
}
mysql_select_db($database_connection, $connection);
 $query_list_acao = sprintf("SELECT * FROM tbnext_produtos WHERE id_produtos = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

mysql_select_db($database_connection, $connection);
$query_list_unidd = "SELECT * FROM tbnext_produtos_unidd WHERE prod_serv!='1' ORDER BY xNome ASC";
$list_unidd = mysql_query($query_list_unidd, $connection) or die(mysql_error());
$row_list_unidd = mysql_fetch_assoc($list_unidd);
$totalRows_list_unidd = mysql_num_rows($list_unidd);

$exc="disabled";
?>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<?php include("acao_alt_imagens_banco.php");  ?>
<script src="<?php echo $conf_url; ?>script.js"></script>

<form name="acao" method="POST">

<?php 
$acao_comum="Excluir";
$acao_icons="excluir-30.png";
$msn='<div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>   </button>
           <strong><center>TEM CERTEZA EM EXCLUIR ESSAS INFORMAÇÕES?</center></strong>
      </div>';
include ("../sistema/index_content_head.php");?>

  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    
    <tr>
      <td  colspan="4" align="center" valign="top" class="txt"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="16%" align="left" class="txt-opcoes">Cod Barra</td>
          <td colspan="3" align="left" class="txt"><input name="codigo_barra" type="text" disabled  id="codigo_barra" value="<?php echo $row_list_acao['codigo_barra']; ?>" /></td>
          <td width="14%" rowspan="2" class="txt-opcoes">Palavra p/ pesquisa na web</td>
          <td width="38%" rowspan="2">
          <textarea name="palavra_pesquisa" disabled  required id="palavra_pesquisa" style="width:270px; height:35px;"><?php echo $row_list_acao['palavra_pesquisa']; ?></textarea>
          
          </td>
          </tr>
        <tr>
          <td align="left" class="txt-opcoes"><?php echo $cliente_mod_produtos_nome_produtos; ?>*:
            <input name="id_produtos" type="hidden" id="id_produtos" value="<?php echo $row_list_acao['id_produtos']; ?>">
            <input type="hidden" name="id_local"  id="id_local" value="<?php echo  $_SESSION['LOCAL']; ?>" />
<input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
            <input name="res" type="hidden" id="res" value="res" />
            <input name="list" type="hidden" id="list" value="pro" /></td>
          <td colspan="3" align="left" class="txt">
            <input name="nome_produto" type="text" disabled required  id="nome_produto" style=" width:250px;" value="<?php echo $row_list_acao['nome_produto']; ?>">
          </td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td  colspan="4" align="center" valign="top" class="txt">
    <div id="tabs">
	<ul>
		<li><a href="#tabs-1">Padrão</a></li>
        <li><a href="#tabs-2">Site/Cadastro</a></li>
		<li><a href="#tabs-3">Descrições </a></li>
        <li><a href="#tabs-6">Imagem </a></li>
         <li><a href="#tabs-7" title=" Relacionar  Produtos ">Site/Relacionar  </a></li>

	</ul>
	<div id="tabs-1">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	        <tr>
	          <td align="left" class="txt-opcoes">Ativo</td>
	          <td colspan="2" align="left" class="txt"><select name="ativo" id="ativo" disabled>
	            <option value="" <?php if (!(strcmp("", $row_list_acao['ativo']))) {echo "selected=\"selected\"";} ?>>---</option>
	            <option value="1" <?php if (!(strcmp(1, $row_list_acao['ativo']))) {echo "selected=\"selected\"";} ?>>SIM</option>
	            <option value="2" <?php if (!(strcmp(2, $row_list_acao['ativo']))) {echo "selected=\"selected\"";} ?>>N&Atilde;O</option>
	            </select></td>
	          </tr>
	        <tr>
	          <td width="28%" align="left" class="txt-opcoes">Setor </td>
	          <td colspan="2" align="left" class="txt"><select name="id_setor" id="id_setor" disabled>
	            <option value="" <?php if (!(strcmp("", $row_list_acao['id_setor']))) {echo "selected=\"selected\"";} ?>>---</option>
	            <?php
do {  
?>
	            <option value="<?php echo $row_list_setor['id_setor']?>"<?php if (!(strcmp($row_list_setor['id_setor'], $row_list_acao['id_setor']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_setor['nome_setor']?></option>
	            <?php
} while ($row_list_setor = mysql_fetch_assoc($list_setor));
  $rows = mysql_num_rows($list_setor);
  if($rows > 0) {
      mysql_data_seek($list_setor, 0);
	  $row_list_setor = mysql_fetch_assoc($list_setor);
  }
?>
	            </select></td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Categoria
	            <input type="hidden" name="id_categoria" id="id_categoria">
	            <input type="hidden" name="id_subcategoria" id="id_subcategoria"></td>
	          <td width="45%" align="left" class="txt" id="selec_categoria"><?php
			  $_POST['id_setor']= $row_list_acao['id_setor'];
			  $_POST['id_categoria']= $row_list_acao['id_categoria']; 
			   include("../mod_empresa_produtos/acao_comum_categoria.php"); ?></td>
	          <td width="27%" align="left" class="txt"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt">
	            <tr>
	              <td align="left">&nbsp;</td>
	              </tr>
	            </table></td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes" >Subcategoria</td>
	          <td colspan="2" align="left" class="txt" id="selec_subcategoria"><?php $_POST['id_subcategoria']= $row_list_acao['id_subcategoria']; include("../mod_empresa_produtos/acao_comum_subcategoria.php"); ?></td>
	          </tr>
	        <tr>
	          <td align="left" class="txt">&nbsp;</td>
	          <td align="left" class="txt">&nbsp;</td>
	          <td align="left" class="txt">&nbsp;</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">ISBN</td>
	          <td align="left" class="txt">
	            <input disabled name="codigo_isbn" type="text" id="codigo_isbn2" value="<?php echo $row_list_acao['codigo_isbn']; ?>"></td>
	          <td align="left" class="txt">&nbsp;</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Fabricante</td>
	          <td colspan="2" align="left" class="txt"><select name="id_marca" id="id_marca" disabled>
	            <option value="" <?php if (!(strcmp("", $row_list_acao['id_marca']))) {echo "selected=\"selected\"";} ?>>---</option>
	            <?php
do {  
?>
	            <option value="<?php echo $row_list_marcas['id_marca']?>"<?php if (!(strcmp($row_list_marcas['id_marca'], $row_list_acao['id_marca']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_marcas['nome_marca']?></option>
	            <?php
} while ($row_list_marcas = mysql_fetch_assoc($list_marcas));
  $rows = mysql_num_rows($list_marcas);
  if($rows > 0) {
      mysql_data_seek($list_marcas, 0);
	  $row_list_marcas = mysql_fetch_assoc($list_marcas);
  }
?>
	            </select></td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Cores</td>
	          <td colspan="2" align="left" class="txt"><select name="id_cores" id="id_cores" disabled>
	            <option value="" <?php if (!(strcmp("", $row_list_acao['id_cores']))) {echo "selected=\"selected\"";} ?>>---</option>
	            <?php
do {  
?>
	            <option value="<?php echo $row_list_cores['id_cores']?>"<?php if (!(strcmp($row_list_cores['id_cores'], $row_list_acao['id_cores']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_cores['nome_cores']?></option>
	            <?php
} while ($row_list_cores = mysql_fetch_assoc($list_cores));
  $rows = mysql_num_rows($list_cores);
  if($rows > 0) {
      mysql_data_seek($list_cores, 0);
	  $row_list_cores = mysql_fetch_assoc($list_cores);
  }
?>
	            </select></td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Volt:</td>
	          <td colspan="2" align="left" class="txt"><select name="id_volt" disabled  id="id_volt" required>
	            <option value="" <?php if (!(strcmp("", $row_list_acao['id_volt']))) {echo "selected=\"selected\"";} ?>>---</option>
	            <?php
do {  
?>
	            <option value="<?php echo $row_list_volt['id_volt']?>"<?php if (!(strcmp($row_list_volt['id_volt'], $row_list_acao['id_volt']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_volt['xNome']?></option>
	            <?php
} while ($row_list_volt = mysql_fetch_assoc($list_volt));
  $rows = mysql_num_rows($list_volt);
  if($rows > 0) {
      mysql_data_seek($list_volt, 0);
	  $row_list_volt = mysql_fetch_assoc($list_volt);
  }
?>
	            </select></td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">&nbsp;</td>
	          <td align="left" class="txt">&nbsp;</td>
	          <td align="left" class="txt">&nbsp;</td>
	          </tr>
	        </table>
	        &nbsp;.</td>
	      <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	        <tr>
	          <td align="left" class="txt-opcoes">Unidade de Medida</td>
	          <td align="left" class="txt"><select name="id_produto_undd" id="id_produto_undd" disabled>
	            <option value="" <?php if (!(strcmp("", $row_list_acao['id_produtos_unidd']))) {echo "selected=\"selected\"";} ?>>---</option>
	            <?php
do {  
?>
	            <option value="<?php echo $row_list_unidd['id_class']?>"<?php if (!(strcmp($row_list_unidd['id_class'], $row_list_acao['id_produtos_unidd']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_unidd['xNome']?></option>
	            <?php
} while ($row_list_unidd = mysql_fetch_assoc($list_unidd));
  $rows = mysql_num_rows($list_unidd);
  if($rows > 0) {
      mysql_data_seek($list_unidd, 0);
	  $row_list_unidd = mysql_fetch_assoc($list_unidd);
  }
?>
	            </select></td>
	          <td align="left" class="txt">&nbsp;</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Peso</td>
	          <td align="left" class="txt"><input name="peso" type="text" class="msk_money_br" id="peso" value="<?php echo converter_numero_moeda($row_list_acao['peso']); ?>" disabled /></td>
	          <td align="left" class="txt">&quot;Kg&quot;</td>
	          </tr>
	        <tr>
	          <td colspan="3" align="left" class="txt">Consulte sua empresa de 'transporte' se é necessario inserir as dimenções do produto para calcular o 'frete'.</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Altura - y </td>
	          <td align="left" class="txt"><input name="dim_alt_y" type="text" class="msk_money_br" id="dim_alt_y" value="<?php echo converter_numero_moeda($row_list_acao['dim_alt_y']); ?>" disabled /></td>
	          <td align="left" class="txt">&quot;Centrimetro&quot;</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Largura - x</td>
	          <td align="left" class="txt"><input name="dim_larg_x" type="text" class="msk_money_br" id="dim_larg_x" value="<?php echo converter_numero_moeda($row_list_acao['dim_larg_x']); ?>" disabled /></td>
	          <td align="left" class="txt">&quot;Centrimetro&quot;</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Profundidade - z</td>
	          <td align="left" class="txt"><input name="dim_prop_z" type="text" class="msk_money_br" id="dim_prop_z" value="<?php echo converter_numero_moeda($row_list_acao['dim_prop_z']); ?>" disabled/></td>
	          <td align="left" class="txt">&quot;Centrimetro&quot;</td>
	          </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	          </tr>
	        </table></td>
	      </tr>
	    </table>
	  <br>
<br>
<br>
<br>

    	</div>
    <div id="tabs-2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" class="txt-opcoes">Quantidade Minima</td>
        <td colspan="3" align="left" class="txt"><label>
          <input name="qtdd_mm" type="text"  id="qtdd_mm" disabled value="<?php echo $row_list_acao['qtdd_mm']; ?>" />
        </label></td>
      </tr>
      <tr>
        <td width="25%" align="left" class="txt-opcoes">Vitrine:</td>
        <td align="left" class="txt"><label>
          <select name="vitrine" id="vitrine" disabled>
            <option value="nao" <?php if (!(strcmp("nao", $row_list_acao['vitrine']))) {echo "selected=\"selected\"";} ?>>Selecione</option>
            <option value="1" <?php if (!(strcmp(1, $row_list_acao['vitrine']))) {echo "selected=\"selected\"";} ?>>SIM</option>
            <option value="2" <?php if (!(strcmp(2, $row_list_acao['vitrine']))) {echo "selected=\"selected\"";} ?>>N&Atilde;O</option>
          </select>
        </label></td>
        <td width="22%">&nbsp;</td>
        <td width="6%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="center" class="txt-indece-titulo">Vendas</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor:</td>
        <td align="left" class="txt"><input name="valor" type="text" disabled class="msk_money_br" id="valor" value="<?php echo converter_numero_moeda($row_list_acao['valor']); ?>" /></td>
        <td colspan="2">Cliente não cadastrado</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor Promo&ccedil;&atilde;o:</td>
        <td align="left" class="txt"><input name="valor_promocao" type="text" disabled class="msk_money_br" id="valor_promocao" value="<?php echo converter_numero_moeda($row_list_acao['valor_promocao']); ?>" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 1</td>
        <td align="left" class="txt"><input name="valor_1" type="text" disabled class="msk_money_br" id="valor_1" value="<?php echo converter_numero_moeda($row_list_acao['valor_1']); ?>" /></td>
        <td colspan="2">1º nivel do cliente</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 2</td>
        <td align="left" class="txt"><input name="valor_2" type="text" disabled class="msk_money_br" id="valor_2" value="<?php echo converter_numero_moeda($row_list_acao['valor_2']); ?>" /></td>
        <td colspan="2">2º nivel do cliente</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 3</td>
        <td align="left" class="txt"><input name="valor_3" type="text" disabled class="msk_money_br" id="valor_3" value="<?php echo converter_numero_moeda($row_list_acao['valor_3']); ?>" /></td>
        <td colspan="2">3º nivel do cliente</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 4</td>
        <td align="left" class="txt"><input name="valor_4" type="text" disabled class="msk_money_br" id="valor_4" value="<?php echo converter_numero_moeda($row_list_acao['valor_4']); ?>" /></td>
        <td colspan="2">4º nivel do cliente</td>
      </tr>
      <tr>
        <td align="left" class="txt-opcoes">&nbsp;</td>
        <td align="left" class="txt">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td colspan="4" align="center" class="txt-opcoes">Forma de pagamento</td>
        </tr>
      <tr>
        <td colspan="4" align="left" class="txt">
        
                    <textarea name="valor_parcelas" cols="80" rows="10" disabled class="editor" id="valor_parcelas" tabindex="1"><?php echo $row_list_acao['valor_parcelas']; ?></textarea>
		  <script>
          CKEDITOR.replace( 'valor_parcelas', {
          toolbar :'basic'
          });
          </script>
        
        </td>
        </tr>
    </table>
     </div>
	<div id="tabs-3">
    
    
    <div id="TabbedPanels1" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
         <li class="TabbedPanelsTab" tabindex="0">
          <DIV class="txt" >
		  Descrição Produto
          </DIV>
          </li>
         
        <li class="TabbedPanelsTab" tabindex="0" >
        <DIV class="txt" >
		Descrição Tecnica
        </DIV>
        </li>
        
        </ul>
        <div class="TabbedPanelsContentGroup">
           <div class="TabbedPanelsContent">
             <textarea name="descricao_produto" cols="80" rows="10" disabled class="editor" id="descricao_produto" style="height:600px;" tabindex="1"><?php echo $row_list_acao['descricao_produto']; ?></textarea>
             <script>
          CKEDITOR.replace( 'descricao_produto', {
          toolbar :'basic'
          });
          </script>
           </div>
         <?php if ($cliente_mod_produtos_desc_tec==1){ ?>
          <div class="TabbedPanelsContent"> 
          <textarea class="editor" cols="80" id="descricao_tecnica" disabled name="descricao_tecnica" rows="10" tabindex="1"><?php echo $row_list_acao['descricao_tecnica']; ?></textarea>
		  <script>
          CKEDITOR.replace( 'descricao_tecnica', {
          toolbar :'basic'
	       });
          </script>
           </div><?php } ?>

      </div>
    
    
    
    
    
     </div>
     <div  style="clear:both;"></div>
      </div>  	
    <div id="tabs-6"><br>
<br>
<?php include("acao_alt_imagens_banco.php");  ?>
<?php include("acao_edit_imagens.php"); ?>
<br>
<br>
    </div>
    <div id="tabs-7">
<br>
Em Desenvolvimento
<br>
<br>
<br>
    </div>
    
    
      </td>
    </tr>
    
    <tr>
      <td colspan="4" align="center">
      <input id="voltar" class="txt-Botao-voltar" type="button" value="|< Voltar" onclick="javascript:history.back()" name="voltar">
        <input name="SALVAR" type="submit" class="txt-Botao-Excluir" id="EXCLUIR" value="EXCLUIR">
      </td>
    </tr>
  </table>
</form>
<?php 


switch($_GET['alt_quadro']){
	case 'alt_setor':
	include "produtos_acao_alt_list_setor.php";
	break;
	case 'alt_cat':
		include "produtos_acao_alt_list_categoria.php";
	break;
	case 'alt_sub':
		include "produtos_acao_alt_list_subcategoria.php";
	break;
	case 'alt_concluido':
		include "produtos_acao_alt_res.php";
	break;
	
}




?>

<?php 
//envio de resposta do formulario
if ($_POST['res']=='res'){include "res_exc.php";}


mysql_free_result($list_cores);

mysql_free_result($list_setor);

mysql_free_result($list_volt);

mysql_free_result($list_marcas);

mysql_free_result($list_acao);

mysql_free_result($list_unidd);




?>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
