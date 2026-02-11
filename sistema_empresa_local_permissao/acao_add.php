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
echo $_POST["MM_insert"];
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
 echo  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_local_usuario_permisao (id_local_permissao,  id_usuario, id_local) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id_local_permissao'], "int"), 
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['id_local'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}

mysql_select_db($database_connection, $connection);
$query_list_fazendas = "SELECT id_local, razao_social, fantasia, cnpj FROM tbnext_mod_empresa_local ORDER BY razao_social ASC";
$list_fazendas = mysql_query($query_list_fazendas, $connection) or die(mysql_error());
$row_list_fazendas = mysql_fetch_assoc($list_fazendas);
$totalRows_list_fazendas = mysql_num_rows($list_fazendas);



?>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<form action="<?php echo $editFormAction; ?>" method="POST" name="acao" id="acao">
<?php 
$acao_comum="Adicionar";
$acao_icons="add-30.png";
include ("../sistema/index_content_head.php");?>

<table width="98%" border="0" cellpadding="0" cellspacing="1" class="texto">
           <tr>
            <td colspan="2" valign="top">
            <?php
		  $id_usuario=$_GET['id_usuario'];
		   include("../sistema_usuario/list_usuario.php"); ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="20%" bgcolor="#FFFFFF" class="txt-opcoes">Usuario:</td>
              <td width="80%" class="txt"> <?php  echo $row_list_acao_usuario['usuario']; ?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="txt-opcoes">Nome:</td>
              <td class="txt"><?php  echo $row_list_acao_usuario['nome']; ?> <?php  echo $row_list_acao_usuario['sobrenome']; ?></td>
            </tr>
          </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="16%" class="txt-opcoes">Empresa:
                    <input type="hidden" name="id_local_permissao" id="id_local_permissao" />
                  <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $_GET['id_usuario']; ?>" />
                  <input name="res" type="hidden" id="res" value="res" />
                  <input type="hidden" name="MM_insert" value="acao">
                  </td>
                <td width="84%" class="txt"><span id="spryselect1">
                    <select name="id_local" id="id_local" class="txt-form" required>
                      <option value="">Selecione</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_list_fazendas['id_local']?>">FAZENDA: <?php echo $row_list_fazendas['fantasia']?>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;RAZAO SOCIAL: <?php echo $row_list_fazendas['razao_social']?></option>
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
            <td colspan="2" align="center" valign="top" >
                <input name="Alterar" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar" value="|&lt; Voltar" />
                <input name="adicionar" type="submit" class="txt-Botao-ADD" id="adicionar" value="Adicionar" />
            </td>
          </tr>
  </table>

</form>
<?php 
// data de construcao 24/09/2009 - 20:32
//envio de resposta do formulario
if ($_POST['res']=='res'){
	include "res_add.php";
}

?>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
<?php
mysql_free_result($list_fazendas);
?>
