<?php require_once('../../Connections/connection_user.php'); ?>
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
//recebe a premissao do usuario 
mysql_select_db($database_connection, $connection_user);
   $query_list_acao_permissao_permissao = "SELECT * FROM tbnext_mod_empresa_local_usuario_permisao WHERE id_usuario = '".$row_perfusuario['id_usuario']."'";
$list_acao_permissao_permissao = mysql_query($query_list_acao_permissao_permissao, $connection_user) or die(mysql_error());
$row_list_acao_permissao_permissao = mysql_fetch_assoc($list_acao_permissao_permissao);
$totalRows_list_acao_permissao_permissao = mysql_num_rows($list_acao_permissao_permissao);

 $id_local= $row_list_acao_permissao_permissao['id_local'];
 $totalRows_list_acao_permissao_permissao;

switch($totalRows_list_acao_permissao_permissao){
	
	
	case '0':
		echo '<br>
			<div style="background-color:#FFF; font-family:Verdana; font-size:18px;  color:#900; margin:auto; ">Este usuario não tem permissão.</div>
			<div style="text-align:center; background-color:#FFF; font-family:Verdana;">
Entre em contato com adminitrador do sitema para mais formações
</div>';
	break;
	

	case '1':

		//initialize the session
		if (!isset($_SESSION)) {
 	 session_start();
	}
	$_SESSION['LOCAL']=$id_local;
	echo '<style onload="refreshJS(1)"></style> <meta http-equiv="refresh" content="0"> ';
	//echo "foi";
	 break;
	 
	 default;
	 do {
		include("../sistema_empresa_local/select_local_permissao.php");
	
	 } while ($row_list_acao_permissao_permissao = mysql_fetch_assoc($list_acao_permissao_permissao)); 
 
 	break;
} ?>

<script>
refreshJS(1);
</script>