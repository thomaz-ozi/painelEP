<?php  require_once('../Connections/connection.php'); ?>
<?php
	include ('../sistema_funcoes/maiuscola_minuscola.php');
	include ("../sistema_funcoes/converte_datas.php");
?>

<?php
//------------------- LISTA QUANTIDADE REGISTRO
$list_qtdd=$_GET['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd='10';
}

//----------------------> PERMISSAO DE USUARIO
$id_usuario=$row_perfusuario['id_usuario'];

$id_local=$_SESSION['LOCAL'];
$adm_perm_mod=$row_perfusuario['id_perm_status_pess_clientes'];
if($adm_perm_mod == '1'){
	$and_sql=" ";
	}else{
		 $and_sql =" id_usuario = '".$id_usuario."' AND id_local = '".$id_local."' ";}
//--------------------------------> OPCAO DE PESQUISA
$opcao=$_GET['opcao'];
if($opcao=='data'){
	$palavra_pesquisa=converte_data($_GET['palavra_pesquisa']);
	$opcao_sql="  ". $opcao ." = '".$palavra_pesquisa."' ";
		}else{
	$palavra_pesquisa=convertem($_GET['palavra_pesquisa'],1);
	$opcao_sql="   UPPER(". $opcao .") LIKE '%".$palavra_pesquisa."%' ";
	}
