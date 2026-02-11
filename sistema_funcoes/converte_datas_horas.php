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

function converte_data_horas($date)
{
$explode = explode(" ", $date);
$date = $explode[0];
if ( isset($explode[1])) { $hour = $explode[1];}  else { $hour = NULL; }
$date = explode("-", ereg_replace('/', '-', $date));
$date = ''.$date[2].'/'.$date[1].'/'.$date[0].' '.$hour.'';
return $date;
}
# Exemplo de uso:
	//$data_entrada=$_POST['data_entrada'];
	//$data_saida=$_POST['data_saida'];
	//$_POST['data_entrada'] = converte_data_horas("$data_entrada");
	//$_POST['data_saida'] = converte_data_horas("$data_saida");
?>