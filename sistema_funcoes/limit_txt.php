<?php

		
function limit_text($string, $charlimit){	
	
	if (strlen($string)>$charlimit){	
	$new_string = substr($string, 0, $charlimit);
		return $new_string.' ...'; 
		
	}else{
		return $string;
	}
		
}
//Limita o texto 
//		$texto='ELETRICA MALAVAZZI';
//		echo limit_text2($texto, 40); 

?>