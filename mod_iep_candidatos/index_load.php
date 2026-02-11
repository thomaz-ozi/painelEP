<?php require_once('../Connections/connection.php'); ?>

<?php
	require_once "../sistema_funcoes/converte_datas.php";
	require_once "../sistema_funcoes/converte_datas_horas.php";
	require_once("../sistema_funcoes/extrair_data.php");
	require_once "../sistema_funcoes/converter_numero_moeda.php"; 
	require_once "../sistema_funcoes/limit_txt.php"; 
	require_once "../sistema_funcoes/converter_utf8.php"; 
 	require_once ("../sistema_funcoes/mask.php");
 ?>
 <?php

$whereSql="WHERE";
$andSql="AND";

//xRua
/*
$xRua=$_POST['xRua'];
if($xRua!=""){
$ruaSQL= " AND Endereco LIKE '%".$xRua."%' ";
}


//dataNascimento
if($_POST['dataNascimento']!=""){
	//$dataNascimento=converte_data($_POST['dataNascimento']);
	$dataNascimento=$_POST['dataNascimento'];
	//WHERE  YEAR(data_abate)='2011'
	
	$dataNascSql= " AND YEAR(DataNascimento)='".$dataNascimento."'";
	
	}else{$dataNascSql= "";}
	
//xPesq
$xPesq=$_POST['xPesq'];
if($xPesq!=""){
	$xPesqSQL=" AND Nome LIKE '%".$xPesq."%'  ";	
		}else{	}
*/
//Objetivo
$ObjetivoSQL=$_POST['Objetivo'];
if($ObjetivoSQL!=""){
$ObjetivoSQL= " AND Objetivo LIKE '%".$ObjetivoSQL."%' ";
}
//bairro
$xBairro=$_POST['xBairro'];
if($xBairro!=""){
$bairroSQL= " AND Bairro LIKE '%".$xBairro."%' ";
}		
//ORDER
if($xPesq!=""){
	$ordSql=" ORDER BY Nome ASC";	
		}else{
		$ordSql=" ORDER BY codigo DESC ";
		}


//SELECT * FROM iep_candidatos WHERE Nome LIKE '%maria%' AND Endereco LIKE '%%' AND Estao Civil LIKE '%%' ORDER BY Nome ASC
//echo $listSQL="SELECT * FROM vwnext_candidatoscompleto WHERE RegistroStatus='1' ".$xPesqSQL.$dataNascSql.$ruaSQL.$estaoCivilSQL.$bairroSQL.$ordSql; 
 $listSQL="SELECT * FROM tbMod_canditados WHERE RegistroStatus='1' ".$xPesqSQL.$bairroSQL.$ObjetivoSQL.$ordSql; 

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
/*
mysql_select_db($database_connection, $connection);
$query_list_acao =$listSQL;
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
*/


/*iniciando Pesquisa*/
$maxRows_list_acao = 30;
$pageNumList_list_acao = 0;
if (isset($_GET['pageNumList_list_acao'])) {
  $pageNumList_list_acao = $_GET['pageNumList_list_acao'];
}
$startRow_list_acao = $pageNumList_list_acao * $maxRows_list_acao;

mysql_select_db($database_connection, $connection);
// $query_list_acao = "SELECT * FROM ".$tbSQL." WHERE ".$coluna."  ORDER BY Codigo ASC";
 $query_list_acao =$listSQL;
$query_limit_list_acao = sprintf("%s LIMIT %d, %d ", $query_list_acao, $startRow_list_acao, $maxRows_list_acao);
$list_acao = mysql_query($query_limit_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);

if (isset($_GET['totalRows_list_acao'])) {
  $totalRows_list_acao = $_GET['totalRows_list_acao'];
} else {
  $all_list_acao = mysql_query($query_list_acao);
  $totalRows_list_acao = mysql_num_rows($all_list_acao);
}
$totalPages_list_acao = ceil($totalRows_list_acao/$maxRows_list_acao)-1;


/*list_acao - fim*/




$id_sistema="Codigo";
include "../mod_iep_candidatos/conf.php"
?>
   
