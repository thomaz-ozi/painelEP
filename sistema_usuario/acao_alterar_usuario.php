<?php require_once('../Connections/connection.php'); ?>
<?php
/*if (!function_exists("GetSQLValueString")) {
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
echo $query_list_usuario_local = "SELECT * FROM tbnext_mod_empresa_local_usuario_permisao WHERE id_local = '".$_SESSION['LOCAL']."' AND id_usuario='".$_GET['id_usuario']."'";
$list_usuario_local = mysql_query($query_list_usuario_local, $connection) or die(mysql_error());
$row_list_usuario_local = mysql_fetch_assoc($list_usuario_local);
$totalRows_list_usuario_local = mysql_num_rows($list_usuario_local);




//if($totalRows_list_usuario_local!=0){

*/

 //editado 14/11/2010

 
$_GET['id_usuario']=base64_decode( $_GET['id_usuario']); //---> 23/10/22017

	 //perfil do usuario
 	$perf_id_usuario=$row_perfusuario['id_usuario'];
	$perf_id_usuario_perm=$row_perfusuario['id_usuario_perm']; 
	$id_perm_status_usuario_perfil=$row_perfusuario['id_perm_status_usuario_perfil'];
	//lista de usuario
	
	$id_usuario=$row_list_acao['id_usuario'];
	$id_usuario_get=$_GET['id_usuario'];
	$id_usuario_perm=$row_list_acao['id_usuario_perm']; 
	
	$_SESSION['MM_UserGroup'];
	
	 //usuario administrador do sistema
if($_GET['id_usuario']=='0'){
	include ("acao_alterar_usuario_restirto.php");
	echo "0";
}else{
		 //usuario administrador
	if($id_perm_status_usuario_perfil=='1'){
		
		if($row_perfusuario['id_usuario']== $id_usuario_get){
			echo "1";
			 include ("acao_alterar_usuario_restirto.php");
			}else{
					 include("acao_alterar_usuario_adm.php");
					 echo "2";
				}
		 			 
		 //usuario normal
	}elseif($id_perm_status_usuario_perfil>1){
		include ("acao_alterar_usuario_restirto.php");
		echo "3";
		
		
		  //usuario restrito
	
	}elseif($id_perm_status_usuario_perfil==3){
		include ("acao_alterar_usuario_restirto.php");
		echo "4";
			}
 }
 /*	}else{
	 echo '	<center><br>
	 <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    Não tem permissão ou ocorreu um erro <br> contate o adminstrador do sistema<br>
                  </div>
			<br><br><br>';
	 echo '<button type="button" class="btn btn-default"  onClick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button></center>';
	 }
mysql_free_result($list_usuario_local);
*/
?>
