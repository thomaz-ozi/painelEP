<?php require_once('../../Connections/connection_user.php'); ?>
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
//recebe a premissao do usuario 
mysql_select_db($database_connection, $connection_user);
$query_list_acao_permissao_permissao = "SELECT * FROM tbnext_mod_empresa_local_usuario_permisao WHERE id_usuario = '".$row_perfusuario['id_usuario']."'";
$list_acao_permissao_permissao = mysql_query($query_list_acao_permissao_permissao, $connection_user) or die(mysql_error());
$row_list_acao_permissao_permissao = mysql_fetch_assoc($list_acao_permissao_permissao);
$totalRows_list_acao_permissao_permissao = mysql_num_rows($list_acao_permissao_permissao);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td width="2%" class="txt-Indece">&nbsp;</td>
    <td width="94%" class="txt-Indece">&nbsp;</td>
    <td width="4%" align="center" class="txt-Indece">&nbsp;</td>
  </tr>
  <tr>
    <td class="txt">&nbsp;</td>
    <td align="left" class="txt"><br>      
    <br></td>
    <td class="txt">&nbsp;</td>
  </tr>
  <tr>
    <td class="txt">&nbsp;</td>
    <td rowspan="2" align="center" class="txt">
	<?php if($totalRows_list_acao_permissao_permissao!=0){ ?>
	<?php do { ?>
          <?php $id_local= $row_list_acao_permissao_permissao['id_local']; ?>

<?php include ("select_local_empresa.php"); ?>
    <?php } while ($row_list_acao_permissao_permissao = mysql_fetch_assoc($list_acao_permissao_permissao)); ?>
        <div style="clear:both"></div>
		<?php } ?></td>
    <td align="center" class="txt">&nbsp;</td>
  </tr>
  <tr>
    <td class="txt">&nbsp;</td>
    <td class="txt">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="txt-Indece">&nbsp;</td>
  </tr>
</table><br />
<br />
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

mysql_free_result($list_acao_permissao_permissao);
?>
<?php 
if($row_perfusuario['adm_perm_sistem_usuario_perfil']==1){
include ("../sistema_inicio/ativar_cliente.php"); } ?>
