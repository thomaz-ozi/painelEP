<?php require_once('../Connections/connection.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
  $insertSQL = sprintf("INSERT INTO tbnext_mod_site_texto (id_texto, id_classe01, id_usuario, meta_title, meta_description, meta_keywords, botao_pg, pg, texto_titulo, texto, posicao_botao, ocultar_botao) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_texto'], "int"),
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
                       GetSQLValueString($_POST['ocultar_botao'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}

mysql_select_db($database_connection, $connection);
$query_list_acao_posicao = "SELECT id_texto, posicao_botao FROM tbnext_mod_site_texto ORDER BY posicao_botao DESC";
$list_acao_posicao = mysql_query($query_list_acao_posicao, $connection) or die(mysql_error());
$row_list_acao_posicao = mysql_fetch_assoc($list_acao_posicao);
$totalRows_list_acao_posicao = mysql_num_rows($list_acao_posicao);

mysql_select_db($database_connection, $connection);
$query_list_cascata01 = "SELECT * FROM tbnext_mod_site_texto_classe01  ".$and_sql." ORDER BY nome ASC";
$list_cascata01 = mysql_query($query_list_cascata01, $connection) or die(mysql_error());
$row_list_cascata01 = mysql_fetch_assoc($list_cascata01);
$totalRows_list_cascata01 = mysql_num_rows($list_cascata01);
 // include "../funcoes/estilo.php"; ?>

&nbsp;
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />


<form action="<?php echo $editFormAction; ?>" id="acao" name="acao" method="POST">
  <table width="98%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="3" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td ><img src="<?php echo "$local_icons"; ?>add-30.png" width="30" height="30" /></td>
          <td  align="left">&nbsp;&nbsp;Adicionar</td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center">Otimize o Sistema de Busca</div></td>
    </tr>
    <tr>
      <td width="20%" align="left" class="txt-opcoes"><label for="checkbox_row_7">Title pagina:
<input type="hidden" name="id_texto" id="id_texto" />
          <input name="res" type="hidden" id="res" value="res" />
          <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
      </label></td>
      <td width="38%" align="left" class="txt"><label>
        <input name="meta_title" type="text" class="txt-form" id="meta_title"  style="width:220px;" />
      </label></td>
      <td width="42%" rowspan="3" align="left" class="txt">Ex: Google, Yahoo, Bing...</td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Descri&ccedil;&atilde;o:</td>
      <td align="left" class="txt"><label>
        <input name="meta_description" type="text" class="txt-form" id="meta_description"  style="width:220px;" />
      </label></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Palavra chave:</td>
      <td align="left" class="txt"><label>
        <input name="meta_keywords" type="text" class="txt-form" id="meta_keywords"  style="width:220px;" />
      </label></td>
    </tr>
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center">Alterar o texto do site</div></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes"> Link da pagina:</td>
      <td align="left" class="txt"><span id="sprytextfield1">
        <input name="pg" type="text" id="pg" class="txt-form" required />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td rowspan="2" align="left" class="txt">
      <?php   if( $row_perfusuario['adm_perm_mod_textos'] == '1'){?>
	  <?php   if($posicao_botao=='1'){   ?> 
      <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td width="43%" class="txt-opcoes">Posi&ccedil;&atilde;o do bot&atilde;o:</td>
            <td width="19%" class="txt"> <label>
              <input name="posicao_botao" type="text" class="txt-form" id="posicao_botao" value="<?php 
			  $posicao_botao=$row_list_acao_posicao['posicao_botao']+1;
			  echo $posicao_botao; ?> " size="3" />
            </label></td>
            <td width="38%" align="center" valign="middle" class="txt">Crescente</td>
          </tr>
      </table><?php } ?>
            <?php 
	  if ($ocultar_botao=='1'){
	  ?> 
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td width="43%" class="txt-opcoes">Ocultar bot&atilde;o:</td>
            <td width="57%" class="txt"><label>
            <input name="ocultar_botao" type="radio" id="ocultar_botao" value="1" checked="checked" />
            SIM</label>
              <label>
          <input type="radio" name="ocultar_botao" id="ocultar_botao" value="2" />
          N&Atilde;O</label></td>
          </tr>
      </table>
      <?php } ?><?php } ?>
      </td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Bot&atilde;o pagina:</td>
      <td align="left" class="txt"><input name="botao_pg" type="text" class="txt-form" id="botao_pg" required/></td>
    </tr><?php
		// ATIVAR OU DESATIVAR BOTÃO DE OCULTAR
	  	if ($cascata01=='1'){
	  	?>
    <tr>
      <td align="left" class="txt-opcoes"><?php echo $tra_cliente_mod_texto_cascata01; ?></td>
      <td align="left" class="txt"><label>
        <select name="id_classe01" id="id_classe01">
          <option value="">Selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_cascata01['id_classe01']?>"><?php echo $row_list_cascata01['nome']?></option>
          <?php
} while ($row_list_cascata01 = mysql_fetch_assoc($list_cascata01));
  $rows = mysql_num_rows($list_cascata01);
  if($rows > 0) {
      mysql_data_seek($list_cascata01, 0);
	  $row_list_cascata01 = mysql_fetch_assoc($list_cascata01);
  }
?>
        </select>
      </label></td>
      <td align="left" class="txt">&nbsp;</td>
    </tr><?php } ?>
    <tr>
      <td align="left" class="txt-opcoes">Titulo do texto</td>
      <td align="left" class="txt"><span id="sprytextfield2">
        <label>
          <input name="texto_titulo" type="text" id="texto_titulo" required class="txt-form" />
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td align="center" class="txt">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt-opcoes">Texto</td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#FFFFFF" class="txt">
<textarea class="editor" cols="80" id="editor1" rows="10" tabindex="1"></textarea>

<script>
CKEDITOR.replace( 'editor1', {
toolbar :'default'

});
</script> 
           </td>
    </tr>
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center">
        <input name="Adicionar" type="submit" class="txt-Botao-ADD" id="Adicionar" value="Adicionar" />
      </div></td>
    </tr>
  </table>  
  
  
  
  
  <input type="hidden" name="MM_insert" value="form1" />
  <input type="hidden" name="MM_insert" value="acao" />
</form>
<?php 
//envio de resposta do formulario
$res=$_POST['res'];
if ($res==res){
	include "../sistema/res_add.php";
}

mysql_free_result($list_acao_posicao);

mysql_free_result($list_cascata01);
?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
