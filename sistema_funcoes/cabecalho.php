<?php
 require_once('../Connections/connection_user.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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
$query_next_versao = "SELECT * FROM tbnext_sistem";
$next_versao = mysql_query($query_next_versao, $connection_user) or die(mysql_error());
$row_next_versao = mysql_fetch_assoc($next_versao);
$totalRows_next_versao = mysql_num_rows($next_versao);
?>

<!DOCTYPE html>
<html lang="BR"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<head>
    <meta charset="utf-8">
    <meta name="Language" 		content="PT-BR">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Painel Next">
    <meta name="author" content="Grupo Next">
    <title><?php echo $row_next_versao['nome_next']; ?> - <?php echo $row_next_versao['versao_next']; ?></title>
    
<meta name="DC.title" 		content="Next System Web" />	
<meta name="DC.Subject" 	content="Next System Web" />	
<meta name="DC.publisher" 	content="Next System Web" />	
<meta name="DC.identifier" 	content="www.gruponext.com.br" />	
<meta name="DC.rights" 		content="All rights reserved." />

<meta name="description" content="<?php echo $row_listSistema['descriscaoBanco']; ?>">
<link rel="icon" type="image/png" href="sistema_aparencia/favicon.png" />
<?php // include "../sistem_funcoes/perfusuario.php";?>
</head>

<?php
mysql_free_result($next_versao);
?>

