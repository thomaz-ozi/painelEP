<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
	
<form action="?Codigo=<?php echo $row_list_acao['Codigo']; ?>&conteudo=candidatos-alt"   method="POST" enctype="multipart/form-data" name="acao" id="acao" >

	
	<input name="nome" id="nome" placeholder="NOME" value="" type="text" required>
	<input name="email" id="email" placeholder="email" value="" type="email" required>
	<input name="fone" id="fone" placeholder="fone" value="" type="tel" required>
	<input type="submit" name="submit" id="submit" value="Submit">
</form>
	
</body>
<body>
</body>
</html>
