<?php

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
//03/01/2018
function agoraDataHoras(){
$H=date(H);
//$H=$H-4;
	$agoraDataHoras=date(Y.'-'.m.'-'.d.' '.$H.':'.i.':'.s);
return $agoraDataHoras;
}

function agoraData(){
	$agoraData=date(Y.'-'.m.'-'.d);
return $agoraData;
}	
	
//EX:	
// echo agoraDataHoras();
//	echo agoraData();
?>