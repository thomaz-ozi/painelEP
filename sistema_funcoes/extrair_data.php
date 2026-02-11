<?php 
//Thomaz Ozi
//29/08/2010
//07/04/2014
//07/04/2016

	function ext_data_br_dia($data_banco){
		$data_banco=substr($data_banco , 0, -8);
		return $data_banco;
		}
	function ext_data_br_mes($data_banco){
		$data_banco=substr($data_banco , 3, -5);
		return $data_banco;
		}
	function ext_data_br_ano($data_banco){
		$data_banco=substr($data_banco , 6, 4);
		return $data_banco;
		}
//-----------> Data base
	function ext_data_db_dia($data_banco){
		$data_banco=substr($data_banco , 6, -3);
		return $data_banco;
		}		
	function ext_data_db_mes($data_banco){
		$data_banco=substr($data_banco , 6, -3);
		return $data_banco;
		}
	function ext_data_db_ano($data_banco){
		$data_banco=substr($data_banco , 6, -3);
		return $data_banco;
		}	
/*		
$data='30/08/2010';
echo 	ext_data_br_dia($data);
echo '<br>';
echo 	ext_data_br_mes($data);
echo '<br>';
echo 	ext_data_br_ano($data);
*/
?>