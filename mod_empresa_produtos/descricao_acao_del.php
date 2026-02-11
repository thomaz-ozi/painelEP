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

if ((isset($_POST['id_produtos_descricao'])) && ($_POST['id_produtos_descricao'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_produtos_descricao WHERE id_produtos_descricao=%s",
                       GetSQLValueString($_POST['id_produtos_descricao'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
 exit;
}

$colname_list_acao = "-1";
if (isset($_POST['content'])) {
  $colname_list_acao = $_POST['content'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_produtos_descricao WHERE id_produtos_descricao = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

?>
<style onload="divLoadMsn('.divLoadMsnlocal','options_action_del_sec','Excluir','#loadDescricao')"></style> 
<div class="divLoadMsnlocal">
<form action="" method="post"  id="delDescricao"  >
<script src="../sistema/ckeditor/ckeditor.js"></script>
 <div class="form-group">
 
 <input name="id_produtos_descricao" type="hidden" id="loadDescricao_id_produtos_descricao" value="<?php echo $row_list_acao['id_produtos_descricao']; ?>" >
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">Titulo <span class="required">*</span>           </label>
    <input name="xNome" type="text" disabled required="required" class="form-control col-md-6  col-sm-3 col-xs-12" id="loadDescricao_xNome" value="<?php echo $row_list_acao['xNome']; ?>">
 </div>
 <div class="clearfix"></div>
<div class="form-group">	
    <label class="control-label col-md-12" for="first-name">Descrição</label>
    <div class="clearfix"></div>
    <textarea name="descricao" rows="10" disabled class="form-control"  id="loadDescricao_descricao" tabindex="1"><?php echo $row_list_acao['descricao']; ?></textarea>
	<script>
       CKEDITOR.replace( 'descricao', {
       toolbar :'basic'
       });
    </script>
</div>

<div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default" onclick="loadsDataClear('#loadDescricao')" ><i class="fa fa-close"></i>&nbsp; FECHAR</button>
        <span id="concluir_verificar">
               <button type="button" class="btn btn-danger" onClick="descricaoDelet()"><i class="fa fa-times"></i> Excluir</button>
        </span>
      </div>
    </div>
    <input type="hidden" name="MM_update" value="acao">
 </form>
</div>
<?php
mysql_free_result($list_acao);
?>
