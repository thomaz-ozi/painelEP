<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>formula Requerd </title>
</head>
<script src="../sistema/ckeditor/ckeditor.js"></script>

  <link href="../sistema_jquery/css/" rel="stylesheet">
<script src="../sistema_jquery/js/jquery-1.9.1.js"></script>
<script src="../sistema_jquery/js/jquery-ui-1.10.3.custom.js"></script>
<script src="../js/simpleupload/simpleupload.mim.js"></script>

<link rel="stylesheet" type="text/css" href="../sistema_aparencia/custom_jqueryui.css">
<script src="../sistema_funcoes/jq_mascaras.js"></script>
<script src="../sistema_funcoes/jq_maskmoney.js"></script>
<script src="../sistema_funcoes/jq_loadsData.js"></script>

		

<body>
	
<form action="?Codigo=<?php echo $row_list_acao['Codigo']; ?>&conteudo=candidatos-alt"   method="POST" enctype="multipart/form-data" name="conteudoForm" id="conteudoForm" >

	<input name="teset" type="hidden" id="teset" >
	
	  <input name="nome" id="nome" placeholder="NOME" value="" required>
	  <br>
	  <input name="email" required="required" id="email" placeholder="email"  value=""><br>
  <input name="fone" required="required" id="fone" placeholder="fone" value=""><br>
	  <br>
		<input type="file" id="acaofile">
  
<button type="button" 
onClick="loadsDataFormFile('#PesquisaAvancadaLoad','add_fotos.php','#conteudoForm','GET','POST','dados.php')"
 class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> Salvar file &nbsp;&nbsp;&nbsp;&nbsp;</button>
	
	
	
  <button type="button" 
onClick="loadsDataForm('#PesquisaAvancadaLoad','dados.php','#conteudoForm','')"
 class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> Salvar form &nbsp;&nbsp;&nbsp;&nbsp;</button>
	
</form>
	--------------------
	<div id="PesquisaAvancadaLoad"></div>
	
	
	--------------------<br>

<button type="button" 
	onClick="loadsData('#acaoAjax','dados.php',1)"

 class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> teste ajax &nbsp;&nbsp;&nbsp;&nbsp;</button>
	<div id="acaoAjax"></div>
</body>
</html>
