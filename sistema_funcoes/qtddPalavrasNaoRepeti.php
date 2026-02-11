<?php

function qtddPalavrasNaoRepeti($txt){
	
	$filtra = explode(' ', $txt);
 $result = array_unique($filtra);
/*
echo "<pre>";
 var_dump($result);
echo "</pre>";

echo $qtddPalavra = count($result);
*/
foreach ($result as $palava):
//           echo " ";
            echo $palava;
    endforeach;
}

	/*exemplo*/
	
	
//	echo $texto = "bla bla bla thomaz";
//	qtddPalavrasNaoRepeti($texto);
?>