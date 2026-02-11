<?php require_once('../Connections/connection.php'); ?>
<?php
//------------------- LISTA QUANTIDADE REGISTRO
$list_qtdd=$_GET['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd='10';
}

//----------------------> PERMISSAO DE USUARIO
$id_usuario=$row_perfusuario['id_usuario'];
 $adm_perm_mod=$row_perfusuario['id_perm_status_textos'];
if($adm_perm_mod == '1'){
	$and_sql=" id_usuario !=''";
	}else{
		 $and_sql =" id_usuario = ".$id_usuario;}
?>
<?php 
//--------------------------------> OPCAO DE PESQUISA
$opcao=$_GET['opcao'];
if($opcao==pg){
	$palavra_pesquisa=strtolower($_GET['palavra_pesquisa']);
	}else{
	$palavra_pesquisa=$_GET['palavra_pesquisa'];
	}

?>
<?php 

//-------------------------------------------------> FILTRO DO USUARIO E PESQUISA <-----------------------------//
if(empty($opcao)){
	 $list_SQL="SELECT * FROM tbnext_mod_site_texto WHERE  ". $and_sql." ORDER BY botao_pg ASC";
		}else{
 		$list_SQL="SELECT * FROM tbnext_mod_site_texto WHERE  ". $and_sql ." AND ". $opcao ." LIKE '%".$palavra_pesquisa."%' ORDER BY ".$opcao." ASC";
		}
//$query_list_acao = $filtroSQL;

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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_list_acao = $list_qtdd;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

