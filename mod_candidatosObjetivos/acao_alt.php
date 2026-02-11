<?php require_once('../Connections/connection.php'); 

                       $_POST['id_usuario']=$row_perfusuario['id_usuario'];
                       $_POST['DataRegistroAlt']=date(Y.'-'.m.'-'.d.' '.H.':'.m.':'.s);


?>
<?php include ("../sistema_funcoes/converter_utf8.php");?>


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
  $updateSQL = sprintf("UPDATE tbMod_canditadosObjet SET Objetivo=%s, descricao=%s, id_usuario=%s, DataRegistroAlt=%s WHERE IdObjetivo=%s",
                       GetSQLValueString($_POST['Objetivo'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['DataRegistroAlt'], "date"),
                       GetSQLValueString($_POST['IdObjetivo'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['IdObjetivo'])) {
  $colname_list_acao = $_GET['IdObjetivo'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbMod_canditadosObjet WHERE IdObjetivo = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

?>

<?php 
$acao_comum="Alterar";
$acao_icons="alt-30.png";
include ("../sistema/index_content_head.php");?>

<form action="<?php echo $editFormAction; ?>" name="acao" method="POST">


  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="16%" align="left"  class="txt-opcoes">Objetivos*:
        <input name="res" type="hidden" id="res" value="res" />
        <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
        <input name="DataRegistroAlt" type="hidden" id="DataRegistroAlt" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
        <input name="IdObjetivo" type="hidden" id="IdObjetivo" value="<?php echo $row_list_acao['IdObjetivo']; ?>" /></td>
      <td width="84%" align="left"  class="txt"><span id="sprytextfield3">
        <input name="Objetivo" type="text" required class="form-control col-md-5 col-sm-5 col-xs-12" id="Objetivo" value="<?php echo convert_utf8($row_list_acao['Objetivo']); ?>"/>
      </span></td>
    </tr>
    <tr>
      <td colspan="2" align="left"  class="txt-opcoes">Descri&ccedil;&atilde;o:</td>
    </tr>
    <tr>
      <td colspan="2" align="center"  class="txt">
          <textarea class="form-control"  id="descricao" name="descricao" rows="10" tabindex="2"><?php echo $row_list_acao['descricao']; ?></textarea>
	<script>
       CKEDITOR.replace( 'descricao', {
       toolbar :'basic'
       });
    </script>
      
      </td>
    </tr>

  </table>
<div class="btn-group">
        <button type="button" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>
        <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> Salvar&nbsp;&nbsp;&nbsp;</button>
    <button type="button" class="btn btn-primary"    
          onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-add');return document.MM_returnValue"
><i class="fa fa-file-text-o"></i> Novo</button>
    <button type="button" class="btn btn-danger"       
        onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc');return document.MM_returnValue"
><i class="fa fa-times"></i> Excluir</button>

</div>
  <input type="hidden" name="MM_update" value="acao" />
</form>
<?php 
//envio de resposta do formulario
$list=$_POST['list'];
$res=$_POST['res'];
if ($res==res){
	include "res_alt.php";
}


mysql_free_result($list_acao);


?>
