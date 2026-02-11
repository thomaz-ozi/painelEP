<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connection_user = "localhost";
$database_connection_user = "iepdados";
$username_connection_user = "gruponext";
$password_connection_user = "nextserver";
$connection_user = mysql_pconnect($hostname_connection_user, $username_connection_user, $password_connection_user) or trigger_error(mysql_error(),E_USER_ERROR); 
$connection_use;
?>
