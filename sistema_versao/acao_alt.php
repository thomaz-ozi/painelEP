<?php  require_once('../Connections/connection.php'); ?>
<?php

$id_usuario=$row_perfusuario['id_usuario'];
$adm_perm_mod_textos_cascata01=$row_perfusuario['adm_perm_mod_textos_cascata01'];
if($adm_perm_mod_textos_cascata01== '1'){
	$and_sql='';
	}else{
		$and_sql =' WHERE  id_usuario = '.$id_usuario;}
?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
  $updateSQL = sprintf("UPDATE tbnext_mod_site_texto SET id_classe01=%s, id_usuario=%s, meta_title=%s, meta_description=%s, meta_keywords=%s, botao_pg=%s, pg=%s, texto_titulo=%s, texto=%s, posicao_botao=%s, ocultar_botao=%s, img_titulo1=%s, img_titulo2=%s, img_titulo3=%s, img_titulo4=%s, img_titulo5=%s WHERE id_texto=%s",
					   GetSQLValueString($_POST['id_classe01'], "int"),
					   GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['meta_title'], "text"),
                       GetSQLValueString($_POST['meta_description'], "text"),
                       GetSQLValueString($_POST['meta_keywords'], "text"),
                       GetSQLValueString($_POST['botao_pg'], "text"),
                       GetSQLValueString($_POST['pg'], "text"),
					   GetSQLValueString($_POST['texto_titulo'], "text"),
                       GetSQLValueString($_POST['texto'], "text"),
                       GetSQLValueString($_POST['posicao_botao'], "int"),
                       GetSQLValueString($_POST['ocultar_botao'], "int"),
                       GetSQLValueString($_POST['img_titulo1'], "text"),
                       GetSQLValueString($_POST['img_titulo2'], "text"),
                       GetSQLValueString($_POST['img_titulo3'], "text"),
                       GetSQLValueString($_POST['img_titulo4'], "text"),
                       GetSQLValueString($_POST['img_titulo5'], "text"),
                       GetSQLValueString($_POST['id_texto'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_texto'])) {
  $colname_list_acao = $_GET['id_texto'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_site_texto WHERE id_texto = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

mysql_select_db($database_connection, $connection);
$query_list_cascata01 = "SELECT * FROM tbnext_mod_site_texto_classe01 ".$and_sql." ORDER BY nome ASC";
$list_cascata01 = mysql_query($query_list_cascata01, $connection) or die(mysql_error());
$row_list_cascata01 = mysql_fetch_assoc($list_cascata01);
$totalRows_list_cascata01 = mysql_num_rows($list_cascata01);
// include "../funcoes/perfusuario.php"; ?>
<?php  include ("conf.php"); ?>

<?php
$ToolbarSet_editor = 'Default';
include "fckeditor/fckeditor.php";?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
&nbsp;
<form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
  <table width="98%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="3" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td  align="center"><img src="<?php echo "$local_icons"; ?>alt-30.png" width="30" height="30" /></td>
          <td align="left">&nbsp;&nbsp;Alterar</td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center">Otimize o Sistema de Busca</div></td>
    </tr>
    <tr>
      <td width="20%" align="left" class="txt-opcoes"><label for="checkbox_row_7">Title pagina:
          <input name="id_texto" type="hidden" id="id_texto" value="<?php echo $row_list_acao['id_texto']; ?>" />
          <input name="res" type="hidden" id="res" value="res" />
          <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
      </label></td>
      <td width="40%" align="left" class="txt"><label>
        <input name="meta_title" type="text" class="txt-form" id="meta_title" value="<?php echo $row_list_acao['meta_title']; ?>" style="width:220px;" />
      </label></td>
      <td width="40%" rowspan="3" align="left" class="txt">Ex: Google, Yahoo, Bing...</td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Descri&ccedil;&atilde;o:</td>
      <td align="left" class="txt"><label>
        <input name="meta_description" type="text" class="txt-form" id="meta_description" value="<?php echo $row_list_acao['meta_description']; ?>" style="width:220px;" />
      </label></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Palavra chave:</td>
      <td align="left" class="txt"><label>
        <input name="meta_keywords" type="text" class="txt-form" id="meta_keywords" value="<?php echo $row_list_acao['meta_keywords']; ?>" style="width:220px;" />
      </label></td>
    </tr>
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center">Alterar o texto do site</div></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes"> Pagina:</td>
      <td align="left" class="txt"><label><span id="sprytextfield1">
        <input name="pg" type="text" id="pg" value="<?php echo $row_list_acao['pg']; ?>" required class="txt-form"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></label></td>
      <td rowspan="2" align="left" class="txt">  
    <?php   if( $row_perfusuario['adm_perm_mod_textos'] == '1'){?>
	  <?php 
	  // ATIVAR OU DESATIVAR POSIÇÃO DE BOTÃO
	  if($posicao_botao=='1'){  
	  ?> 
      <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td width="43%" class="txt-opcoes">Posi&ccedil;&atilde;o do bot&atilde;o:</td>
            <td width="19%" class="txt"> <label>
              <input name="posicao_botao" type="text" class="txt-form" id="posicao_botao" value="<?php echo $row_list_acao['posicao_botao']; ?>" size="3" />
            </label></td>
            <td width="38%" align="center" valign="middle" class="txt">Crescente</td>
          </tr>
      </table><?php } ?>
    	<?php
		// ATIVAR OU DESATIVAR BOTÃO DE OCULTAR
	  	if ($ocultar_botao=='1'){
	  	?> 
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td width="43%" class="txt-opcoes">Ocultar bot&atilde;o:</td>
            <td width="57%" class="txt">
              <label>
                <input <?php if (!(strcmp($row_list_acao['ocultar_botao'],"1"))) {echo "checked=\"checked\"";} ?> name="ocultar_botao" type="radio" id="ocultar_botao_0" value="1" />
                SIM</label>
              <label>
                <input <?php if (!(strcmp($row_list_acao['ocultar_botao'],"2"))) {echo "checked=\"checked\"";} ?> name="ocultar_botao" type="radio" id="ocultar_botao_1" value="2" />
              N&Atilde;O</label>
            </td>
          </tr>
      </table>
      <?php } ?><?php } ?></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Bot&atilde;o da pagina:</td>
      <td align="left" class="txt"><input name="botao_pg" type="text" class="txt-form" id="botao_pg" value="<?php echo $row_list_acao['botao_pg']; ?>" required /></td>
    </tr><?php
		// ATIVAR OU DESATIVAR BOTÃO DE OCULTAR
	  	if ($cascata01=='1'){
	  	?>
    <tr>
      <td align="left" class="txt-opcoes"><?php echo $tra_cliente_mod_texto_cascata01; ?></td>
      <td align="left" class="txt">
        <select name="id_classe01" id="id_classe01" class="txt-form">
        <option value="" <?php if (!(strcmp("", $row_list_acao['id_classe01']))) {echo "selected=\"selected\"";} ?>>Selecione</option>
        <?php
do {  
?>
        <option value="<?php echo $row_list_cascata01['id_classe01']?>"<?php if (!(strcmp($row_list_cascata01['id_classe01'], $row_list_acao['id_classe01']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_cascata01['nome']?></option>
        <?php
} while ($row_list_cascata01 = mysql_fetch_assoc($list_cascata01));
  $rows = mysql_num_rows($list_cascata01);
  if($rows > 0) {
      mysql_data_seek($list_cascata01, 0);
	  $row_list_cascata01 = mysql_fetch_assoc($list_cascata01);
  }
?>
      </select>
      </td>
      <td align="left" class="txt">&nbsp;</td>
    </tr><?php } ?>
    <tr>
      <td align="left" class="txt-opcoes">Titulo do texto</td>
      <td align="left" class="txt"><span id="sprytextfield2">
        <label>
          <input name="texto_titulo" type="text" class="txt-form" id="texto_titulo" value="<?php echo $row_list_acao['texto_titulo']; ?>" required />
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td align="center" class="txt">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt-opcoes">Texto</td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#FFFFFF" class="txt">
      
                  <textarea class="editor" cols="80" id="texto" name="texto" rows="10" tabindex="1"><?php echo $row_list_acao['texto']; ?></textarea>
		  <script>
          CKEDITOR.replace( 'texto', {
          toolbar :'default'
          });
          </script>
      
      
   </td>
    </tr>
    <tr></tr>
    <tr>
      <td colspan="3" align="center" class="txt"><?php
	   // ATIVAR ou DESATIVAR IMAGEM
	  if($ati_des_imagens=='1'){  
	  ?> 
	  <?php 
	  // add sistema de imagem
	  // sao 3 include
	  //inclui a configuração do banco
	  include ("acao_alt_imagens_banco.php"); 
	  // add sistema de imagens
	  include("acao_alt_imagens.php"); 
	  // adicionar na ultima linha
	  //include('acao_alt_imagens_url.php');
	    ?><?php }?></td>
    </tr>
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center">
        <input name="Alterar2" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar2" value="|&lt; Voltar" />
        <input name="Alterar" type="submit" class="txt-Botao-Alterar" id="Alterar" value="Alterar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="acao" />
</form>
<?php 
//envio de resposta do formulario
$res=$_POST['res'];
if ($res==res){
	include "../sistema/res_alt.php";
} 

mysql_free_result($list_acao);

mysql_free_result($list_cascata01);
?>

<?php
// ATIVAR ou DESATIVAR IMAGEM
if($ati_des_imagens=='1'){  
?> 
		<?php //deixa na ultima linha  
			include('acao_alt_imagens_url.php'); 
		?>
<?php }?>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