//-------------------------------------------------> FILTRO DO USUARIO E PESQUISA <-----------------------------//
$SQL_table="tbnext_mod_empresa_clientes";
if((empty($opcao))and($adm_perm_mod == '1')){
	 $list_SQL="SELECT * FROM ".$SQL_table."   ".$and_sql." ORDER BY xNome ASC";
	 	}else if(empty($opcao)){
		 $list_SQL="SELECT * FROM ".$SQL_table." WHERE  ".$and_sql." ORDER BY xNome ASC";
		 }else if($adm_perm_mod == '1'){
		 $list_SQL="SELECT * FROM ".$SQL_table." WHERE  ".$opcao_sql." ORDER BY xNome ASC";
		}else{
 		$list_SQL="SELECT * FROM ".$SQL_table." WHERE  ".$and_sql." AND".$opcao_sql." ORDER BY ".$opcao." ASC";
		}


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
<script>
$(function($){
$("#opcao").change(function(){
	var var_opcoes=$("#opcao").val();
	if(var_opcoes=='CNPJ'){
   		$("#palavra_pesquisa").mask("99.999.999/9999-99");//CNPJ
	}else if(var_opcoes=='CPF'){
   		$("#palavra_pesquisa").mask("999.999.999-99");//CPF
	}else{ $("#palavra_pesquisa").unmask();}
});
});
</script>
<style>
.dropdown-menu {
    left: -95px;
}
@media(max-width:964px){
.fechado{ font-size:18px; color:#24359B; }
.aberto{ display:none;}
}
@media(min-width:963px) {
	.aberto{ font-size:18px;}
	.fechado{ display:none;}

}


</style>

<table width="100%" border="0" cellpadding="0" cellspacing="1" class="texto">
  <tr>
    <td colspan="4" align="center" valign="top"  bgcolor="#FFFFFF"  class="txt-indece-titulo"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  align="center"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
        <td ><?php echo "$sistema_nome"; ?> &nbsp;<?php echo "$versao"; ?></td>
        <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qtdd:&nbsp;&nbsp;<?php echo $totalRows_list_acao ?> &nbsp;&nbsp;&nbsp;</td>
        <?php    if($adm_perm <= '2'){?>
        <form id="qtdd" name="qtdd" method="get" action="?">
          <input name="conteudo" type="hidden" id="conteudo" value="<?php echo $_GET['conteudo']; ?>" />
          <input name="usuario" type="hidden" id="usuario" value="<?php echo $_GET[usuario]; ?>" />
          <input name="id_categoria" type="hidden" id="id_categoria" value="<?php echo $_GET['id_categoria']; ?>" />
          <td valign="middle"  ><label>
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
  </tr><?php if($id_perm_status_agendas<=2){ ?>
  <tr>
    <td colspan="4" align="center" valign="top"  bgcolor="#FFFFFF"  class="txt"><table  border="0" align="center" cellspacing="0" cellpadding="0">
        <tr>
          <?php if($row_perfusuario['id_perm_status_noticias']==1){?>
          <td ><a href="?startmod=imagens_minhas_dim&<?php echo $usuario_get; ?>&amp;conteudo=<?php echo $conteudo_inf; ?>_dim&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>" >
            <div class="options_action_edit" title=" EDITAR "></div>
          </a></td>
          <td  align="left"><a href="?startmod=empresa_clientes_class&conteudo=clien_class&amp;<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>">Editar Classifica&ccedil;&atilde;o</a>&nbsp;&nbsp;</td>
          <?php } ?>

        </tr>
      </table>
<form id="pesquisar" name="pesquisar" method="GET" action="">
  <input name="conteudo" type="hidden" id="conteudo" value="<?php echo $_GET['conteudo']; ?>" />
      <input name="list_qtdd" type="hidden" id="list_qtdd" value="<?php echo $_GET['list_qtdd']; ?>" />
      <input name="palavra_pesquisa" type="text" id="palavra_pesquisa" value="<?php echo $_GET['palavra_pesquisa'] ?>" size="35"    />
      <select name="opcao" id="opcao">
        <option value="xNome" <?php if (!(strcmp("xNome", $_GET['opcao']))) {echo "selected=\"selected\"";} ?>>Nome</option>
        <option value="CNPJ" <?php if (!(strcmp("CNPJ", $_GET['opcao']))) {echo "selected=\"selected\"";} ?>>CNPJ</option>
        <option value="CPF" <?php if (!(strcmp("CPF", $_GET['opcao']))) {echo "selected=\"selected\"";} ?>>CPF</option>
        <option value="id_clientes" <?php if (!(strcmp("id_clientes", $_GET['opcao']))) {echo "selected=\"selected\"";} ?>>ID</option>
      </select>
      <input type="submit" name="button" id="button" value="Pesquisar" class="txt-Botao-pesquisar"/>
    <?php // echo $list_SQL; ?></form></td>
  </tr><?php } ?>
  <tr>
    <td width="51" align="left" bgcolor="#FFFFFF" class="txt-Indece">ID</td>
    <td width="240" align="left" bgcolor="#FFFFFF" class="txt-Indece">Nome</td>
    <td width="472" align="left" bgcolor="#FFFFFF" class="txt-Indece">Fone&nbsp;&nbsp;</td>
    <td width="82" align="center"  class="txt">
      <button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR ">
      </button>
    
    </td>
  </tr>
  
  <?php $l=1;?>
   <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
  <tr class="linhas<?php echo $l; ?>">
  
    <td align="left"  ><?php echo $row_list_acao[$id_sistema]; ?></td>
    <td align="left"  ><?php echo $row_list_acao['xNome']; ?></td>
  
    <td align="left" ><?php echo $row_list_acao['fone1']; ?></td>
    <td align="center"  > 
    <span class="aberto">
    <button type="button" 
    
     onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
    
     class="options_action_edit" title=" EDITAR ">
     </button>
     <button type="button" 
      onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc');return document.MM_returnValue"
      class="options_action_del" title=" EXCLUIR ">
      </button>
      </span>
      <span class="fechado">
      
        <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <i class="fa fa-cog fa-1x" aria-hidden="true"></i>
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#"><i class="fa fa-edit" aria-hidden="true"></i>Editar</a></li>
      <li><a href="#"><i class="fa fa-close" aria-hidden="true"></i>Excluir</a></li>
      <li><a href="#"><i class="fa fa-list" aria-hidden="true"></i>Detalhes</a></li>
    </ul>
  </div>
      
      
      </span>
    
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