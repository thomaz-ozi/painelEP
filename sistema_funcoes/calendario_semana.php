<?php 
function retorna_senama()
{
$agora_s=time();
$data_semana=getdate($agora_s);
if($data_semana["wday"]==0)		{echo $semana = "Domingo, ";}
elseif($data_semana["wday"]==1)	{echo $semana = "Segunda - feira, ";}
elseif($data_semana["wday"]==2)	{echo  $semana = "Ter&ccedil;a - feira, ";}
elseif($data_semana["wday"]==3)	{echo $semana = "Quarta - feira, ";}
elseif($data_semana["wday"]==4)	{echo $semana = "Quinta - feira, ";}
elseif($data_semana["wday"]==5)	{echo $semana = "Sexta - feira, ";}
elseif($data_semana["wday"]==6)	{echo $semana ="S&aacute;bado - feira, ";}
}
$semana=retorna_senama();
//echo $semana;
?>