<?php require_once("../sistem_funcoes/seguranca_usuario.php"); ?>
<?php require_once('../Connections/connection.php'); ?>
<?php
//$id_animais=15;
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
  mysql_select_db($database_connection, $connection);
$query_list_primeira_data = "SELECT `data`, peso FROM vwnext_mod_sma_manejo_animais WHERE id_animais = '".$id_animais."'   AND tipo_manejo!='13' AND inativo_peso !='1' ORDER BY `data`  ASC LIMIT 0, 1";
$list_primeira_data = mysql_query($query_list_primeira_data, $connection) or die(mysql_error());
$row_list_primeira_data = mysql_fetch_assoc($list_primeira_data);
$totalRows_list_primeira_data = mysql_num_rows($list_primeira_data);
	//DATA PRIMEIRA
  $primeira_data=$row_list_primeira_data['data'];
  $primeira_peso= $row_list_primeira_data['peso']; 


mysql_select_db($database_connection, $connection);
$query_list_penultima_data = "SELECT `data`, peso FROM vwnext_mod_sma_manejo_animais WHERE id_animais ='".$id_animais."' AND tipo_manejo!='13' AND inativo_peso !='1' ORDER BY `data` DESC LIMIT 1, 1";
$list_penultima_data = mysql_query($query_list_penultima_data, $connection) or die(mysql_error());
$row_list_penultima_data = mysql_fetch_assoc($list_penultima_data);
$totalRows_list_penultima_data = mysql_num_rows($list_penultima_data);
	//DATA Penultimo
	$penultima_data=$row_list_penultima_data['data']; 
	$penultima_peso= $row_list_penultima_data['peso'];
 
 
 mysql_select_db($database_connection, $connection);
$query_list_ultima_data = "SELECT `data`, peso FROM vwnext_mod_sma_manejo_animais WHERE id_animais = '".$id_animais."'   AND tipo_manejo!='13' AND inativo_peso !='1' ORDER BY `data`  DESC LIMIT 0, 1";
$list_ultima_data = mysql_query($query_list_ultima_data, $connection) or die(mysql_error());
$row_list_ultima_data = mysql_fetch_assoc($list_ultima_data);
$totalRows_list_ultima_data = mysql_num_rows($list_ultima_data);
	//DATA Ultimo
  $ultima_data=$row_list_ultima_data['data'];
  $ultima_peso= $row_list_ultima_data['peso'];
  
  

  
  
  
  
 //MEDIA 
mysql_select_db($database_connection, $connection);
  $query_resuldado_dia_ultimo_penultimo = "SELECT `data`,( DATEDIFF('".$ultima_data."','".$penultima_data."') +1)AS total_resultado_data,  id_animais  FROM vwnext_mod_sma_manejo_animais WHERE id_animais = '".$id_animais."'  AND tipo_manejo !='1' AND inativo_peso !='1'";

$resuldado_dia_ultimo_penultimo = mysql_query($query_resuldado_dia_ultimo_penultimo, $connection) or die(mysql_error());
$row_resuldado_dia_ultimo_penultimo = mysql_fetch_assoc($resuldado_dia_ultimo_penultimo);
$totalRows_resuldado_dia_ultimo_penultimo = mysql_num_rows($resuldado_dia_ultimo_penultimo);

// GERAL
mysql_select_db($database_connection, $connection);
$query_resuldado_dia_ultimo_primeiro = "SELECT `data`, (DATEDIFF('".$ultima_data."','".$primera_data."') +1)AS total_resultado_data,  id_animais  FROM vwnext_mod_sma_manejo_animais WHERE id_animais = '".$id_animais."'  AND tipo_manejo !='1' AND inativo_peso !='1'";
$resuldado_dia_ultimo_primeiro = mysql_query($query_resuldado_dia_ultimo_primeiro, $connection) or die(mysql_error());
$row_resuldado_dia_ultimo_primeiro = mysql_fetch_assoc($resuldado_dia_ultimo_primeiro);
$totalRows_resuldado_dia_ultimo_primeiro = mysql_num_rows($resuldado_dia_ultimo_primeiro);

// PROGESSAO DO  DIAS
$data_hoje=date(Y.'-'.m.'-'.d);

mysql_select_db($database_connection, $connection);
$query_progessao_dias = "SELECT `data`, (DATEDIFF('".$data_hoje."','".$ultima_data."') +1)AS progessao_dias,  id_animais  FROM vwnext_mod_sma_manejo_animais WHERE id_animais = '".$id_animais."'  AND tipo_manejo !='1' AND inativo_peso !='1'";
$progessao_dias = mysql_query($query_progessao_dias, $connection) or die(mysql_error());
$row_progessao_dias = mysql_fetch_assoc($progessao_dias);
$totalRows_progessao_dias = mysql_num_rows($progessao_dias);

?>

<?php 

$dias_interlado=$row_resuldado_dia_ultimo_penultimo['total_resultado_data']; 
$dias_total=$row_resuldado_dia_ultimo_primeiro['total_resultado_data']; 

//progessao

$progessao_dias=$row_progessao_dias['progessao_dias']; 
  /*
 echo $peso_penultimo;
 echo '-';
echo $peso_ultimo;
echo '-';
echo $total_resultado_data;
*/
// $resultado=($peso_ultimo-$peso_penultimo)/$total_resultado_data;
/*
$soma_peso = $row_resuldado_dia_ultimo_penultimo['soma_peso']; 
$total_resultado_data=$row_resuldado_dia_ultimo_penultimo['total_resultado_data']; 
 $qtdd=$totalRows_list_penultima_data;
 
*/
// echo ($soma_peso/$qtdd)/$total_resultado_data; ?>
<?php
mysql_free_result($resuldado_dia_ultimo_penultimo);

mysql_free_result($list_penultima_data);

mysql_free_result($list_ultima_data);
?>
