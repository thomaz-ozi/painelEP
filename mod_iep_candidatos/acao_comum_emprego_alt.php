<?php require_once('../Connections/connection.php'); ?>
<?php require_once ("../sistema_funcoes/agoraDataHoras.php");?>
<?php 
$_POST['DataRegistroEmp']=agoraDataHoras();
$_POST['StatusRegistro']=1;

if($_POST['EmpregoDataEntreda']==''){$_POST['EmpregoDataEntreda']='00/00/0000';}
if($_POST['EmpregoDataSaida']==''){$_POST['EmpregoDataSaida']='00/00/0000';}

   $updateSQL = sprintf("UPDATE tbMod_canditadosEmprego SET Codigo=%s, EmpregoEmpresa=%s, EmpregoCargo=%s, EmpregoDataEntreda=%s, EmpregoDataSaida=%s, EmpregoMotivoSaida=%s, DataRegistroEmp=%s, EmpregoCidade=%s, id_usuario=%s, StatusRegistro=%s  WHERE IdEmprego=%s",
                       GetSQLValueString($_POST['Codigo'], "int"),
                       GetSQLValueString($_POST['EmpregoEmpresa'], "text"),
                       GetSQLValueString($_POST['EmpregoCargo'], "text"),
                       GetSQLValueString(converte_data($_POST['EmpregoDataEntreda']), "date"),
                       GetSQLValueString(converte_data($_POST['EmpregoDataSaida']), "date"),
                       GetSQLValueString($_POST['EmpregoMotivoSaida'], "text"),
                       GetSQLValueString($_POST['DataRegistroEmp'], "date"),
                       GetSQLValueString($_POST['EmpregoCidade'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['StatusRegistro'], "int"),
                       GetSQLValueString($_POST['IdEmprego'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
?>
