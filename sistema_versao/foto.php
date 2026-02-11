<?php
	$imagens_edit=$_GET['imagens_edit'];
	
	switch($imagens_edit){
// ---------------------------------------------------------- IMAGEM-1
// -----------------------------------------ADINIONAR IMAGEM-1
		case 'imagens_add1':
			$imagens_edit_acao=imagens_edit1;
			$titulo="Minhas Imagens 1";
			break;
// -----------------------------------------ALTERAR IMAGEM-1			
		case 'imagens_alt1':
			$imagens_edit_acao=imagens_edit1;
			$titulo="Minhas Imagens 1";
			$imagens_alt=imagens_alt;
			break;
// ---------------------------------------------------------- IMAGEM-2
// -----------------------------------------ADINIONAR IMAGEM-2
		case 'imagens_add2':
			$imagens_edit_acao=imagens_edit2;
			$titulo="Minhas Imagens 2";
			break;
// -----------------------------------------ALTERAR IMAGEM-2			
		case 'imagens_alt2':
			$imagens_edit_acao=imagens_edit2;
			$titulo="Minhas Imagens 2";
			$imagens_alt=imagens_alt;
			break;
// ---------------------------------------------------------- IMAGEM-3
// -----------------------------------------ADINIONAR IMAGEM-3
		case 'imagens_add3':
			$imagens_edit_acao=imagens_edit3;
			$titulo="Minhas Imagens 3";
			break;
// -----------------------------------------ALTERAR IMAGEM-3			
		case 'imagens_alt3':
			$imagens_edit_acao=imagens_edit3;
			$titulo="Minhas Imagens 3";
			$imagens_alt=imagens_alt;
			break;
// ---------------------------------------------------------- IMAGEM-4
// -----------------------------------------ADINIONAR IMAGEM-4
		case 'imagens_add4':
			$imagens_edit_acao=imagens_edit4;
			$titulo="Minhas Imagens 4";
			$imagens_alt=imagens_alt;
			break;
// -----------------------------------------ALTERAR IMAGEM-4		
		case 'imagens_alt4':
			$imagens_edit=imagens_edit4;
			$titulo="Minhas Imagens 4";
			$imagens_alt=imagens_alt;
			break;
			
// ---------------------------------------------------------- IMAGEM-5
// -----------------------------------------ADINIONAR IMAGEM-5
		case 'imagens_add5':
			$imagens_edit_acao=imagens_edit5;
			$titulo="Minhas Imagens 5";
			$imagens_alt=imagens_alt;
			break;
// -----------------------------------------ALTERAR IMAGEM-5		
		case 'imagens_alt5':
			$imagens_edit_acao=imagens_edit5;
			$titulo="Minhas Imagens 5";
			$imagens_alt=imagens_alt;
			break;
///-------------------------------- Finalizando sistema de imagens

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

$colname_upload = "-1";
if (isset($_GET['id_imgs'])) {
  $colname_upload = $_GET['id_imgs'];
}
mysql_select_db($database_connection, $connection);
$query_list_dim = "SELECT * FROM tbnext_mod_barra_texto_images_dim ORDER BY posicao ASC";
$list_dim = mysql_query($query_list_dim, $connection) or die(mysql_error());
$row_list_dim = mysql_fetch_assoc($list_dim);
$totalRows_list_dim = mysql_num_rows($list_dim);
?>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<?php // include "../sistem_funcoes/perfusuario.php"; ?>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<div  class="div_absolute"></div>
<div  class="div_absolute_msn">
 <form action="?usuario=<?php echo $_GET['usuario']; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&indice=<?php echo $id_banco_recebe; ?>&<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;imagens_edit=<?php echo $imagens_edit_acao; ?>&amp;img_nome=<?php echo $_GET['img_nome']; ?>&imagens_alt=<?php echo $imagens_alt; ?>" method="POST" enctype="multipart/form-data" name="upload" id="upload">
	<br />
<br />
		
  <table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td width="383" background="<?php echo "$local_icons"; ?>barra-preta.jpg" bgcolor="#CCCCCC"><div align="center" class="textoTitulo_branco">
        <table width="450" height="24" border="0" cellpadding="0" cellspacing="0" class="txt-Indece">
          <tr>
            <td width="10%"><div align="center"><img src="<?php echo "$local_icons"; ?>add_imagem-30.png" width="30" height="30" border="0"   title=" Adicionar Foto "/></div></td>
            <td width="77%"><div align="center"><?php echo $titulo; ?></div></td>
            <td width="13%" ><div align="center"><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&<?php echo $row_list_alt['id_imgs']; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>" ><img src="<?php echo "$local_icons"; ?>logoff2-25.png" width="25" height="25" border="0" title=" FECHAR "/></a></div></td>
          </tr>
        </table>
      </div></td>
    </tr>
    <tr>
      <td class="texto_fund_cinza"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td colspan="2" class="txt"><div align="center" class="txt-Botao-Alterar">S&oacute; adiciona imagem com exten&ccedil;&atilde;o .jpg</div></td>
          </tr>
        <tr>
          <td colspan="2" align="center" class="txt">&nbsp;</td>
        </tr>
        <tr>
          <td width="31%" align="left" class="txt-opcoes">Escolha o tamanho:</td>
          <td width="69%" align="left" class="txt"><span id="spryselect1">
            <label>
              <select name="id_img_dim" class="txt-form" id="id_img_dim">
                <option value="">Selecione</option>
                <?php
do {  
?>
                <option value="<?php echo $row_list_dim['id_img_dim']?>"><?php echo $row_list_dim['nome_dimencao']?></option>
                <?php
} while ($row_list_dim = mysql_fetch_assoc($list_dim));
  $rows = mysql_num_rows($list_dim);
  if($rows > 0) {
      mysql_data_seek($list_dim, 0);
	  $row_list_dim = mysql_fetch_assoc($list_dim);
  }
?>
              </select>
            </label>
            <span class="selectRequiredMsg">Obrigatorio.</span></span></td>
        </tr>
        <tr>
          <td align="left" class="txt-opcoes">Procure a imagem:</td>
          <td align="left" class="txt"> <input  type="file" class="txt-form"  name="imagem" id="imagem" required />
</td>
        </tr>
        <tr>
          <td colspan="2" class="txt">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2" class="txt"><div align="center" class="txt-Botao-Excluir">N&atilde;o adicione imagem com acentua&ccedil;&atilde;o e espa&ccedil;o por exemplo:</div></td>
        </tr>
        <tr>
          <td colspan="2" class="txt"><div align="center" class="txt-Botao-Excluir">P&ocirc;r do sol.gif, caf&eacute;.gif e outros.</div></td>
        </tr>

      </table></td>
    </tr>
    <tr>
      <td class="txt-Indece" ><div align="center">
          <input name="enviar" type="submit" class="txt-Botao-ADD" id="enviar" value="Enviar" onClick="CarregarDiv('#res_carregando','../mod_slide_imagens/res_carregand.php')"  />
        </div>
      </label></td>
    </tr>
    
        <tr>
      <td class="txt" ><div id="res_carregando"></div></td>
    </tr>
    
    <tr>
      <td class="txt" ><?php if($_GET['img_nome']==''){
		} else 
		{echo "<br />Se j&aacute;  existe a imagem ir&aacute; duplicar-la &ldquo;Clique na op&ccedil;&atilde;o alterar&rdquo;";}?></td>
    </tr>
  </table>
</form></div>
<?php

mysql_free_result($list_dim);
?>
<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
//-->
</script>
