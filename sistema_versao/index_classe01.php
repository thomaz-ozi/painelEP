<?php require_once('../Connections/connection.php'); ?>

<?php
$id_usuario=$row_perfusuario['id_usuario'];
$adm_perm_mod_textos_cascata01=$row_perfusuario['adm_perm_mod_textos_cascata01'];
if($adm_perm_mod_textos_cascata01== '1'){
	$and_sql='';
	}else{
		$and_sql =' WHERE  id_usuario = '.$id_usuario;}
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

$maxRows_list_acao = 10;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM tbnext_mod_site_texto_classe01".$and_sql;
$query_limit_list_acao = sprintf("%s LIMIT %d, %d", $query_list_acao, $startRow_list_acao, $maxRows_list_acao);
$list_acao = mysql_query($query_limit_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);

if (isset($_GET['totalRows_list_acao'])) {
  $totalRows_list_acao = $_GET['totalRows_list_acao'];
} else {
  $all_list_acao = mysql_query($query_list_acao);
  $totalRows_list_acao = mysql_num_rows($all_list_acao);
}
$totalPages_list_acao = ceil($totalRows_list_acao/$maxRows_list_acao)-1;
?>

<table width="100%" border="0" cellspacing="1" cellpadding="0">
  		<tr>
   			 <td colspan="5" align="center" class="txt-indece-titulo"><table border="0" cellspacing="0" cellpadding="0">
   			   <tr>
   			     <td  align="center"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
   			     <td >&nbsp;&nbsp;&nbsp;<?php echo "$sistema_nome"; ?> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$versao"; ?></td>
		       </tr>
		     </table></td>

  <tr>
    <td colspan="3"  align="left" class="txt-Indece">Categoria</td>
    <td width="1%" colspan="2"  class="txt-Indece">
      <?php if($row_perfusuario['adm_perm_mod']<3){ ?>
      <a href="?<?php echo $usuario_get; ?>&amp;conteudo=<?php echo $conteudo_inf; ?>-add&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>">
<div class="options_action_add" title=" ADICIONAR "></div>
      <?php }elseif($totalRows_list_acao==0){ ?>
      <a href="?<?php echo $usuario_get; ?>&amp;conteudo=<?php echo $conteudo_inf; ?>-add&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>">
<div class="options_action_add" title=" ADICIONAR "></div></a><?php } ?></td>
  </tr>
    <?php $l=1;?>
   <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
  <tr class="linhas<?php echo $l; ?>">
    
      <td colspan="3" align="left" >&nbsp;<?php echo $row_list_acao['nome']; ?></td>
      <td colspan="2" align="center" >
      <a href="?<?php echo $usuario_get; ?>&amp;<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt" >
      <div class="options_action_edit" title=" EDITAR "></div></a>
      
      <a href="?<?php echo $usuario_get; ?>&amp;<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc" >
      <div class="options_action_del" title=" EXCLUIR "></div>
      </a>
      </td>
     </tr> 
	<?php  $l++; if($l>2){$l=1;} ?>
	<?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  
  <?php  }else{ ?>
  <tr >
    <td colspan="4" align="center" class="txt" ><p><br />
      O sistema n&atilde;o encontrou nada!<br />
      <br />
  <br />
  <br />
  <br />
    </p>
    <p align="right" class="financeiro-txt"></p></td>
    </tr>
  <?php } ?>
  <td width="15%"></tr>
<tr>
    <td colspan="5" align="center" class="txt-Indece"><table width="100%" border="0">
      <tr>
        <td width="10%" align="center" valign="middle"><?php if ($pageNum_list_acao > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, 0, $queryString_list_acao); ?>"><img src="<?php echo "$local_icons"; ?>setas_dir_inicio_bola-20.png" width="20" height="20" border="0" /></a>
          <?php } // Show if not first page ?></td>
        <td width="10%" align="center" valign="middle"><?php if ($pageNum_list_acao > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, max(0, $pageNum_list_acao - 1), $queryString_list_acao); ?>"><img src="<?php echo "$local_icons"; ?>setas_esq_bola-25.png" width="25" height="25" border="0" /></a>
          <?php } // Show if not first page ?></td>
        <td width="60%" align="center" valign="middle">&nbsp;
Lista <?php echo ($startRow_list_acao + 1) ?> de <?php echo min($startRow_list_acao + $maxRows_list_acao, $totalRows_list_acao) ?> para <?php echo $totalRows_list_acao ?></td>
        <td width="10%" align="center" valign="middle"><?php if ($pageNum_list_acao < $totalPages_list_acao) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, min($totalPages_list_acao, $pageNum_list_acao + 1), $queryString_list_acao); ?>"><img src="<?php echo "$local_icons"; ?>setas_dir_bola-25.png" width="25" height="25" border="0" /></a>
          <?php } // Show if not last page ?></td>
        <td width="10%" align="center" valign="middle"><?php if ($pageNum_list_acao < $totalPages_list_acao) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, $totalPages_list_acao, $queryString_list_acao); ?>"><img src="<?php echo "$local_icons"; ?>setas_dir_fim_bola-20.png" width="20" height="20" border="0" /></a>
          <?php } // Show if not last page ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5" align="center"><input name="Alterar" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar" value="|&lt; Voltar" /></td>
  </tr>
</table>
<?php
mysql_free_result($list_acao);
?>
