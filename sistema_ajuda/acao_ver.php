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

$colname_list_acao = "-1";
if (isset($_GET['id_ajuda'])) {
  $colname_list_acao = $_GET['id_ajuda'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_sistema_ajuda WHERE id_ajuda = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

mysql_select_db($database_connection, $connection);
$query_list_cascata01 = "SELECT * FROM tbnext_sistema_ajuda_classe01 ".$and_sql." ORDER BY xNome ASC";
$list_cascata01 = mysql_query($query_list_cascata01, $connection) or die(mysql_error());
$row_list_cascata01 = mysql_fetch_assoc($list_cascata01);
$totalRows_list_cascata01 = mysql_num_rows($list_cascata01);
 ?>

<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<form id="acao" name="acao" method="POST">
  <table width="98%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="3" align="center" class="txt-indece-titulo"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
          <td  align="left">&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td  align="center"><img src="<?php echo "$local_icons"; ?>ver-30.png" width="30" height="30" /></td>
          <td align="left">&nbsp;&nbsp;VER</td>
        </tr>
      </table></td>
    </tr>
    

    </tr>
    <?php
		// ATIVAR OU DESATIVAR BOTÃO DE OCULTAR
	  	if ($cascata01=='1'){
	  	?>
    <tr>
      <td width="20%" align="left" class="txt-opcoes"><?php echo $tra_cliente_mod_texto_cascata01; ?></td>
      <td width="40%" align="left" class="txt">
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
      <td align="left" class="txt-opcoes">Titulo</td>
      <td align="left" class="txt">
          <input name="texto_titulo" type="text" disabled required class="txt-form" id="texto_titulo" value="<?php echo $row_list_acao['xNome']; ?>" />
     </td>
      <td align="center" class="txt">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt-opcoes">Texto</td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#FFFFFF" class="txt">
      
                  <textarea name="texto" cols="80" rows="10" disabled class="editor" id="texto" tabindex="1"><?php echo $row_list_acao['descricao']; ?>
</textarea>
		  <script>
          CKEDITOR.replace( 'texto', {
          toolbar :'basic'
          });
          </script>
      
      
   </td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="txt">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" class="txt-Indece"><div align="center">
        <input name="Alterar2" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar2" value="|&lt; Voltar" />
      </div></td>
    </tr>
  </table>
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




