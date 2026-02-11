<?php 
//09/05/2016
function data_qtddDias($data_inicial,$data_final){
	$time_inicial = strtotime($data_inicial);
	$time_final = strtotime($data_final);
	// Calcula a diferença de segundos entre as duas datas:
	$diferenca = $time_final - $time_inicial; // 19522800 segundos
	// Calcula a diferença de dias
	$dias = (int)floor( $diferenca / (60 * 60 * 24)); 
	return $dias;
	}
//EX:
//echo data_qtddDias('2016-03-23','2019-11-04');
?>