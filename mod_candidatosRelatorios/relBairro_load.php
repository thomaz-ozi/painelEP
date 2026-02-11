<?php
$relatorio_titulo="RELATÓRIO Por Nome v-1";
switch($_GET['converter']){
	
	case 'xls':
		$filename='relatorio_bairro';
		header('Content-type: application/x-msdownload');
        header('Content-Disposition: attachment; filename='.$filename.'.xls');
        header('Pragma: no-cache');
        header('Expires: 0');
		$_GET['list_qtdd']='10000';
		$conv='2';
	break;
	case 'pri':
		$_GET['list_qtdd']='11000';
		$conv='2';
	break;
	
	default;
	$conv='1';
	
	}


?>
<?php require_once('../Connections/connection.php'); ?>
<?php include ("../mod_iep_candidatos/periodoData.php");
	require_once "../sistema_funcoes/converter_utf8.php"; 
?>

<?php
/*
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
if (isset($_GET['Nome'])) {
  $colname_list_acao = $_GET['Nome'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM tbMod_canditados  ORDER BY Nome ASC";
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

*/

//------------------- LISTA QUANTIDADE REGISTRO
$list_qtdd=$_GET['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd='11000';
}


 		$list_SQL="SELECT * FROM tbMod_canditados  ORDER BY Bairro ASC";;


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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_list_acao = $list_qtdd;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

mysql_select_db($database_connection, $connection);
  $query_list_acao = $list_SQL;
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

$queryString_list_acao = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_list_acao") == false && 
        stristr($param, "totalRows_list_acao") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_list_acao = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_list_acao = sprintf("&totalRows_list_acao=%d%s", $totalRows_list_acao, $queryString_list_acao);
?>




<?php 
if($_POST['cabecalho']==''){$_POST['cabecalho']='2';}
if($_POST['cabecalho']!='1'){?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Relatórios</title>
</head>
<style>
body{ font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif; font-size:14px;}
.ln_solid {
    border-top: 1px solid #e5e5e5;
    color: #ffffff;
    background-color: #ffffff;
    height: 1px;
    margin: 20px 0;
}
</style>

<!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
       <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center"><h2>Relatório do Ordem por Bairro</h2><br>
Quantidade de Registro: <?php echo $totalRows_list_acao; ?>
      <div class="ln_solid"></div></td>

    </tr>
  </tbody>
</table>

<?php }else{?>




<?php } ?>
<style>
.linha1 {background-color:#FFF; padding:0px 5px;}
.linha2 {background-color:#F2F2F6; padding:0px 5px;}

.dados{font-weight:bolder; font-size:16px; }
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="relStyle table table-striped sorting_asc table-bordered dt-responsive nowrap table-hover datatable-full-personalizado">
     <thead>

    <tr>
      <td colspan="2" > Cadastro</td>
      <td >&nbsp;</td>
    </tr>
    </thead>
  <tbody> 
   <?php $n=1; $nT=1; $l=1;?>
  <?php do { ?>
    <tr class="linha<?php echo $l; ?>">
    <td width="11%" ><img src="../mod_iep_candidatos/acao_imagem.php?codigo=<?php echo $row_list_acao['Codigo']; ?>" class="img-responsive img-thumbnail" alt="Imagem do Cantidato" style="width:204px;height:auto; float:right"></td>
        <td width="39%" >
          Nº <?php 
		  
		  echo str_pad($n, 5, '0', STR_PAD_LEFT)
			?> | Nome <span class="dados"><?php echo convert_utf8($row_list_acao['Nome']); ?></span>
          <br>
          Codigo <span class="dados"><?php echo $row_list_acao['Codigo']; ?></span> /Idade <span class="dados"><?php echo periodoDataAtual($row_list_acao['DataNascimento']); ?></span> /Objetivo <span class="dados"><?php echo convert_utf8($row_list_acao['Objetivo']); ?></span><br>
          CEP <span class="dados"><?php echo $row_list_acao['CEP']; ?></span><br>
          Endereço <span class="dados"><?php echo convert_utf8($row_list_acao['Endereco']); ?></span><br>
          Bairro <span class="dados"><?php echo convert_utf8($row_list_acao['Bairro']); ?></span><br>
          Cidade <span class="dados"><?php echo convert_utf8($row_list_acao['Cidade']); ?>-</span><br>
          <br>
          Fone <span class="dados"><?php echo $row_list_acao['Telefone1']; ?>/ <?php echo $row_list_acao['Telefone2']; ?>/ <?php echo $row_list_acao['Telefone3']; ?></span><br>
          Email <span class="dados">	<?php echo $row_list_acao['EMail']; ?></span>
        </td>
        
        <td width="50%">CPF <span class="dados"><?php echo $row_list_acao['CPF']; ?></span> /CNH <span class="dados"><?php echo $row_list_acao['CNH']; ?></span> /RG <span class="dados">
          <?php echo $row_list_acao['RG']; ?></span><br>
          
          Ultimo Emprego<span class="dados"></span><br>
          Cargo<span class="dados"></span><br>
          Obs<span class="dados"></span><br>
          Prova/ Entrevista/ Treinamento/ /Ex IEP
          <br>
          Data de Registro<span class="dados"> <?php echo $row_list_acao['DataRegistro']; ?></span></td>
    </tr>

    <?php 
	$n++;
	$nT++;
	if($nT==1000){sleep(0.30); $nT=1;}
	 $l++; if($l>2){$l=1;}
	
	 ?>
	<?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>

  </tbody>
</table>

<?php
mysql_free_result($list_acao);
?>
<?php if($cabecalho!=1){?>
</body>
</html>
<?php }else{?>


<?php } ?>


   <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>


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
