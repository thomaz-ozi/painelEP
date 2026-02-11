<?php
	$imagens_edit=$_GET['imagens_edit'];
	
	switch($imagens_edit){
// ---------------------------------------------------------- IMAGEM-1
// -----------------------------------------EXCLUIR IMAGEM-1
		case 'imagens_exc11':
			$imagens_edit='imagens_edit11';
			$titulo="Excluir Minhas Imagens 1";
			$imagem_full="img1";
			$largura_full='largura1'; 
			$altura_full='altura1'; 
			$nome_dimencao_full='nome_dimencao1'; 
			break;

// ---------------------------------------------------------- IMAGEM-2
// -----------------------------------------EXCLUIR IMAGEM-2
		case 'imagens_exc22':
			$imagens_edit='imagens_edit22';
			$titulo="Excluir Minhas Imagens 2";
			$imagem_full="img2";
			$largura_full='largura2'; 
			$altura_full='altura2'; 
			$nome_dimencao_full='nome_dimencao2';
			break;
//------------------------------------------------------ IMAGEM-3
// -----------------------------------------EXCLUIR IMAGEM-3
		case 'imagens_exc33':
			$imagens_edit='imagens_edit3';
			$titulo="Excluir Minhas Imagens 3";
			$imagem_full="img3";
			$largura_full='largura3'; 
			$altura_full='altura3'; 
			$nome_dimencao_full='nome_dimencao3';
			break;

// ---------------------------------------------------------- IMAGEM-4
// -----------------------------------------EXCLUIR IMAGEM-4
		case 'imagens_exc44':
			$imagens_edit='imagens_edit4';
			$titulo="Excluir Minhas Imagens 4";
			$imagem_full="img4";
			$largura_full='largura4'; 
			$altura_full='altura4'; 
			$nome_dimencao_full='nome_dimencao4';
			break;
// ---------------------------------------------------------- IMAGEM-5
// -----------------------------------------EXCLUIR IMAGEM-5
		case 'imagens_exc55':
			$imagens_edit='imagens_edit5';
			$titulo="Excluir Minhas Imagens 5";
			$imagem_full="img5";
			$largura_full='largura5'; 
			$altura_full='altura5'; 
			$nome_dimencao_full='nome_dimencao5';
			break;

	default:
	}
?><?php 
//apaga os dados da tabela
$_POST['MM_update']='add_foto';
$_POST['id_noticias']=$id_banco_recebe;
$_POST['img1']='';
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "add_foto")) {
   $updateSQL = sprintf("UPDATE $nome_banco SET $imagem_full=%s, $largura_full=%s, $altura_full=%s, $nome_dimencao_full=%s WHERE $id_banco=%s",
                       GetSQLValueString($_POST[''], "text"),
                       GetSQLValueString($_POST[''], "text"),
                       GetSQLValueString($_POST[''], "text"),
                       GetSQLValueString($_POST[''], "text"),
                       GetSQLValueString($_GET['id_produtos'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}
 

?>

<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style2 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style3 {
	color: #FFFFFF;
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<?php // include "../funcoes/estilo.php"; ?>
<div  class="div_absolute"></div>
<div  class="div_absolute_msn">
<p>&nbsp;</p>
<table width="33%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" valign="top" background="../icons/barra-preta.jpg" bgcolor="#FFFFFF"><table width="100%" height="24" border="0" cellpadding="0" cellspacing="0" class="txt-Indece">
      <tr>
        <td width="10%"><div align="center"><img src="<?php echo "$local_icons"; ?>add_imagem-30.png" width="30" height="30" border="0"   title=" Adicionar Foto "/></div></td>
        <td width="77%"><div align="center" class="style3"><span class="style1">Excluir Imagens </span></div></td>
        <td width="13%" ><div align="center"><a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;id_imgs=<?php echo $_GET['id_imgs']; ?>" ><img src="<?php echo "$local_icons"; ?>logoff2-25.png" width="25" height="25" border="0" title=" FECHAR "/></a></div></td>
      </tr>
    </table>      </td>
  </tr>
  <tr>
    <td height="90" colspan="2" align="center" valign="top" class="txt">
	

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="73" align="center" valign="middle"><?php echo $id_banco_recebe.$largura_full; ?><?php
	//origem da fonte http://www.arquivodecodigos.net/sistema/main/visualizar_dica/2635 - Osmar J. Silva<br />
	// 04/11/2009
  	// caminho e nome do arquivo (o diretório no qual o arquivo 
  	// a ser excluído está deve ter permissão de escrita
	
  $arquivo = $local_imagem.$_GET['img_nome'];
  
  // vamos excluir
  if(unlink($arquivo)){
    echo "<br />Arquivo exclu&iacute;do com sucesso.<br />";
  }
  else{
    echo "<br />N&atilde;o foi poss&iacute;vel excluir o arquivo.<br />";
  }
?>
          </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF" class="txt-Indece"><form action="<?php echo $editFormAction; ?>" method="POST" name="add_foto" id="add_foto">
    <input type="hidden" name="id_noticias" id="id_noticias>" />
    <input name="img1" type="hidden" id="img1" />
    <input name="altura1" type="hidden" id="altura1" />
    <input name="largura1" type="hidden" id="largura1" />
    <input name="nome_dimencao1" type="hidden" id="nome_dimencao1" />
<input type="hidden" name="res"  id="res" value="res" />
<a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_banco; ?>=<?php echo $_GET['id_produtos']; ?>" >
<img src="<?php echo "$local_icons"; ?>botao_form_ok.png" width="80" height="22" border="0" /></a>
<input type="hidden" name="MM_update" value="add_foto" />
    </form></td>
    </tr>
  <tr>
    <td width="23%">    </td>
    <td width="77%">    </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
</table>
</div>
