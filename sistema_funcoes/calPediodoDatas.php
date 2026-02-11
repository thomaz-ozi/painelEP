<?php


/*PERIODO - DIA */
function calPediodoDatas($d_inicial,$d_final){
	
	
	// Define os valores a serem usados
	/*
$data_inicial = '2009-03-23';
$data_final = '2009-11-04';*/

$data_inicial = $d_inicial;
$data_final = $d_final;

// Usa a função strtotime() e pega o timestamp das duas datas:
$time_inicial = strtotime($data_inicial);
$time_final = strtotime($data_final);

// Calcula a diferença de segundos entre as duas datas:
$diferenca = $time_final - $time_inicial; // 19522800 segundos

// Calcula a diferença de dias
$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

// Exibe uma mensagem de resultado:
//EX
return $dias;
//echo "A diferença entre as datas ".$data_inicial." e ".$data_final." é de <strong>".$dias."</strong> dias";
// A diferença entre as datas 23/03/2009 e 04/11/2009 é de 225 dias
}


//------------< Perido de Data Horas

function periodoDataAno($data,$dataSelec){

  $date = new DateTime( $data ); // data e hora de nascimento
  $interval = $date->diff(new DateTime($dataSelec)); // data e hora atual
  $ano =  $interval->format('%Y');
  if($ano > 0){
	  return $interval->format( '%Y Anos' );
  }else{
	  return $interval->format( '%m Meses' );
  }	
}
//echo periodoDataAno('1977-02-18','2017/10/11');



?>
<?php
/*PERIODO DE POR TEXTO*/

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

//echo periodoDataAtual('2006-01-11');
//echo periodoDataHorasAtual('2006-01-11 16:08:00');
//echo periodoData('2006-01-11','2016-10-03');
//echo periodoDataHoras('2006-01-11 16:08:00','2016-10-03 22:33:10');

?>
