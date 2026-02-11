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
			
			

			
			
			
			
	$(document).ready(function(){
		//adicona linhas
		$('#end_id_add').click(function () {
			
			
			//adicionar valor do form na linha	
			var xId_class = $('#end_id_class option:selected').text();
			var id_class = $('#end_id_class').val();
			
			var end_cep = $('#end_CEP').val();
			var end_xLgr = $('#end_xLgr').val();
			var end_cLgr = $('#end_cLgr').val();
			
			var end_nro = $('#end_nro').val();
			var end_xMun = $('#end_xMun').val();
			var end_cMun = $('#end_cMun').val();
			
			var end_UF = $('#end_UF').val();
			var end_cUF = $('#end_cUF').val();
			var end_xPais = $('#end_xPais').val();
			var end_cPais = $('#end_cPais').val();
			
			var end_cmpto = $('#end_cmpto').val();
			
			

			
			if(end_cep !=''){
				if(end_nro !=''){
			
			
			var f= '<input name="id_class[]" type="hidden" id="id_class" value="'+id_class+'">';
			f+= '<input name="CEP[]" type="hidden" id="CEP" value="'+end_cep+'">';
			
			f+= '<input name="xLgr[]" type="hidden" id="xLgr" value="'+end_xLgr+'">';
			f+= '<input name="xBairro[]" type="hidden" id="xBairro" value="'+end_cMun+'">';
			f+= '<input name="nro[]" type="hidden" id="nro" value="'+end_nro+'  ">';
			
			f+= '<input name="xMun[]" type="hidden" id="xMun" value="'+end_xMun+'">';
			f+= '<input name="cMun[]" type="hidden" id="cMun" value="'+end_cMun+'">';
			
			f+= '<input name="UF[]" type="hidden" id="UF" value="'+end_UF+'">';
			f+= '<input name="cUF[]" type="hidden" id="cUF" value="'+end_cUF+'">';
			
			f+= '<input name="cPais[]" type="hidden" id="cPais" value="'+end_cPais+'">';
			f+= '<input name="xPais[]" type="hidden" id="xPais" value="'+end_xPais+'">';
			f+= '<input name="cmpto[]" type="hidden" id="cUF" value="'+end_cmpto+'">';
			
			
		var	t ='  <tr class="linhas1" id="end_tr'+e_i+'">';
    		t += '<td align="left" class="txt-opcoes" >'+f +'&nbsp;'+xId_class+'</td>';
			t +=' <td align="left" class="txt-opcoes" >'+end_cep+'</td>';
			t += '<td align="left"  >'+end_xLgr+'</td>';
			t +=' <td align="left"  >'+end_nro+'</td>';
			t +=' <td align="left"  >'+end_xMun+'</td>';
    		t +=' <td align="left" >'+end_UF+'</td>';
 			t += '<td align="left" bgcolor="#FFFFFF"  rowspan="2" ><div  onclick="end_excluir('+e_i+')" class="options_action_del_sec" title=" EXCLUIR "></div></td>';
			t += '</tr>';
			t += '<tr  id="end_tr2'+e_i+'" >';
			t += '<td align="left" class="txt-opcoes" >Complemento: </td>';
    		t += '<td colspan="5" align="left"  >'+end_cmpto+'</td>';
  			t += '</tr> ';
			
			
			
			
			$('#idtabela_end').append(t);
			$('#avancar').css('display','block');
			
			e_i++;
			
			//limpar form
			 $('#end_CEP').val('');
			 $('#div_endereco').html('');
			// $("#end_id_class option[value='0']").select();
			 $('#end_id_class option[value="0"]').attr("selected", true);
						
			
			
					}else{
				alert ('Selecione os campos ')
				$('#end_nro').css('border' , '1px solid #F00');
				$('#end_nro').select();
				}
			}else{
				alert ('Preencha os campos ')
				$('#end_CEP').css('border' , '1px solid #F00');
				$('#end_CEP').select();
				
				
				}
		

		
		});
		$('#end_xMun').click(function () {
			$('#end_xMun').css('border','');
		});
		
	});
		