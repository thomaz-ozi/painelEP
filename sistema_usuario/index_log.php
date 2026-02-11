<?php require_once('../Connections/connection_user.php'); ?>
<?php
if($row_perfusuario['id_usuario']!=0){
$bancoDados=" WHERE banco_dados= '".$row_perfusuario['banco_dados']."'";
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_list_acao = 20;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;



mysql_select_db($database_connection_user, $connection_user);
$query_list_acao = "SELECT * FROM tbnext_usuario_logs ".$bancoDados." ORDER BY id_logs DESC";
$query_limit_list_acao = sprintf("%s LIMIT %d, %d", $query_list_acao, $startRow_list_acao, $maxRows_list_acao);
$list_acao = mysql_query($query_limit_list_acao, $connection_user) or die(mysql_error());
 $row_list_acao = mysql_fetch_assoc($list_acao);

if (isset($_GET['totalRows_list_acao'])) {
  $totalRows_list_acao = $_GET['totalRows_list_acao'];
} else {
  $all_list_acao = mysql_query($query_list_acao);
  $totalRows_list_acao = mysql_num_rows($all_list_acao);
}
$totalPages_list_acao = ceil($totalRows_list_acao/$maxRows_list_acao)-1;

$queryString_list_acao = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_list_acao") == false && 
        stristr($param, "totalRows_list_acao") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_list_acao = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_list_acao = sprintf("&totalRows_list_acao=%d%s", $totalRows_list_acao, $queryString_list_acao);
?>

<form id="acao" name="acao" method="post" action="">
<?php include ("../sistema/index_content_head.php");?>
<?php
			$id_usuario_class=$row_perfusuario['id_class_usuario']; 
		if ($id_usuario_class <= 3 ){?>
         <button type="button" class="btn btn-default" onclick="MM_goToURL('parent','?log_exc=log_exc&conteudo=ulog&menu=Usuario&submenu=subUsuario');return document.MM_returnValue"><i style="color:#F8BD3F;" class="fa fa-exclamation-triangle"></i> LIMPAR HISTÓRICO</button>
        
<?php } ?>
<table width="100%" border="0" cellpadding="0" cellspacing="1"  class="table table-striped table-bordered dt-responsive nowrap datatable-full">
  <thead>
  <tr>
    <td width="25%" align="left"  >Data</td>
    <td width="25%" align="left"  >Horas</td>
    <td width="25%" align="left"  >Nome - Usuario</td>
    <td width="25%" align="left"  >IP</td>
    </tr>
      </thead>
      <tbody>
   <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
 <tr >

      <td align="center" ><?php echo $row_list_acao['data_inicio']; ?></td>
      <td align="center"  ><?php echo $row_list_acao['horas_inicio']; ?></td>
      <td align="center"  ><?php $id_usuario=$row_list_acao['id_usuarios']; ?>
        <?php include('../sistema_usuario/include_usuario.php'); ?>
		<?php echo $tratamento;?>&nbsp;<?php echo $row_list_usuario['usuario']; ?>- <?php echo $row_list_usuario['email']; ?>
      </td>
      <td align="center" ><?php echo $row_list_acao['ip_usuario']; ?></td>
      </tr>
	  
	  
	  
	
  <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  <?php  }else{ ?>
  <tr >
    <td colspan="6" align="center" class="txt" ><p><br />
      O sistema n&atilde;o encontrou nada!<br />
      <br />
  <br />
  <br />
  <br />
    </p>
    </td>
    </tr><?php }?>
 </tbody>
</table>
<?php
mysql_free_result($list_acao);
?>

</form>
<?php //envio de resposta do formulario
$log_exc=$_GET['log_exc'];
if ($log_exc==log_exc){
	include "log_usuario-excluir.php";
}
?>
