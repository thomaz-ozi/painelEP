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
  $MM_redirectLoginSuccess = "log_usuario.php";
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $row_list_sistemas['nome_next']; ?>  - <?php echo $row_list_sistemas['versao_next']; ?></title>


<?php /*  $id_session= $_SESSION['MM_UserGroup'];
if(isset($id_session)){

echo "<script type=\"text/javascript\">
		<!--
		function MM_goToURL() { //v3.0
		  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
		  for (i=0; i<(args.length-1); i+=2) eval(args[i]+\".location='\"+args[i+1]+\"'\");
		}
		//-->
		</script>";
		
echo "<body onload=\"MM_goToURL('parent','../sistema/painel.php?startmod=&conteudo=inicio');return document.MM_returnValue\">";
exit;
} */
?>
<?php  include "../sistema_usuario/cabecalho_login.php"; ?>

<style type="text/css">
<!--
body {
		
	margin-top: 20px;
	background-image:url(../sistema_aparencia/wallpaper/login.jpg);
	/*background-attachment:fixed;**/
	background-color:#FFF;
	background-repeat:no-repeat;
	background-position:center;
	background-position:top;
}
.login_txt {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #4477A2;
}
#button{
	cursor:pointer;
	}
.botao_entrar {
	background-image: url(../sistema_aparencia/login/login_r10_c4.png);
	cursor:pointer;
	height: 35px;
	width: 93px;
	border:none;
}
.botao_onMouseOver{
	background-image:url(../sistema_aparencia/login/login_r10_c4.png);
	height: 35px;
	width: 93px;
	border:none;
}
.botao_onclick{
	background-image: url(../sistema_aparencia/login/login_r10_c4.png);
	height: 35px;
	width: 93px;
	border:none;
}
.login_txt_form{
	height:16px;
	font-family: Verdana, Geneva, sans-serif;
	font-weight: normal;
	font-size: 12px;
	color: #4477A2;
	border:none;
	background-color:transparent;
}
.login_txt_botao{
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #003768;
}
.login_info {
	font-size: 14px;
	color: #4477A2;
	font-weight: bold;
}
a:visited {
	color: #FFFFFF;
	text-decoration: none;
	font-weight: bold;
	font-size: 12px;
}
a:active {
	color: #FFFFFF;
	text-decoration: none;
}
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:hover {
	color: #FFFFFF;
	text-decoration: underline;
	font-weight: bold;
	font-size: 12px;
}
.txt {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
}
.form_tabela{
	background-image: url(../sistema_aparencia/login/login_r3_c2.png);
}
.form_tabela_fundo{
	background-image: url(../sistema_aparencia/login/login_r8_c1.png);
}

-->
</style>
