<?php include ("../mod_iep_candidatos/index_page.php");?>

  
 <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-striped sorting_asc table-bordered dt-responsive nowrap table-hover datatable-full-personalizado">
 <thead>
    <tr>
      <td width="3%" align="center"  >ID</td>
      <td align="center"  >Candidatos |&nbsp Quantidade: &nbsp &nbsp<?php echo $totalRows_list_acao; ?> </td>
      <td height="30" align="center"  >Endereço</td>
      <td width="13%"> </td>
    </tr> 
    </thead>
    <tbody>
   <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
    <tr >
      <td align="center"><?php echo $id_receitas_parcelas= $row_list_acao['Codigo']; $_GET['codigo']= $row_list_acao['Codigo'];?><br></td>
      <td align="left"><?php echo convert_utf8($row_list_acao['Nome']); ?><br> Idade: <?php echo $row_list_acao['Idade']; ?>- Filhos: <?php echo $row_list_acao['NFilhos']; ?><br>
        CPF: <?php  echo mask($row_list_acao['CPF'],'###.###.###-##');?> RG: <?php  echo mask($row_list_acao['RG'],'##.###.###-#'); ?><br>
        Objetivo: <?php echo  $Objetivo=convert_utf8($row_list_acao['Objetivo']); ?> <br>      </td>
      <td align="left">CEP: <?php echo convert_utf8($row_list_acao['CEP']); ?><br>
        Rua: <?php echo convert_utf8($row_list_acao['Endereco']); ?><br>
        Bairro: <?php echo convert_utf8($row_list_acao['Bairro']); ?><br>
        Telefone: <?php echo $row_list_acao['Telefone1']; ?>	  
        
      </td>
      <td align="center"><button type="button" 
    
     onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt&Objetivo=<?php echo $_POST['Objetivo']; ?>&xBairro=<?php echo $_POST['xBairro']; ?>&pageNumList_list_acao=<?php echo $_GET['pageNumList_list_acao'];?>');return document.MM_returnValue"
    
     class="options_action_edit" title=" EDITAR ">
        </button>
        <button type="button" 
      onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc');return document.MM_returnValue"
      class="options_action_del" title=" EXCLUIR ">
          </button>
        
      </td>
    </tr>
	<?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  <?php  }else{ ?>
    <tr >
    <td colspan="4" align="center" class="txt" ><p><br />
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
<?php include ("../mod_iep_candidatos/index_page.php");?>
<?php
mysql_free_result($list_acao);
?>
<script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($(".datatable-full-personalizado").length) {
            $(".datatable-full-personalizado").DataTable({
				
				
	
				"order": [[ 0, "desc" ]],
           
				/*"displayLength": 100,// lismite de paginação*/
				"paging": false, //desabilitar a paginação
				  "language": {	
				   		"sEmptyTable": "Nenhum registro encontrado",
    					"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
						"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
						"sInfoFiltered": "(Filtrados de _MAX_ registros)",
						"sInfoPostFix": "",
						"sInfoThousands": ".",
						"sLengthMenu": "_MENU_ resultados por página",
						"sLoadingRecords": "Carregando...",
						"sProcessing": "Processando...",
						"sZeroRecords": "Nenhum registro encontrado",
						"sSearch": "",
						"searchPlaceholder": "Pesquisar...",
    				"paginate": {
						"sNext": "Próximo",
						"sPrevious": "Anterior",
						"sFirst": "Primeiro",
						"sLast": "Último"
							
					},
    				"oAria": {
						"sSortAscending": ": Ordenar colunas de forma ascendente",
						"sSortDescending": ": Ordenar colunas de forma descendente"
					},
					
					
  				},
				
				

				
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
			  
			   
			  
			  
			  
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();
		


/*tabela ordenar*/






        $('.datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });

/*
        $('#datatable-scroller').DataTable({
          ajax: "../js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });
*/
        var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        TableManageButtons.init();
      });
    </script>
    <script>
      $(document).ready(function() {
        $('.form-data').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_2",
		  format: 'DD/MM/YYYY',
		  customRangeLabel: 'Custom',
		  daysOfWeek: ['dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab'],
          monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Juho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
       
        });	
		
		
      });
 </script>