<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../Connections/connection.php'); ?>
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

if ((isset($_POST['IdObjetivo'])) && ($_POST['IdObjetivo'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbMod_canditadosObjet WHERE IdObjetivo=%s",
                       GetSQLValueString($_POST['IdObjetivo'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
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
$acao_comum="Excluir";
$acao_icons="excluir-30.png";
$msn='<div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>   </button>
           <strong><center>TEM CERTEZA EM EXCLUIR ESSAS INFORMAÇÕES?</center></strong>
      </div>';
include ("../sistema/index_content_head.php");?>

<form name="acao" method="POST">


  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="16%" align="left"  class="txt-opcoes">Objetivos*:
        <input name="res" type="hidden" id="res" value="res" />
        <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
        <input name="DataRegistroAlt" type="hidden" id="DataRegistroAlt" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
        <input name="IdObjetivo" type="hidden" id="IdObjetivo" value="<?php echo $row_list_acao['IdObjetivo']; ?>" /></td>
      <td width="84%" align="left"  class="txt"><span id="sprytextfield3">
        <input name="Objetivo" type="text" disabled required class="form-control col-md-5 col-sm-5 col-xs-12" id="Objetivo" value="<?php echo convert_utf8($row_list_acao['Objetivo']); ?>"/>
      </span></td>
    </tr>
    <tr>
      <td colspan="2" align="left"  class="txt-opcoes">Descri&ccedil;&atilde;o:</td>
    </tr>
    <tr>
      <td colspan="2" align="center"  class="txt">
          <textarea name="descricao" rows="10" disabled class="form-control"  id="descricao" tabindex="2"><?php echo $row_list_acao['descricao']; ?></textarea>
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
    <button type="button" class="btn btn-primary"    
          onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-add');return document.MM_returnValue"
><i class="fa fa-file-text-o"></i> Novo</button>
 <button type="button" class="btn btn-success"    
          onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
><i class="fa fa-edit"></i> Alterar</button>
    <button type="submit" class="btn btn-danger"       
><i class="fa fa-times"></i> Excluir</button>

</div>
</form>
<?php 

if ($_POST['res']==res){include "res_exc.php";}



mysql_free_result($list_acao);


?>
