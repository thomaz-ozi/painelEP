 <?php 
function retorna_data()
{
$agora=time();
$data_semana=getdate($agora);
$data=getdate($agora);
if($data["mon"]==1)			{$mes="Janeiro";}
elseif($data["mon"]==2)		{$mes="Fevereiro";}
elseif($data["mon"]==3)		{$mes="Mar&ccedil;o";}
elseif($data["mon"]==4)		{$mes="Abril";}
elseif($data["mon"]==5)		{$mes="Maio";}
elseif($data["mon"]==6)		{$mes="Junho";}
elseif($data["mon"]==7)		{$mes="Julho";}
elseif($data["mon"]==8)		{$mes="Agosto";}
elseif($data["mon"]==9)		{$mes="Setembro";}
elseif($data["mon"]==10)	{$mes="Outubro";}
elseif($data["mon"]==11)	{$mes="Novembro";}
elseif($data["mon"]==12)	{$mes="Dezembro";}
$data_atual=$data["mday"]." de ".$mes." de ".$data["year"];
return $data_atual;
}
$hoje=retorna_data();
echo $hoje;

?>