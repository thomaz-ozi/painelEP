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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
  $updateSQL = sprintf("UPDATE tbnext_produtos SET id_setor=%s, id_categoria=%s, id_subcategoria=%s, id_marca=%s, id_cores=%s, codigo_isbn=%s, nome_produto=%s, descricao_produto=%s, descricao_tecnica=%s, valor=%s, valor_promocao=%s, valor_parcelas=%s, vitrine=%s, qtdd_mm=%s, id_local=%s, peso=%s, palavra_pesquisa=%s, codigo_barra=%s, id_usuario=%s, ativo=%s, id_volt=%s, id_produtos_unidd=%s, dim_alt_y=%s, dim_larg_x=%s, dim_prop_z=%s, valor_1=%s, valor_2=%s, valor_3=%s, valor_4=%s, valor_ativo=%s, valor_1_ativo=%s, valor_2_ativo=%s, valor_3_ativo=%s, valor_4_ativo=%s WHERE id_produtos=%s",
                       GetSQLValueString($_POST['id_setor'], "int"),
                       GetSQLValueString($_POST['id_categoria'], "int"),
                       GetSQLValueString($_POST['id_subcategoria'], "int"),
                       GetSQLValueString($_POST['id_marca'], "int"),
                       GetSQLValueString($_POST['id_cores'], "int"),
                       GetSQLValueString($_POST['codigo_isbn'], "text"),
                       GetSQLValueString($_POST['nome_produto'], "text"),
                       GetSQLValueString($_POST['descricao_produto'], "text"),
                       GetSQLValueString($_POST['descricao_tecnica'], "text"),
                       GetSQLValueString($_POST['valor'], "double"),
                       GetSQLValueString($_POST['valor_promocao'], "double"),
                       GetSQLValueString($_POST['valor_parcelas'], "text"),
                       GetSQLValueString($_POST['vitrine'], "int"),
                       GetSQLValueString($_POST['qtdd_mm'], "text"),
                       GetSQLValueString($_POST['id_local'], "int"),
                       GetSQLValueString($_POST['peso'], "double"),
                       GetSQLValueString($_POST['palavra_pesquisa'], "text"),
                       GetSQLValueString($_POST['codigo_barra'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['ativo'], "int"),
                       GetSQLValueString($_POST['id_volt'], "int"),
                       GetSQLValueString($_POST['id_produtos_unidd'], "int"),
                       GetSQLValueString($_POST['dim_alt_y'], "double"),
                       GetSQLValueString($_POST['dim_larg_x'], "double"),
                       GetSQLValueString($_POST['dim_prop_z'], "double"),
                       GetSQLValueString($_POST['valor_1'], "double"),
                       GetSQLValueString($_POST['valor_2'], "double"),
                       GetSQLValueString($_POST['valor_3'], "double"),
                       GetSQLValueString($_POST['valor_4'], "double"),
					   GetSQLValueString(isset($_POST['valor_ativo']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['valor_1_ativo']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['valor_2_ativo']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['valor_3_ativo']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['valor_4_ativo']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_produtos'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
  
  include("../mod_empresa_produtos/acao_comum.php");
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
$query_list_unidd = "SELECT * FROM tbnext_produtos_unidd WHERE prod_serv!='2' ORDER BY xNome ASC";
$list_unidd = mysql_query($query_list_unidd, $connection) or die(mysql_error());
$row_list_unidd = mysql_fetch_assoc($list_unidd);
$totalRows_list_unidd = mysql_num_rows($list_unidd);





?>



<script src="<?php echo $conf_url; ?>script.js"></script>

<form action="<?php echo $editFormAction; ?>" name="acao" method="POST">
<?php 
$acao_comum="Alterar";
$acao_icons="alt-30.png";
include ("../sistema/index_content_head.php");?>
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    
    <tr>
      <td  colspan="4" align="center" valign="top" class="txt"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="16%" align="left" class="txt-opcoes">Cod Barra</td>
          <td colspan="3" align="left" class="txt"><input name="codigo_barra" type="text" class="form-control" id="codigo_barra" value="<?php echo $row_list_acao['codigo_barra']; ?>" />
            </td>
          <td width="14%" rowspan="2" class="txt-opcoes">Palavra p/ pesquisa na web</td>
          <td width="38%" rowspan="2">
          <textarea id="palavra_pesquisa"  class="form-control" style=" height:35px;"  required name="palavra_pesquisa"><?php echo $row_list_acao['palavra_pesquisa']; ?></textarea>
          
          </td>
          </tr>
        <tr>
          <td align="left" class="txt-opcoes"><?php echo $cliente_mod_produtos_nome_produtos; ?>*:
            <input name="id_produtos" type="hidden" id="id_produtos" value="<?php echo $id_produtos=$row_list_acao['id_produtos']; ?>">
            <input type="hidden" name="id_local"  id="id_local" value="<?php echo  $_SESSION['LOCAL']; ?>" />
<input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
            <input name="res" type="hidden" id="res" value="res" />
            <input name="list" type="hidden" id="list" value="pro" /></td>
          <td colspan="3" align="left" class="txt">
            <input name="nome_produto" type="text" required  id="nome_produto" class="form-control" value="<?php echo $row_list_acao['nome_produto']; ?>">
          </td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td  colspan="4" align="center" valign="top" class="txt">
    <div id="tabs">
	<ul>
		<li><a href="#tabs-1">Padrão</a></li>
        <li><a href="#tabs-2">Cadastro</a></li>
		<li><a href="#tabs-3">Descrições </a></li>
        <li><a href="#tabs-6">Imagem </a></li>
         <li><a href="#tabs-8" title=" Imposto ">Imposto </a></li>

	</ul>
	<div id="tabs-1">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	        <tr>
	          <td align="left" class="txt-opcoes">Estatus</td>
	          <td colspan="2" align="left" class="txt"><select name="ativo" id="ativo" required>
	            <option value="" <?php if (!(strcmp("", $row_list_acao['ativo']))) {echo "selected=\"selected\"";} ?>>---</option>
	            <option value="1" <?php if (!(strcmp(1, $row_list_acao['ativo']))) {echo "selected=\"selected\"";} ?>>Ativo</option>
	            <option value="2" <?php if (!(strcmp(2, $row_list_acao['ativo']))) {echo "selected=\"selected\"";} ?>>Inativo</option>
	            <option value="3" <?php if (!(strcmp(3, $row_list_acao['ativo']))) {echo "selected=\"selected\"";} ?>>Sob Consulta</option>
	            </select></td>
	          </tr>
	        <tr>
	          <td width="28%" align="left" class="txt-opcoes">Setor </td>
	          <td colspan="2" align="left" class="txt"><select name="id_setor" id="id_setor" required>
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
	          <td align="left" class="txt"><label for="codigo_isbn2"></label>
	            <input name="codigo_isbn" type="text" id="codigo_isbn2" value="<?php echo $row_list_acao['codigo_isbn']; ?>"></td>
	          <td align="left" class="txt">&nbsp;</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Fabricante</td>
	          <td colspan="2" align="left" class="txt"><select name="id_marca" id="id_marca">
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
	          <td colspan="2" align="left" class="txt"><select name="id_cores" id="id_cores">
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
	          <td colspan="2" align="left" class="txt"><select name="id_volt" id="id_volt" required>
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
	          <td align="left" class="txt"><select name="id_produtos_unidd" id="id_produtos_unidd" required  >
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
	          <td align="left" class="txt"><input name="peso" type="text" class="msk_money_br" id="peso" value="<?php echo converter_numero_moeda($row_list_acao['peso']); ?>" required   /></td>
	          <td align="left" class="txt">&quot;Kg&quot;</td>
	          </tr>
	        <tr>
	          <td colspan="3" align="left" class="txt">Consulte sua empresa de 'transporte' se é necessario inserir as dimenções do produto para calcular o 'frete'.</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Altura - y </td>
	          <td align="left" class="txt"><input name="dim_alt_y" type="text" class="msk_money_br" id="dim_alt_y" value="<?php echo converter_numero_moeda($row_list_acao['dim_alt_y']); ?>" /></td>
	          <td align="left" class="txt">&quot;Centrimetro&quot;</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Largura - x</td>
	          <td align="left" class="txt"><input name="dim_larg_x" type="text" class="msk_money_br" id="dim_larg_x" value="<?php echo converter_numero_moeda($row_list_acao['dim_larg_x']); ?>" /></td>
	          <td align="left" class="txt">&quot;Centrimetro&quot;</td>
	          </tr>
	        <tr>
	          <td align="left" class="txt-opcoes">Profundidade - z</td>
	          <td align="left" class="txt"><input name="dim_prop_z" type="text" class="msk_money_br" id="dim_prop_z" value="<?php echo converter_numero_moeda($row_list_acao['dim_prop_z']); ?>" /></td>
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
        <td colspan="4" align="left" class="txt"><label>
          <input name="qtdd_mm" type="text"  id="qtdd_mm" value="<?php echo $row_list_acao['qtdd_mm']; ?>" />
        </label></td>
      </tr>
      <tr>
        <td width="25%" align="left" class="txt-opcoes">Vitrine:</td>
        <td colspan="2" align="left" class="txt"><label>
          <select name="vitrine" id="vitrine">
            <option value="nao" <?php if (!(strcmp("nao", $row_list_acao['vitrine']))) {echo "selected=\"selected\"";} ?>>Selecione</option>
            <option value="1" <?php if (!(strcmp(1, $row_list_acao['vitrine']))) {echo "selected=\"selected\"";} ?>>SIM</option>
            <option value="2" <?php if (!(strcmp(2, $row_list_acao['vitrine']))) {echo "selected=\"selected\"";} ?>>N&Atilde;O</option>
          </select>
        </label></td>
        <td width="22%">&nbsp;</td>
        <td width="6%">&nbsp;</td>
      </tr>

      <tr>
        <td colspan="5" align="center" class="txt-opcoes"><center>Varejo</center></td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor: </td>
        <td align="left" class="txt"><input name="valor" type="text" class="msk_money_br" id="valor" value="<?php echo converter_numero_moeda($row_list_acao['valor']); ?>" /></td>
        <td align="left" class="txt">
                             
        <input <?php if (!(strcmp($row_list_acao['valor_ativo'],1))) {echo "checked=\"checked\"";} ?> name="valor_ativo" type="checkbox" class="flat" id="valor_ativo" value="1">   
Ativo </td>
        <td colspan="2">Cliente não cadastrado</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor &quot;Promoção&quot;</td>
        <td colspan="2" align="left" class="txt"><input name="valor_promocao" type="text" class="msk_money_br" id="valor_promocao" value="<?php echo converter_numero_moeda($row_list_acao['valor_promocao']); ?>" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="5" align="center" class="txt-opcoes"><center>Atacado</center></td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 1 %</td>
        <td width="23%" align="left" class="txt"><input name="valor_1" type="text" class="msk_money_br" id="valor_1" value="<?php echo converter_numero_moeda($row_list_acao['valor_1']); ?>" /></td>
        <td width="24%" align="left" class="txt"><input class="flat" <?php if (!(strcmp($row_list_acao['valor_1_ativo'],1))) {echo "checked=\"checked\"";} ?> name="valor_1_ativo" type="checkbox" id="valor_1_ativo" value="1">
          Ativo
          </td>
        <td colspan="2">1º nivel do cliente</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 2 %</td>
        <td align="left" class="txt"><input name="valor_2" type="text" class="msk_money_br" id="valor_2" value="<?php echo converter_numero_moeda($row_list_acao['valor_2']); ?>" /></td>
        <td align="left" class="txt"><input class="flat" <?php if (!(strcmp($row_list_acao['valor_2_ativo'],1))) {echo "checked=\"checked\"";} ?> name="valor_2_ativo" type="checkbox" id="valor_2_ativo" value="1">
Ativo </td>
        <td colspan="2">2º nivel do cliente</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 3 %</td>
        <td align="left" class="txt"><input name="valor_3" type="text" class="msk_money_br" id="valor_3" value="<?php echo converter_numero_moeda($row_list_acao['valor_3']); ?>" /></td>
        <td align="left" class="txt"><input class="flat" <?php if (!(strcmp($row_list_acao['valor_3_ativo'],1))) {echo "checked=\"checked\"";} ?> name="valor_3_ativo" type="checkbox" id="valor_3_ativo" value="1">
Ativo </td>
        <td colspan="2">3º nivel do cliente</td>
        </tr>
      <tr>
        <td align="left" class="txt-opcoes">Valor 4 %</td>
        <td align="left" class="txt"><input name="valor_4" type="text" class="msk_money_br" id="valor_4" value="<?php echo converter_numero_moeda($row_list_acao['valor_4']); ?>" /></td>
        <td align="left" class="txt"><input class="flat" <?php if (!(strcmp($row_list_acao['valor_4_ativo'],1))) {echo "checked=\"checked\"";} ?> name="valor_4_ativo" type="checkbox" id="valor_4_ativo" value="1">
Ativo </td>
        <td colspan="2">4º nivel do cliente</td>
      </tr>
      <tr>
        <td align="left" class="txt">&nbsp;</td>
        <td colspan="2" align="left" class="txt">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        </tr>
    </table>
     </div>
	<div id="tabs-3">
    <div id="loadDescricaolist">
    <?php include ("../mod_empresa_produtos/index_descricao.php");?>
  
  </div>
      </div>
    
    

     <div  style="clear:both;"></div>
    <div id="tabs-6"><br>
<br>
<?php include("acao_alt_imagens_banco.php");  ?>
<?php include("acao_edit_imagens.php"); ?>
<br>
<br>
    </div>

    <div id="tabs-8">
<?php include ("../mod_empresa_produtos/acao_comum_imposto.php");?>
    </div>
 </div>    
    
      </td>
    </tr>
    
  </table>
  <input type="hidden" name="MM_update" value="acao">
  <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>
        <span id="concluir_verificar">
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
        </span>
      </div>
    </div>
</form>

<?php include("acao_alt_imagens_url.php"); ?>

<?php 
//envio de resposta do formulario
if ($_POST['res']=='res'){include "res_alt.php";}


mysql_free_result($list_cores);

mysql_free_result($list_setor);

mysql_free_result($list_volt);

mysql_free_result($list_marcas);

mysql_free_result($list_acao);

mysql_free_result($list_unidd);




?>

<div id="loadDescricao"></div>