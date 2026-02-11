<?php

//------------< Perido de Data Horas

function periodoData($data,$dataSelec){

  $date = new DateTime( $data ); // data e hora de nascimento
  $interval = $date->diff(new DateTime($dataSelec)); // data e hora atual
  $ano =  $interval->format('%Y');
  if($ano > 0){
	  return $interval->format( '%Y Anos, %m Meses' );
  }else{
	  return $interval->format( '%m Meses, %d Dias' );
  }	
}

//------------< Perido de Data Horas do Dia Atual
function periodoDataHoras($dataHoras,$dataHorasSelec){

  $date = new DateTime( $dataHoras ); // data e hora de nascimento
  $interval = $date->diff( new DateTime($dataHorasSelec) ); // data e hora atual
  $ano =  $interval->format('%Y');
  if($ano > 0){
	echo $interval->format( '%Y Anos, %m Meses, %d Dias, %H Horas, %i Minutos e %s Segundos' );
  }else{
	echo $interval->format( '%m Meses, %d Dias, %H Horas, %i Minutos e %s Segundos' );
 }
}

//------------< Perido de Data Horas do Dia Atual

function periodoDataAtual($data){

  $date = new DateTime( $data ); // data e hora de nascimento
  $interval = $date->diff( new DateTime( ) ); // data e hora atual
  $ano =  $interval->format('%Y');
  if($ano > 0){
	  return $interval->format( '%Y Anos, %m Meses' );
  }else{
	  return $interval->format( '%m Meses, %d Dias' );
  }	
}
//------------< Perido de Data Horas do Dia Atual
function periodoDataHorasAtual($dataHoras){

  $date = new DateTime( $dataHoras ); // data e hora de nascimento
  $interval = $date->diff( new DateTime( ) ); // data e hora atual
  $ano =  $interval->format('%Y');
  if($ano > 0){
	return $interval->format( '%Y Anos, %m Meses, %d Dias, %H Horas, %i Minutos e %s Segundos' );
  }else{
	return $interval->format( '%m Meses, %d Dias, %H Horas, %i Minutos e %s Segundos' );
 }
}


/* EXEMPLO */
//echo periodoData('2006-01-11','2016-10-03');
//echo periodoDataHoras('2006-01-11 16:08:00','2016-10-03 22:33:10');
//echo periodoDataAtual('2006-01-11');
//echo periodoDataHorasAtual('2006-01-11 16:08:00');

?>
