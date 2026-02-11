
<?php
$relatorio_titulo="RELATÓRIO MANEJO DE ANIMAL v:3.0";

?>
<?php require_once("../sistem_funcoes/seguranca_usuario.php"); ?>
<?php require_once('../Connections/connection.php'); ?>
<?php include("../sistem_funcoes/include_formata_datahoras.php"); ?>

<?php 
############################### FILTRAR PESQUISA #############################
//------------------------------------------------->COD_ANIMAL
$sql_local= "'".$_SESSION['LOCAL']."' ";

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

$colname_list_acao = "-1";
if (isset($_GET['cod_animal'])) {
  $colname_list_acao = $_GET['cod_animal'];
}
$data_inicial=converte_datahoras($_POST['data_inicial']);
$data_final=converte_datahoras($_POST['data_final']);

   $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_otimizar_leite (data_otimizar, data_otimizar_inicial, data_otimizar_ultimo ) VALUES (%s, %s, %s)",
                       GetSQLValueString(date("Y-m-d"), "date"),
					   GetSQLValueString($data_inicial, "date"),
					   GetSQLValueString($data_final, "date")
					   );

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());





mysql_select_db($database_connection, $connection);
$query_list_otimizar = "SELECT * FROM tbnext_mod_sma_otimizar_leite ORDER BY id_otimizar DESC";
$list_otimizar = mysql_query($query_list_otimizar, $connection) or die(mysql_error());
$row_list_otimizar = mysql_fetch_assoc($list_otimizar);
$totalRows_list_otimizar = mysql_num_rows($list_otimizar);
mysql_free_result($list_otimizar);



mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM vwnext_relatorio_cad_animais  ";
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>

