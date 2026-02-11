<?php 
//2010/03/05
//2012-10-31
//Mais exemplos no sistema DBL na pasta Desen
function converte_numero_banco($decimais){
	$decimais = implode("", explode(" ", $decimais));//recebe a f7 e retira espaco
	$decimais = implode("", explode(".", $decimais));//recebe a f7 e retira ponto
	$decimais = implode(".", explode(",", $decimais));//converte virgula em ponto
	
	return $decimais;
	}
	
//$valor='123.456.789,50';
//echo converte_numero_banco($valor);
?>