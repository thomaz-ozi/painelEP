<?php require_once('../Connections/connection.php'); ?>
<?php 
include ("../sistema_funcoes/maiuscola_minuscola.php");
//------------------- lista a quantidade
$list_qtdd=$_GET['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd='100';
}
	
	
$id_categoria=$_GET['id_categoria'];
$nome_produto= convertem($_GET['nome_produto'], 1);
/*
if(empty($id_categoria)){
	$list_SQL="SELECT * FROM tbnext_produtos  WHERE  prod_serv='1' AND id_local='".$_SESSION['LOCAL']."' AND nome_produto LIKE '%".$nome_produto."%' ORDER BY nome_produto ASC";
		}else{
		$list_SQL="SELECT * FROM tbnext_produtos  WHERE prod_serv='1' AND id_local='".$_SESSION['LOCAL']."' AND  id_categoria = '$id_categoria'  ORDER BY nome_produto ASC";
		}
*/
$list_SQL="SELECT * FROM tbnext_produtos  WHERE  prod_serv='1' AND id_local='".$_SESSION['LOCAL']."'  ORDER BY nome_produto ASC";
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

mysql_select_db($database_connection, $connection);
$query_list_cat = "SELECT * FROM tbnext_produtos_categoria ORDER BY nome_categoria ASC";
$list_cat = mysql_query($query_list_cat, $connection) or die(mysql_error());
$row_list_cat = mysql_fetch_assoc($list_cat);
$totalRows_list_cat = mysql_num_rows($list_cat);

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

<?php include ("../sistema/index_content_head.php");?>

<table width="100%" border="0" cellpadding="0" cellspacing="1" class="table table-striped table-bordered dt-responsive nowrap table-hover datatable-full"
>
<thead>
  <tr >
    <td width="251" align="left" ><?php echo $cliente_mod_produtos_nome_produtos; echo $totalRows_list_acao;?>: </td>
    <td width="220" align="left" >Categoria</td>
    <td width="309" align="left" >Subcategoria</td>
    <td width="65"  align="center">
<button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR "> </button>
</td>
  </tr>
  <thead>
  <tbody>
   <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
  <tr>
    
    <td align="left"  ><?php echo $row_list_acao['nome_produto']; ?></td>
    <td align="left"  ><?php  $id_categoria = $row_list_acao['id_categoria'];  include"../mod_empresa_produtos_classificacao/include_List_categoria.php"; ?> <?php echo $row_list_cat['nome_categoria']; ?></td>
    <td align="left" ><?php $id_subcategoria=$row_list_acao['id_subcategoria'];  include"../mod_empresa_produtos_classificacao/include_List_subcategoria.php"; ?><?php echo $row_list_subcat['nome_subcategoria']; ?></td>
    <td align="center" >
    
<div class="buttonOpenIcon2">
    <button type="button" 
    
     onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
    
     class="options_action_edit" title=" EDITAR ">
     </button>
     <button type="button" 
      onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc');return document.MM_returnValue"
      class="options_action_del" title=" EXCLUIR ">
      </button>
      </div>
      <div class="buttonDropdown">
      
        <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <i class="fa fa-cog fa-1x" aria-hidden="true"></i>
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt"><i class="fa fa-edit" aria-hidden="true"></i>Editar</a></li>
      <li><a href="?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc"><i class="fa fa-close" aria-hidden="true"></i>Excluir</a></li>
    </ul>
  </div>
</div>

    </td>
  </tr>
   <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
   <?php }else{ ?>
  <tr >
    <td colspan="4" align="center" bgcolor="#FFFFFF" ><br>
      <br>
      <br>
      <br>
    O sistema não encontrou nada!<br>
    <br>
    <br>
    <br>
    <br></td>
  </tr>
<?php } ?>
</tbody>
</table>
<?php
mysql_free_result($list_acao);
?>
