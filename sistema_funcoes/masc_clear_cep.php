<?php 
//2017-12-07
//Mais exemplos no sistema DBL na pasta Desen
function masc_clear_cep($n){
	$n = implode("", explode("-", $n));//recebe a f7 e retira ponto
//	$decimais = implode(".", explode(",", $decimais));//converte virgula em ponto
	
	return $n;
	}
	
//$cep= '18205-520';
//echo "CEP: ".masc_clear_cpf($cep);
?>
