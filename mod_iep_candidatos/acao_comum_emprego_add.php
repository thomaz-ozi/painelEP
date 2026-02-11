<?php 
//====================================>  Números de Empregos <=================================//
			$Codigo=$_POST['Codigo'];
		   	$EmpregoEmpresa=$_POST['EmpregoEmpresa_insert'];
		   	$EmpregoCargo=$_POST['EmpregoCargo_insert'];
			$EmpregoMotivoSaida=$_POST['EmpregoMotivoSaida_insert'];
			$EmpregoCidade=$_POST['EmpregoCidade_insert'];
		   	$EmpregoDataEntreda=$_POST['EmpregoDataEntreda_insert'];
			$EmpregoDataSaida=$_POST['EmpregoDataSaida_insert'];
		   	$id_usuario=$_POST['id_usuario'];
			$DataRegistroEmp=$_POST['DataRegistroEmp'];
			
		   	



	
	for($ne = 0; $ne < sizeof($EmpregoEmpresa); $ne++) {
 	$insertSQL = sprintf("INSERT INTO tbMod_canditadosEmprego (Codigo, EmpregoEmpresa, EmpregoCargo, EmpregoMotivoSaida, EmpregoDataEntreda, EmpregoDataSaida, id_usuario, DataRegistroEmp, EmpregoCidade) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($Codigo, "int"),
                       GetSQLValueString($EmpregoEmpresa[$ne], "text"),
                       GetSQLValueString($EmpregoCargo[$ne], "text"),
					   GetSQLValueString($EmpregoMotivoSaida[$ne], "text"),
                       GetSQLValueString(converte_data($EmpregoDataEntreda[$ne]), "date"),
                       GetSQLValueString(converte_data($EmpregoDataSaida[$ne]), "date"),
                       GetSQLValueString($id_usuario, "int"),
                       GetSQLValueString(agoraDataHoras(), "date"),
                       GetSQLValueString($EmpregoCidade[$ne], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
		}
?>
