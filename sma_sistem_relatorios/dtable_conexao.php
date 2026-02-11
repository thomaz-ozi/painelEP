<?php /* Database connection information */
	$gaSql['user']       = "gruponext";
	$gaSql['password']   = "nextserver";
	$gaSql['db']         = "cabanhavillano06";
	$gaSql['server']     = "192.168.1.10";
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	//mysql_select_db( $gaSql['db']);
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'Could not select database '. $gaSql['db'] );
        
        
 ?>