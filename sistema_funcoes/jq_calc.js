// JavaScript Document


function getNum(val) {
	//stackoverflow 03/052016
	//Ao trazer o valor NaN esta funçao retorna valor 0;
   if (isNaN(val)) {
     return 0;
   }
   return val;
}


//alert('calc');
function ConvertNumero(op,n){
	//ConvertNumero(1.000,00) /ex: 1000.00
	//ConvertNumero(1000.00,'1') /ex: 1000,00
	//BR=1;
	if(op=='1'){
		var n=n.toString().replace(".",",");
	}else{
		var n = parseFloat(n.replace(",","."));
	}
  return (n)
}
/*Somar ARRAY */
function sumJS(input){  
               
 if (toString.call(input) !== "[object Array]")  
    return false;  
        
	  var total =  0;  
	  for(var i=0;i<input.length;i++)  
		{                    
		  if(isNaN(input[i])){  
		  continue;  
		   }  
			total += Number(input[i]);  
		 }  
	   return total;  
 } 

/*Calcular Soma de Valores*/

function calcSumValue(nValue,op){
//1 - HTML  | 2 - val   | 3 - html   | 4 - val
//	EX:	 var result=calcSumValue('.parc_valor_class','2');
  var totalSum=new Array();	 
  var arraySum = 0; 
  $(nValue).each(function(i){
	switch(op){
		case '1':
			totalSum[i] =+ $(this).html().replace(".","").replace(",","."); //alert('1 ') //Origem-> html()0.000,00
			break;
		case '2':
			totalSum[i] =+ $(this).val().replace(".","").replace(",","."); //alert('2') //Origem-> val()0.000,00
			break;
		case '3':
			totalSum[i] =+ $(this).html(); // alert('3')//Origem-> html()banco 0000.00
			break;
		case '4':
			totalSum[i] =+ $(this).val(); //alert('4')//Origem-> val()banco 0000.00
			break;
		default:
			alert('ERROR: Selecione a opção 1=html, 2-val ...')
	}

	});
	//totalSum=arraySum(totalSum);
	totalSum=sumJS(totalSum);
  return totalSum;
  }	
		
//--- 01 --------------------------> AND




//--- 02 ----------------------------------------> Numeric converter

 function convertNumbreMoney(nV,f){
//1 - EN  | 2 - BR   | 3 - DATABASE	 
//convertNumbreMoney(pendency,2);	 
	 var  nV=nV.toString();
switch(f){ 
	case 1: //EN
	
		nV=parseFloat(nV.replace(",","."));
		nV=nV.toFixed(2);
		nV = nV.replace(".",",");
		nV=nV.replace(/\D/g,"");  //allows you to enter only numbers
        nV=nV.replace(/[0-9]{12}/,"ERROR");		//limit for maximum 999,999,999.99
        nV=nV.replace(/(\d{1})(\d{8})$/,"$1,$2");	//puts point before the last 8 digits
        nV=nV.replace(/(\d{1})(\d{5})$/,"$1,$2");	//puts point before the last 5 digits
        nV=nV.replace(/(\d{1})(\d{1,2})$/,"$1.$2");	//comma placed before the last 2 digits
		break;
	case 2://PT-BR
		nV=parseFloat(nV.replace(",","."));
		nV=nV.toFixed(2);
		nV=nV.replace(".",",");
		nV=nV.replace(/\D/g,"") ; //permite digitar apenas números
        nV=nV.replace(/[0-9]{12}/,"ERROR");   //limita pra máximo 999.999.999,99
        nV=nV.replace(/(\d{1})(\d{8})$/,"$1.$2");  //coloca ponto antes dos últimos 8 digitos
        nV=nV.replace(/(\d{1})(\d{5})$/,"$1.$2");  //coloca ponto antes dos últimos 5 digitos
        nV=nV.replace(/(\d{1})(\d{1,2})$/,"$1,$2") ;       //coloca virgula antes dos últimos 2 digitos
		
		break;
	case 3:	 //database
		nV=parseFloat(nV.replace(",","."))
		nV=nV.toFixed(2);
		nV=nV.replace(".",",");
		nV=nV.replace(/\D/g,"");
        nV=nV.replace(/[0-9]{12}/,"ERROR");
        nV=nV.replace(/(\d{1})(\d{8})$/,"$1$2");
        nV=nV.replace(/(\d{1})(\d{5})$/,"$1$2");
        nV=nV.replace(/(\d{1})(\d{1,2})$/,"$1.$2");
		break;
	default: //msn
		v='Select options: '+nV+' '+f;
		break;
	}
	return nV;
 }
