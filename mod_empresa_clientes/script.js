// JavaScript Document
$(function(){
$('#cpf_cnpj').change(function(){
	var val_cpf_cnpj=$(this).val();
	var val_id=$('#id_clientes').val();
	
	if(val_cpf_cnpj==0){
		loadsData('#div_cnpj_cpf','../mod_empresa_clientes/acao_comum_cpf.php',val_id)
		}else{
			loadsData('#div_cnpj_cpf','../mod_empresa_clientes/acao_comum_cnpj.php',val_id)
			}
	
	
	
	
});

$('#comunicacao_id_comunicacao_tipo').change(function(){
 	var val_id=$(this).val();
 	var val_id_class=$('#comunicacao_id_class').val();
if(val_id_class==''){
	 alert('Selecione opção: Classificação');
	$('#comunicacao_id_comunicacao_tipo').val('');
	}else{
		switch(val_id){
		case '1': //fone
			loadsData('#comunicacao_valor','../mod_empresa_clientes/acao_comum_comun_tippo_fone.php',val_id)
		break;
		case '2': //celular
			loadsData('#comunicacao_valor','../mod_empresa_clientes/acao_comum_comun_tippo_celular.php',val_id)
		break;
		case '3'://email
			loadsData('#comunicacao_valor','../mod_empresa_clientes/acao_comum_comun_tippo_email.php',val_id)
		break;
		case '4'://skype
			loadsData('#comunicacao_valor','../mod_empresa_clientes/acao_comum_comun_tippo_skype.php',val_id)
		break;
		case '5'://web/site
			loadsData('#comunicacao_valor','../mod_empresa_clientes/acao_comum_comun_tippo_websie.php',val_id)
		break;
		}
		
}

	
	
	
});



$('#end_CEP').change(function(){
	
	var id_class=$('#end_id_class').val();
	if(id_class!='0'){
	pesquisaCEP('#div_endereco','../mod_empresa_clientes/acao_comum_cep.php','#end_CEP');
	
	}else{
		alert ('Selecione o campo: "Classificar" ');
		$('#end_CEP').val('');
		$('#end_id_class').css('border' , '1px solid #F00');}
		$('#end_id_class option[value=""]').attr("selected", true);
})




	
});