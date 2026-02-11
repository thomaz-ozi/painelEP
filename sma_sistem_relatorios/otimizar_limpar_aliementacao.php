<?php require_once('../Connections/connection.php'); ?>
<?php 
  $SQLtable='tbnext_mod_sma_otimizar_alimentacao';
mysql_select_db($database_connection, $connection);
 $sql = "TRUNCATE  table $SQLtable";
mysql_query($sql);
echo "Memoria Limpa ".$SQLtable;
mysql_close($connection);

?>