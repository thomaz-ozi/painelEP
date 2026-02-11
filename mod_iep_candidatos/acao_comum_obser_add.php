<?php require_once ("../sistema_funcoes/agoraDataHoras.php");?>
<?php


//====================================>  Observação do Canidato <=================================//

		   $Observacoes=$_POST['Observacoes'];
		   $Codigo=$_POST['Codigo'];
		   $id_usuario=$_POST['id_usuario'];
		   $loadDescricao_data=$_POST['loadDescricao_data'];

	
	for($nl = 0; $nl < sizeof($Observacoes); $nl++) {


  $insertSQL = sprintf("INSERT INTO tbMod_canditadosObser (Codigo, Observacoes, id_usuario, DataRegistroObs) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($Codigo, "int"),
                       GetSQLValueString($Observacoes[$nl], "text"),
                       GetSQLValueString($id_usuario, "int"),
                       GetSQLValueString(agoraDataHoras(), "date"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}



?>