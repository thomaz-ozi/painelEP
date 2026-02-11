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

$maxRows_list_acao_esq = 1;
$pageNum_list_acao_esq = 0;
if (isset($_GET['pageNum_list_acao_esq'])) {
  $pageNum_list_acao_esq = $_GET['pageNum_list_acao_esq'];
}
$startRow_list_acao_esq = $pageNum_list_acao_esq * $maxRows_list_acao_esq;

$colname_list_acao_esq = "-1";
if (isset($_GET['Codigo'])) {
  $colname_list_acao_esq = $_GET['Codigo'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao_esq = sprintf("SELECT Codigo FROM tbMod_canditados WHERE Codigo > '%s' ORDER BY Codigo ASC", GetSQLValueString($colname_list_acao_esq, "int"));
$query_limit_list_acao_esq = sprintf("%s LIMIT %d, %d", $query_list_acao_esq, $startRow_list_acao_esq, $maxRows_list_acao_esq);
$list_acao_esq = mysql_query($query_limit_list_acao_esq, $connection) or die(mysql_error());
$row_list_acao_esq = mysql_fetch_assoc($list_acao_esq);

if (isset($_GET['totalRows_list_acao_esq'])) {
  $totalRows_list_acao_esq = $_GET['totalRows_list_acao_esq'];
} else {
  $all_list_acao_esq = mysql_query($query_list_acao_esq);
  $totalRows_list_acao_esq = mysql_num_rows($all_list_acao_esq);
}
$totalPages_list_acao_esq = ceil($totalRows_list_acao_esq/$maxRows_list_acao_esq)-1;





//voltar
$maxRows_list_acao_dir = 1;
$pageNum_list_acao_dir = 0;
if (isset($_GET['pageNum_list_acao_dir'])) {
  $pageNum_list_acao_dir = $_GET['pageNum_list_acao_dir'];
}
$startRow_list_acao_dir = $pageNum_list_acao_dir * $maxRows_list_acao_dir;

$colname_list_acao_dir = "-1";
if (isset($_GET['Codigo'])) {
  $colname_list_acao_dir = $_GET['Codigo'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao_dir = sprintf("SELECT Codigo FROM tbMod_canditados WHERE Codigo > %s ORDER BY Codigo ASC", GetSQLValueString($colname_list_acao_dir, "int"));
$query_limit_list_acao_dir = sprintf("%s LIMIT %d, %d", $query_list_acao_dir, $startRow_list_acao_dir, $maxRows_list_acao_dir);
$list_acao_dir = mysql_query($query_limit_list_acao_dir, $connection) or die(mysql_error());
$row_list_acao_dir = mysql_fetch_assoc($list_acao_dir);

 $totalRows_list_acao_dir ;
  
if (isset($_GET['totalRows_list_acao_dir'])) {
  $totalRows_list_acao_dir = $_GET['totalRows_list_acao_dir'];
} else {
  $all_list_acao_dir = mysql_query($query_list_acao_dir);
  $totalRows_list_acao_dir = mysql_num_rows($all_list_acao_dir);
}
$totalPages_list_acao_dir = ceil($totalRows_list_acao_dir/$maxRows_list_acao_dir)-1;


mysql_select_db($database_connection, $connection);
$query_list_ultimo = "SELECT Codigo FROM tbMod_canditados ORDER BY Codigo DESC";
$list_ultimo = mysql_query($query_list_ultimo, $connection) or die(mysql_error());
$row_list_ultimo = mysql_fetch_assoc($list_ultimo);
$totalRows_list_ultimo = mysql_num_rows($list_ultimo);


?>



<script>

$(function(){
	var 	bt_c='<div class="btn-group">';
	<?php
	
	 do { ?>
			bt_c+='<button class="btn btn-default" type="button" 	 onClick="loadsData(\'#PesquisaAvancadaLoad\',\'../mod_iep_candidatos/acao_alt_load.php\',\'&opcao=codvoltar&xPesq=<?php echo $_GET['Codigo']-1; ?>&PesquisaAvancadaColunas=Codigo\')" >	<i class="fa fa-caret-left"></i></button>';
			  <?php } while ($row_list_acao_esq = mysql_fetch_assoc($list_acao_esq)); ?>

			bt_c+=' <button class="btn btn-info" type="button" > ';
			bt_c+='<?php echo $_GET['Codigo']; ?>';
			bt_c+='</button>';
			  <?php if($totalRows_list_acao_dir >0){ do { ?>

			bt_c+='<button class="btn btn-default" type="button" onClick="loadsData(\'#PesquisaAvancadaLoad\',\'../mod_iep_candidatos/acao_alt_load.php\',\'&xPesq=<?php echo $row_list_acao_dir['Codigo']; ?>&PesquisaAvancadaColunas=Codigo\')"><i class="fa fa-caret-right"></i></button>';

			  <?php } while ($row_list_acao_dir = mysql_fetch_assoc($list_acao_dir)); 
			  if($row_list_acao_dir['Codigo']!=$row_list_ultimo['Codigo']){
			   ?>
			//ultimo registro  	
			bt_c+='<button class="btn btn-default" type="button" onClick="loadsData(\'#PesquisaAvancadaLoad\',\'../mod_iep_candidatos/acao_alt_load.php\',\'&xPesq=<?php  echo $row_list_ultimo['Codigo'] ?>&PesquisaAvancadaColunas=Codigo\')" title="Último registro"><i class="fa fa-step-forward"></i></button>';
			  <?php }}?>

			bt_c+='</div>';
$("#BarraPesquisaCodigoLoad").html(bt_c);

});
</script>


<?php
mysql_free_result($list_acao_dir);

mysql_free_result($list_acao_esq);

mysql_free_result($list_ultimo);
?>
