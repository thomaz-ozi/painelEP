<?php 
//2017-12-07
//Mais exemplos no sistema DBL na pasta Desen
function masc_clear_cpf($n){
	$n = implode("", explode(".", $n));//recebe a f7 e retira espaco
	$n = implode("", explode("-", $n));//recebe a f7 e retira ponto
//	$decimais = implode(".", explode(",", $decimais));//converte virgula em ponto
	
	return $n;
	}
	
//$cpf= '371.873.308-04';
//echo "CPF: ".masc_clear_cpf($cpf);
?>
<?php 
//2017-12-07
//Mais exemplos no sistema DBL na pasta Desen
function masc_clear_rg($n){
	$n = implode("", explode(".", $n));//recebe a f7 e retira espaco
	$n = implode("", explode("-", $n));//recebe a f7 e retira ponto
	
	return $n;
	}
	
//$rg='43.224.503-0';
//echo "<br>RG: ".masc_clear_rg($rg);
?>
<?php 
//2017-12-07
//Mais exemplos no sistema DBL na pasta Desen
function masc_clear_cnh($n){
	$n = implode("", explode(".", $n));//recebe a f7 e retira espaco
	$n = implode("", explode("-", $n));//recebe a f7 e retira ponto
	
	return $n;
	}
	
//$rg='43.224.503.540';
//echo "<br>CNH: ".masc_clear_cnh($rg);
?>