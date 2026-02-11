// JavaScript Document

var contador = 900;

function temporizador() {
 
 
  if(contador > 0){
    setTimeout(temporizador,1000);
  } else {
	  
	  goToURL('?doLogout=true')
	  
    window.onbeforeunload = null;
  }
  document.getElementById('temporizadorInfo').innerHTML = converterHorasMinutosSegundos(contador);
  contador--;
  
}

function temporizadorReinicializar(){
	contador=900;
	}
	
//07/11/2017