<div style="">

      <?php $l=1;?>
	  <?php do { ?>

  <?php
   $id_animais= $row_list_acao['id_animais'];
  //echo "<br>";
  
   ?>

      <?php
//data inicial
/*
$ano_inical=2013;
$ano=$ano_inical;
$mes_inicial=6;
$dia_inicial=1;
*/
$data_inicial=$_POST['data_inicial'];

 $dia_inicial= substr($data_inicial, 0, 2);
 $mes_inicial= substr($data_inicial, 3, 2);
 $ano_inical= substr($data_inicial, 6, 4);
// echo "<br>";

//data final
/*
$ano_final=2013;
$mes_final=7;
$dia_final=10;
*/
 $data_final=$_POST['data_final'];

	 $dia_final= substr($data_final, 0, 2);
	 $mes_final= substr($data_final, 3, 2);
	 $ano_final= substr($data_final, 6, 4);
// "<br>";

$ano=$ano_inical;

//exit;



$days = array();
$day_name_length = 3;
$month_href = NULL;
$first_day = 0; 
$pn = array();
$dia_p=$dia_inicial;

for($i=$mes_inicial; $i<=$mes_final; $i++){

  $mes_p =$i;
$first_of_month = gmmktime(0,0,0,$mes_p ,1,$ano_inical);

	//condicao
	if($i==$mes_inicial){ 
						if($mes_inicial==$mes_final){$dia_p=1; $days_in_month=$dia_final;}
						else{ $dia_p=$dia_inicial; $days_in_month=gmdate('t',$first_of_month);}
						}
	elseif($i==$mes_final  ){$dia_p=1; $days_in_month=$dia_final;}
	else{$dia_p=1; $days_in_month=gmdate('t',$first_of_month);}
	
    for($day=$dia_p; $day<=$days_in_month; $day++,$weekday++){
 	 	$day = $day;
		$mes =$mes_p;
		

		
		
		
		
		

		include ("../sma_relatorios_leite/relatorios_manejo_animal_diario_leite.php");
   	if($row_list_include['leite_qtdd_soma']==0){$leite_qtdd_soma=1;}else{$leite_qtdd_soma=$row_list_include['leite_qtdd_soma'];}
	   $leite_qtdd_soma_op=$row_list_include['leite_qtdd_soma'];
  	if($_GET['id_lactacao']=='1'){$leite_qtdd_soma_op=1;}
   		
		
			$_POST['id_animais']=$id_animais;	
			$_POST['cod_animal']=$row_list_acao['cod_animal']." = ";
			$_POST['data_registro'] =$ano."-".$mes."-".$day; 
	//	echo  '<br>';
	 		$_POST['data_registro'];
	//	echo  '<br>';
  
          
		  
		//MEDICAMENTOS
		  
		   
		//LEITE
		    $_POST['leite_qtdd_litros']=$row_list_include['leite_qtdd_soma'];
			
			if($leite_qtdd_soma_op >0){$_POST['lactacao']=2;}else{$_POST['lactacao']=1;} //lactacao
			$_POST['valor_venda_litros_soma']=$row_list_include['leite_valor_estimado_soma']; 
			
			if($row_list_include['leite_valor_estimado_soma']==0){$leite_valor_estimado_soma=1;}else{$leite_valor_estimado_soma=$row_list_include['leite_valor_estimado_soma'];}
			
			$_POST['faturado']=$receita=$row_list_include['leite_qtdd_soma']*$leite_valor_estimado_soma;
	
	 	?>
	 	<?php
	 	//ALIMENTAÇÂO - concentrado
		include("../sma_relatorios_leite/relatorios_manejo_animal_diario_alimentacao_concentrado.php");
			$_POST['alimentacao_qtdd_concentrado']= $row_list_alimentacao['kilo_animal_soma']; 
			$_POST['alimentacao_custo_concentrado'] =  $row_list_alimentacao['valor_total_soma']; 
			
		//ALIMENTAÇÂO - volumoso	
		include("../sma_relatorios_leite/relatorios_manejo_animal_diario_alimentacao_volumoso.php"); 
			$_POST['alimentacao_qtdd_volumoso']=$row_list_alimentacao['kilo_animal_soma']; 
			$_POST['alimentacao_custo_columoso']=$row_list_alimentacao['valor_total_soma'];
	   	
		//ALIMENTAÇÂO - mineral	
		include("../sma_relatorios_leite/relatorios_manejo_animal_diario_alimentacao_mineral.php"); 
	   		$_POST['alimentacao_qtdd_mineral']=$row_list_alimentacao['kilo_animal_soma']; 
			$_POST['alimentacao_custo_mineral']=$row_list_alimentacao['valor_total_soma']; 

		//ALIMENTAÇÂO -
		include("relatorios_manejo_animal_diario_alimentacao.php"); 
		 	$_POST['alimentacao_custo_total']= $row_list_alimentacao['valor_total_soma']; ?>
		<?php 
		//CUSTO MAO DE OBRA
		include("../sma_relatorios_leite/relatorios_manejo_animal_dias_custo_mao_obra.php"); 
			$_POST['custos_mao_obra']= $row_list_custo_mo_mo['valor_animais_dia_soma']; ?>
		<?php 
		//MEDICAMENTOS
		include("../sma_relatorios_leite/relatorios_manejo_animal_diario_medicamento.php"); 
			$_POST['custos_medicamentos']=$row_list_medicamento['custo_medicamento_soma']; ?>
		<?php 
		//CUSTO DIAS
			$total_custo= $row_list_custo['valor_animais_dia_soma']+ $row_list_custo_mo_mo['valor_animais_dia_soma']  +$row_list_alimentacao['valor_total_soma']+ $row_list_medicamento['custo_medicamento_soma']; 

		include("../sma_relatorios_leite/relatorios_manejo_animal_diario_custo.php"); 
			$_POST['custos_outros']=$row_list_custo['valor_animais_dia_soma']; 
			$_POST['custos_total_geral']= $total_custo; 
			$_POST['custo_litro']= $custo_litro= $total_custo/ $leite_qtdd_soma; 
			$_POST['rentabilidade_animal']=$rentabilidade_animal=$receita-$total_custo;
			
//			echo "ren:".$rentabilidade_animal;
//			echo "<br>";
//			echo "leite:".$leite_qtdd_soma; 
			
			
			$_POST['rentabilidade_litros']=$rentabilidade_animal/$leite_qtdd_soma; 
			 
			  
			  
			  $insertSQL = sprintf("INSERT INTO tbnext_mod_sma_otimizar_leite_relatorio (id_animais, cod_animal, id_otimizar, data_registro, leite_qtdd_litros, lactacao, valor_venda_litros_soma, faturado, alimentacao_qtdd_concentrado, alimentacao_custo_concentrado, alimentacao_qtdd_volumoso, alimentacao_custo_volumoso, alimentacao_qtdd_mineral, alimentacao_custo_mineral, alimentacao_custo_total, custos_mao_obra, custos_outros, custos_medicamentos, custos_total_geral, custo_litro, rentabilidade_litros, rentabilidade_animal) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_animais'], "int"),
                       GetSQLValueString($_POST['cod_animal'], "text"),
					   GetSQLValueString( $row_list_otimizar['id_otimizar'], "text"),
					   
                       GetSQLValueString($_POST['data_registro'], "date"),
					   
                       GetSQLValueString($_POST['leite_qtdd_litros'], "double"),
					   GetSQLValueString($_POST['lactacao'], "int"),
                       GetSQLValueString($_POST['valor_venda_litros_soma'], "double"),
                       GetSQLValueString($_POST['faturado'], "double"),
					   
                       GetSQLValueString($_POST['alimentacao_qtdd_concentrado'], "double"),
                       GetSQLValueString($_POST['alimentacao_custo_concentrado'], "double"),
					   
                       GetSQLValueString($_POST['alimentacao_qtdd_volumoso'], "double"),
                       GetSQLValueString($_POST['alimentacao_custo_columoso'], "double"),
					   
                       GetSQLValueString($_POST['alimentacao_qtdd_mineral'], "double"),
                       GetSQLValueString($_POST['alimentacao_custo_mineral'], "double"),
					   
                       GetSQLValueString($_POST['alimentacao_custo_total'], "double"),
					   
                       GetSQLValueString($_POST['custos_mao_obra'], "double"),
                       GetSQLValueString($_POST['custos_outros'], "double"),//????
					   
                       GetSQLValueString($_POST['custos_medicamentos'], "double"),
                       GetSQLValueString($_POST['custos_total_geral'], "double"),
                       GetSQLValueString($_POST['custo_litro'], "double"),
					   
                       GetSQLValueString($_POST['rentabilidade_litros'], "double"),
                       GetSQLValueString($_POST['rentabilidade_animal'], "double"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error()); 


  

    }
}	
?>

  <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  <?php
echo "Otimização Concluida"; 
?>     
<script>
$(function(){
	$('#msn_load').hide();
	alert('Otimização Concluida!')
	//$['#idDadoOtimizar'].html('Otimização Concluida');
	})

</script>
</div>

<?php
mysql_free_result($list_acao);
?>
