<?php require_once('../Connections/connection.php'); ?>
<?php

if($id_clientes==""){
	$id_clientes=$_POST['content'];
	}

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

mysql_select_db($database_connection, $connection);
$query_list_acao_descr = "SELECT * FROM tbnext_mod_empresa_clientes_descricao WHERE id_clientes = '".$id_clientes."' ORDER BY xNome ASC";
$list_acao_descr = mysql_query($query_list_acao_descr, $connection) or die(mysql_error());
$row_list_acao_descr = mysql_fetch_assoc($list_acao_descr);
$totalRows_list_acao_descr = mysql_num_rows($list_acao_descr);
?>
<script>
$(function(){
 $('#descricaoAdd').click(function(){
	loadsDataAbsoluto('#loadDescricao','../mod_empresa_clientes/descricao_acao_add.php',1);
 });	
 	
});

function descricaoEdit(n){
	loadsDataAbsoluto('#loadDescricao','../mod_empresa_clientes/descricao_acao_alt.php',n);

	}
	
function descricaoDel(n){
	loadsDataAbsoluto('#loadDescricao','../mod_empresa_clientes/descricao_acao_del.php',n);

	}
</script>
<script src="../mod_empresa_clientes/script_descricao.js"></script>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-hover" >
  <thead>
    <tr>
      <td width="88%">Titulo</td>
      <td width="12%" align="center"><button class="options_action_add_sec" id="descricaoAdd" title=" ADICIONAR "  type="button"> </button></td>
    </tr>
  </thead>
  </table>

<div  class="listTable" style="margin-top:-20px;" >
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:-18px;" class="table table-hover" >

    <tr>
      <td width="88%"></td>
      <td width="12%"></td>
    </tr>

  <tbody id="tableDesc">
  <?php if($totalRows_list_acao_descr >=1){ ?>
  <?php do { ?>
    <tr>
    
        <td>&nbsp;<?php echo $row_list_acao_descr['xNome']; ?></td>
        <td align="center">
        <button class="options_action_edit_sec " title=" EDITAR " onClick="descricaoEdit(<?php echo $row_list_acao_descr['id_clientes_descricao']; ?>)"   type="button"> </button>
        <button class="options_action_del_sec" title=" EXCLUIR " onClick="descricaoDel(<?php echo $row_list_acao_descr['id_clientes_descricao']; ?>)" type="button"> </button></td>
        
    </tr>
	<?php } while ($row_list_acao_descr = mysql_fetch_assoc($list_acao_descr)); ?>
    <?php } ?>
  </tbody>
</table>
</div>
<?php
mysql_free_result($list_acao_descr);
?>
