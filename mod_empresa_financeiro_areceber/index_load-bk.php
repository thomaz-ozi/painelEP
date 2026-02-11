<?php require_once('../Connections/connection.php'); ?>

<?php
	require_once "../sistema_funcoes/converte_datas.php";
	require_once "../sistema_funcoes/converte_datas_horas.php";
	require_once("../sistema_funcoes/extrair_data.php");
	require_once "../sistema_funcoes/converter_numero_moeda.php"; 
	require_once "../sistema_funcoes/limit_txt.php"; 
 ?>
 
 <?php

 
switch($_POST['content']){
	case '1':
	
	$data=$_POST['data'];
	$data_dia=ext_data_br_dia($data);
	$data_mes=ext_data_br_mes($data);
	$data_ano=ext_data_br_ano($data);
	$dataSQL=" data_vcto= '".$data_ano."/".$data_mes."/".$data_dia."' AND ";
	break;
	
	
	case '2':
	$data_mes=$_POST['data'];
	$data_ano=date(Y);
	$dataSQL="month(data_vcto) = '".$data_mes."' AND year(data_vcto) = '".$data_ano."' AND ";
	break;
	
	case '3':
	echo $pesq_data_inicio=converte_data($_POST['pesq_data_inicio']);
	echo $pesq_data_final=converte_data($_POST['pesq_data_final']);
	$dataSQL="data_vcto between '".$pesq_data_inicio."' and '".$pesq_data_final."' AND ";
	$_POST['data']=$pesq_data_inicio;
	break;
}

$pesquisarem= $_POST['pesquisarem'];

 switch($_POST['pesquisaselect']){
	case '1'://Cliente/nome
	
	$textSQL=" xNome_clientes LIKE '%".$pesquisarem."%' AND ";	
	$_POST['data']='ok';

	break;
	
	
	case '2':
	$data_mes=$_POST['data'];
	$data_ano=date(Y);
	//$dataSQL="month(data_vcto) = '".$data_mes."' AND year(data_vcto) = '".$data_ano."' AND ";
	break;
	
	case '3':
	$textSQL=" id_receitas_parcelas LIKE '%".$pesquisarem."%' AND ";	
	break;
	
	case '5':
	echo $pesq_data_inicio=converte_data($_POST['pesq_data_inicio']);
	echo $pesq_data_final=converte_data($_POST['pesq_data_final']);
	//$dataSQL="data_vcto between '".$pesq_data_inicio."' and '".$pesq_data_final."' AND ";
	$_POST['data']=$pesq_data_inicio;
	break;
	
	default:
	$dataSQL=" month(data_vcto) = '".$data_mes."' AND year(data_vcto) = '".$data_ano."'";
	break;	
}
 
 if (empty($_POST['data'])){
	$data_mes=date(m);
 	$data_ano=date(Y);
echo 	$listSQL= "SELECT * FROM vwnext_mod_empresa_financeiro_receita_parc WHERE  month(data_vcto) = '".$data_mes."' AND year(data_vcto) = '".$data_ano."' AND ativado='1' ORDER BY data_mvto DESC";
 }else{
		
	echo $listSQL= "SELECT * FROM vwnext_mod_empresa_financeiro_receita_parc WHERE  ".$dataSQL." ".$textSQL."  ativado='1' ORDER BY data_mvto DESC";
	 
	 }
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

mysql_select_db($database_connection, $connection);
 $query_list_acao =$listSQL;
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

$id_sistema="id_receitas_parcelas";
?>
   
<script>
$(function(){
$('.bt_pgn').click(function(){
	var bt_pgn=$(this).val();
	  loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_pgn.php',bt_pgn);
   });   
 $('.bt_pg').click(function(){
	var bt_pg=$(this).val();
	  loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_pg.php',bt_pg);
   });   
$('.bt_can').click(function(){
	var bt_can=$(this).val();
	  loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_cobranca.php',bt_can);
   });   
     
   
   
});
</script>
   

 <table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <td width="4%" align="center" class="txt-Indece" >ID</td>
      <td width="7%" align="center" class="txt-Indece" >Parcs</td>
      <td width="8%" align="center" class="txt-Indece" >Data Vcto</td>
      <td width="57%" align="center" class="txt-Indece" >Cliente <?php echo $totalRows_list_acao; ?> </td>
      <td width="4%" align="center" class="txt-Indece" >Status</td>
      <td width="5%" height="1" align="center" class="txt-Indece" >Valor</td>
      <td width="15%">&nbsp;</td>
    </tr>
        <?php $l=1;?>
   <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
    <tr class="linhas<?php echo $l; ?>">
      <td align="center"><?php echo $id_receitas_parcelas= $row_list_acao['id_receitas_parcelas']; ?></td>
      <td align="center"><?php echo $row_list_acao['parc_n'] ."/". $row_list_acao['total_parcs']; ?></td>
      <td align="center"><?php echo converte_data($row_list_acao['data_vcto']); ?></td>
      <td><?php echo $row_list_acao['xNome_clientes']; ?></td>
      <td align="center"><?php 
	  if($row_list_acao['parc_pgto']==1){
	  	echo '<button class="options_fin_pg bt_pg" title=" PAGO " value="'.$row_list_acao['id_receitas_parcelas'].'" type="button" > </button>';
	  }else{
		echo '<button class="options_fin_pgn bt_pgn" title=" NÃO PAGO "  value="'.$row_list_acao['id_receitas_parcelas'].'"  type="button"> </button>';
	  }
	  
	  ?></td>
      <td align="center"><b><?php echo $parc_valor=converter_numero_moeda($row_list_acao['parc_valor']); ?></b></td>
      <td align="center">
      <?php 
	  if($row_list_acao['parc_pgto']!=1){
	  	echo '<button class="options_fin_conbra bt_can" title="Cobrança" type="button"  value="'.$row_list_acao[$id_sistema].'"> </button>';
	  }	  
	  ?>
      
      
      
      <button type="button" 
    
     onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
    
     class="options_action_edit" title=" EDITAR ">
     </button>
     <button type="button" 
      onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-can');return document.MM_returnValue"
      class="options_action_can" title=" CANCELAR ">
      </button>
      
      
      </td>
    </tr>
    <?php  $l++; if($l>2){$l=1;} ?>
	<?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  <?php  }else{ ?>
    <tr >
    <td colspan="7" align="center" class="txt" ><p><br />
      O sistema n&atilde;o encontrou nada!<br />
      <br />
  <br />
  <br />
  <br />
    </p>
    <p align="right" class="financeiro-txt"></p></td>
    </tr>
  <?php } ?>

  </tbody>
</table>


<?php
mysql_free_result($list_acao);
?>
