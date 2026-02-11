<?php
	
	$aColumns = array('cod_animal','id_animais','id_origem','peso','id_local','id_lote','id_setor');
	$sIndexColumn = "cod_animal";
	$sTable = "vwnext_relatorio_animais";
	include('dtable_conexao.php');
	include('dtable_utils.php');
	include('dtable_loop.php');
	echo json_encode( $output );
	//echo $output
?>