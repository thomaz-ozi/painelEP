<?php
$relatorio_titulo="RELATÓRIO MESES e ANO DOS ANIMAIS v:3.5";

if($_GET['id_ano']==""){ $_GET['id_ano']=date(Y);}
$ano=$_GET['id_ano'];

if($_GET['id_mes']==""){ $_GET['id_mes']=date(n);}
$mes=$_GET['id_mes'];


if($_GET['id_lactacao']==""){ $_GET['id_lactacao']=1;  }
if($_GET['id_lactacao']==2){ $SQLlactacao= "  lactacao='2' AND ";}


switch($_GET['converter']){
	
	case 'xls':
		$filename='relatorio_diario';
		header('Content-type: application/x-msdownload');
        header('Content-Disposition: attachment; filename='.$filename.'.xls');
        header('Pragma: no-cache');
        header('Expires: 0');
		$_GET['list_qtdd']='10000';
		$conv='2';
	break;
	case 'pri':
		$_GET['list_qtdd']='10000';
		$conv='2';
	break;
	
	default;
	$conv='1';
	
	}


?>
<?php // require_once("../sistema_funcoes/seguranca_usuario.php"); ?>
<?php require_once('../Connections/connection.php'); ?>
<?php include("../sistema_funcoes/converte_datas.php"); ?>
<?php require_once('../sistema_funcoes/converter_numero_moeda_3.php'); ?>

<?php include "../sistema_funcoes/masc_mes.php"; ?>
<?php include "../sma_funcoes/calcular_idade.php"; ?>


<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo $relatorio_titulo; ?></title>

<?php if($conv==1){ ?>
<link href="relatorios_estilo.css" rel="stylesheet" type="text/css" />
<?php }else{?>
<?php include('relatorios_estilo_imprimir.php');?>
<?php }?>
<script src="../sistem_funcoes/openWindow.js" type="text/javascript"></script>
<script src="../sistem_funcoes/goURL.js" type="text/javascript"></script>
</head>

<body>
<form id="relatorio" name="relatorio" method="get" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="rel_table">
  <tr class="rel_informacoes">
    <td width="128" align="center"><img src="../empresa_logo/logo_cabanha-126x64.png" alt="" width="84" height="42" />
      <div style="font-size:9px; text-align:center; width:100%;"><b><?php echo $relatorio_titulo; ?></b></div></td>
    <td width="117" align="center" ><div style="width:80px;">
      <div title="EXPORTA XLS" id="divXls"  onclick="goToURL('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=xls&%d%s", $currentPage,$ordem , $queryString_1); ?>')"></div>
      <div id="divHtml" onClick="MM_openBrWindow('<?php printf("%s?".$_SERVER['QUERY_STRING']."&cod_animal=".$_GET['cod_animal']."&converter=pri&%d%s", $currentPage,$ordem , $queryString_1); ?>','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,height=768')"></div>
    </div></td>
    <td width="211" ><div style="height:45px; margin-top:5px;">
      <table width="80%" border="0" cellspacing="0" cellpadding="0" class="rel_informacoes">
        <tr>
          <td align="center">ANO</td>
          </tr>
        <tr>
          <td align="center"><select name="id_ano" id="id_ano" style="width:50px;">
            <option value="2012" <?php if (!(strcmp(2012, $_GET['id_ano']))) {echo "selected=\"selected\"";} ?>>2012</option>
            <option value="2013" <?php if (!(strcmp(2013, $_GET['id_ano']))) {echo "selected=\"selected\"";} ?>>2013</option>
            <option value="2014" <?php if (!(strcmp(2014, $_GET['id_ano']))) {echo "selected=\"selected\"";} ?>>2014</option>
            <option value="2015" <?php if (!(strcmp(2015, $_GET['id_ano']))) {echo "selected=\"selected\"";} ?>>2015</option>
          </select></td>
          </tr>
      </table>
    </div></td>
    <td width="162" align="center" ><div class="rel_informacoes">OPÇÕES</div>
      <select name="id_lactacao" id="id_lactacao">
        <option value="1" <?php if (!(strcmp(1, $_GET['id_lactacao']))) {echo "selected=\"selected\"";} ?>>Sem Lactação</option>
        <option value="2" <?php if (!(strcmp(2, $_GET['id_lactacao']))) {echo "selected=\"selected\"";} ?>>Com Lactação</option>
      </select>
      <select name="condicao" id="condicao">
        <option value="1" <?php if (!(strcmp(1, $_GET['condicao']))) {echo "selected=\"selected\"";} ?>>Soma</option>
        <option value="2" <?php if (!(strcmp(2, $_GET['condicao']))) {echo "selected=\"selected\"";} ?>>Média</option>
      </select></td>
    <td width="468" ><input  name="cod_animal" type="text" class="form_pesquisa_input" id="cod_animal" value="<?php echo $_GET['cod_animal']; ?>" size="38" />
      <input type="submit" name="botao" id="botao" value="Pesquisar" /></td>
  </tr>
  <tr class="rel_informacoes">
    <td colspan="5" align="right"><br></td>
  </tr>
