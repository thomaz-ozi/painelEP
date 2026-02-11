<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>APARENCIA FERRAMENTA </title>
<link href="system_options.css" rel="stylesheet" type="text/css">


<link href="skin/novatec/css/estilos.css" rel="stylesheet" type="text/css">


    <link href="../sistema_bootstrap/bootstrap.css" rel="stylesheet">
    <link href="../sistema_bootstrap/simple-sidebar.css" rel="stylesheet">
    <link href="../sistema_bootstrap/font-awesome.css" rel="stylesheet">

<script src="../sistema/ckeditor/ckeditor.js"></script>
<link href="../sistema_jquery/css/custom_blue/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="../sistema_jquery/js/jquery-1.9.1.js"></script>
<script src="../sistema_jquery/js/jquery-ui-1.10.3.custom.js"></script>
<script src='../sistema_jquery/spectrum.js'></script>
<link  href='../sistema_jquery/spectrum.css' rel='stylesheet' />
<script src="../sistema_funcoes/jq_mascaras.js"></script>

<script src="../sistema_funcoes/jq_maskmoney.js"></script>
<script src="../sistema_funcoes/includeJs.js"></script>
<script src="../sistema_funcoes/js_mods.js"></script>



<style>
body{ 
 background-color:#F0F0F0;
font-family:Arial Helvetica, sans-serif;
font-size:14px;
color:#666;


}
/*este estilo esta no arquivo perfuruario.php*/
.inputDiv{width:160px; background-color:#FFF; height:18px; padding:2px 5px 4px 5px; border:#999 solid 1px; color:#000; cursor:text; margin-left:5px;}
/*Desativado*/
.inputDivDes{width:160px; background-color:#FFF; height:18px; padding:2px 5px 4px 5px; border:#999 solid 1px; color:#969696; cursor:text; margin-left:5px;}

</style>
</head>

<body>
VERSÃO: 15.93<br>
<div class="tabs">
	<ul>
		<li><a href="#abas-1">APARENCIA E BOTÕES</a></li>
        <li><a href="#abas-2">FORMULARIOS</a></li>
        <li><a href="#abas-3">FORMULARIOS 2</a></li>
        <li><a href="#abas-4">FUNÇÕES PHP</a></li>
        <li><a href="#abas-5">FUNÇÕES JS-JQ</a></li>
        <li><a href="#abas-6">BOOTSTRAP</a></li>
         <li><a href="#abas-7">FONTS</a></li>
	</ul>
  <div id="abas-1">   
	<?php include('index_aparencia.php'); ?> 
  </div> 
  <div id="abas-2">    
    <?php include('index_form1.php'); ?>  
  </div>
  <div id="abas-3">    
     <?php include('index_form2.php'); ?>
  </div>
  <div id="abas-4">  
    <?php include('index_funcoes_php.php'); ?>
  </div>
    <div id="abas-5">  
    <?php include('index_funcoes_js.php'); ?>
  </div>
    <div id="abas-6">  
    <?php include('index_bootstrap.php'); ?>
  </div>
  <div id="abas-7">  
    <?php include('index_fonts.php'); ?>
  </div>
</div>
    
    
    
    



<script src="../sistema_bootstrap/bootstrap.js"></script>
<script src="../sistema_bootstrap/sidebar_menu.js"></script>  

</body>
</html>
