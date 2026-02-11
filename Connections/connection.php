<?php require_once('../Connections/connection_user.php'); ?>
<?php 
header('Content-Type: text/html; charset=utf-8');
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
 $hostname_connection = "mysql58-farm2.uni5.net";
 $database_connection = $row_list_user_database['banco_dados'];
 $username_connection = $row_list_user_database['banco_dados'];
 $password_connection = "ert3fTTWPLB43fdfa12w";
 $connection = mysql_pconnect($hostname_connection, $username_connection, $password_connection) or trigger_error(mysql_error(),E_USER_ERROR); 


    mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');

mysql_free_result($list_user_database);

?>




