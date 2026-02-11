<?php require_once('../Connections/connection_user.php'); ?>
<?php

//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

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

$colname_list_user_database = "-1";
if (isset($_SESSION['MM_UserGroup'])) {
  $colname_list_user_database = $_SESSION['MM_UserGroup'];
}
 mysql_select_db($database_connection_user, $connection_user);
$query_list_user_database = sprintf("SELECT * FROM tbnext_usuario WHERE id_usuario = %s", GetSQLValueString($colname_list_user_database, "int"));
$list_user_database = mysql_query($query_list_user_database, $connection_user) or die(mysql_error());
$row_list_user_database = mysql_fetch_assoc($list_user_database);
$totalRows_list_user_database = mysql_num_rows($list_user_database);


# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true" 
$hostname_connection = "mysql.gruponext.com.br";
$database_connection = $row_list_user_database['banco_dados'];
$username_connection = $row_list_user_database['banco_dados'];
$password_connection = "ndte45ge";
$connection = mysql_pconnect($hostname_connection, $username_connection, $password_connection) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_free_result($list_user_database);
?>
