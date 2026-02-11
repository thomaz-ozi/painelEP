<?php
//criado 19/04/2016
//funcao somar e subtrair dias da data
function data_calcSomSub($data,$dias,$f,$i){
//alterar barra para traço
$data=str_replace("/", "-", $data);
// Soma 5 dias a partir da data indicada

//verifica se é dias, meses ou anos;
switch($i){
	case 1: //dias
		$indece='days';
	break;
	case 2: //meses
		 $indece='months';
	break;
	case 3: //anos
		$indece='years';
	break;

}


switch($f){
	case 1: //BANCO -> 2016/04/19
		$data= date('Y-m-d', strtotime($dias.$indece, strtotime($data)));
	break;
	
	case 2: //BR -> 19/04/2016
		 $data=date('d/m/Y', strtotime($dias.$indece, strtotime($data)));
	break;
	
	case 3: //EN -> 04/19/2016
		$data= date('m/d/Y', strtotime($dias.$indece, strtotime($data)));
	break;
}
return $data;
}
/*EX:*/
//echo $data='10-02-2016';
//echo data_calcSomSub($data,'+3','1','1');
//echo "<br>";
//echo data_calcSomSub($data,'+3','1','2');
//echo "<br>";
//echo data_calcSomSub($data,'+3','1','3');




?>
