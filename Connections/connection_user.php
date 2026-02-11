<?php
header('Content-Type: text/html; charset=utf-8');
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connection_user = "mysql58-farm2.uni5.net";
$database_connection_user = "institutoiep01";
$username_connection_user = "institutoiep01";
$password_connection_user = "fk45vA7U8rDdfAte";
$connection_user = mysql_pconnect($hostname_connection_user, $username_connection_user, $password_connection_user) or trigger_error(mysql_error(),E_ERROR); 
    mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');

?>
