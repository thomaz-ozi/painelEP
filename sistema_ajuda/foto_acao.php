<?php $indece=$_GET['indice'];?>
<?php $usuario=$_GET['usuario']; ?>
<?php
	//feito 05/11/2009 - Alterado 07/11/2009 // 30/11/2009
	$imagens_alt=$_GET['imagens_alt'];
	$img_del=$_GET['img_nome'];
	if($imagens_alt==imagens_alt)	{
	
	//origem da fonte http://www.arquivodecodigos.net/sistema/main/visualizar_dica/2635 - Osmar J. Silva<br />
	//04/11/2009
  	//Caminho e nome do arquivo (o diretório no qual o arquivo 
  	//A ser excluído está deve ter permissão de escrita

  $arquivo_alt = $local_imagem.$img_del;
  // vamos excluir
  if(unlink($arquivo_alt)){
    $mensagem=  "<br />Arquivo ALTERADO com sucesso.";
  }
  else{
    $mensagem= "<br />N&atilde;o foi poss&iacute;vel ALTERADO o arquivo.";
  }
	
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
$query_list_dim = sprintf("SELECT * FROM tbnext_mod_barra_texto_images_dim WHERE id_img_dim = %s", GetSQLValueString($colname_list_dim, "int"));
$list_dim = mysql_query($query_list_dim, $connection) or die(mysql_error());
$row_list_dim = mysql_fetch_assoc($list_dim);
$totalRows_list_dim = mysql_num_rows($list_dim);
?>
<?php
//list_dimencionamento
$nome_dimencao=$row_list_dim['nome_dimencao'];
$altura_dim=$row_list_dim['altura'];
$largura_dim=$row_list_dim['largura'];
 // carrega do arquivo do tmp $_FILES
$MAX_SIZE = 999999;
$imagem=$_FILES["imagem"]["tmp_name"];
$tipo=$_FILES["imagem"]["type"];
$extencao=$_FILES["imagem"]["extension"];
$nome=$_FILES["imagem"]["name"];
$tamanho=$_FILES["imagem"]["size"];
$id=$_GET['indice'];
$aux=getimagesize($imagem);
$largura=$aux[0];
$altura=$aux[1];

/*  if ($tipo!="image/jpeg" and $tipo!="image/pjpeg" ) {
	$msg="Este arquivo nao tem extençao jpg $tipo";
	$indice=$id;
	echo("<script language='javascript'>location.href='?usuario=$usuario&amp;conteudo=imagens-alt&amp;imagens_add11=imagens_add11&indice=$indece&indice=$indice&id_imgs=$indice&conteudo=imagens-alt'</script>");
	exit;
} */

$arquivo = $nome;

while (file_exists($local_imagem. $arquivo)==1) {
	$a++;
	$arquivo = $a . "_" . $nome;
}
 
move_uploaded_file($imagem, $local_imagem .$arquivo);

if ($largura!=$largura_dim or $altura!=$altura_dim) {
	$tipo = "jpeg";
	$img = imagecreatefromjpeg($local_imagem.$arquivo);
	$width = imagesx($img);
	$height = imagesy($img);
	$imgsmall = ImageCreateTrueColor($largura_dim,$altura_dim);
	imagecopyresampled($imgsmall, $img, 0, 0, 0, 0, $largura_dim, $altura_dim, $width, $height);
	unlink($local_imagem .$arquivo);
	imagejpeg($imgsmall, $local_imagem .$arquivo, 80);
}

//$query="INSERT INTO fotos_produtos(cod_locacao,caminho) VALUES('$idimoveis','$arquivo')";

$query="UPDATE $nome_banco SET $img_full='$arquivo', $largura_full='$largura_dim', $altura_full='$altura_dim' , $nome_dimencao_full='$nome_dimencao' where  $id_banco='$indece'";

mysql_query($query, $connection) or die(mysql_error());
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
<?php  //include "../sistem_funcoes/perfusuario.php"; ?>
<div  class="div_absolute"></div>
<div  class="div_absolute_msn">
<p>&nbsp;</p><?php echo 'dsdsds1------'.$aux; ?>
<table width="33%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" valign="top" background="../icons/circulo_red/barra-preta.jpg" bgcolor="#FFFFFF"><table width="100%" height="24" border="0" cellpadding="0" cellspacing="0" class="txt-Indece">
      <tr>
        <td width="10%"><div align="center"><img src="<?php echo "$local_icons"; ?>add_imagem-30.png" width="30" height="30" border="0"   title=" Adicionar Foto "/></div></td>
        <td width="77%"><div align="center" class="style3"><span class="style1">Adicionar Imagens </span>1</div></td>
        <td width="13%" ><div align="center"><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $indece;?>&amp;conteudo=<?php echo $conteudo_imagens; ?>" ><img src="<?php echo "$local_icons"; ?>logoff2-25.png" width="25" height="25" border="0" title=" FECHAR "/></a></div></td>
      </tr>
    </table>      </td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="txt"><img src="../../minhas_imagens/<?php echo $arquivo; ?>" width="110" height="82" class="texto_branco" /><br />
<?php echo $mensagem; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
   <form method="POST" name="add_foto" id="add_foto"> <td colspan="2" align="center" bgcolor="#FFFFFF" class="txt-Indece">
    <a href="?<?php echo $usuario_get; ?>&conteudo=<?php echo $conteudo_inf; ?>"><img src="<?php echo "$local_icons"; ?>botao_form_ok.png" width="80" height="22" border="0" /></a><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>"></a>
    </td></form>
    </tr>

</table>
</div>
<?php
mysql_free_result($list_dim);
?>