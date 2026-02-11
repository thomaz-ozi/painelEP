<?php require_once('../Connections/connection.php'); ?>
<?php 
 $SQLtable='vwnext_relatorio_animais';

mysql_select_db($database_connection, $connection);
 echo $sql = "CHECK TABLE  $SQLtable";
mysql_query($sql);
echo "Checar tabela; OK ".$SQLtable;
mysql_close($connection);



mysql_select_db($database_connection, $connection);
 echo $sql = "REPAIR TABLE  $SQLtable";
mysql_query($sql);
echo "Checar tabela; OK ".$SQLtable;
mysql_close($connection);

 
mysql_select_db($database_connection, $connection);
 echo $sql = "OPTIMIZE TABLE  $SQLtable";
mysql_query($sql);
echo "Otimização; OK ".$SQLtable;
mysql_close($connection);


?>