<?php

/* quantidade de palavras permitidas */

function qtddPalavras($frase){
	$qtddPalavras = explode(" ", $frase);
	    return  count($qtddPalavras);
}

/*ex:
echo $texto="Maria de oliveira";
echo qtddPalavras($texto);
*/
?>