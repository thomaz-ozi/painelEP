<?php require("../Connections/connection_user.php");?>
<?php $id_session=$_SESSION['MM_UserGroup']; ?>
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
mysql_select_db($database_connection_user, $connection_user);
$query_perfusuario = "SELECT * FROM vwnext_usuario WHERE id_usuario = '$id_session'";
$perfusuario = mysql_query($query_perfusuario, $connection_user) or die(mysql_error());
$row_perfusuario = mysql_fetch_assoc($perfusuario);
$totalRows_perfusuario = mysql_num_rows($perfusuario);

?>
<style type="text/css">

<?php
//ocultar body
if (empty($body)){
		?>
@charset "utf-8";
<?php } ?>
<!--

.txt{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_txt']; ?>;
	text-indent: 5px;
	background-image: url(../sistema_aparencia/skin/<?php echo $row_perfusuario['ap_skin']; ?>/fundo.png);
}
.txt-form {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_form_txt']; ?>;
	text-indent: 5px;
}
.txt-form-Maiusculos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_form_txt']; ?>;
	text-indent: 5px;
	text-transform: uppercase;
}.txt-form-Minusculos{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_form_txt']; ?>;
	text-indent: 5px;
	text-transform: lowercase;
}
.txt-list{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	text-indent: 5px;
}
.txt-Titulo{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: <?php echo $row_perfusuario['cor_titulo_txt']; ?>;
	text-indent: 5px;
	font-weight: bold;
	text-transform: uppercase;
}
.txt-Subtitulo{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_subtitulo_txt']; ?>;
	text-indent: 5px;
	font-weight: bold;
}

.txt-indece-titulo {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFF;
	text-indent: 5px;
	background-color: #1F8CB1;
	font-weight: bold;
	/*background-image: url(../sistema_aparencia/skin/<?php echo $row_perfusuario['ap_tabela'];?>/barra-indece.png);*/
	background-position: 30px;
	line-height: 30px;
	text-transform: uppercase;
	
	
	border-top-left-radius: 10px;    
    border-top-right-radius: 10px;  
}

.txt-Indece {
	padding:4px;
	line-height: 20px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #536A7F;
	text-indent: 5px;
	background-color: #F5F5F5;
	border:#E3E3E3 solid 1px;
	border-radius:5px;
	font-weight: bold;
/*	background-image: url(../sistema_aparencia/skin/<?php echo $row_perfusuario['ap_tabela'];?>/barra-indece.png);*/

	
	
}



.txt-opcoes {
	/*font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #666;
	text-indent: 5px;
	/*font-weight: bold;*/
	/*background-image: url(../sistema_aparencia/skin/<?php echo $row_perfusuario['ap_tabela']; ?>/barra-opcao.png);
	line-height: 24px;
	*/
	padding:5px;
	border-right:#DCDCDC solid 1px;
	border-bottom:#DCDCDC solid 1px;
	
	color: #73879C;
font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
font-size: 13px;
font-weight: bold;
text-align: right;
}
.txt-opcoes a:link {
	
	font-family: Arial, Helvetica, sans-serif;
	text-decoration: none;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_tb_opcoes']; ?>;
}
.txt-opcoes a:visited {
	font-family: Arial, Helvetica, sans-serif;
	text-decoration: none;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_tb_opcoes']; ?>;
}
.txt-opcoes a:hover {
	font-family: Arial, Helvetica, sans-serif;
	text-decoration: underline;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_tb_opcoes']; ?>;
	text-indent: 20px;
	text-align: right;
}

.txt-Botao-ADD {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:  <?php echo $row_perfusuario['cor_botao_add']; ?>;
	text-indent: 5px;
	font-weight: bold;
}
.txt-Botao-Alterar {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_botao_alterar']; ?>;
	text-indent: 5px;
	font-weight: bold;
}
.txt-Botao-voltar{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:#666;
	text-indent: 5px;
	font-weight: bold;
	}
.txt-Botao-Excluir {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_botao_excluir']; ?>;
	text-indent: 5px;
	font-weight: bold;
}
.txt-Botao-pesquisar {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_botao_pesquisar']; ?>;
	text-indent: 5px;
}
.txt-logoff {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px; 
<?php if(!empty($row_perfusuario['corLogoff'])){ ?>	color: <?php echo $row_perfusuario['corLogoff']; }?>;
	background-color: #FFFFFF;
	background-position: center;
}
.txt_date_time {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: <?php echo $row_perfusuario['cor_data_horas']; ?>;
	text-indent: 5px;
	font-weight: bold;
}

-->



.divBarraRol{height:350px; width:100%; overflow-x: hidden; overflow-y: scroll; border:#B1B1B1 solid 1px;}

.msn_selecionado{ font-size:16px; font-weight: bold;}

.connection_oculto{ display:none;}


/*Opcoes de tabelas*/

.dropdown-menu {
    left: -95px;
}
@media(max-width:964px){
/*LOADS*/	
.divLoadMsn{ width:100%; margin-top:-60px; box-shadow: 0px 0px 5px 0px rgba(23,45, 68,0.75)}
.divLoadMsnFull{ width:100%; box-shadow: 0px 0px 5px 0px rgba(23,45, 68,0.75)}
.ocultarMin{ display:none;}

/*BUTTON*/
.buttonDropdown{ font-size:18px; color:#24359B;  width:80px;  margin:-8px;  }
.buttonDropdown .buttons, button, .btn {    margin-bottom: 0px;    margin-right: 0px;}
.buttonDropdown .btn-primary {    color: #263E48;    background-color: #FFF;    border-color: #FFF;}
.buttonOpenIcon2{ display:none;}
.buttonOpenIcon3{ display:none;}
}
@media(min-width:963px) {
/*LOADS*/	
.divLoadMsn{ width:75%; box-shadow: 0px 0px 5px 0px rgba(23,45, 68,0.75)}
.divLoadMsnFull{ width:100%; box-shadow: 0px 0px 5px 0px rgba(23,45, 68,0.75)}

.ocultarMin{ display:block;}

/*BUTTON*/
.buttonOpenIcon2{ font-size:18px; width:80px;  margin:-10px; }
.buttonOpenIcon3{ font-size:18px; width:100px;  margin:-10px; }
.buttonDropdown{ display:none; }
	
	

}

.tableListMsnNone{width:99%;  position:absolute; margin-top: -5px; margin-left:-5px; padding:5px; text-align:center; background-color:#FFF;}
.divLoadMsnClouse{ cursor:pointer; margin:5px 5px 20px; }
.listTable {    height: 250px;    width: 100%;    overflow-x: hidden;    overflow-y: scroll;    border: #A5A5A5 solid 1px;}

/*PERSONALIZAR*/

.ui-widget-content{ color:#73879C;}

</style>






<link href="../sistema_aparencia/skin/<?php echo $row_perfusuario['ap_skin']; ?>/css/estilos.css" rel="stylesheet" type="text/css">
<link href="../sistema_aparencia/skin/<?php echo $row_perfusuario['ap_skin']; ?>/css/site_barra.css" rel="stylesheet" type="text/css">
<link href="../sistema_aparencia/system_options.css" rel="stylesheet" type="text/css">
  
<?php 

//LOCAL DOS ICONS:
$local_icons='../sistema_aparencia/icons/';
$local_images='../sistema_aparencia/skin/';

?>

<?php

mysql_free_result($perfusuario);
?>

