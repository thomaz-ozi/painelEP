<span style="display:none;"><?php require_once('../Connections/connection.php'); ?></span>
<?php  include ("../sistema_funcoes/maiuscola_minuscola.php");?>
<?php include ("../sistema_funcoes/converter_numero_moeda.php");?>

<?php //------------------- LISTA QUANTIDADE REGISTRO
$list_qtdd=$_POST['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd='30';
}
 $content=convertem($_POST['content'],1);
if($content ==''){
	$filtroSQL="SELECT id_clientes, xNome,  CNPJ, CPF, cpf_cnpj, responsavel FROM tbnext_mod_empresa_clientes ORDER BY xNome ASC";
	
	}else{
		$filtroSQL="SELECT id_clientes, xNome, CNPJ, CPF, cpf_cnpj, responsavel FROM tbnext_mod_empresa_clientes WHERE xNome LIKE '%".$content."%'  ORDER BY xNome ASC";}

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

$maxRows_list_action = $list_qtdd;
$pageNum_list_action = 0;
if (isset($_GET['pageNum_list_action'])) {
  $pageNum_list_action = $_GET['pageNum_list_action'];
}
$startRow_list_action = $pageNum_list_action * $maxRows_list_action;

mysql_select_db($database_connection, $connection);
 $query_list_action = $filtroSQL;
$query_limit_list_action = sprintf("%s LIMIT %d, %d", $query_list_action, $startRow_list_action, $maxRows_list_action);
$list_action = mysql_query($query_limit_list_action, $connection) or die(mysql_error());
$row_list_action = mysql_fetch_assoc($list_action);

if (isset($_GET['totalRows_list_action'])) {
  $totalRows_list_action = $_GET['totalRows_list_action'];
} else {
  $all_list_action = mysql_query($query_list_action);
  $totalRows_list_action = mysql_num_rows($all_list_action);
}
$totalPages_list_action = ceil($totalRows_list_action/$maxRows_list_action)-1;



?>


<table width="100%" align="center" cellpadding="0" cellspacing="0"  class="table table-hover"   >
  <thead style="display:none;">
    <tr  >
      <th width="1%"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th width="31%" scope="col"> </th>
    </tr>
  </thead>
  <tbody>
 
    <?php if($totalRows_list_action >=1){ ?>
    <?php do { ?>
    <tr 
    onclick="addContentClientes('<?php echo $id_application= $row_list_action['id_clientes']; ?>','<?php echo $row_list_action['xNome']; ?>','<?php if($row_list_action['cpf_cnpj']==1){ echo $row_list_action['CNPJ'];}else{echo $row_list_action['CPF'];} ?>','<?php echo $row_list_action['responsavel']; ?>')"
     style="cursor:pointer;">
  
      <td scope="row" width="11%" align="left"><?php echo $row_list_action['id_clientes']; ?></td>
      <td width="57%" align="left"><?php echo $row_list_action['xNome']; ?></td>
      <td align="left"> <?php if($row_list_action['cpf_cnpj']==1){ echo $row_list_action['CNPJ'];}else{echo $row_list_action['CPF'];} ?></td>
      </tr>
    <?php } while ($row_list_action = mysql_fetch_assoc($list_action)); ?>
    <?php } ?>
  </tbody>
</table>
<?php
mysql_free_result($list_action);
?>
