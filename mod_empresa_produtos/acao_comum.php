<?php

	
$id_produtos=$_POST['id_produtos'];
$xNome=$_POST['loadDescricao_xNome'];
$descricao=$_POST['loadDescricao_descricao'];
	
for($c = 0; $c < sizeof($xNome); $c++) {
			
  $insertSQL = sprintf("INSERT INTO tbnext_produtos_descricao (id_produtos, xNome, descricao) VALUES (%s, %s, %s)",
                       GetSQLValueString($id_produtos, "int"),
                       GetSQLValueString($xNome[$c], "text"),
                       GetSQLValueString($descricao[$c], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
  
}

?>
