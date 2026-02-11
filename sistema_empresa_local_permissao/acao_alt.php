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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
  $updateSQL = sprintf("UPDATE tbnext_mod_empresa_local_usuario_permisao SET id_usuario=%s, id_local=%s WHERE id_local_permissao=%s",
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['id_local'], "int"),
                       GetSQLValueString($_POST['id_local_permissao'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_local_permissao'])) {
  $colname_list_acao = $_GET['id_local_permissao'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_empresa_local_usuario_permisao WHERE id_local_permissao = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

mysql_select_db($database_connection, $connection);
$query_list_fazendas = "SELECT id_local, razao_social, fantasia, cnpj FROM tbnext_mod_empresa_local ORDER BY razao_social ASC";
$list_fazendas = mysql_query($query_list_fazendas, $connection) or die(mysql_error());
$row_list_fazendas = mysql_fetch_assoc($list_fazendas);
$totalRows_list_fazendas = mysql_num_rows($list_fazendas);
?>
<form action="<?php echo $editFormAction; ?>&id_usuario=<?php echo $_GET['id_usuario']; ?>" method="POST" name="acao" id="acao">
<?php 
$acao_comum="Adicionar";
$acao_icons="alt-30.png";
include ("../sistema/index_content_head.php");?>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="texto">
          <tr>
            <td colspan="2" valign="top">
            
            
                      
              <?php
		  $id_usuario=$row_list_acao['id_usuario'];
		   include("../sistema_usuario/list_usuario.php"); ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="20%" bgcolor="#FFFFFF" class="txt-opcoes">Usuario:</td>
                  <td width="80%" class="txt"><?php  echo $row_list_acao_usuario['usuario']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="txt-opcoes">Nome:</td>
                  <td class="txt"><?php  echo $row_list_acao_usuario['nome']; ?>
                  <?php  echo $row_list_acao_usuario['sobrenome']; ?></td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="36%" class="txt-opcoes">Empresa
                    <input name="id_local_permissao" type="hidden" id="id_local_permissao" value="<?php echo $row_list_acao['id_local_permissao']; ?>" />
                    <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>" />
                  <input name="res" type="hidden" id="res" value="res" /></td>
                  <td width="64%" class="txt"><span id="spryselect1">
                    <label for="id_fazenda"></label>
                    <select name="id_local" id="id_local" class="txt-form">
                      <option value="" <?php if (!(strcmp("", $row_list_acao['id_local']))) {echo "selected=\"selected\"";} ?>>Selecione</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_list_fazendas['id_local']?>"<?php if (!(strcmp($row_list_fazendas['id_local'], $row_list_acao['id_local']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_fazendas['fantasia']?></option>
                      <?php
} while ($row_list_fazendas = mysql_fetch_assoc($list_fazendas));
  $rows = mysql_num_rows($list_fazendas);
  if($rows > 0) {
      mysql_data_seek($list_fazendas, 0);
	  $row_list_fazendas = mysql_fetch_assoc($list_fazendas);
  }
?>
                    </select>
                    <span class="selectRequiredMsg"></span></span></td>
                </tr>

            </table></td>
          </tr>

          <tr>
            <td colspan="2" align="center"valign="top">
                <input name="Alterar2" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar2" value="|&lt; Voltar" />
                
                <input name="Alterar" type="submit" class="txt-Botao-Alterar" id="Alterar" value="Alterar" />
            </td>
          </tr>
      </table>
<input type="hidden" name="MM_update" value="acao" />
</form>
<?php 
// data de construcao 24/09/2009 - 20:32
//envio de resposta do formulario
$list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "../sistema_empresa_local_permissao/res_alt.php";
}

?>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
<?php
mysql_free_result($list_acao);

mysql_free_result($list_fazendas);
?>
