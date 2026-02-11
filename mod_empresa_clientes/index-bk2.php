<?php  require_once('../Connections/connection.php'); ?>
<?php
	include ('../sistema_funcoes/maiuscola_minuscola.php');
	include ("../sistema_funcoes/converte_datas.php");
?>

<?php
//------------------- LISTA QUANTIDADE REGISTRO
$list_qtdd=$_GET['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd='10';
}

//----------------------> PERMISSAO DE USUARIO
$id_usuario=$row_perfusuario['id_usuario'];

$id_local=$_SESSION['LOCAL'];
$adm_perm_mod=$row_perfusuario['id_perm_status_pess_clientes'];
if($adm_perm_mod == '1'){
	$and_sql=" ";
	}else{
		 $and_sql =" id_usuario = '".$id_usuario."' AND id_local = '".$id_local."' ";}
//--------------------------------> OPCAO DE PESQUISA
$opcao=$_GET['opcao'];
if($opcao=='data'){
	$palavra_pesquisa=converte_data($_GET['palavra_pesquisa']);
	$opcao_sql="  ". $opcao ." = '".$palavra_pesquisa."' ";
		}else{
	$palavra_pesquisa=convertem($_GET['palavra_pesquisa'],1);
	$opcao_sql="   UPPER(". $opcao .") LIKE '%".$palavra_pesquisa."%' ";
	}
//-------------------------------------------------> FILTRO DO USUARIO E PESQUISA <-----------------------------//
$SQL_table="tbnext_mod_empresa_clientes";
if((empty($opcao))and($adm_perm_mod == '1')){
	 $list_SQL="SELECT * FROM ".$SQL_table."   ".$and_sql." ORDER BY xNome ASC";
	 	}else if(empty($opcao)){
		 $list_SQL="SELECT * FROM ".$SQL_table." WHERE  ".$and_sql." ORDER BY xNome ASC";
		 }else if($adm_perm_mod == '1'){
		 $list_SQL="SELECT * FROM ".$SQL_table." WHERE  ".$opcao_sql." ORDER BY xNome ASC";
		}else{
 		$list_SQL="SELECT * FROM ".$SQL_table." WHERE  ".$and_sql." AND".$opcao_sql." ORDER BY ".$opcao." ASC";
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
<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"  rel='stylesheet'>
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js'></script>

<script>
$(function($){
$("#opcao").change(function(){
	var var_opcoes=$("#opcao").val();
	if(var_opcoes=='CNPJ'){
   		$("#palavra_pesquisa").mask("99.999.999/9999-99");//CNPJ
	}else if(var_opcoes=='CPF'){
   		$("#palavra_pesquisa").mask("999.999.999-99");//CPF
	}else{ $("#palavra_pesquisa").unmask();}
});
});
</script>
<style>
.dropdown-menu {
    left: -95px;
}
@media(max-width:964px){
.fechado{ font-size:18px; color:#24359B; }
.aberto{ display:none;}
}
@media(min-width:963px) {
	.aberto{ font-size:18px; width:80px; }
	.fechado{ display:none;}

}


</style>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
$(document).ready(function() {
    $('#example1').DataTable();
} );

</script>

<table width="100%" border="0"      cellpadding="0" cellspacing="1" >
  <tr>
    <td colspan="4" align="center"  bgcolor="#FFFFFF"  class="txt-indece-titulo">
    
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  align="center"><img src="<?php echo "$icons_sistema_nome"; ?>"  /></td>
        <td >&nbsp;&nbsp;  <?php echo "$sistema_nome"; ?> &nbsp;<?php echo "$versao"; ?></td>
        <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qtdd:&nbsp;&nbsp;<?php echo $totalRows_list_acao ?> &nbsp;&nbsp;&nbsp;</td>
        <?php    if($adm_perm <= '2'){?>
        <form id="qtdd" name="qtdd" method="get" action="?">
          <input name="conteudo" type="hidden" id="conteudo" value="<?php echo $_GET['conteudo']; ?>" />
          <input name="usuario" type="hidden" id="usuario" value="<?php echo $_GET[usuario]; ?>" />
          <input name="id_categoria" type="hidden" id="id_categoria" value="<?php echo $_GET['id_categoria']; ?>" />
          <td valign="middle"  >
          </form>
        <?php }?>
      </tr>
    </table></td>
  <tr>
    <td colspan="4" align="left">
    <div class="table-content">
    <a href="?startmod=empresa_clientes_class&conteudo=clien_class&amp;<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>">Editar Classifica&ccedil;&atilde;o</a>
    
    <table id="example" class="table table-striped table-bordered " cellspacing="0" width="100%">
        <thead>
            <tr class="txt-Indece">
                <th width="12%">ID</th>
                <th width="38%">Nome</th>
                <th width="45%">Fone</th>
                <th width="5%">  <button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR ">
      </button></th>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>  <button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR ">
      </button></th>

            </tr>
        </tfoot>
        <tbody>
         <?php do { ?>

<tr class="linhas<?php echo $l; ?>">
  
    <td align="left"  ><?php echo $row_list_acao[$id_sistema]; ?></td>
    <td align="left"  ><?php echo $row_list_acao['xNome']; ?></td>
  
    <td align="left" ><?php echo $row_list_acao['fone1']; ?></td>
    <td align="center"  > 
    <div class="aberto">
    <button type="button" 
    
     onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
    
     class="options_action_edit" title=" EDITAR ">
     </button>
     <button type="button" 
      onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc');return document.MM_returnValue"
      class="options_action_del" title=" EXCLUIR ">
      </button>
      </div>
      <div class="fechado">
      
        <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <i class="fa fa-cog fa-1x" aria-hidden="true"></i>
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#"><i class="fa fa-edit" aria-hidden="true"></i>Editar</a></li>
      <li><a href="#"><i class="fa fa-close" aria-hidden="true"></i>Excluir</a></li>
      <li><a href="#"><i class="fa fa-list" aria-hidden="true"></i>Detalhes</a></li>
    </ul>
  </div>
      
      
      </div>
    
</td>
    </tr>


     <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
        </tbody>
    </table>
    </div>
    </td>
  </tr>
  
</table>


<?php
mysql_free_result($list_acao);
?>