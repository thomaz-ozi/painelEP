<?php
##############################################
##  Função para converter datas seja qual   ##
##            for o seu formato.            ##
##                                          ##
##                Criada por:               ##
##          Felipe Cardoso Martins          ##
##        felipe@eletronicparty.com         ##
##          www.eletronicparty.com          ##
##############################################

function converte_data($date)
{
$explode = explode(" ", $date);
$date = $explode[0];
if ( isset($explode[1])) { $hour = $explode[1];}  else { $hour = NULL; }
$date = explode("-", ereg_replace('/', '-', $date));
$date = ''.$date[2].'/'.$date[1].'/'.$date[0].'';
return $date;
}

# Exemplo de uso:
	
	//$data_entrada=$_POST['data_entrada'];
	//$data_saida=$_POST['data_saida'];
	//$_POST['data_entrada'] = converte_data("$data_entrada");
	//$_POST['data_saida'] = converte_data("$data_saida");
	//$data_br='10/02/2011';
	//echo converte_data($data_br);
	//echo "<br>";
	//$data='2016/02/20';
	//echo converte_data($data);

?>