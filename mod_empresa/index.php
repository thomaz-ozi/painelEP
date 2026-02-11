<?php require_once('../Connections/connection_user.php'); ?>
<?php 
$_GET['id_usuario']=base64_decode( $_GET['id_usuario']); //---> 23/10/22017
  if ($row_perfusuario['ativo_empresa']==1) {//MÓDULO EMPRESA?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tbnext_usuario_perm_empresa SET ativo_empresa=%s, id_usuario=%s, id_usuario_class=%s, id_usuario_class_funcao=%s, id_perm_status_prod=%s, id_perm_status_prod_opcoes=%s, id_perm_status_prod_class=%s, id_perm_status_prod_prod=%s, id_perm_status_prod_serv=%s, ativo_perm_prov_serv_vendas=%s, id_perm_status_pess=%s, id_perm_status_pess_clientes=%s, id_perm_status_pess_fornec=%s, id_perm_status_pess_funcionario=%s, perm_limit_produtos_prod=%s, perm_limit_produtos_serv=%s WHERE id_perm=%s",
                       GetSQLValueString(isset($_POST['ativo_empresa']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['id_usuario_class'], "int"),
                       GetSQLValueString($_POST['id_usuario_class_funcao'], "int"),
                       GetSQLValueString(isset($_POST['id_perm_status_prod']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_perm_status_prod_opcoes'], "int"),
                       GetSQLValueString($_POST['id_perm_status_prod_class'], "int"),
                       GetSQLValueString($_POST['id_perm_status_prod_prod'], "int"),
                       GetSQLValueString($_POST['id_perm_status_prod_serv'], "int"),
                       GetSQLValueString($_POST['ativo_perm_prov_serv_vendas'], "int"),
                       GetSQLValueString(isset($_POST['id_perm_status_pess']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_perm_status_pess_clientes'], "int"),
                       GetSQLValueString($_POST['id_perm_status_pess_fornec'], "int"),
                       GetSQLValueString($_POST['id_perm_status_pess_funcionario'], "int"),
                       GetSQLValueString($_POST['perm_limit_produtos_prod'], "int"),
                       GetSQLValueString($_POST['perm_limit_produtos_serv'], "int"),
                       GetSQLValueString($_POST['id_perm'], "int"));

  mysql_select_db($database_connection_user, $connection_user);
  $Result1 = mysql_query($updateSQL, $connection_user) or die(mysql_error());
}

$colname_list_acao = "-1";
if (isset($_GET['id_usuario'])) {
  $colname_list_acao = $_GET['id_usuario'];
}
mysql_select_db($database_connection_user, $connection_user);
 $query_list_acao = sprintf("SELECT * FROM tbnext_usuario_perm_empresa WHERE id_usuario = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection_user) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

mysql_select_db($database_connection_user, $connection_user);
$query_list_perm = "SELECT * FROM tbnext_usuario_perm_list ORDER BY id_perm_status ASC";
$list_perm = mysql_query($query_list_perm, $connection_user) or die(mysql_error());
$row_list_perm = mysql_fetch_assoc($list_perm);
$totalRows_list_perm = mysql_num_rows($list_perm);



//se este usuario não tem criado permissão a este modulo então faça: 
if ($totalRows_list_acao =='0') {
  $insertSQL = sprintf("INSERT INTO tbnext_usuario_perm_empresa (id_perm, id_usuario ) VALUES (%s, %s)",
                       GetSQLValueString($_POST['id_perm'], "int"),
                       GetSQLValueString($_GET['id_usuario'], "int"));

  mysql_select_db($database_connection_user, $connection_user);
  $Result1 = mysql_query($insertSQL, $connection_user) or die(mysql_error());
  
 mysql_select_db($database_connection_user, $connection_user);
$query_list_acao = sprintf("SELECT * FROM tbnext_usuario_perm_empresa WHERE id_usuario = %s", GetSQLValueString($colname_list_acao, "int"));
$list_acao = mysql_query($query_list_acao, $connection_user) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);


}
mysql_select_db($database_connection_user, $connection_user);
$query_list_usuario_class = "SELECT * FROM tbnext_usuario_class ORDER BY xNome ASC";
$list_usuario_class = mysql_query($query_list_usuario_class, $connection_user) or die(mysql_error());
$row_list_usuario_class = mysql_fetch_assoc($list_usuario_class);
$totalRows_list_usuario_class = mysql_num_rows($list_usuario_class);
 
?>

<style>
#tablePerm{ display:  <?php if($row_list_acao['ativo_empresa']==1){echo';';}else{ echo "none;"; } ?>}
.perm_apli_prod{ disabled:  <?php if($row_list_acao['id_perm_status_prod']==1){echo'';}else{ echo "disabled;"; } ?>}
.perm_apli_pess{ disabled: }

</style>

<script>

$(function(){
	
 <?php
 if($row_list_acao['id_perm_status_prod']==1){}else{ echo "$('.perm_apli_prod').attr('disabled','disabled');"; } 
 if($row_list_acao['id_perm_status_pess']==1){}else{ echo "$('.perm_apli_pess').attr('disabled','disabled');"; }
 ?>
	
	
$('#ativo_empresa').click(function(){
	//verifica se esta atico e empresa verdadeiro ou falso
	if($(this).is(":checked")==true) {
	  $("#tablePerm").show();
	
	 // $('#id_perm_status_prod').attr('checked','checked');
	  $(".perm_apli_prod").attr('disabled','disabled');
	 // $('#id_perm_status_pess').attr('checked','checked');
	  $(".perm_apli_pess").attr('disabled','disabled');
	} else {
      $("#tablePerm").hide();
	  $('#id_perm_status_prod').attr('checked','');
	  $(".perm_apli_prod").attr('disabled','disabled');
	  $('#id_perm_status_pess').attr('checked','');
	  $(".perm_apli_pess").attr('disabled','disabled');
	}
});
	
	
	
$('#id_perm_status_prod').click(function(){
	if($(this).is(":checked")==true) {
	  $(".perm_apli_prod").removeAttr("disabled");
	} else {
	  $(".perm_apli_prod").attr('disabled','disabled');
	}
});
	
$('#id_perm_status_pess').click(function(){
	if($(this).is(":checked")==true) {
	  $(".perm_apli_pess").removeAttr("disabled");
	} else {
	  $(".perm_apli_pess").attr('disabled','disabled');
	}
});	
	
	
	
	$('#id_usuario_class').change(function(){
		var id=$(this).val()
		if((id!='')&&(id!='0')){
		loadsData('#class_funcao','../mod_empresa/conf_perm_class.php',id);
		}
	});
	
});

</script>


<?php 
$acao_comum="Alterar";
$acao_icons="alt-30.png";
//pesonalizar
$sistema_nome="Perfil de Usuario /MODULO  EMPRESA";
include ("../sistema/index_content_head.php");?>

<form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
<table width="98%" border="0" cellspacing="1" cellpadding="0">
  <tr  >
    <td width="20%" align="left" class="txt-opcoes">Usuario
      <input name="res2" type="hidden" id="res2" value="res" />
      <input name="id_perm" type="hidden" id="id_perm" value="<?php echo $row_list_acao['id_perm']; ?>" />
      <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_acao['id_usuario']; ?>">
      <input name="res" type="hidden" id="res" value="res" />
      </td>
    <td width="13%" align="left" class="txt" >
      <?php $id_usuario=$_GET['id_usuario']; include("../sistema_usuario/list_usuario.php"); ?>
      <?php  echo $row_list_acao_usuario['usuario']; ?>
      </td>
    <td width="67%" align="left" class="txt">Esta opção so é necessario quando vinculo de usuario com cadastros</td>
  </tr>
  <tr  >
    <td align="left" class="txt-opcoes">Classficar</td>
    <td align="left" class="txt" >
      <select name="id_usuario_class" id="id_usuario_class">
        <option value="">---</option>
        <?php
do {  
?>
        <option value="<?php echo $row_list_usuario_class['id_usuario_class']?>"><?php echo $row_list_usuario_class['xNome']?></option>
        <?php
} while ($row_list_usuario_class = mysql_fetch_assoc($list_usuario_class));
  $rows = mysql_num_rows($list_usuario_class);
  if($rows > 0) {
      mysql_data_seek($list_usuario_class, 0);
	  $row_list_usuario_class = mysql_fetch_assoc($list_usuario_class);
  }
?>
      </select></td>
    <td align="left" class="txt">&nbsp;</td>
  </tr>
  <tr  >
    <td align="left" class="txt-opcoes"  >Cadastro:</td>
    <td colspan="2" align="left" class="txt"  id="class_funcao"><input name="id_usuario_class_funcao" type="hidden" id="id_usuario_class_funcao" value="0"></td>
    </tr>
  <tr  class="txt-Indece">
    <td align="left" >MODULO</td>
    <td align="left" >Permissões
      </td>
    <td align="left" >&nbsp;</td>
  </tr>
  <tr  >
    <td align="left" class="txt-opcoes">Modulo Empresa:</td>
    <td align="left" class="txt" ><input name="ativo_empresa" type="checkbox" id="ativo_empresa" value="1" <?php if (!(strcmp($row_list_acao['ativo_empresa'],1))) {echo "checked=\"checked\"";} ?>>
     <span> Ativo</span></td>
    <td align="left" class="txt">&nbsp;</td>
  </tr>
  <tr  >
    <td colspan="3" align="left" >
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="tablePerm">
      <tr  class="txt-Indece">
        <td width="20%" align="left" >Aplicativos</td>
        <td width="20%" align="left" >Permissões</td>
        <td width="55%" align="left" >&nbsp;</td>
        <td width="5%" align="left" >&nbsp;</td>
      </tr>
      <?php   if ($row_perfusuario['id_perm_status_prod']==1) {?>
      <tr>
        <td align="left" class="txt-opcoes">Produtos</td>
        <td align="left" class="txt"><input name="id_perm_status_prod"  type="checkbox" id="id_perm_status_prod" value="1" <?php if (!(strcmp($row_list_acao['id_perm_status_prod'],1))) {echo "checked=\"checked\"";} ?>>
          <span> </span></td>
        <td align="left" class="txt">&nbsp;</td>
        <td align="left" class="txt">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" class="txt-opcoes">Propaganda </td>
        <td align="left" class="txt"><select  name="id_perm_status_prod_opcoes2" class="perm_apli_prod" id="id_perm_status_prod_opcoes2" required>
          <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_prod_opcoes']))) {echo "selected=\"selected\"";} ?>>---</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_perm['id_perm_status']?>"<?php if (!(strcmp($row_list_perm['id_perm_status'], $row_list_acao['id_perm_status_prod_opcoes']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_perm['xNome']?></option>
          <?php
} while ($row_list_perm = mysql_fetch_assoc($list_perm));
  $rows = mysql_num_rows($list_perm);
  if($rows > 0) {
      mysql_data_seek($list_perm, 0);
	  $row_list_perm = mysql_fetch_assoc($list_perm);
  }
?>
        </select></td>
        <td align="left" class="txt">Propaganda esta no menu M.Site</td>
        <td align="left" class="txt">&nbsp;</td>
      </tr>
      
	  <?php   if ($row_perfusuario['id_perm_status_prod_opcoes']==1) {?>
      <tr>
        <td align="left" class="txt-opcoes">Opções </td>
        <td align="left" class="txt"><select  name="id_perm_status_prod_opcoes" class="perm_apli_prod" id="id_perm_status_prod_opcoes" required>
          <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_prod_opcoes']))) {echo "selected=\"selected\"";} ?>>---</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_perm['id_perm_status']?>"<?php if (!(strcmp($row_list_perm['id_perm_status'], $row_list_acao['id_perm_status_prod_opcoes']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_perm['xNome']?></option>
          <?php
} while ($row_list_perm = mysql_fetch_assoc($list_perm));
  $rows = mysql_num_rows($list_perm);
  if($rows > 0) {
      mysql_data_seek($list_perm, 0);
	  $row_list_perm = mysql_fetch_assoc($list_perm);
  }
?>
        </select></td>
        <td align="left" class="txt">Fabricante, volt e outros</td>
        <td align="left" class="txt">&nbsp;</td>
      </tr>
      <?php } ?>
      <?php   if ($row_perfusuario['id_perm_status_prod_class']==1) {?>
      <tr>
        <td align="left" class="txt-opcoes">Class</td>
        <td align="left" class="txt"><select name="id_perm_status_prod_class" class="perm_apli_prod" id="id_perm_status_prod_class" required>
          <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_prod_class']))) {echo "selected=\"selected\"";} ?>>---</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_perm['id_perm_status']?>"<?php if (!(strcmp($row_list_perm['id_perm_status'], $row_list_acao['id_perm_status_prod_class']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_perm['xNome']?></option>
          <?php
} while ($row_list_perm = mysql_fetch_assoc($list_perm));
  $rows = mysql_num_rows($list_perm);
  if($rows > 0) {
      mysql_data_seek($list_perm, 0);
	  $row_list_perm = mysql_fetch_assoc($list_perm);
  }
?>
        </select></td>
        <td align="left" class="txt">Upload de arquivo</td>
        <td align="left" class="txt">&nbsp;</td>
      </tr>
      <?php } ?>
      <?php   if ($row_perfusuario['id_perm_status_prod_prod']==1) {?>
      <tr>
        <td align="left" class="txt-opcoes">Produtos</td>
        <td align="left" class="txt"><select name="id_perm_status_prod_prod" class="perm_apli_prod" id="id_perm_status_prod_prod" required>
          <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_prod_prod']))) {echo "selected=\"selected\"";} ?>>---</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_perm['id_perm_status']?>"<?php if (!(strcmp($row_list_perm['id_perm_status'], $row_list_acao['id_perm_status_prod_prod']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_perm['xNome']?></option>
          <?php
} while ($row_list_perm = mysql_fetch_assoc($list_perm));
  $rows = mysql_num_rows($list_perm);
  if($rows > 0) {
      mysql_data_seek($list_perm, 0);
	  $row_list_perm = mysql_fetch_assoc($list_perm);
  }
?>
        </select></td>
        <td align="left" class="txt">&nbsp;</td>
        <td align="left" class="txt">&nbsp;</td>
      </tr>
      <?php } ?>
      <?php }//fim do submodulo produtos?>
       <?php   if ($row_perfusuario['id_perm_status_pess']==1){?>
       
       <tr>
         <td align="left" class="txt-opcoes">Serviços</td>
         <td align="left" class="txt"><select name="id_perm_status_prod_serv" class="perm_apli_prod" id="perm_downloads3" required>
           <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_prod_serv']))) {echo "selected=\"selected\"";} ?>>---</option>
           <?php
do {  
?>
           <option value="<?php echo $row_list_perm['id_perm_status']?>"<?php if (!(strcmp($row_list_perm['id_perm_status'], $row_list_acao['id_perm_status_prod_serv']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_perm['xNome']?></option>
           <?php
} while ($row_list_perm = mysql_fetch_assoc($list_perm));
  $rows = mysql_num_rows($list_perm);
  if($rows > 0) {
      mysql_data_seek($list_perm, 0);
	  $row_list_perm = mysql_fetch_assoc($list_perm);
  }
?>
         </select></td>
         <td align="left" class="txt">&nbsp;</td>
         <td align="left" class="txt">&nbsp;</td>
       </tr>
       <tr>
         <td align="left" class="txt-opcoes">Imite-produtos</td>
         <td align="left" class="txt"><input name="perm_limit_produtos_prod" class="perm_apli_prod" type="text" id="perm_limit_produtos_prod" style="width:50px;" value="<?php echo $row_list_acao['perm_limit_produtos_prod']; ?>" maxlength="3"></td>
         <td align="left" class="txt">&quot;0&quot; não tem limite de produtos, apartir do &quot;1&quot; é feito a limitação aplicativo.</td>
         <td align="left" class="txt">&nbsp;</td>
       </tr>
       <tr>
         <td align="left" class="txt-opcoes">Imite-Serviços</td>
         <td align="left" class="txt"><input name="perm_limit_produtos_serv" class="perm_apli_prod" type="text" id="perm_limit_produtos_serv" style="width:50px;" value="<?php echo $row_list_acao['perm_limit_produtos_serv']; ?>" maxlength="3"></td>
         <td align="left" class="txt">&quot;0&quot; não tem limite de serviços, apartir do &quot;1&quot; é feito a limitação aplicativo.</td>
         <td align="left" class="txt">&nbsp;</td>
       </tr>
       <tr>
         <td align="left" class="txt-opcoes">Ativo Serviço/Vendas</td>
         <td align="left" class="txt"><select name="ativo_perm_prov_serv_vendas" class="perm_apli_prod" id="ativo_perm_prov_serv_vendas">
           <option value="" <?php if (!(strcmp("", $row_list_acao['ativo_perm_prov_serv_vendas']))) {echo "selected=\"selected\"";} ?>>---</option>
           <option value="1" <?php if (!(strcmp(1, $row_list_acao['ativo_perm_prov_serv_vendas']))) {echo "selected=\"selected\"";} ?>>Sim</option>
           <option value="2" <?php if (!(strcmp(2, $row_list_acao['ativo_perm_prov_serv_vendas']))) {echo "selected=\"selected\"";} ?>>N&atilde;o</option>
         </select></td>
         <td align="left" class="txt">Ativar </td>
         <td align="left" class="txt">&nbsp;</td>
       </tr>
       <tr>
        <td align="left" class="txt-opcoes">P. Física/Jurídica</td>
        <td align="left" class="txt">
        <input     type="checkbox" id="id_perm_status_pess" value="1" <?php if (!(strcmp($row_list_acao['id_perm_status_pess'],1))) {echo "checked=\"checked\"";} ?>>
		<span></span> 
        </td>
        <td align="left" class="txt">&nbsp;</td>
        <td align="left" class="txt">&nbsp;</td>
      </tr>
      <?php   if ($row_perfusuario['id_perm_status_pess_clientes']==1){?>
      <tr>
        <td align="left" class="txt-opcoes">Clientes </td>
        <td align="left" class="txt"><select name="id_perm_status_pess_clientes" class="perm_apli_pess" id="perm_downloads5" required>
          <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_pess_clientes']))) {echo "selected=\"selected\"";} ?>>---</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_perm['id_perm_status']?>"<?php if (!(strcmp($row_list_perm['id_perm_status'], $row_list_acao['id_perm_status_pess_clientes']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_perm['xNome']?></option>
          <?php
} while ($row_list_perm = mysql_fetch_assoc($list_perm));
  $rows = mysql_num_rows($list_perm);
  if($rows > 0) {
      mysql_data_seek($list_perm, 0);
	  $row_list_perm = mysql_fetch_assoc($list_perm);
  }
?>
        </select></td>
        <td align="left" class="txt">&nbsp;</td>
        <td align="left" class="txt">&nbsp;</td>
      </tr>
      <?php }?>
      <?php   if ($row_perfusuario['id_perm_status_pess_fornec']==1){?>
      <tr>
        <td align="left" class="txt-opcoes">Fornecedores</td>
        <td align="left" class="txt"><select name="id_perm_status_pess_fornec" class="perm_apli_pess" id="perm_downloads6" required>
          <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_pess_fornec']))) {echo "selected=\"selected\"";} ?>>---</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_perm['id_perm_status']?>"<?php if (!(strcmp($row_list_perm['id_perm_status'], $row_list_acao['id_perm_status_pess_fornec']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_perm['xNome']?></option>
          <?php
} while ($row_list_perm = mysql_fetch_assoc($list_perm));
  $rows = mysql_num_rows($list_perm);
  if($rows > 0) {
      mysql_data_seek($list_perm, 0);
	  $row_list_perm = mysql_fetch_assoc($list_perm);
  }
?>
        </select></td>
        <td align="left" class="txt">&nbsp;</td>
        <td align="left" class="txt">&nbsp;</td>
      </tr>
      <?php }?>
      <?php   if ($row_perfusuario['id_perm_status_pess_funcionario']==1){?>
      
      <tr>
        <td align="left" class="txt-opcoes">Colaboradores/Candidatos</td>
        <td align="left" class="txt"><select name="id_perm_status_pess_funcionario" class="perm_apli_pess" id="id_perm_status_pess_funcionario" required>
          <option value="" <?php if (!(strcmp("", $row_list_acao['id_perm_status_pess_funcionario']))) {echo "selected=\"selected\"";} ?>>---</option>
          <?php
do {  
?>
          <option value="<?php echo $row_list_perm['id_perm_status']?>"<?php if (!(strcmp($row_list_perm['id_perm_status'], $row_list_acao['id_perm_status_pess_funcionario']))) {echo "selected=\"selected\"";} ?>><?php echo $row_list_perm['xNome']?></option>
          <?php
} while ($row_list_perm = mysql_fetch_assoc($list_perm));
  $rows = mysql_num_rows($list_perm);
  if($rows > 0) {
      mysql_data_seek($list_perm, 0);
	  $row_list_perm = mysql_fetch_assoc($list_perm);
  }
?>
        </select></td>
        <td align="left" class="txt">&nbsp;</td>
        <td align="left" class="txt">&nbsp;</td>
      </tr>
      <?php }?>

    </table></td>
    </tr> 
</table>

<div class="btn-group">
<br><br><br>
	<button type="button"  id="form_bt_voltar" class="btn btn-default" 
     onclick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo base64_encode($row_list_acao[$id_sistema]); ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"><i class="fa fa-chevron-left"></i> Voltar</button>
    <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> Salvar &nbsp;&nbsp;&nbsp;&nbsp;</button>

</div>



 <?php }else{ include "../sistema/sem_permissao.php"; include "../sistema_inicio/conf.php"; }?>
<?php
//envio de resposta do formulario
if ($_POST['res']=='res'){	include "../sistema/res_alt.php";} 

mysql_free_result($list_usuario_class);

mysql_free_result($list_perm);
?>
<input type="hidden" name="MM_insert" value="form1">
<input type="hidden" name="MM_update" value="form1">

</form>

<?php }//fim submodulo p.física/p.jurídica?>