mysql_select_db($database_connection, $connection);
 $query_list_acao = $list_SQL;
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
?>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="texto">
  <tr>
    <td colspan="4" align="center" valign="top"  bgcolor="#FFFFFF"  class="txt-indece-titulo"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  align="center"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
        <td ><?php echo "$sistema_nome"; ?> &nbsp;<?php echo "$versao"; ?></td>
        <td  class="txt-Indece">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qtdd:&nbsp;&nbsp;<?php echo $totalRows_list_acao ?> &nbsp;&nbsp;&nbsp;</td>
        <?php    if($adm_perm <= '2'){?>
        <form id="qtdd" name="qtdd" method="get" action="?">
          <input name="conteudo" type="hidden" id="conteudo" value="<?php echo $_GET['conteudo']; ?>" />
          <input name="usuario" type="hidden" id="usuario" value="<?php echo $_GET[usuario]; ?>" />
          <input name="id_categoria" type="hidden" id="id_categoria" value="<?php echo $_GET['id_categoria']; ?>" />
          <td valign="middle"  class="txt-Indece"><label>
            <select name="list_qtdd" id="list_qtdd">
              <option value="5" <?php if (!(strcmp(5, $list_qtdd))) {echo "selected=\"selected\"";} ?>>5</option>
              <option value="10" <?php if (!(strcmp(10, $list_qtdd))) {echo "selected=\"selected\"";} ?>>10</option>
              <option value="20" <?php if (!(strcmp(20, $list_qtdd))) {echo "selected=\"selected\"";} ?>>20</option>
              <option value="30" <?php if (!(strcmp(30, $list_qtdd))) {echo "selected=\"selected\"";} ?>>30</option>
              <option value="40" <?php if (!(strcmp(40, $list_qtdd))) {echo "selected=\"selected\"";} ?>>40</option>
              <option value="50" <?php if (!(strcmp(50, $list_qtdd))) {echo "selected=\"selected\"";} ?>>50</option>
            </select>
            <input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="txt-Botao-pesquisar"  />
          </label>
        </form>
        <?php }?>
      </tr>
    </table></td>
  </tr><?php if($id_perm_status_textos<=2){ ?>
  <tr>
    <td colspan="4" align="center" valign="top"  bgcolor="#FFFFFF"  class="txt"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <?php if (($row_perfusuario['id_perm_status_usuario_versao']<=3)and($row_perfusuario['id_perm_status_usuario_versao']>=1)){?>
        <td width="33" ><a href="?startmod=arquivos_class&<?php echo $usuario_get; ?>&amp;conteudo=<?php echo $conteudo_inf; ?>_dim&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>" >
          <div class="options_action_edit" title=" EDITAR "></div>
        </a></td>
        <td  align="left"><a href="?startmod=versao_class01&conteudo=versao_class01">Editar Classe</a> &nbsp;&nbsp; </td>
        <td width="720"  align="left">&nbsp;</td>
        <?php } ?>
      </tr>
      <tr>
        <td colspan="3" align="center" ></td>
      </tr>
    </table>
      <form id="pesquisar" name="pesquisar" method="GET" action="">
      <input name="conteudo" type="hidden" id="conteudo" value="<?php echo $_GET['conteudo']; ?>" />
      <input name="list_qtdd" type="hidden" id="list_qtdd" value="<?php echo $_GET['list_qtdd']; ?>" />
      <input name="palavra_pesquisa" type="text" id="palavra_pesquisa" value="<?php echo $palavra_pesquisa; ?>" size="35"    />
      <select name="opcao" id="opcao">
        <option value="botao_pg" <?php if (!(strcmp("botao_pg", $_GET['opcao']))) {echo "selected=\"selected\"";} ?>>Bot&atilde;o</option>
        <option value="pg" <?php if (!(strcmp("pg", $_GET['opcao']))) {echo "selected=\"selected\"";} ?>>link/pagina</option>
        <option value="id_texto" <?php if (!(strcmp("id_texto", $_GET['opcao']))) {echo "selected=\"selected\"";} ?>>ID texto</option>
        <option value="posicao_botao" <?php if (!(strcmp("posicao_botao", $_GET['opcao']))) {echo "selected=\"selected\"";} ?>>Posicao</option>
      </select>
      <input type="submit" name="button" id="button" value="Pesquisar" class="txt-Botao-pesquisar"/>
    <?php // echo $list_SQL; ?></form></td>
  </tr><?php } ?>
  <tr>
    <td width="263" align="left" bgcolor="#FFFFFF" class="txt-Indece">Versão</td>
    <td width="423" align="left" bgcolor="#FFFFFF" class="txt-Indece">Link da Pagina</td>
    <td width="69" align="left" bgcolor="#FFFFFF" class="txt-Indece">&nbsp;Posi&ccedil;&atilde;o&nbsp;</td>
    <td width="90" bgcolor="#FFFFFF" class="txt-Indece"> 
      <?php if($row_perfusuario['adm_perm_mod']<3){ ?>
      <button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR ">
      </button>
      <?php }elseif($totalRows_list_acao==0){ ?>
       <button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR ">
      </button>
	<?php } ?></td>
  </tr>
  
  <?php $l=1;?>
   <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
  <tr class="linhas<?php echo $l; ?>">
  
    <td align="left"  ><?php echo $row_list_acao['botao_pg']; ?></td>
    <td align="left" ><?php echo $row_list_acao['pg']; ?></td>
    <td align="center" ><?php echo $posicao_botao=$row_list_acao['posicao_botao']; ?></td>
    <td align="center"  > 
        <button type="button" 
    
     onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
    
     class="options_action_edit" title=" EDITAR ">
     </button>
     <button type="button" 
      onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc');return document.MM_returnValue"
      class="options_action_del" title=" EXCLUIR ">
      </button>
    
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
  <tr>
    <td colspan="4" align="center" class="txt-Indece"><table border="0">
        <tr>
          <td><?php if ($pageNum_list_acao > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, 0, $queryString_list_acao); ?>"><button type="button">|< inicio</button></a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_list_acao > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, max(0, $pageNum_list_acao - 1), $queryString_list_acao); ?>"><button type="button">< voltar</button></a>
              <?php } // Show if not first page ?></td>
          <td>&nbsp;&nbsp;De &nbsp;&nbsp;<?php echo ($startRow_list_acao + 1) ?>  &nbsp;&nbsp;at&eacute; &nbsp;&nbsp;<?php echo min($startRow_list_acao + $maxRows_list_acao, $totalRows_list_acao) ?>&nbsp;&nbsp;para&nbsp;&nbsp; <?php echo $totalRows_list_acao ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td><?php if ($pageNum_list_acao < $totalPages_list_acao) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, min($totalPages_list_acao, $pageNum_list_acao + 1), $queryString_list_acao); ?>"><button type="button">Avan&ccedil;ar ></button></a>
              <?php } // Show if not last page ?></td>
          <td><?php if ($pageNum_list_acao < $totalPages_list_acao) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, $totalPages_list_acao, $queryString_list_acao); ?>"><button type="button">Fim >|</button></a>
              <?php } // Show if not last page ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input name="Alterar" type="button" onClick="javascript:history.back()" class="txt-Botao-voltar" id="Alterar" value="|&lt; Voltar" /></td>
  </tr>
</table>
<?php
mysql_free_result($list_acao);
?>