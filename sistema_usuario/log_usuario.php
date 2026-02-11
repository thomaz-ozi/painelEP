<?php
//------------------------------------------> gera da DATA
 $today = date("Y/m/d");   //2001/3/10 
 //----------------------------------------->gera da HORAS
 $time = time(); 
 $time_all =date("g:i",$time );
//------------------------------------------> recebe IP do usuario
$ip = $_SERVER['REMOTE_ADDR'];
?>
<?php 
//$usuario=$_POST['usuario'];
if (!isset($_SESSION)) {
  session_start();
}

//verifica e inicia o usuario
$id_session=$_SESSION['MM_UserGroup'];
?>
<?php require_once('../Connections/connection_user.php'); ?>
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


mysql_select_db($database_connection_user, $connection_user);
$query_filtre_user = sprintf("SELECT id_usuario, usuario, banco_dados FROM tbnext_usuario WHERE id_usuario = '$id_session'", GetSQLValueString($colname_filtre_user, "text"));
$filtre_user = mysql_query($query_filtre_user, $connection_user) or die(mysql_error());
$row_filtre_user = mysql_fetch_assoc($filtre_user);

$totalRows_filtre_user = mysql_num_rows($filtre_user);
 
//----------------- ADICIONANDO LOG USUARIO
//------------------------------------> declarando variaveis - formulario metodo "GET"
 
$id_logs = $_GET['id_logs'];
$is_usuarios =	$row_filtre_user['id_usuario'];
$data_inicio = $today;
$hora_inicio =$time_all;
$ip_usuario = $ip;
$banco_dados =	$row_filtre_user['banco_dados'];
//------------------> Incerir dados
$incluir='ok';
if ($incluir == "ok") {
   $insertSQL = sprintf("INSERT INTO tbnext_usuario_logs (`id_logs`, `id_usuarios`, `data_inicio`, `horas_inicio`, `ip_usuario`, banco_dados ) VALUES (NULL, '$is_usuarios ', '$data_inicio', '$hora_inicio', '$ip_usuario', '$banco_dados')");
  mysql_select_db($database_connection_user, $connection_user);
  $Result1 = mysql_query($insertSQL, $connection_user) or die(mysql_error());
}

//Abrindo o sistema
//padrão - $local ="../sistema/?startmod=&conteudo=inicio";
$local ="../sistema/?startmod=candidatos&conteudo=candidatos-alt";
    header("Location: " . $local );
	
// verificando se a LOCAL iniciada
if($_SESSION['LOCAL']==""){

include("../sistema_empresa_local/select_local_permissao_iniciar.php");

}

mysql_free_result($filtre_user);
?>