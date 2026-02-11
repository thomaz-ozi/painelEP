// JavaScript Document
$(function(){
	

$('#id_setor').change(function(){
		var var_id=$('#id_setor').val();
	loadsDataAbsoluto('#selec_categoria','../mod_empresa_produtos/acao_comum_categoria.php','&id_setor='+var_id);
	loadsData('#selec_subcategoria','nullo.php');

	
});

$('#id_categoria').change(function(){
		var var_id=$('#id_categoria').val();
	loadsDataAbsoluto('#selec_subcategoria','../mod_empresa_produtos/acao_comum_subcategoria.php','&id_categoria='+var_id);
});

});