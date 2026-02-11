// JavaScript Document
function searchCEP(){
	//verifica CEP
	var clientCEP = $('#clientCEP').val();
	loadsDataSingle('#client_panel_address_add','../mod_empresa_clientes/webserver_cep.php',clientCEP)
	}
	//Renive a TR da tabela
	//Remove the table TR
	function del_tr_address(n){
			$('#client_address_list_tr_'+n).remove();
			}
