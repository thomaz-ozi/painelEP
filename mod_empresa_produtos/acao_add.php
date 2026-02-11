<?php 
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
   $insertSQL = sprintf("INSERT INTO tbnext_produtos (id_produtos, id_local, id_usuario, id_setor, id_categoria, id_subcategoria, id_volt, id_marca, id_cores, codigo_barra, codigo_isbn, nome_produto, palavra_pesquisa, descricao_produto, descricao_tecnica, valor, valor_promocao, valor_1, valor_2, valor_3, valor_4, valor_parcelas, vitrine, peso, qtdd_mm,id_produtos_unidd, dim_alt_y, dim_larg_x, dim_prop_z, ativo, prod_serv) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_produtos'], "int"),
                       GetSQLValueString($_POST['id_local'], "int"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['id_setor'], "int"),
                       GetSQLValueString($_POST['id_categoria'], "int"),
                       GetSQLValueString($_POST['id_subcategoria'], "int"),
                       GetSQLValueString($_POST['id_volt'], "int"),
                       GetSQLValueString($_POST['id_marca'], "int"),
                       GetSQLValueString($_POST['id_cores'], "int"),
                       GetSQLValueString($_POST['codigo_barra'], "text"),
                       GetSQLValueString($_POST['codigo_isbn'], "text"),
                       GetSQLValueString($_POST['nome_produto'], "text"),
                       GetSQLValueString($_POST['palavra_pesquisa'], "text"),
                       GetSQLValueString($_POST['descricao_produto'], "text"),
                       GetSQLValueString($_POST['descricao_tecnica'], "text"),
                       GetSQLValueString($_POST['valor'], "double"),
                       GetSQLValueString($_POST['valor_promocao'], "double"),
                       GetSQLValueString($_POST['valor_1'], "double"),
                       GetSQLValueString($_POST['valor_2'], "double"),
                       GetSQLValueString($_POST['valor_3'], "double"),
                       GetSQLValueString($_POST['valor_4'], "double"),
                       GetSQLValueString($_POST['valor_parcelas'], "text"),
                       GetSQLValueString($_POST['vitrine'], "int"),
                       GetSQLValueString($_POST['peso'], "double"),
                       GetSQLValueString($_POST['qtdd_mm'], "text"),
					   GetSQLValueString($_POST['id_produtos_unidd'], "int"),
                       GetSQLValueString($_POST['dim_alt_y'], "double"),
                       GetSQLValueString($_POST['dim_larg_x'], "double"),
                       GetSQLValueString($_POST['dim_prop_z'], "double"),
                       GetSQLValueString($_POST['ativo'], "int"),
                       GetSQLValueString($_POST['prod_serv'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
  
  
  mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT id_produtos FROM tbnext_produtos ORDER BY id_produtos DESC";
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
$_POST['id_produtos']=$row_list_acao['id_produtos']; 
  
  include("../mod_empresa_produtos/acao_comum.php");
}


mysql_select_db($database_connection, $connection);
$query_list_cores = "SELECT * FROM tbnext_produtos_cores ORDER BY nome_cores ASC";
$list_cores = mysql_query($query_list_cores, $connection) or die(mysql_error());
$row_list_cores = mysql_fetch_assoc($list_cores);
$totalRows_list_cores = mysql_num_rows($list_cores);
$colname_list_setor = "-1";


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

mysql_select_db($database_connection, $connection);
$query_list_unidd = "SELECT * FROM tbnext_produtos_unidd WHERE prod_serv!='2' ORDER BY xNome ASC";
$list_unidd = mysql_query($query_list_unidd, $connection) or die(mysql_error());
$row_list_unidd = mysql_fetch_assoc($list_unidd);
$totalRows_list_unidd = mysql_num_rows($list_unidd);

mysql_select_db($database_connection, $connection);
$query_list_setor = "SELECT * FROM tbnext_produtos_setor ORDER BY nome_setor ASC";
$list_setor = mysql_query($query_list_setor, $connection) or die(mysql_error());
$row_list_setor = mysql_fetch_assoc($list_setor);
$totalRows_list_setor = mysql_num_rows($list_setor);

?>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<?php include("acao_alt_imagens_banco.php");  ?>
<script src="<?php echo $conf_url; ?>script.js"></script>

<form action="<?php echo $editFormAction; ?>" name="acao" method="POST">
<?php 
$acao_comum="Adicionar";
$acao_icons="add-30.png";
include ("../sistema/index_content_head.php");?>
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    
    <tr>
      <td  colspan="4" align="center" valign="top" class="txt"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="16%" align="left" class="txt-opcoes">Cod Barra</td>
          <td colspan="3" align="left" class="txt"><input name="codigo_barra" type="text"  id="codigo_barra" /></td>
          <td width="11%" rowspan="2" class="txt-opcoes">Palavra p/ pesquisa na web</td>
          <td width="40%" rowspan="2">
          <textarea id="palavra_pesquisa" style="width:270px; height:35px;"  required name="palavra_pesquisa"></textarea>
          
          </td>
          </tr>
        <tr>
          <td align="left" class="txt-opcoes"><?php echo $cliente_mod_produtos_nome_produtos; ?>*:
            <input type="hidden" name="id_produtos" id="id_produtos">
            <input type="hidden" name="id_local"  id="id_local" value="<?php echo  $_SESSION['LOCAL']; ?>" />
<input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
            <input name="res" type="hidden" id="res" value="res" />
            <input name="prod_serv" type="hidden" id="prod_serv" value="1">
            <input name="list" type="hidden" id="list" value="pro" /></td>
          <td colspan="3" align="left" class="txt">
            <input name="nome_produto" type="text"  id="nome_produto"  style=" width:250px;" required>
          </td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td  colspan="4" align="center" valign="top" class="txt">
    <div id="tabs">
	<ul>
		<li><a href="#tabs-1">Padrão</a></li>
        <li><a href="#tabs-2">Web/Cadastro</a></li>
		<li><a href="#tabs-3">Web/Descrição </a></li>
        <li><a href="#tabs-6">Web/Imagem </a></li>

	</ul>
	<div id="tabs-1"><br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" class="txt-opcoes">Estatus</td>
            <td colspan="2" align="left" class="txt"><select name="ativo" id="ativo" required>
              <option>---</option>
              <option value="1">Ativo</option>
              <option value="2">Inativo</option>
              <option value="3">Sub Consulta</option>
            </select></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="txt-opcoes">Setor </td>
            <td colspan="2" align="left" class="txt"><select name="id_setor" id="id_setor" required>
              <option value="">---</option>
              <?php
do {  
?>
              <option value="<?php echo $row_list_setor['id_setor']?>"><?php echo $row_list_setor['nome_setor']?></option>
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
            <td align="left" class="txt-opcoes">Categoria </td>
            <td width="45%" align="left" class="txt" id="selec_categoria">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td width="27%" align="left" class="txt"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt">
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left" class="txt-opcoes" >Subcategoria</td>
            <td colspan="2" align="left" class="txt" id="selec_subcategoria">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" class="txt">&nbsp;</td>
            <td align="left" class="txt">&nbsp;</td>
            <td align="left" class="txt">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" class="txt-opcoes">ISBN</td>
            <td align="left" class="txt"><label for="codigo_isbn2"></label>
              <input type="text" name="codigo_isbn" id="codigo_isbn2"></td>
            <td align="left" class="txt">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" class="txt-opcoes">Fabricante</td>
            <td colspan="2" align="left" class="txt"><select name="id_marca" id="id_marca">
              <option value="">---</option>
              <?php
do {  
?>
              <option value="<?php echo $row_list_marcas['id_marca']?>"><?php echo $row_list_marcas['nome_marca']?></option>
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
            <td colspan="2" align="left" class="txt"><select name="id_cores" id="id_cores">
              <option value="">---</option>
              <?php
do {  
?>
              <option value="<?php echo $row_list_cores['id_cores']?>"><?php echo $row_list_cores['nome_cores']?></option>
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
            <td colspan="2" align="left" class="txt"><select name="id_volt" id="id_volt" required>
              <option value="" <?php if (!(strcmp("", $row_list_produtos['volt']))) {echo "selected=\"selected\"";} ?>>---</option>
              <?php
do {  
?>
              <option value="<?php echo $row_list_volt['id_volt']?>"<?php if (!(strcmp($row_list_volt['id_volt'], $row_list_produtos['volt']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_volt['xNome']?></option>
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
            <td align="left" class="txt"><select name="id_produtos_unidd" id="id_produtos_unidd">
              <option value="">---</option>
              <?php
do {  
?>
              <option value="<?php echo $row_list_unidd['id_class']?>"><?php echo $row_list_unidd['xNome']?></option>
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
            <td align="left" class="txt"><input name="peso" type="text" class="msk_money_br" id="peso" required  /></td>
            <td align="left" class="txt">&quot;Kg&quot;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" class="txt">Consulte sua empresa de 'transporte' se é necessario inserir as dimenções do produto para calcular o 'frete'.</td>
            </tr>
          <tr>
            <td align="left" class="txt-opcoes">Altura - y </td>
            <td align="left" class="txt"><input name="dim_alt_y" type="text" class="msk_money_br" id="dim_alt_y" /></td>
            <td align="left" class="txt">&quot;Centrimetro&quot;</td>
          </tr>
          <tr>
            <td align="left" class="txt-opcoes">Largura - x</td>
            <td align="left" class="txt"><input name="dim_larg_x" type="text" class="msk_money_br" id="dim_larg_x" /></td>
            <td align="left" class="txt">&quot;Centrimetro&quot;</td>
          </tr>
          <tr>
            <td align="left" class="txt-opcoes">Profundidade - z</td>
            <td align="left" class="txt"><input name="dim_prop_z" type="text" class="msk_money_br" id="dim_prop_z" /></td>
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

    	</div>
    <div id="tabs-2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" class="txt-opcoes">Quantidade Minima</td>
        <td colspan="3" align="left" class="txt"><label>
          <input name="qtdd_mm" type="text"  id="qtdd_mm" />
        </label></td>
      </tr>
      <tr>
        <td width="25%" align="left" class="txt-opcoes">Vitrine:</td>
        <td align="left" class="txt"><label>
          <select name="vitrine"  id="vitrine">
<option value="2">N&Atilde;O</option>
<option value="1">SIM</option>
          </select>
        </label></td>
        <td width="22%">&nbsp;</td>
        <td width="6%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="center" class="txt-indece-titulo">Vendas</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor: - Site</td>
        <td align="left" class="txt"><input name="valor" type="text" class="msk_money_br" id="valor" /></td>
        <td colspan="2">Cliente não cadastrado</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor Promo&ccedil;&atilde;o: - Site</td>
        <td align="left" class="txt"><input name="valor_promocao" type="text" class="msk_money_br" id="valor_promocao" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 1</td>
        <td align="left" class="txt"><input name="valor_1" type="text" class="msk_money_br" id="valor_1" /></td>
        <td colspan="2">1º nivel do cliente</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 2</td>
        <td align="left" class="txt"><input name="valor_2" type="text" class="msk_money_br" id="valor_2" /></td>
        <td colspan="2">2º nivel do cliente</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 3</td>
        <td align="left" class="txt"><input name="valor_3" type="text" class="msk_money_br" id="valor_3" /></td>
        <td colspan="2">3º nivel do cliente</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 4</td>
        <td align="left" class="txt"><input name="valor_4" type="text" class="msk_money_br" id="valor_4" /></td>
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
        <td colspan="4" align="left" class="txt"><script>
          CKEDITOR.replace( 'valor_parcelas', {
          toolbar :'basic'
          });
          </script>
        
        </td>
        </tr>
    </table>
     </div>
	<div id="tabs-3">
    
      <div id="loadDescricaolist">
    <?php include ("../mod_empresa_produtos/index_descricao.php");?>
  
  </div>
     <div  style="clear:both;"></div>
      </div>  	
    <div id="tabs-6"><br>
<br>


    A inserção das imagens só ocorrerá na opção de alterar o cadasto. 
    <br>
<br>
    </div>
    
    
      </td>
    </tr>
   </table>
  <input type="hidden" name="MM_insert" value="acao">
  <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
      </div>
    </div>
</form>

<?php 
//envio de resposta do formulario
if ($_POST['res']=='res'){include "res_add.php";}


mysql_free_result($list_cores);

mysql_free_result($list_volt);

mysql_free_result($list_marcas);

mysql_free_result($list_unidd);

mysql_free_result($list_setor);




?>
<div id="loadDescricao"></div>