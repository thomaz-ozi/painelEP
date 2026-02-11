<?php require_once('../Connections/connection_user.php'); ?>
<?php
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

$colname_list_senha = "-1";
if (isset($row_list_acao['id_usuario'])) {
  $colname_list_senha = $row_list_acao['id_usuario'];
}
mysql_select_db($database_connection_user, $connection_user);
 $query_list_senha = sprintf("SELECT * FROM tbnext_usuario WHERE id_usuario = %s", GetSQLValueString($colname_list_senha, "int"));
$list_senha = mysql_query($query_list_senha, $connection_user) or die(mysql_error());
$row_list_senha = mysql_fetch_assoc($list_senha);
$totalRows_list_senha = mysql_num_rows($list_senha);
?>
<?php
$senha_atual=md5(strtoupper($_POST['senha_atual']));
$senha_antiga=$row_list_senha['senha'];
$senha=md5(strtoupper($_POST['senha']));
$senha_confirme=md5(strtoupper($_POST['senha_confirme']));

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	// verificar senha atual
	if($senha_atual==$senha_antiga){
		// verificar senha novas
		if($senha==$senha_confirme){
		$editFormAction = $_SERVER['PHP_SELF'];
			if (isset($_SERVER['QUERY_STRING'])) {
 				 $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
			}

			if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
				$updateSQL = sprintf("UPDATE tbnext_usuario SET senha=%s WHERE id_usuario=%s",
                       GetSQLValueString(md5(strtoupper($_POST['senha'])), "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

 				 mysql_select_db($database_connection_user, $connection_user);
				 $Result1 = mysql_query($updateSQL, $connection_user) or die(mysql_error());
			}
			$local= $modulo_local=$conf_url."acao_alterar_senha_res.php";
			$resposta='
				<div class="alert alert-success alert-dismissible fade in" role="alert">
                    <strong> A Senha foi alterada com SUCESSO!</strong>
                </div>';
		
		}else {
			$local= $modulo_local=$conf_url."acao_alterar_senha_form.php";
			 $resposta='
			 	<div class="alert alert-warning  alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong> A Senha do campo de confirma&ccedil;&atilde;o n&atilde;o s&atilde;o iguais!<br /> Tente novamente</strong>
                </div>
			 ';
			 }
	}else{
	$local= $modulo_local=$conf_url."acao_alterar_senha_form.php";
		$resposta='
			<div class="alert alert-warning alert-dismissible fade in" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                 </button>
                <strong> N&atilde;o é a SENHA atual! Tente novamente</strong>
            </div>				  
				 ';}

}else{ 
$local= $modulo_local=$conf_url."acao_alterar_senha_form.php";
$resposta= "Altere sua senha!";}

?>


<div  id="divPermanecer">
	 <div  class="div_absolute"></div>
		<div  class="div_absolute_msn">
  <br /><br /><br />
  			
			<div class="x_panel divLoadMsnRes" style=" width: 85%;">
			  <div class="x_title">
					<h2><img src="<?php echo "$icons_sistema_nome"; ?>" />&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp; &nbsp;<img src="<?php echo "$local_icons"; ?>alt-30.png" width="30" height="30" />  Alterar senha </h2>
					<a class="close-link" style="float:right;" onclick="MM_goToURL('parent','?conteudo=<?php echo $_GET['conteudo']; ?>&<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&');return document.MM_returnValue"><i class="fa fa-close"></i></a>
					<div class="clearfix"></div>
				</div>
  
  <table width="80%" border="0" cellpadding="0" cellspacing="1" class="texto" align="center">
    <tr>
      <td colspan="2" align="left" background="../icons/circulo_red/financeiro_linhas.png">&nbsp;</td>
    </tr>
    

    <tr>
      <td colspan="2" align="center" valign="top"  class="txt">
      <form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">

  <input type="hidden" name="MM_update" value="form1" />
  <?php include $local; ?>
      </form></td>
    </tr>

  </table>
  
  </div>
  
</div>
<?php 
//envio de resposta do formulario
if ($_POST['res']==res){	include "res_alt.php";}

mysql_free_result($list_senha);
?>
88