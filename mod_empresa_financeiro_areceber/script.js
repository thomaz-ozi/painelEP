// JavaScript Document
$(function(){
	
//---------------------------->DATA
$('#pesq_data_dia').change(function(){
	var data = $(this).val();
	loadsData('#indexLoad','../mod_empresa_financeiro_areceber/index_load.php','1'+'&data='+data);
});

$('#pesq_date_mes').change(function(){
	var data = $(this).val();
	var pesq_date_ano= $("#pesq_date_ano option:selected").val();
	loadsData('#indexLoad','../mod_empresa_financeiro_areceber/index_load.php','2'+'&data='+data+'&ano='+pesq_date_ano);

});
$('#pesq_data_final').change(function(){
	var pesq_data_inicio = $("#pesq_data_inicio").val();
	var pesq_data_final = $("#pesq_data_final").val();
	loadsData('#indexLoad','../mod_empresa_financeiro_areceber/index_load.php','3'+'&pesq_data_inicio='+pesq_data_inicio+'&pesq_data_final='+pesq_data_final);

});
//--------------------------> DATA FIM



$('#pesquisarem').keyup(function(){
	
	var pesquisarem = $(this).val();
	var qtdd = $(this).val().length;
	var pesquisaselect= $("#pesquisaselect option:selected").val();
	
	//if(qtdd>=2){
		if(pesquisaselect!=''){
		loadsData('#indexLoad','../mod_empresa_financeiro_areceber/index_load.php','&pesquisarem='+pesquisarem+'&pesquisaselect='+pesquisaselect);
	//}else{alert("Selecione");}
	}

});



});
