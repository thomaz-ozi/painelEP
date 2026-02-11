<?php  
if($posicao_botao==1){
	$ordem='posicao_botao';}
	else{$ordem='site_titulo';}
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_list_acao = 20;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM tbnext_usuario_setor ORDER BY id_usuario_setor ASC";
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
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="table table-striped table-bordered dt-responsive nowrap datatable-full">
<thead>
  <tr>
    <td width="51" align="center" bgcolor="#FFFFFF" class="txt-Indece">ID</td>
    <td width="212" align="left" bgcolor="#FFFFFF" class="txt-Indece">Setor</td>
    <td width="511" align="left" bgcolor="#FFFFFF" class="txt-Indece">DESCRI&Ccedil;&Atilde;O</td>
    <td width="71" align="center"  class="txt"> <?php 
	if(($row_perfusuario['perm_limit_setor']==0)or($row_perfusuario['perm_limit_setor']>$totalRows_lista_acao)){
	if( $row_perfusuario['id_usuario_setor']<=3){?>      <button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR ">
      </button><?php }} ?></td>
  </tr>
  </thead>
  <tbody>
  
     
   <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
  <tr >
  
  
  
    <td align="center"  ><?php echo $id_usuario_setor= $row_list_acao['id_usuario_setor']; ?></td>
    <td align="left" ><?php echo $row_list_acao['xNome']; ?></td>
    <td align="left" ><?php echo $row_list_acao['descricao']; ?></td>
    <td align="center"  > 
        <button type="button" 
    
     onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
    
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
    <td colspan="6" align="center" class="txt" ><p><br />
      O sistema n&atilde;o encontrou nada!<br />
      <br />
  <br />
  <br />
  <br />
    </p>
    <p align="right" class="financeiro-txt"></p></td>
    </tr><?php }?>
 </tbody>
</table>
<?php
mysql_free_result($list_acao);
?>