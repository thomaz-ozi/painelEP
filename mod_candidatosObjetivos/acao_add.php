<?php require_once('../Connections/connection.php'); 

    $_POST['id_usuario']=$row_perfusuario['id_usuario'];
     $_POST['DataRegistro']=date(Y.'-'.m.'-'.d.' '.H.':'.m.':'.s);
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
   $insertSQL = sprintf("INSERT INTO tbMod_canditadosObjet (Objetivo, descricao, id_usuario, DataRegistro) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['Objetivo'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['DataRegistro'], "date"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
?>
<?php 
$acao_comum="Adicionar";
$acao_icons="add-30.png";
include ("../sistema/index_content_head.php");?>

<form action="<?php echo $editFormAction; ?>" name="acao" method="POST">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="16%" align="left"  class="txt-opcoes">Objetivos*:
        <input name="res" type="hidden" id="res" value="res" />
        <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_perfusuario['id_usuario']; ?>" />
        <input name="DataRegistro" type="hidden" id="DataRegistro" value="<?php echo $row_perfusuario['id_usuario']; ?>" /></td>
      <td width="84%" align="left"  class="txt"><input name="Objetivo" type="text" required class="form-control col-md-7 col-xs-12" id="Objetivo"/></td>
    </tr>
    <tr>
      <td colspan="2" align="left"  class="txt-opcoes">Descri&ccedil;&atilde;o:</td>
    </tr>
    <tr>
      <td colspan="2" align="center"  class="txt"><textarea class="form-control"  id="descricao" name="descricao" rows="10" tabindex="1"></textarea>
      <script>
       CKEDITOR.replace( 'descricao', {
       toolbar :'basic'
       });
    </script></td>
    </tr>
  </table>
  <div class="btn-group">

  <button type="button" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>
        <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> Salvar&nbsp;&nbsp;&nbsp;</button>
  <input type="hidden" name="MM_insert" value="acao" />
  </div>
</form>
<?php 
//Resposta do formulario
if ($_POST['res']=='res'){include "../sistema/res_add.php";}
?>

