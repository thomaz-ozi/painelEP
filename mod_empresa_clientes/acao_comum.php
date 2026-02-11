<?php 

  
  
 //----------------> COMUNICAÇÃO 	
$id_comunicacao=$_POST['id_comunicacao'];
$id_comunicacao_tipo= $_POST['id_comunicacao_tipo'];
$id_class=$_POST['id_class'];
$id_clientes= $_POST['id_clientes'];
$data_acao= $_POST['data_acao'];
$xNome_contato= $_POST['xNome_contato'];
$xNome_contato2= $_POST['xNome_contato2'];
	
for($c = 0; $c < sizeof($xNome_contato); $c++) {	
  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_clientes_comunicacao (id_comunicacao, id_comunicacao_tipo, id_class, id_clientes, data_acao, xNome_contato, xNome_contato_2) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($id_comunicacao[$c], "int"),
                       GetSQLValueString($id_comunicacao_tipo[$c], "int"),
                       GetSQLValueString($id_class[$c], "int"),
                       GetSQLValueString($id_clientes, "int"),
                       GetSQLValueString($data_acao, "date"),
                       GetSQLValueString($xNome_contato[$c], "text"),
                       GetSQLValueString($xNome_contato2[$c], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}
//----------------> ENDEREÇO
$id_enderecos=$_POST['id_enderecos'];
$id_clientes=$_POST['id_clientes'];
$id_class=$_POST['id_class'];
$xLgr=$_POST['xLgr'];
$nro=$_POST['nro'];
$xBairro=$_POST['xBairro'];
$xMun=$_POST['xMun'];
$cMun=$_POST['cMun'];
$UF=$_POST['UF'];
$cUF=$_POST['cUF'];
$CEP=$_POST['CEP'];
$cPais=$_POST['cPais'];
$xPais=$_POST['xPais'];
$cmpto=$_POST['cmpto'];


for($e = 0; $e < sizeof($xLgr); $e++) {
	
  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_clientes_endereco (id_enderecos, id_clientes, id_class, xLgr, nro, xBairro, xMun, cMun, UF, cUF, CEP, cPais, xPais, cmpto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)  ",
                       GetSQLValueString($id_enderecos, "int"),
                       GetSQLValueString($id_clientes, "int"),
					   GetSQLValueString($id_class[$e], "int"),
                       GetSQLValueString($xLgr=utf8_decode($xLgr[$e]), "text"),
                       GetSQLValueString($nro[$e], "text"),
                       GetSQLValueString($xBairro[$e], "text"),
                       GetSQLValueString($xMun=utf8_decode($xMun[$e]), "text"),
                       GetSQLValueString($cMun[$e], "int"),
                       GetSQLValueString($UF[$e], "text"),
                       GetSQLValueString($cUF[$e], "text"),
                       GetSQLValueString($CEP[$e], "text"),
                       GetSQLValueString($cPais[$e], "int"),
                       GetSQLValueString($xPais[$e], "text"),
                       GetSQLValueString($cmpto[$e], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
	
	
	
}
  

//----------------> Descricao
	
$id_clientes=$_POST['id_clientes'];
$xNome=$_POST['loadDescricao_xNome'];
$descricao=$_POST['loadDescricao_descricao'];
	
for($d = 0; $d < sizeof($xNome); $d++) {
			
  $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_clientes_descricao (id_clientes, xNome, descricao) VALUES (%s, %s, %s)",
                       GetSQLValueString($id_clientes, "int"),
                       GetSQLValueString($xNome[$d], "text"),
                       GetSQLValueString($descricao[$d], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
  
}

?>