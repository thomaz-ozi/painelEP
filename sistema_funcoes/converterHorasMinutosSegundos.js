// JavaScript Document
function converterHorasMinutosSegundos(s){
              
	function duas_casas(numero){
		if (numero <= 9){
			numero = "0"+numero;
        }
		return numero;
	}

    hora = duas_casas(Math.round(s/3600));
    minuto = duas_casas(Math.floor((s%3600)/60));
    segundo = duas_casas((s%3600)%60);
              
    formatado = hora+":"+minuto+":"+segundo;
    return formatado;
 }