<?php require_once('../Connections/connection.php'); ?>
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
if($_GET['codigo']==""){$_GET['codigo']=1;}

mysql_select_db($database_connection, $connection);
$query_list_fotos = "SELECT Foto,tipo FROM tbMod_canditadosFotos WHERE codigo ='".$_GET['codigo']."'";
$list_fotos = mysql_query($query_list_fotos, $connection) or die(mysql_error());
$row_list_fotos = mysql_fetch_assoc($list_fotos);
$totalRows_list_fotos = mysql_num_rows($list_fotos);

if($row_list_fotos['tipo']!=""){
	
// echo base64_encode($row_list_fotos['Foto']);	
	
	echo '<img src="data:' . $row_list_fotos['tipo'] . ';base64,'.base64_encode( $row_list_fotos['Foto'] ).'"/>';
}

mysql_free_result($list_fotos);
?>