/*EX:
$(function(){
	//alert('entrou');
	var total=$("#total").html()
	teste = convertNumbreMoney(total,2)
	$("#resultado").html(teste)
	})
	
<div id="total">12000</div>
<div id="resultado">0</div>	
*/
//--- 02 --------------------------> AND

//--- 03 ---------------------------------------->  mask money Input
//1 - EN  | 2 - BR 	 

function maskMoneyInput(nZ,f){  
var nZ;
		
  switch(f){ 
	case 1: //EN
        var nV = nZ.value;
        nV=nV.replace(/\D/g,"");  //permite digitar apenas números
        nV=nV.replace(/[0-9]{12}/,"inválido");   //limita pra máximo 999.999.999,99
        nV=nV.replace(/(\d{1})(\d{8})$/,"$1,$2");  //coloca ponto antes dos últimos 8 digitos
        nV=nV.replace(/(\d{1})(\d{5})$/,"$1,$2");  //coloca ponto antes dos últimos 5 digitos
        nV=nV.replace(/(\d{1})(\d{1,2})$/,"$1.$2");        //coloca virgula antes dos últimos 2 digitos
        nZ.value = nV;
			break;
	case 2://PT-BR
		 var nV = nZ.value;
        nV=nV.replace(/\D/g,"") ; //permite digitar apenas números
        nV=nV.replace(/[0-9]{12}/,"inválido") ;  //limita pra máximo 999.999.999,99
        nV=nV.replace(/(\d{1})(\d{8})$/,"$1.$2");  //coloca ponto antes dos últimos 8 digitos
        nV=nV.replace(/(\d{1})(\d{5})$/,"$1.$2");  //coloca ponto antes dos últimos 5 digitos
        nV=nV.replace(/(\d{1})(\d{1,2})$/,"$1,$2") ;       //coloca virgula antes dos últimos 2 digitos
        nZ.value = nV;
			break;
	default: //msn
	var	v='Select options: '+nZ+' '+f;
		break;
}
        }
//EX:
//<input type="text" name="texto" size="11" style="text-align:right" onKeyUp="maskMoneyInput(this,1);">

//--- 03 --------------------------> AND



function FormCalMult(a,b,c){
//thomaz 07/04/2014	-alt 19-04-2016
//	var resultado=FormCalMult('#pesquisa_produtos_qtdd','#pesquisa_produtos_valor',1);
//	$('#pesquisa_valor_subtotal').html(resultado);
	  var contentA;
	  var contentB;
  switch(c){

	case 1://val
		 contentA=parseFloat($(a).val().replace(".","").replace(",","."));
		 contentB=parseFloat($(b).val().replace(".","").replace(",","."));
		break;
	case 2://html
		 contentA=parseFloat($(a).html().replace(".","").replace(",","."));
		 contentB=parseFloat($(b).html().replace(".","").replace(",","."));
		break;
	
	 }
	//alert(currentMnt);
	var res=contentA*contentB;
	resultado=res.toFixed(2).toString().replace(".",",");
	//$(r).html(res);
	return resultado;
}


function CalcMultDuplo(a,b,c,d){
//thomaz 03/05/2016
//	var resultado=CalcMultDuplo('#pesquisa_produtos_qtdd','#pesquisa_produtos_valor','html','val');
//	$('#pesquisa_valor_subtotal').html(resultado);
	  var contentA;
	  var contentB;
	
	
	switch (c){
		case 'val':
			contentA=parseFloat($(a).val().replace(".","").replace(",","."));
		break;
		case 'html':
			contentA=parseFloat($(a).html().replace(".","").replace(",","."));
		break;
		
		}
	switch (d){
		case 'val':
			contentB=parseFloat($(b).val().replace(".","").replace(",","."));
		break;
		case 'html':
			contentB=parseFloat($(b).html().replace(".","").replace(",","."));
		break;
		}
		if(contentA=='0'){contentB=1;}
		if(contentB=='0'){contentB=1;}
		
	var res=contentA*contentB;
	resultado=res.toFixed(2).toString().replace(".",",");
	return resultado;
}

// JavaScript Document