<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<style type="text/css">
td img {display: block;}.form_tabela_fundo1 {	background-image: url(../images/login-sistema/login_r8_c1.png);
}
</style>
<!--Fireworks CS6 Dreamweaver CS6 target.  Created Thu Oct 17 09:16:13 GMT-0300 (Hora oficial do Brasil) 2013-->
<script language="JavaScript1.2" type="text/javascript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_nbGroup(event, grpName) { //v6.0
var i,img,nbArr,args=MM_nbGroup.arguments;
  if (event == "init" && args.length > 2) {
    if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
      img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
      if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
      nbArr[nbArr.length] = img;
      for (i=4; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
        if (!img.MM_up) img.MM_up = img.src;
        img.src = img.MM_dn = args[i+1];
        nbArr[nbArr.length] = img;
    } }
  } else if (event == "over") {
    document.MM_nbOver = nbArr = new Array();
    for (i=1; i < args.length-1; i+=3) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = (img.MM_dn && args[i+2]) ? args[i+2] : ((args[i+1])?args[i+1] : img.MM_up);
      nbArr[nbArr.length] = img;
    }
  } else if (event == "out" ) {
    for (i=0; i < document.MM_nbOver.length; i++) { img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
  } else if (event == "down") {
    nbArr = document[grpName];
    if (nbArr) for (i=0; i < nbArr.length; i++) { img=nbArr[i]; img.src = img.MM_up; img.MM_dn = 0; }
    document[grpName] = nbArr = new Array();
    for (i=2; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = img.MM_dn = (args[i+1])? args[i+1] : img.MM_up;
      nbArr[nbArr.length] = img;
  } }
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

//-->
</script>
   <script>
$(document).ready(function(){
$('#button').click(function(){
	$('#loading').css('display','block');
	$('.login_info').css('display','none');

	});
});
</script>
</head>
<body bgcolor="#ffffff" onload="MM_preloadImages('../sistema_aparencia/login/login_r10_c4_s2.png','../sistema_aparencia/login/login_r10_c4_s4.png','../sistema_aparencia/login/login_r10_c4_s3.png')">
<form action="<?php echo $loginFormAction; ?>" id="login" name="login" method="post" >
<table width="367" border="0" align="center" cellpadding="0" cellspacing="0" style="">
<!-- fwtable fwsrc="LOGIN-4.png" fwpage="Page 1" fwbase="login.png" fwstyle="Dreamweaver" fwdocid = "1126982481" fwnested="0" -->
  <tr>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="115" height="1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="21" height="1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="4" height="1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="93" height="1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="88" height="1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="45" height="1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="1" alt="" /></td>
  </tr>

  <tr>
   <td colspan="7"><img name="login_r1_c1" src="../sistema_aparencia/login/login_r1_c1.png" width="367" height="66" id="login_r1_c1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="66" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><img name="login_r2_c1" src="../sistema_aparencia/login/login_r2_c1.png" width="367" height="11" id="login_r2_c1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="11" alt="" /></td>
  </tr>
  <tr>
   <td><img name="login_r3_c1" src="../sistema_aparencia/login/login_r3_c1.png" width="115" height="21" id="login_r3_c1" alt="" /></td>
   <td colspan="4" style="background-image:url(../sistema_aparencia/login/login_r3_c2.png);">
   <input name="usuario" type="text" class="login_txt_form" id="usuario"  style=" width:180px;" value="<?php echo $loginUsername;?>"/></td>
   <td colspan="2"><img name="login_r3_c6" src="../sistema_aparencia/login/login_r3_c6.png" width="46" height="21" id="login_r3_c6" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="21" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><img name="login_r4_c1" src="../sistema_aparencia/login/login_r4_c1.png" width="367" height="14" id="login_r4_c1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="14" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><img name="login_r5_c1" src="../sistema_aparencia/login/login_r5_c1.png" width="367" height="3" id="login_r5_c1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="3" alt="" /></td>
  </tr>
  <tr>
   <td><img name="login_r6_c1" src="../sistema_aparencia/login/login_r6_c1.png" width="115" height="21" id="login_r6_c1" alt="" /></td>
   <td colspan="4" style="background-image:url(../sistema_aparencia/login/login_r6_c2.png);"><input name="senha" type="password" class="login_txt_form" id="senha" style=" width:180px;"  /></td>
   <td colspan="2"><img name="login_r6_c6" src="../sistema_aparencia/login/login_r6_c6.png" width="46" height="21" id="login_r6_c6" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="21" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><img name="login_r7_c1" src="../sistema_aparencia/login/login_r7_c1.png" width="367" height="11" id="login_r7_c1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="11" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7" align="center" style="background-image:url(../sistema_aparencia/login/login_r8_c1.png);">
   
     <div id="loading" style="display:none;">
  <img src="../sistema_aparencia/icons/loadingBar.gif" width="225" height="40">
  </div>
   
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
	   
	   ?></td>
   <td align="center"><img src="../sistema_aparencia/login/spacer.gif" width="1" height="37" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" colspan="2"><img name="login_r9_c1" src="../sistema_aparencia/login/login_r9_c1.png" width="136" height="39" id="login_r9_c1" alt="" /></td>
   <td colspan="2"><img name="login_r9_c3" src="../sistema_aparencia/login/login_r9_c3.png" width="97" height="4" id="login_r9_c3" alt="" /></td>
   <td rowspan="2" colspan="2"><img name="login_r9_c5" src="../sistema_aparencia/login/login_r9_c5.png" width="133" height="39" id="login_r9_c5" alt="" /></td>
   <td rowspan="2"><img name="login_r9_c7" src="../sistema_aparencia/login/login_r9_c7.png" width="1" height="39" id="login_r9_c7" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="4" alt="" /></td>
  </tr>
  <tr>
   <td><img name="login_r10_c3" src="../sistema_aparencia/login/login_r10_c3.png" width="4" height="35" id="login_r10_c3" alt="" /></td>
   <td>
   
   <input name="button" type="submit" id="button" value=" "
	 	class="botao_entrar" 
      	onmouseover="this.className='botao_onMouseOver';" 
      	onmouseout ="this.className='botao_onMouseOver';"
      	onclick = "this.className='botao_onclick';"/>
   
   
   </td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="35" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><img name="login_r11_c1" src="../sistema_aparencia/login/login_r11_c1.png" width="367" height="42" id="login_r11_c1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="42" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7" style="background-image:url(../sistema_aparencia/login/login_r12_c1.png);"><table width="302" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
       <td colspan="2" class="login_info" style="font-size: 11px; font-family: Arial, Helvetica, sans-serif"><div align="center">Sistema compativel: Navegadores com norma W3C</div></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><br />
         <div align="right" > <a href="http://www.gruponext.com.br"  target="_blank"   ><span class="login_txt" style="font-family: Arial, Helvetica, sans-serif; font-style: italic; font-size: 10px"> Desenvolvido pelo GrupoNext</span> </a></div></td>
     </tr>
   </table>
   <div class="login_txt">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_next_versao['nome_next']; ?> - <?php echo $row_next_versao['versao_next']; ?>
   </div>
   </td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="51" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7"><img name="login_r13_c1" src="../sistema_aparencia/login/login_r13_c1.png" width="367" height="29" id="login_r13_c1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="29" alt="" /></td>
  </tr>
  <tr>
   <td colspan="7">
   <img name="../sistema_aparencia/login/login_r14_c1" src="../sistema_aparencia/login/login_r14_c1.png" width="367" height="29" id="login_r14_c1" alt="" />
     <img name="../sistema_aparencia/login/login_r15_c1" src="../sistema_aparencia/login/login_r15_c1.png" width="367" height="13" id="login_r15_c1" alt="" /></td>
   <td><img src="../sistema_aparencia/login/spacer.gif" width="1" height="13" alt="" /></td>
  </tr>
</table>
</form>
<p align="center">
    <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
        <img
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="CSS válido!" border="0" style="border:0;width:88px;height:31px" />
    </a>
    
    <a href="http://validator.w3.org/check?uri=referer" target="_blank"><img
      src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" border="0" /></a>
  
</p>
</body>
</html>
<?php
mysql_free_result($list_usu);

mysql_free_result($list_sistemas);
?>