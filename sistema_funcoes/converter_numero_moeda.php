<?php
//2010/03/05
//EX 123 456 789,00
function converter_numero_moeda($number  , $decimals = 2 , $dec_point = ',' , $space = '.', $group=3   ){
    $num = sprintf("%0.{$decimals}f",$number);    
    $num = explode('.',$num);
	
	while (strlen($num[0]) % $group) $num[0]= ' '.$num[0];
    $num[0] = str_split($num[0],$group);
    $num[0] = join($space[0],$num[0]);
    $num[0] = trim($num[0]);
    $num = join($dec_point[0],$num);
    return $num;
}
//echo converter_numero_moeda($valor,2,'.',' ',3); // 1 2345 6789.00
//$valor="123456789.50200120";
//echo converter_numero_moeda($valor);
//echo "<br>";

?>
