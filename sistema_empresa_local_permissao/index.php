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

$colname_list_acao = "-1";
if (isset($_GET['id_usuario'])) {
  $colname_list_acao = $_GET['id_usuario'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_empresa_local_usuario_permisao WHERE id_usuario = %s ORDER BY id_local_permissao ASC", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

mysql_select_db($database_connection, $connection);
$query_list_local = "SELECT * FROM tbnext_mod_empresa_local";
$list_local = mysql_query($query_list_local, $connection) or die(mysql_error());
$row_list_local = mysql_fetch_assoc($list_local);
$totalRows_list_local = mysql_num_rows($list_local);
?>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<?php include ("../sistema/index_content_head.php");?>
          
          <?php
		  $id_usuario=$_GET['id_usuario'];
		   include("../sistema_usuario/list_usuario.php"); ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="10%" bgcolor="#FFFFFF" class="txt-opcoes">Usuario:</td>
              <td width="90%" class="txt"> <?php  echo $row_list_acao_usuario['usuario']; ?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="txt-opcoes">Nome:</td>
              <td class="txt"><?php  echo $row_list_acao_usuario['nome']; ?> <?php  echo $row_list_acao_usuario['sobrenome']; ?></td>
            </tr>
          </table>
    <br>
<table width="100%" border="0" cellpadding="0" cellspacing="1"  class="table table-striped table-bordered dt-responsive nowrap datatable-full" >
<thead>
  <tr>
    <td width="81" align="center" ><div align="center">ID</div>
       </td>
    <td align="left" >Empresa</td>
    <td align="left" >CNPJ</td>
    <td width="82" >
    
    <?php if( $totalRows_list_local==$totalRows_list_acao){}else{ ?>
  
     <button type="button" 
      onClick="MM_goToURL('parent','?&amp;conteudo=<?php echo $conteudo_inf; ?>-add&id_usuario=<?php echo $_GET['id_usuario'];?>');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR "> </button>
    <?php } ?>
    </td>
  </tr>
  </thead>
  <tbody>

   <?php  
      
    if($totalRows_list_acao !=0){?>
  <?php do { ?>
  <tr >
    <td align="center" ><?php echo $id=$row_list_acao['id_local_permissao']; ?></td>
    <td width="575" align="left" ><?php $id_local= $row_list_acao['id_local'];
	 include ("../sistema_empresa_local/list_local.php"); ?>
    
    <?php  $row_list_acao_empresa_local['id_local']; ?><?php echo $row_list_acao_empresa_local['fantasia']; ?>&nbsp;&nbsp;&nbsp;    <div align="left"></div></td>
    <td width="281" align="left" ><?php echo $row_list_acao_empresa_local['cnpj']; ?></td>
    <td  align="center" >
        <div class="buttonOpenIcon2">
    <button type="button" 
    
     onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
    
     class="options_action_edit" title=" EDITAR ">
     </button>
     <button type="button" 
      onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc');return document.MM_returnValue"
      class="options_action_del" title=" EXCLUIR ">
      </button>
      </div>
      <div class="buttonDropdown">
      
        <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <i class="fa fa-cog fa-1x" aria-hidden="true"></i>
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt"><i class="fa fa-edit" aria-hidden="true"></i>Editar</a></li>
      <li><a href="?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc"><i class="fa fa-close" aria-hidden="true"></i>Excluir</a></li>
    </ul>
  </div>
</div>
      </td>
  </tr>  
	<?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  <?php  }else{ ?>
  <tr >
    <td colspan="4" align="center" class="txt" ><p><br />
      O sistema n&atilde;o encontrou nada!<br />
      <br />
  <br />
  <br />
    </p>
    <p align="right" class="financeiro-txt"></p></td>
    </tr><?php }?>
    </tbody>
</table>
<?php

mysql_free_result($list_acao);

mysql_free_result($list_local);

?>
