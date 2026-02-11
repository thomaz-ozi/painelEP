
<?php
if ($_POST['opcao']=='codvoltar') {//verifica se o valor é inteiro

if($_POST['xPesq']!=''){

 require_once('../Connections/connection.php'); ?>
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

mysql_select_db($database_connection, $connection);
 $query_list_pesquisa_cod_verif = "SELECT Codigo FROM tbMod_canditados WHERE Codigo = '".$_POST['xPesq']."'";
$list_pesquisa_cod_verif = mysql_query($query_list_pesquisa_cod_verif, $connection) or die(mysql_error());
$row_list_pesquisa_cod_verif = mysql_fetch_assoc($list_pesquisa_cod_verif);
$totalRows_list_pesquisa_cod_verif = mysql_num_rows($list_pesquisa_cod_verif);
?>
<?php
if($totalRows_list_pesquisa_cod_verif ==0){
	if($_POST['xPesq']>=43){
		$_POST['xPesq']=$_POST['xPesq']-1;
		
		include ("../mod_iep_candidatos/acao_alt_load_pesquisa_codverif.php");
		 
	}else if($_POST['xPesq']<43){ 
	echo "Não tem registro menor que 43.";
	$_POST['xPesq']=43; }
$nv++;
}else{
	 $_POST['xPesq']=$row_list_pesquisa_cod_verif['Codigo'];
}


?>
<?php
mysql_free_result($list_pesquisa_cod_verif);
}}
?>
