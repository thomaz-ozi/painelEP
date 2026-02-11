<?php require_once('../Connections/connection.php'); ?>
<?php
$xNome=$_POST['content'];
switch ($_POST['id_pesquisa']){
	case 1://cliente
	$SQL="SELECT * FROM tbnext_mod_empresa_clientes WHERE xNome LIKE  '%".$xNome."%' ORDER BY xNome ASC";
	$idList='id_clientes';
	break;
	case 2://Fornecedor
	$SQL="SELECT * FROM tbnext_mod_empresa_fornecedores WHERE class_fornecedores='1' AND xNome LIKE  '%".$xNome."%' ORDER BY xNome ASC";
		$idList='id_fornecedores';
	break;
	case 3://Funcionario
	$SQL="SELECT * FROM tbnext_mod_empresa_fornecedores WHERE class_fornecedores!='1' AND xNome LIKE  '%".$xNome."%' ORDER BY xNome ASC";
		$idList='id_fornecedores';
	break;
}



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

$maxRows_list_pesquisa = 20;
$pageNum_list_pesquisa = 0;
if (isset($_GET['pageNum_list_pesquisa'])) {
  $pageNum_list_pesquisa = $_GET['pageNum_list_pesquisa'];
}
$startRow_list_pesquisa = $pageNum_list_pesquisa * $maxRows_list_pesquisa;

mysql_select_db($database_connection, $connection);
 $query_list_pesquisa = $SQL;
$query_limit_list_pesquisa = sprintf("%s LIMIT %d, %d", $query_list_pesquisa, $startRow_list_pesquisa, $maxRows_list_pesquisa);
$list_pesquisa = mysql_query($query_limit_list_pesquisa, $connection) or die(mysql_error());
$row_list_pesquisa = mysql_fetch_assoc($list_pesquisa);

if (isset($_GET['totalRows_list_pesquisa'])) {
  $totalRows_list_pesquisa = $_GET['totalRows_list_pesquisa'];
} else {
  $all_list_pesquisa = mysql_query($query_list_pesquisa);
  $totalRows_list_pesquisa = mysql_num_rows($all_list_pesquisa);
}
$totalPages_list_pesquisa = ceil($totalRows_list_pesquisa/$maxRows_list_pesquisa)-1;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php if($totalRows_list_pesquisa !=0){ ?>
<?php do { ?>
	<tr class="linhas1" style="cursor:pointer;" onClick="selecionado('<?php echo $row_list_pesquisa[$idList]; ?>','<?php echo $row_list_pesquisa['xNome']; ?>')">
      <td width="5%" class="txt-opcoes" ><div class="bt_check"></div></td>
      <td width="37%" class="txt"><?php echo $row_list_pesquisa['xNome']; ?></td>
      <td width="58%" class="txt"><?php echo $row_list_pesquisa['CNPJ']; ?><?php echo $row_list_pesquisa['CPF']; ?></td>
    </tr>
<?php } while ($row_list_pesquisa = mysql_fetch_assoc($list_pesquisa)); ?> 
<?php }else{?>  
	<tr class="linhas1">
	  <td colspan="3" align="center" class="txt-opcoes">Assunto não encontrado..</td>
    </tr>
<?php } ?>
</table>
<?php
mysql_free_result($list_pesquisa);
?>
