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

mysql_select_db($database_connection, $connection_user);
$query_list_acao = "SELECT id_local, razao_social, fantasia, cnpj FROM tbnext_mod_empresa_local WHERE id_local = '".$id_local."' ORDER BY razao_social ASC";
$list_acao = mysql_query($query_list_acao, $connection_user) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
 // include"../sistem_funcoes/perfusuario.php";?>

<div style="width:30%; height:150px; float:left; background-color:#FFF; margin-left:2px; ;"  

  			
            onMouseOver="this.style.background='url(<?php echo $local_images; ?><?php echo $row_perfusuario['ap_tabela'];?>/barra-indece.png) repeat-x';  this.style.cursor = 'pointer';" 
            onMouseOut="this.style.background='white';"



><a href="?local=<?php echo $row_list_acao['id_local']; ?>"><img src="<?php echo "$icons_sistema_nome"; ?>" width="55" height="55" border="0" />
    <div align="center">LOCAL: <?php echo $row_list_acao['fantasia']; ?></div>
    <div align="center">RAZ&Atilde;O SOCIAL: <?php echo $row_list_acao['razao_social']; ?></div>
    
  <div align="center">CNPJ:<?php echo $row_list_acao['cnpj']; ?></div>
    
    </a></div>
    
<?php 

$edit_texto=$_GET['edit_texto'];

switch ($edit_texto){
	
	case '1':
	include ("../sistema_inicio/acao_alt.php");
	break;
	case '2':
	include ("");
	break;
}

mysql_free_result($list_acao);
?>