// JavaScript Document
function pesquisaCEP(div,url,content){
	//verifica CEP
	var CepVal = $(content).val();
	loadsData(div,url,CepVal);
	}
