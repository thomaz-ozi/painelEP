<?php require_once('../Connections/connection.php'); ?>
<?php 
 	$SQLtableOrigem='vwnext_relatorio_animais';
	$SQLtableDestino='tbnext_mod_sma_otimizar_relatorio_animais';
	
mysql_select_db($database_connection, $connection);
 echo $sql = " INSERT INTO $SQLtableDestino SELECT * FROM $SQLtableOrigem";

mysql_query($sql);
echo "<br>Atualização: concluida ".$SQLtable;
mysql_close($connection);





?>