 //------------------------>  FUNÇÔES<br>
 
 //VERIFICA A QUANTIDADE DE EX: CLASSE, ID, OUTROS'<br>
VerificaQtdd();<br>

<br>
 
 
//------> loadsData<br>
onClick="loadsData('#LoadOpcoes','system_conf/mod_application.php',1)"<br>
onClick="loadsDataAbsoluto('#LoadOpcoes','system_conf/mod_application.php',1)"<br>
onClick="loadsDataSimples('#LoadOpcoes','system_conf/mod_application.php',1)"<br>
<br><br>

//------> ABRIR UMA NOVA JANELA<br>
onClick="MM_openBrWindow('../imoveis_listar_detalhes.php?id=','','toolbar=yes,location=yes ,menubar=yes, status=yes, scrollbars=yes,  resizable=yes, width=1024,height=768')"

//------> ABRIR UM ENDEREÇO<br>
onclick="goToURL('http://compare.buscape.com.br/categorias?id=0&c=0&raiz=0&site_origem=508452')"<br>
<br>

//------> Acao de formularios<br>
   $(".mask_fone").mask("(99)9999-9999");<br>
   $(".mask_cel").mask("(99)9.9999-9999");<br>
   $(".mask_tin").mask("99-9999999");<br>
   $(".mask_ssn").mask("999-99-9999");<br>
   $(".mask_cpf").mask("999.999.999-99");<br>
   $(".mask_cnh").mask("999.999.999.99");<br>
   $(".mask_rg").mask("99.999.999-9");<br>
   $(".mask_cnpj").mask("99.999.999/9999-99");<br>
   $(".mask_cep").mask("99999-999");<br>
<br>
   $(".mask_number2").mask("99");<br>
   $(".mask_number3").mask("999");<br>
   <br>
  //--> date time<br>
   $(".mask_date").mask("99/99/9999");<br>
   $(".mask_datetime").mask("99/99/9999 99:99:99");<br>
   $(".mask_time").mask("99:99:99");<br><br>
<br>
<br>

 //---------------------> CALCULOS MATEMATICOS/FINANCEIROS<br>
ConvertNumero()<br>
	ConvertNumero(1.000,00) /ex: 1000.00<br>
	ConvertNumero(1000.00,'1') /ex: 1000,00<br>
 <br>
<br>
   
calcSumValue()<br>
	1 - HTML  | 2 - val   | 3 - html   | 4 - val<br>
	EX:	 var result=calcSumValue('.parc_valor_class','2');<br>
<br>

convertNumbreMoney()<br>
	1 - EN  | 2 - BR   | 3 - DATABASE<br>
	convertNumbreMoney(pendency,2);<br>
<br>
FormCalMult()<br>
	var resultado=FormCalMult('#pesquisa_produtos_qtdd','#pesquisa_produtos_valor',1);<br>
    <br>

CalDuplo()<br>
	var resultado=FormCalMult('#pesquisa_produtos_qtdd','#pesquisa_produtos_valor','html','val');<br>
	$('#pesquisa_valor_subtotal').html(resultado);	$('#pesquisa_valor_subtotal').html(resultado);<br><br>

Dicas: A função CalDuplo() substitui a função calcSumValue();















 