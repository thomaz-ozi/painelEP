
$(function(){
	var n_ln='1';
 $('#descricaoAdd').click(function(){
			//adicionar valor do form na linha	
			var loadDescricao_usuario_nome = $('#usuario_nome').val();
			var loadDescricao_data = $('#dataHorasInscricao').val();

					
		var	t ='  <tr  id="tableTr'+n_ln+'" scope="row">';
    		t += '<td align="left">&nbsp;'+loadDescricao_data+'</td>';
			t += '<td align="left">&nbsp;'+loadDescricao_usuario_nome+'</td>';
			t += '<td align="left"> <textarea name="Observacoes[]" id="Observacoes'+n_ln+'"  class="form-control col-md-7 col-xs-12 Observacoes" style="height:80px;" rows="1">&nbsp;</textarea></td>';
	 		t += '<td align="right"><button type="button" onclick="tableTrRem(\'tableTr'+n_ln+'\')" class="options_action_del_sec oculPrint" title=" EXCLUIR "></button></td>';
						t += '</tr>';

			$('#tableDesc  > tbody').prepend(t)
			$( "#target" ).select('Observacoes'+n_ln+''); 

			//incrementar o valor para próxima linha da tabela
			n_ln++;


 });
 	

	
});

function tableTrRem (id){
	$('#'+id).remove();

}



		
			
	