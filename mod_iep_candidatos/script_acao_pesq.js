$(function(){
 $('#acaoCPF').change(function(){
	 var cpf=$(this).val();
	//loadsData('#divPesq','../mod_iep_candidatos/acao_pesq_flitro.php',cpf+'&cpfpesq=1');
	
	 loadsData('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_pesq_flitro.php','&xPesq='+cpf+'&PesquisaAvancadaColunas=CPF');
 });	
 	
});


	
		
			
	