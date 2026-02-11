<?php

while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			
				/* General output */
			$row[] = $aRow[ $aColumns[$i] ];
			
	}
	$row[] = '<a href="javascript:editar(' .  $aRow[ $aColumns[0] ] . ');">Editar</a>';
	$row[] = '<a href="javascript:apagar(' .  $aRow[ $aColumns[0] ] . ');">Apagar</a>';
	$output['aaData'][] = $row;
}

?>