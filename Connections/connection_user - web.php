<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connection_user = "mysql.gruponext.com.br";
$database_connection_user = "gruponext01";
$username_connection_user = "gruponext01";
$password_connection_user = "ndte45ge";
$connection_user = mysql_pconnect($hostname_connection_user, $username_connection_user, $password_connection_user) or trigger_error(mysql_error(),E_USER_ERROR); 
?>