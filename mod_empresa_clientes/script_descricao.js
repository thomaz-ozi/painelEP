// JavaScript Document
function end_excluir(var_n,val_id){
	loadsDataAbsoluto('#msn','../mod_empresa_clientes/acao_comum_end_excluir_msn.php',val_id+'&n='+var_n);
}

//excluir linha da tabela
function end_excluir_tr(n,val_id){
	$('#end_tr'+n).remove();
	$('#end_tr2'+n).remove();
	loadsDataAbsoluto('#msn','../mod_empresa_clientes/acao_comum_end_excluir.php',val_id);

}

	






var n_ln='1';
function addtableDescricao(){
			//adicionar valor do form na linha	
			var id_clientes = $('#loadDescricao_id_clientes').val();
			var loadDescricao_xNome = $('#loadDescricao_xNome').val();
			var loadDescricao_descricao = CKEDITOR.instances['loadDescricao_descricao'].getData(); //or $('#editor1').ckeditor(function( textarea ){ $(textarea).val(); });
			//alert(loadDescricao_descricao)
			//if(loadDescricao_xNome !=''){
			//	if(loadDescricao_descricao !=''){
			
			
			var f= '<input name="loadDescricao_xNome[]" type="hidden"  value="'+loadDescricao_xNome+'">';
			f+= '<input name="loadDescricao_descricao[]" type="hidden" value="'+loadDescricao_descricao+'">';
			
		var	t ='  <tr  id="end_tr'+n_ln+'">';
    		t += '<td align="left">'+f+'&nbsp;'+loadDescricao_xNome+'</td>';
	 		t += '<td align="center"><button  onclick="end_excluir('+n_ln+')" class="options_action_del_sec" title=" EXCLUIR "></button></td>';
			t += '</tr>';

	
			
			$('#tableDesc').append(t);
			//$('#avancar').css('display','block');
			
			n_ln++;
			/*
			//limpar form
			 $('#load_xNome').val('');
			 $('#div_endereco').html('');
			// $("#end_id_class option[value='0']").select();
			 $('#end_id_class option[value="0"]').attr("selected", true);
					*/	
			
			
				/*	}else{
				alert ('Selecione os campos ')
				$('#loadDescricao_xNome').css('border' , '1px solid #F00');
				$('#loadDescricao_xNome').select();
				}
			}else{
				alert ('Preencha os campos ')
				$('#loadDescricao_descricao').css('border' , '1px solid #F00');
				$('#loadDescricao_descricao').select();
				
				
				}
		
				*/
				loadsDataAbsoluto('#loadDescricao','../sistema/nullo.php');
}
	
function descricaoSalvar(){
  var id_clientes=$('#id_clientes').val();
  var loadDescricao_id_clientes_descricao=$('#saveDescricao #loadDescricao_id_clientes_descricao').val();
  alert(id_clientes);
  var loadDescricao_xNome=$('#saveDescricao #loadDescricao_xNome').val();
  var loadDescricao_descricao = CKEDITOR.instances['loadDescricao_descricaoSave'].getData();
  
		loadsDataAbsoluto('#loadDescricao','../mod_empresa_clientes/descricao_acao_alt.php','&MM_update=acao&id_clientes_descricao='+loadDescricao_id_clientes_descricao+'&xNome='+loadDescricao_xNome+'&descricao='+loadDescricao_descricao);
		loadsData('#loadDescricaolist','../mod_empresa_clientes/index_descricao.php',id_clientes);

}

function descricaoDelet(){
  var id_clientes=$('#id_clientes').val();
  var loadDescricao_id_clientes_descricao=$('#delDescricao #loadDescricao_id_clientes_descricao').val();
		loadsDataAbsoluto('#loadDescricao','../mod_empresa_clientes/descricao_acao_del.php','&id_clientes_descricao='+loadDescricao_id_clientes_descricao);
		loadsData('#loadDescricaolist','../mod_empresa_clientes/index_descricao.php',id_clientes);

}		