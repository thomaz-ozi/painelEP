<?php require_once('../Connections/connection_user.php'); ?>
<?php 

if (!isset($_SESSION)) {
  session_start();
}

 ?>
<?php $usuario=$_POST['usuario']; ?>
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
$id_session=$_SESSION['MM_UserGroup'];



mysql_select_db($database_connection_user, $connection_user);
$query_list_usu = "SELECT id_usuario, usuario FROM tbnext_usuario WHERE id_usuario = '$id_session'";
$list_usu = mysql_query($query_list_usu, $connection_user) or die(mysql_error());
$row_list_usu = mysql_fetch_assoc($list_usu);
$totalRows_list_usu = mysql_num_rows($list_usu);

mysql_select_db($database_connection_user, $connection_user);
$query_list_sistemas = "SELECT * FROM tbnext_sistem";
$list_sistemas = mysql_query($query_list_sistemas, $connection_user) or die(mysql_error());
$row_list_sistemas = mysql_fetch_assoc($list_sistemas);
$totalRows_list_sistemas = mysql_num_rows($list_sistemas);
?>
<?php


$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=md5(strtoupper($_POST['senha']));
  $MM_fldUserAuthorization = "id_usuario";
  $MM_redirectLoginSuccess = "../sistema_usuario/log_usuario.php";
  $MM_redirectLoginFailed = "login.php?erro=342";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connection_user, $connection_user);
  	
  $LoginRS__query=sprintf("SELECT usuario, senha, id_usuario FROM tbnext_usuario WHERE usuario=%s AND senha=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connection_user) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'id_usuario');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GERENTE | Login -  <?php echo $row_list_sistemas['nome_next']; ?>  - <?php echo $row_list_sistemas['versao_next']; ?></title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../css/custom.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
       <script>
$(function(){
$('#button').click(function(){
	$('#loading').slideDown()
	$('.login_info').css('display','none');

	});
});
</script>
    <style>
	
	
	@media(max-width:964px){
    .login_content{ width:100%; border:#BCBCBC 1px solid; padding:20px; background-color:#F7F7F7; border-radius:5px;}

}
@media(min-width:963px) {
	    .login_content{ width:500px; border:#BCBCBC 1px solid; padding:20px; background-color:#F7F7F7; border-radius:5px;}

}
	
	
	
	
	
    </style>
  </head>

  <body style="background:#2A3F54;">
    <div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>

      <div id="wrapper">
        <div id="login" class=" form">
          <section class="login_content">
            <form action="<?php echo $loginFormAction; ?>" id="login_acao" name="login_acao" method="post" >

              <h1>GERENTE 1.0</h1>
              <div>
                <input name="usuario" type="text" required="" class="form-control" id="usuario" placeholder="usuario" value="<?php echo $loginUsername;?>" />
              </div>
              <div>
                <input name="senha" type="password" required="" class="form-control" id="senha" placeholder="senha" />
              </div>

              <div>
                <button  type="submit" class="btn btn-default submit" id="button">Entrar</button>
                <a class="reset_pass" href="#">Perdeu sua senha?</a>
              </div>
              	<div id="loading" style="display:none; height:50px;">
  					<img src="../sistema_aparencia/icons/loadingBar.gif" width="225" height="40">
  				</div>
              <div class="clearfix"></div>
              <div class="separator">
				
                  <?php 
$erro=$_GET['erro'];
switch($erro){
	case '2':
	 	include "login_erro.php";
	break;

	case '3':
		echo '<span  align="center" class="login_info" style="font-family: Arial, Helvetica, sans-serif"> Acesso Restrito </span>';
	break;
	 
	case '342':
	echo '<span  align="center" class="login_info" style="  font-family: Arial, Helvetica, sans-serif"> Usuario ou senha <br>"incorreta" </span>';
	break;
	}
	   
	   ?>
                
                <p class="change_link">
                  <a href="#toregister" class="to_register"> Criar uma conta </a>
                </p>
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1>Grupo Next </h1>

                  <p>©2016 All Rights Reserved. Grupo Next! Termos de privacidade</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        
          </section>
        </div>
      </div>
    </div>
  </body>
</html>