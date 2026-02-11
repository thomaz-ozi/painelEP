<?php $id_usuario=$row_perfusuario['id_usuario']; ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "alterar")) {
  $updateSQL = sprintf("UPDATE tbnext_usuario SET cor_txt=%s, cor_txt_fundo=%s, cor_titulo_txt=%s, cor_subtitulo_txt=%s, cor_data_horas=%s, cor_botao_add=%s, cor_botao_alterar=%s, cor_botao_excluir=%s, cor_botao_pesquisar=%s, ap_skin=%s, ap_plano_fundo=%s, ap_tabela=%s, cor_tb_opcoes=%s, cor_tb_indece=%s, cor_menu_txt=%s, cor_menu_fundo=%s, cor_menu_txt_down=%s, cor_submenu_txt=%s, cor_submenu_fundo=%s, cor_submenu_txt_down=%s, cor_form_txt=%s WHERE id_usuario=%s",
                       GetSQLValueString($_POST['cor_txt'], "text"),
                       GetSQLValueString($_POST['cor_txt_fundo'], "text"),
                       GetSQLValueString($_POST['cor_titulo_txt'], "text"),
                       GetSQLValueString($_POST['cor_subtitulo_txt'], "text"),
                       GetSQLValueString($_POST['cor_data_horas'], "text"),
                       GetSQLValueString($_POST['cor_botao_add'], "text"),
                       GetSQLValueString($_POST['cor_botao_alterar'], "text"),
                       GetSQLValueString($_POST['cor_botao_excluir'], "text"),
                       GetSQLValueString($_POST['cor_botao_pesquisar'], "text"),
                       GetSQLValueString($_POST['ap_skin'], "text"),
                       GetSQLValueString($_POST['ap_plano_fundo'], "text"),
                       GetSQLValueString($_POST['ap_tabela'], "text"),
                       GetSQLValueString($_POST['cor_tb_opcoes'], "text"),
                       GetSQLValueString($_POST['cor_tb_indece'], "text"),
                       GetSQLValueString($_POST['cor_menu_txt'], "text"),
                       GetSQLValueString($_POST['cor_menu_fundo'], "text"),
                       GetSQLValueString($_POST['cor_menu_txt_down'], "text"),
                       GetSQLValueString($_POST['cor_submenu_txt'], "text"),
                       GetSQLValueString($_POST['cor_submenu_fundo'], "text"),
                       GetSQLValueString($_POST['cor_submenu_txt_down'], "text"),
                       GetSQLValueString($_POST['cor_form_txt'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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
$colname_list_usuario = "-1";
if (isset($id_usuario)) {
  $colname_list_usuario = $id_usuario;
}
mysql_select_db($database_connection, $connection);
$query_list_usuario = sprintf("SELECT * FROM tbnext_usuario WHERE id_usuario = %s", GetSQLValueString($colname_list_usuario, "int"));
$list_usuario = mysql_query($query_list_usuario, $connection) or die(mysql_error());
$row_list_usuario = mysql_fetch_assoc($list_usuario);
$totalRows_list_usuario = mysql_num_rows($list_usuario);
mysql_select_db($database_connection, $connection);

mysql_select_db($database_connection, $connection);
$query_list_pfundo = "SELECT * FROM tbnext_usuario_ap_pfundo ORDER BY label_pfundo ASC";
$list_pfundo = mysql_query($query_list_pfundo, $connection) or die(mysql_error());
$row_list_pfundo = mysql_fetch_assoc($list_pfundo);
$totalRows_list_pfundo = mysql_num_rows($list_pfundo);

mysql_select_db($database_connection, $connection);
$query_list_txt = "SELECT * FROM tbnext_usuario_ap_cortxt ORDER BY label_cor ASC";
$list_txt = mysql_query($query_list_txt, $connection) or die(mysql_error());
$row_list_txt = mysql_fetch_assoc($list_txt);
$totalRows_list_txt = mysql_num_rows($list_txt);

mysql_select_db($database_connection, $connection);
$query_list_menu = "SELECT * FROM tbnext_usuario_ap_menu ORDER BY label_menu ASC";
$list_menu = mysql_query($query_list_menu, $connection) or die(mysql_error());
$row_list_menu = mysql_fetch_assoc($list_menu);
$totalRows_list_menu = mysql_num_rows($list_menu);

mysql_select_db($database_connection, $connection);
$query_list_subm = "SELECT * FROM tbnext_usuario_ap_submenu ORDER BY label_submenu ASC";
$list_subm = mysql_query($query_list_subm, $connection) or die(mysql_error());
$row_list_subm = mysql_fetch_assoc($list_subm);
$totalRows_list_subm = mysql_num_rows($list_subm);

mysql_select_db($database_connection, $connection);
$query_list_txt_fundo = "SELECT * FROM tbnext_usuario_ap_cortxt_fundo ORDER BY label_cortxt_fundo ASC";
$list_txt_fundo = mysql_query($query_list_txt_fundo, $connection) or die(mysql_error());
$row_list_txt_fundo = mysql_fetch_assoc($list_txt_fundo);
$totalRows_list_txt_fundo = mysql_num_rows($list_txt_fundo);

mysql_select_db($database_connection, $connection);
$query_list_tb_barras = "SELECT * FROM tbnext_usuario_ap_tabela";
$list_tb_barras = mysql_query($query_list_tb_barras, $connection) or die(mysql_error());
$row_list_tb_barras = mysql_fetch_assoc($list_tb_barras);
$totalRows_list_tb_barras = mysql_num_rows($list_tb_barras);

mysql_select_db($database_connection, $connection);
$query_list_skin = "SELECT * FROM tbnext_usuario_ap_skin ORDER BY label_skin ASC";
$list_skin = mysql_query($query_list_skin, $connection) or die(mysql_error());
$row_list_skin = mysql_fetch_assoc($list_skin);
$totalRows_list_skin = mysql_num_rows($list_skin);
?>
<?php // include"../sistem_funcoes/perfusuario.php";?>
<form action="<?php echo $editFormAction; ?>" name="alterar" method="POST"><table width="99%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="2"><div align="center" class="txt-indece-titulo">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  align="center"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
            <td ><?php echo "$sistema_nome"; ?> &nbsp;<?php echo "$versao"; ?></td>
          </tr>
        </table>
      </div></td>
    </tr>
    <tr>
      <td colspan="2" class="txt-opcoes"><div align="center"><span class="txt">
        <input name="id_usuario" type="hidden"  id="id_usuario" value="<?php echo $row_list_usuario['id_usuario']; ?>" />
      </span></div></td>
    </tr>
    <tr>
      <td width="23%" align="left" class="txt-opcoes">Skin</td>
      <td width="77%" align="left" class="txt"><label>
        <select name="ap_skin" class="txt-form" id="ap_skin">
          <?php
do {  
?><option value="<?php echo $row_list_skin['value_skin']?>"<?php if (!(strcmp($row_list_skin['value_skin'], $row_list_usuario['ap_skin']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_skin['label_skin']?></option>
          <?php
} while ($row_list_skin = mysql_fetch_assoc($list_skin));
  $rows = mysql_num_rows($list_skin);
  if($rows > 0) {
      mysql_data_seek($list_skin, 0);
	  $row_list_skin = mysql_fetch_assoc($list_skin);
  }
?>
        </select>
        <input name="res" type="hidden" id="res" value="res" />
      </label></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Barras</td>
      <td align="left" class="txt"><select name="ap_tabela" class="txt-form" id="ap_tabela">
        <?php
do {  
?>
        <option value="<?php echo $row_list_tb_barras['value_tabela']?>"<?php if (!(strcmp($row_list_tb_barras['value_tabela'], $row_list_usuario['ap_tabela']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_tb_barras['label_tabela']?></option>
        <?php
} while ($row_list_tb_barras = mysql_fetch_assoc($list_tb_barras));
  $rows = mysql_num_rows($list_tb_barras);
  if($rows > 0) {
      mysql_data_seek($list_tb_barras, 0);
	  $row_list_tb_barras = mysql_fetch_assoc($list_tb_barras);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Wallpapers</td>
      <td align="left" class="txt"><label>
        <select name="ap_plano_fundo" class="txt-form" id="ap_plano_fundo">
          <?php
do {  
?><option value="<?php echo $row_list_pfundo['value_pfundo']?>"<?php if (!(strcmp($row_list_pfundo['value_pfundo'], $row_list_usuario['ap_plano_fundo']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_pfundo['label_pfundo']?></option>
          <?php
} while ($row_list_pfundo = mysql_fetch_assoc($list_pfundo));
  $rows = mysql_num_rows($list_pfundo);
  if($rows > 0) {
      mysql_data_seek($list_pfundo, 0);
	  $row_list_pfundo = mysql_fetch_assoc($list_pfundo);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center">Texto</div></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Texto</td>
      <td align="left" class="txt"><label>
        <select name="cor_txt" class="txt-form" id="cor_txt">
          <?php
do {  
?>
          <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_txt']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
          <?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Fundo Texto</td>
      <td align="left" class="txt"><select name="cor_txt_fundo" class="txt-form" id="cor_txt_fundo">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt_fundo['value_cortxt_fundo']?>"<?php if (!(strcmp($row_list_txt_fundo['value_cortxt_fundo'], $row_list_usuario['cor_txt_fundo']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt_fundo['label_cortxt_fundo']?></option>
        <?php
} while ($row_list_txt_fundo = mysql_fetch_assoc($list_txt_fundo));
  $rows = mysql_num_rows($list_txt_fundo);
  if($rows > 0) {
      mysql_data_seek($list_txt_fundo, 0);
	  $row_list_txt_fundo = mysql_fetch_assoc($list_txt_fundo);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Titulo</td>
      <td align="left" class="txt"><label>
        <select name="cor_titulo_txt" class="txt-form" id="cor_titulo_txt">
          <?php
do {  
?>
          <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_titulo_txt']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
          <?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Subtitulo</td>
      <td align="left" class="txt"><label>
        <select name="cor_subtitulo_txt" class="txt-form" id="cor_txt3">
          <?php
do {  
?>
          <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_subtitulo_txt']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
          <?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Data</td>
      <td align="left" class="txt"><select name="cor_data_horas" class="txt-form" id="cor_data_horas">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_data_horas']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
        <?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Indece</td>
      <td align="left" class="txt"><select name="cor_tb_indece" class="txt-form" id="cor_tb_indece">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_tb_indece']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
        <?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Op&ccedil;&otilde;es</td>
      <td align="left" class="txt"><select name="cor_tb_opcoes" class="txt-form" id="cor_tb_opcoes">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_tb_opcoes']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
        <?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center">Formulario</div></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Texto do Formulario</td>
      <td align="left" class="txt"><select name="cor_form_txt" class="txt-form" id="cor_form_txt">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_form_txt']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
<?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center">Bot&otilde;es</div></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Botao Adicionar</td>
      <td align="left" class="txt"><select name="cor_botao_add" class="txt-form" id="cor_botao_add">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_botao_add']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
<?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Botao Alterar</td>
      <td align="left" class="txt"><select name="cor_botao_alterar" class="txt-form" id="cor_botao_alterar">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_botao_alterar']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
        <?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Botao Excluir</td>
      <td align="left" class="txt"><select name="cor_botao_excluir" class="txt-form" id="cor_botao_excluir">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_botao_excluir']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
<?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Botao Pesquisar</td>
      <td align="left" class="txt"><select name="cor_botao_pesquisar" class="txt-form" id="cor_botao_pesquisar">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_botao_pesquisar']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
        <?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center">Menu</div></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Menu texto</td>
      <td align="left" class="txt"><select name="cor_menu_txt" class="txt-form" id="cor_menu_txt">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_menu_txt']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
<?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">menu Fundo</td>
      <td align="left" class="txt"><label>
        <select name="cor_menu_fundo" class="txt-form" id="cor_menu_fundo">
          <?php
do {  
?>
          <option value="<?php echo $row_list_menu['value_menu']?>"<?php if (!(strcmp($row_list_menu['value_menu'], $row_list_usuario['cor_menu_fundo']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_menu['label_menu']?></option>
          <?php
} while ($row_list_menu = mysql_fetch_assoc($list_menu));
  $rows = mysql_num_rows($list_menu);
  if($rows > 0) {
      mysql_data_seek($list_menu, 0);
	  $row_list_menu = mysql_fetch_assoc($list_menu);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Menu over</td>
      <td align="left" class="txt"><select name="cor_menu_txt_down" class="txt-form" id="menu3">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_menu_txt_down']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
        <?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Submenu texto</td>
      <td align="left" class="txt"><select name="cor_submenu_txt" class="txt-form" id="menu4">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_submenu_txt']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
<?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Submenu Fundo</td>
      <td align="left" class="txt"><label>
        <select name="cor_submenu_fundo" class="txt-form" id="cor_submenu_fundo">
          <?php
do {  
?>
          <option value="<?php echo $row_list_subm['value_submenu']?>"<?php if (!(strcmp($row_list_subm['value_submenu'], $row_list_usuario['cor_submenu_fundo']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_subm['label_submenu']?></option>
          <?php
} while ($row_list_subm = mysql_fetch_assoc($list_subm));
  $rows = mysql_num_rows($list_subm);
  if($rows > 0) {
      mysql_data_seek($list_subm, 0);
	  $row_list_subm = mysql_fetch_assoc($list_subm);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Submenu over</td>
      <td align="left" class="txt"><select name="cor_submenu_txt_down" class="txt-form" id="cor_submenu_txt_down">
        <?php
do {  
?>
        <option value="<?php echo $row_list_txt['value_cor']?>"<?php if (!(strcmp($row_list_txt['value_cor'], $row_list_usuario['cor_submenu_txt_down']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_txt['label_cor']?></option>
<?php
} while ($row_list_txt = mysql_fetch_assoc($list_txt));
  $rows = mysql_num_rows($list_txt);
  if($rows > 0) {
      mysql_data_seek($list_txt, 0);
	  $row_list_txt = mysql_fetch_assoc($list_txt);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" class="txt-Indece"><div align="center">
        <input name="Alterar" type="submit" class="txt-Botao-ADD" id="Alterar" value="Alterar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="alterar" />
</form>
<?php 
//envio de resposta do formulario
$res=$_POST['res'];
if ($res==res){
	include "res_alt.php";
}
?>
<?php
mysql_free_result($list_skin);

mysql_free_result($list_pfundo);

mysql_free_result($list_txt);

mysql_free_result($list_menu);

mysql_free_result($list_subm);

mysql_free_result($list_txt_fundo);

mysql_free_result($list_usuario);

mysql_free_result($list_tb_barras);

?>