// JavaScript Document
function excluir(var_n,val_id){
	loadsDataAbsoluto('#msn','../mod_empresa_clientes/acao_comum_comun_excluir_msn.php',val_id+'&n='+var_n);
}

//excluir linha da tabela
function excluir_tr(n,val_id){
	$('#comun_tr'+n).remove();
	loadsDataAbsoluto('#msn','../mod_empresa_clientes/acao_comum_comun_excluir.php',val_id);

}
			
			

			
			
			
			
	$(document).ready(function(){
		//adicona linhas
		$('#comunicacao_id_add').click(function () {
			
			
			//adicionar valor do form na linha	
			var comunicacao_tipo = $('#comunicacao_id_comunicacao_tipo').val();
			var id_class = $('#comunicacao_id_class').val();
			
			var xComunicacao_tipo = $('#comunicacao_id_comunicacao_tipo option:selected').text();
			var xId_class = $('#comunicacao_id_class option:selected').text();
			
			var xNome_contato = $('#xNome_contato').val();
			var xNome_contato2 = $('#xNome_contato2').val();
			
			//limpar form
			$('#comunicacao_id_comunicacao_tipo').val('');
			$('#comunicacao_id_class').val('');
			$('#comunicacao_valor').html('');
			

			if(xNome_contato !=''){
			 if(comunicacao_tipo !=''){
			

			
			var f= '<input name="xNome_contato[]" type="hidden" id="xNome_contato" value="'+xNome_contato+'  ">';
			f+= '<input name="xNome_contato2[]" type="hidden" id="xNome_contato2" value="'+xNome_contato2+'">';
			f+= '<input name="id_comunicacao_tipo[]" type="hidden" id="id_comunicacao_tipo" value="'+comunicacao_tipo+'">';
			f+= '<input name="id_class[]" type="hidden" id="id_class" value="'+id_class+'">';
			
		var	t ='  <tr class="linhas1" id="comun_tr'+c_i+'">';
    		t += '<td align="left" class="txt-opcoes" >'+f +'&nbsp;'+xId_class+'</td>';
			t +=' <td align="left"class="txt-opcoes" >'+xComunicacao_tipo+'</td>';
    		t +=' <td align="left" >'+xNome_contato+xNome_contato2+'</td>';
 			t += '<td align="left" bgcolor="#FFFFFF" ><div  onclick="excluir('+c_i+')" class="options_action_del_sec" title=" EXCLUIR "></div></td>';
			t += '</tr>';
			
			$('#idtabela').append(t);
			$('#avancar').css('display','block');
			
			c_i++;
			
			$('#res').text('');
					}else{
				alert ('Selecione os campos ')
				$('#comunicacao_id_cliente_comunicacao_tipo').css('border' , '1px solid #F00');
				}
			}else{
				alert ('Preencha os campos ')
				$('#xNome_contato').css('border' , '1px solid #F00');
				}
		

		
		});
		$('#xNome_contato2').click(function () {
			$('#xNome_contato2').css('border','');
		});
		
	});
		