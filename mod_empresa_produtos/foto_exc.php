<?php $indece=$_GET['id_produtos'];?>
<?php $usuario=$_GET['usuario']; ?>
<?php
	$imagens_edit=$_GET['imagens_edit'];
	
	switch($imagens_edit){
// ---------------------------------------------------------- IMAGEM-1
// -----------------------------------------EXCLUIR IMAGEM-1
		case 'imagens_exc1':
			$imagens_edit='imagens_exc11';
			$titulo="Excluir Minhas Imagens 1";
			$imagem_full="img1";
			break;

// ---------------------------------------------------------- IMAGEM-2
// -----------------------------------------EXCLUIR IMAGEM-2
		case 'imagens_exc2':
			$imagens_edit='imagens_exc22';
			$titulo="Excluir Minhas Imagens 2";
			$imagem_full="img2";
			
			break;
//------------------------------------------------------ IMAGEM-3
// -----------------------------------------EXCLUIR IMAGEM-3
		case 'imagens_exc3':
			$imagens_edit='imagens_exc33';
			$titulo="Excluir Minhas Imagens 3";
			$imagem_full="img3";
			break;

// ---------------------------------------------------------- IMAGEM-4
// -----------------------------------------EXCLUIR IMAGEM-4
		case 'imagens_exc4':
			$imagens_edit='imagens_exc44';
			$titulo="Excluir Minhas Imagens 4";
			$imagem_full="img4";
			break;
// ---------------------------------------------------------- IMAGEM-5
// -----------------------------------------EXCLUIR IMAGEM-5
// 30/11/2009
		case 'imagens_exc5':
			$imagens_edit='imagens_exc55';
			$titulo="Excluir Minhas Imagens 5";
			$imagem_full="img5";
			break;
//------------------------ FIM
	default:
	}
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

$colname_list_dim = "-1";
if (isset($_POST['id_img_dim'])) {
  $colname_list_dim = $_POST['id_img_dim'];
}
mysql_select_db($database_connection, $connection);
$query_list_dim = sprintf("SELECT * FROM tbnext_produtos_images_dim WHERE id_img_dim = %s", GetSQLValueString($colname_list_dim, "int"));
$list_dim = mysql_query($query_list_dim, $connection) or die(mysql_error());
$row_list_dim = mysql_fetch_assoc($list_dim);
$totalRows_list_dim = mysql_num_rows($list_dim);
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
        <td width="77%"><div align="center" class="style3"><span class="style1"><?php echo $titulo; ?> </span></div></td>
        <td width="13%" ><div align="center"><a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>" ><img src="<?php echo "$local_icons"; ?>logoff2-25.png" width="25" height="25" border="0" title=" FECHAR "/></a></div></td>
      </tr>
    </table>      </td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="txt"><img src="<?php echo $local_imagem; ?><?php echo $_GET['img_nome']; ?>" width="110" height="82" border="0" class="texto_branco" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="txt"> <div class="txt-Botao-Excluir">Tem certeza que quer excluir esta foto?</div></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF" class="txt-Indece"><form method="POST" name="add_foto" id="add_foto">
		<a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>">
        <img src="<?php echo "$local_icons"; ?>botao_form_fechar.png" width="80" height="22" border="0" /></a>

        <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_banco; ?>=<?php echo $_GET['id_produtos']; ?>&amp;imagens_edit=<?php echo $imagens_edit; ?>&amp;img_nome=<?php echo $_GET['img_nome']; ?>">
        <img src="<?php echo "$local_icons"; ?>botao_form_excluir.png" width="80" height="22" border="0" /></a>
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
<?php
mysql_free_result($list_dim);
?>
