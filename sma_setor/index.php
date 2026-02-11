<?php require_once('../Connections/connection.php'); ?>
<?php 
//------------------- lista a quantidade
$list_qtdd=$_GET['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd= '20';
}?>
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
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_list_acao = $list_qtdd;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

$colname_list_acao = "-1";
if (isset($_GET['id_usuario'])) {
  $colname_list_acao = $_GET['id_usuario'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbnext_mod_sma_cad_setor  WHERE id_local= '".$_SESSION['LOCAL']."'  ORDER BY nome ASC", GetSQLValueString($colname_list_acao, "int"));
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
?>&nbsp;
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="texto">
  <tr>
    <td colspan="8" align="center" bgcolor="#FFFFFF" class="txt-Indece"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  align="center"><img src="<?php echo "$local_icons"; ?><?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
        <td ><?php echo "$sistema_nome"; ?> &nbsp;<?php echo "$versao"; ?></td>
        <td  class="txt-Indece">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qtdd: <?php echo $totalRows_list_acao ?>&nbsp;</td>
        <form id="qtdd" name="qtdd" method="get" action="?">
          <td  class="txt-Indece"><input name="conteudo" type="hidden" id="conteudo" value="<?php echo "$conteudo_inf"; ?>" />
            <input name="usuario" type="hidden" id="usuario" value="<?php echo $_GET[usuario]; ?>" />
            <input name="<?php echo $pesquisa_form; ?>" type="hidden" id="<?php echo $pesquisa_form; ?>" value="<?php echo $pesquisa; ?>" />
            <input name="<?php echo $id_sistema; ?>" type="hidden" id="<?php echo $id_sistema; ?>" value="<?php echo $row_list_acao[$id_sistema]; ?>" />
            <label>
              <select name="list_qtdd" id="list_qtdd">
                <option value="10" <?php if (!(strcmp(10, $list_qtdd))) {echo "selected=\"selected\"";} ?>>10</option>
                <option value="20" <?php if (!(strcmp(20, $list_qtdd))) {echo "selected=\"selected\"";} ?>>20</option>
                <option value="30" <?php if (!(strcmp(30, $list_qtdd))) {echo "selected=\"selected\"";} ?>>30</option>
                <option value="40" <?php if (!(strcmp(40, $list_qtdd))) {echo "selected=\"selected\"";} ?>>40</option>
                <option value="50" <?php if (!(strcmp(50, $list_qtdd))) {echo "selected=\"selected\"";} ?>>50</option>
              </select>
              <input type="submit" name="filtrar" id="filtrar" value="filtrar" />
            </label></td>
        </form>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="8" class="textoTitulo_cinza"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="4%" bgcolor="#FFFFFF"><div align="left"></div></td>
        <form id="pesquisa" name="pesquisa" method="get" action="?">
          <td width="91%" align="center" class="txt" >
          </td>
        </form>
        <td width="5%" bgcolor="#FFFFFF"><div align="right"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="54" align="center" bgcolor="#FFFFFF"  class="txt-Indece"><div align="center">ID</div>
       </td>
    <td align="center" bgcolor="#FFFFFF"  class="txt-Indece">Nome</td>
    <td align="center" bgcolor="#FFFFFF"  class="txt-Indece">Largura</td>
    <td width="153" align="center" bgcolor="#FFFFFF"  class="txt-Indece">Altura</td>
    <td width="139" align="center" bgcolor="#FFFFFF"  class="txt-Indece">Area</td>
    <td width="139" align="center" bgcolor="#FFFFFF"  class="txt-Indece">Qdd/Animal</td>
    <td width="48" bgcolor="#FFFFFF"  class="txt-Indece">Op&ccedil;&otilde;es</td>
    <td width="20" bgcolor="#FFFFFF"  class="txt-Indece"><a href="?<?php echo $usuario_get; ?>&amp;conteudo=<?php echo $conteudo_inf; ?>-add&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>"><img src="<?php echo "$local_icons"; ?>add-20.png" width="20" height="20" border="0" title=" ADICIONAR " /></a></td>
  </tr>
  <?php if($totalRows_list_acao >0){ ?>
  <?php $menu=1;do { ?>
  <tr class="txt" 
            onMouseOver="this.className='txt-Indece';" 
            onMouseOut = "this.className='txt';">
    <td align="center" ><?php echo $id_setor=$row_list_acao['id_setor']; ?></td>
    <td width="227" align="left" ><?php  echo $row_list_acao['nome']; ?>    &nbsp;&nbsp;&nbsp;
<div align="left"></div>      <div align="left"></div></td>
    <td width="143" align="center" ><?php echo $row_list_acao['largura']; ?></td>
    <td align="center" ><?php echo $row_list_acao['altura']; ?></td>
    <td align="center" ><?php echo $area=$row_list_acao['altura']* $row_list_acao['largura']; ?></td>
    <td align="center" ><?php $id_setor= $row_list_acao['id_setor']; include ("../sma_setor/list_setor_animal.php"); ?></td>
    <td colspan="2"  align="center" class="txt-Indece"><a href="acao_alterar.php?idUsuario=<?php echo $idUsuario; ?>&id=<?php echo $row_lista_completa['id']; ?>" class="txt" ></a>
        <div align="center"><a href="acao_excluir.php?idUsuario=<?php echo $idUsuario; ?>&id=<?php echo $row_lista_completa['id']; ?>" ></a><a href="?<?php echo $usuario_get; ?>&amp;conteudo=<?php echo $conteudo_inf; ?>-alt&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>" ><img src="<?php echo "$local_icons"; ?>alt-20.png" width="20" height="20" border="0" title=" ALTERAR " /></a><a href="?<?php echo $usuario_get; ?>&amp;conteudo=<?php echo $conteudo_inf; ?>-exc&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>" ><img src="<?php echo "$local_icons"; ?>excluir-20.png" width="20" height="20" border="0" title=" EXCLUIR " /></a></div>
      <div align="center"></div></td>
  </tr>  
  <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  <?php  }else{ ?>
  <tr >
    <td colspan="8" align="center" class="txt" ><p><br />
      O sistema n&atilde;o encontrou nada!<br />
      <br />
  <br />
  <br />
  <br />
    </p>
    <p align="right" class="financeiro-txt"></p></td>
    </tr><?php }?>

  <tr>
    <td colspan="8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="7%" bgcolor="#FFFFFF" class="txt-Indece"><div align="left"></div></td>
        <td width="83%" bgcolor="#FFFFFF" class="txt-Indece"><table  border="0" align="center">
          <tr>
            <td ><?php if ($pageNum_list_acao > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, 0, $queryString_list_acao); ?>">|&lt; inicio</a>
              <?php } // Show if not first page ?></td>
            <td ><?php if ($pageNum_list_acao > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, max(0, $pageNum_list_acao - 1), $queryString_list_acao); ?>">&lt; voltar</a>
              <?php } // Show if not first page ?></td>
            <td align="center" >&nbsp;&nbsp;De &nbsp;&nbsp;<?php echo ($startRow_list_acao + 1) ?> &nbsp;&nbsp;at&eacute; &nbsp;&nbsp;<?php echo min($startRow_list_acao + $maxRows_list_acao, $totalRows_list_acao) ?>&nbsp;&nbsp;para&nbsp;&nbsp; <?php echo $totalRows_list_acao ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td ><?php if ($pageNum_list_acao < $totalPages_list_acao) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, min($totalPages_list_acao, $pageNum_list_acao + 1), $queryString_list_acao); ?>">Avan&ccedil;ar &gt;</a>
              <?php } // Show if not last page ?></td>
            <td ><?php if ($pageNum_list_acao < $totalPages_list_acao) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, $totalPages_list_acao, $queryString_list_acao); ?>">Fim &gt;|</a>
              <?php } // Show if not last page ?></td>
          </tr>
        </table></td>
        <td width="10%" bgcolor="#FFFFFF" class="txt-Indece"><div align="right"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="8" class="txt-Indece"><div align="center"></div></td>
  </tr>
</table>

<?php
mysql_free_result($list_acao);
?>
