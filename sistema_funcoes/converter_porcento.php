<?php

function porCent($valor,$porcentagem) {
	$porcentagem=$porcentagem/100;
    return ( $valor * $porcentagem ) ;
}
//Exemplo
//24/06/2016
//$valor=200.10;
//$porcentagem=10.1;
//echo "Valor de: ".$valor." SOMENTE com porc ".$porcentagem."% o resultao: <b>" . porCent($valor,$porcentagem) . "</b><br>";
?>
<?php

function porCentValAcre($valor,$porcentagem) {
	$porcentagem=$porcentagem/100;
	 $res=$valor * $porcentagem;
    return ( $valor+$res ) ;
}
//Exemplo
//30/06/2016
//echo "Valor de: ".$valor." com ACRECIMO em porc ".$porcentagem."% o resultao: <b>" . porCentValAcre($valor,$porcentagem) . "</b><br>";

?>
<?php

function porCentValDesc( $valor, $porcentagem ) {
	$porcentagem=$porcentagem/100;
	 $res=$valor * $porcentagem;
    return ( $valor-$res ) ;
}
//echo "Valor de: ".$valor." com DESCONTO em porc ".$porcentagem."% o resultao: <b>" . porCentValDesc($valor,$porcentagem) . "</b><br>";
?>
<?php

function porCentExtr( $valorA, $valorB ) {
	$valor=$valorA-$valorB;
	$res=$valor/2;
    return ($res);
}
//Exemplo
//24/06/2016
$valorA=300;
$valorB=100;

//echo "Valor A: ".$valorA." EXTRAIR  a porc do Valor B ".$valorB." o resultao : <b>" . porCentExtr($valorA,$valorB) . "%</b><br>";
?>