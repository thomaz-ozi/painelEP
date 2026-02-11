<?php require_once('../Connections/connection.php'); ?>
<?php include ("../sistema_funcoes/converter_utf8.php");?>
<?php
$id_usuario=$row_perfusuario['id_usuario'];
$adm_perm_mod_textos_cascata01=$row_perfusuario['id_perm_status_pess_clientes'];
if($adm_perm_mod_textos_cascata01== '1'){
	$and_sql='';
	}else{
		$and_sql =' WHERE  id_usuario = '.$id_usuario;}
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

$maxRows_list_acao = 500;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

mysql_select_db($database_connection, $connection);
 echo $query_list_acao = "SELECT * FROM tbMod_canditadosObjet ".$and_sql;
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

<?php include ("../sistema/index_content_head.php");?>





<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped sorting_asc table-bordered dt-responsive nowrap table-hover datatable-full-personalizado">
     <thead>
    <tr>
      <td width="90%">Objetos</td>
      <td width="10%">
      
            <button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR "></button>
      
      </td>
    </tr>
    </thead>
      <tbody>
 <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
    <tr>
      <td>&nbsp;<?php echo  convert_utf8($row_list_acao['Objetivo']); ?></td>
      <td>
            <button type="button" 
     onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
     class="options_action_edit" title=" EDITAR "> </button>
     
      <button type="button" 
      onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc');return document.MM_returnValue"
      class="options_action_del" title=" EXCLUIR "> </button>
      
      </td>
    </tr>
	<?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  
  <?php  }else{ ?>
     <tr >
    <td colspan="4" align="center" class="txt" ><p><br />
      O sistema n&atilde;o encontrou nada!<br />
      <br />  <br />  <br />  <br />
    </p>
    <p align="right" class="financeiro-txt"></p></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php
mysql_free_result($list_acao);
?>
<script>

      $(document).ready(function() {
		  
        var handleDataTableButtons = function() {
			
          if ($(".datatable-full-personalizado").length) {
			   $(".datatable-full-personalizado").DataTable({
	
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
					}

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
  
