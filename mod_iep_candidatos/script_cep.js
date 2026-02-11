/*
$(function(){
  $('#CEP1').on('change',function(){
	 alert()
	 var cep=$(this).val();
	loadsData('#loadEndereco','../mod_iep_candidatos/acao_comum_cep.php',cep);
 });	
});
*/

function vereficaCEP(id){

 var cep=$('#'+id).val();
	loadsData('#loadEndereco','../mod_iep_candidatos/acao_comum_cep.php',cep);

}
		
			
	