</table>
</form>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="rel_table">

  <tr class="rel_opcoes">
    <td align="center">MÊS</td>
    <td class="coluna_titulo">MÉTODO</td>
    <td class="coluna_titulo">QTDD/LISTROS </td>
    <td class="coluna_titulo">V.VENDA/LITROS</td>
    <td class="coluna_titulo">FATURADO</td>
    <td class="coluna_titulo">QTD/CONCENTRADO</td>
    <td class="coluna_titulo">CUSTO/CONCENTRADO</td>
    <td class="coluna_titulo">QTD/VOLUMOSO</td>
    <td class="coluna_titulo">CUSTO/VOLUMOSO</td>
    <td class="coluna_titulo"> QTD/MINERAL</td>
    <td class="coluna_titulo">CUSTO/MINERAL</td>
    <td class="coluna_titulo">C.ALI</td>
    <td class="coluna_titulo">C.MÃO/OBRA</td>
    <td class="coluna_titulo">C.MED</td>
    <td class="coluna_titulo">C.OUTROS</td>
    <td class="coluna_titulo">TOTAL-CUST0 </td>
    <td class="coluna_titulo">CUSTO/LITRO</td>
    <td class="coluna_titulo">RETAB/LITROS</td>
    <td class="coluna_titulo">RENTABILIDADE</td>
  </tr>
  <?php
for($m=1; $m<=12; $m++){
	$mes=$m;
	
	
 ?>
  <?php include('../sma_relatorios_leite/relatorios_manejo_lista_animais_mensal_soma_grupo.php');
	
	
	$nAnimais=$totalRows_list_acao;
	 ?>
  <tr class="linha1">
    <td rowspan="2" class="linha" style="border-bottom:#4F5118 1px solid;">
	
	<div title="Relatório de <?php echo masc_mes($m);?>" class="rel_cod_animal" onclick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_lista_animais_mensal.php?id_mes=<?php echo $m; ?>&id_ano=<?php echo $_GET['id_ano']; ?>', '','toolbar=no, location=no, menubar=no, status=yes, scrollbars=yes, resizable=yes, width=1024, height=768, ')">&nbsp;&nbsp;<?php echo masc_mes($m);?>&nbsp;</div></td>
    <td>&nbsp;&nbsp;<b>MÉDIA</b>&nbsp;&nbsp;</td>
    <td align="right"><?php
	
	switch ($row_list_soma['leite_qtdd_litros_soma']){
		case 0:
		$leite_qtdd_litros_soma=1;
		break;
		case '':
		$leite_qtdd_litros_soma=1;
		break;
		default;
		
		echo converter_numero_moeda_3($row_list_soma['leite_qtdd_litros_soma']/$nAnimais);
		}
		
				
	  ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['valor_venda_litros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['faturado_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_concentrado_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_concentrado_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_volumoso_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_volumoso_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_mineral_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_mineral_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_total_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_mao_obra_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_medicamentos_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_outros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_total_geral_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custo_litro_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_litros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_animal_soma']/$nAnimais); ?></td>
  </tr>
  <tr class="linha2">
    <td>&nbsp;&nbsp;<b>SOMA</b>&nbsp;&nbsp;</td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['leite_qtdd_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['valor_venda_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['faturado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_concentrado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_concentrado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_volumoso_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_volumoso_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_mineral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_mineral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_total_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_mao_obra_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_medicamentos_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_outros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_total_geral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custo_litro_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_animal_soma']); ?></td>
  </tr>
  
  <?php }?>
  <tr >
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="rel_table">
  <tr class="rel_opcoes">
    <td align="center">ANO</td>
    <td class="coluna_titulo">MÉTODO</td>
    <td class="coluna_titulo">QTDD/LISTROS </td>
    <td class="coluna_titulo">V.VENDA/LITROS</td>
    <td class="coluna_titulo">FATURADO</td>
    <td class="coluna_titulo">QTD/CONCENTRADO</td>
    <td class="coluna_titulo">CUSTO/CONCENTRADO</td>
    <td class="coluna_titulo">QTD/VOLUMOSO</td>
    <td class="coluna_titulo">CUSTO/VOLUMOSO</td>
    <td class="coluna_titulo"> QTD/MINERAL</td>
    <td class="coluna_titulo">CUSTO/MINERAL</td>
    <td class="coluna_titulo">C.ALI</td>
    <td class="coluna_titulo">C.MÃO/OBRA</td>
    <td class="coluna_titulo">C.MED</td>
    <td class="coluna_titulo">C.OUTROS</td>
    <td class="coluna_titulo">TOTAL-CUST0 </td>
    <td class="coluna_titulo">CUSTO/LITRO</td>
    <td class="coluna_titulo">RETAB/LITROS</td>
    <td class="coluna_titulo">RENTABILIDADE</td>
  </tr>


  <tr class="linha1">
    <td rowspan="2" class="linha" style="border-bottom:#4F5118 1px solid;"><div class="rel_cod_animal" onclick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_animal_diario.php?cod_animal=300fff0000000000000000000005', '','toolbar=no, location=no, menubar=no, status=yes, scrollbars=yes, resizable=yes, width=1024, height=768, ')"><?php echo $_GET['id_ano']; ?></td>
    <td>&nbsp;&nbsp;MÉDIA&nbsp;&nbsp;</td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['leite_qtdd_litros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['valor_venda_litros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['faturado_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_concentrado_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_concentrado_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_volumoso_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_volumoso_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_mineral_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_mineral_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_total_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_mao_obra_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_medicamentos_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_outros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_total_geral_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custo_litro_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_litros_soma']/$nAnimais); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_animal_soma']/$nAnimais); ?></td>
  </tr>
  <tr class="linha2">
    <td>&nbsp;&nbsp;SOMA&nbsp;&nbsp;</td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['leite_qtdd_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['valor_venda_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['faturado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_concentrado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_concentrado_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_volumoso_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_volumoso_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_qtdd_mineral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_mineral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['alimentacao_custo_total_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_mao_obra_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_medicamentos_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_outros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custos_total_geral_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['custo_litro_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_litros_soma']); ?></td>
    <td align="right"><?php echo converter_numero_moeda_3($row_list_soma['rentabilidade_animal_soma']); ?></td>
  </tr>
  <tr >
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>