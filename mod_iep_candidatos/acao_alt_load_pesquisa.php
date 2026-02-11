<style>
.DivBarraFixed{
	
position:fixed;  top:20%; right:0; border:#D4D4D4 1px solid; border-left:none; padding: 5px; z-index:100; ; 

background: rgba(42,63,84,0.9);
background: -moz-radial-gradient(center, ellipse cover, rgba(42,63,84,0.9) 0%, rgba(42,63,84,0.9) 100%);
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(42,63,84,0.9)), color-stop(100%, rgba(42,63,84,0.9)));
background: -webkit-radial-gradient(center, ellipse cover, rgba(42,63,84,0.9) 0%, rgba(42,63,84,0.9) 100%);
background: -o-radial-gradient(center, ellipse cover, rgba(42,63,84,0.9) 0%, rgba(42,63,84,0.9) 100%);
background: -ms-radial-gradient(center, ellipse cover, rgba(42,63,84,0.9) 0%, rgba(42,63,84,0.9) 100%);
background: radial-gradient(ellipse at center, rgba(42,63,84,0.9) 0%, rgba(42,63,84,0.9) 100%);

border-radius: 5px 0px 0px 5px;
-moz-border-radius: 5px 0px 0px 5px;
-webkit-border-radius: 5px 0px 0px 5px;
	}
#OcultaPesquisaAvancada{
	
	}
#OcultaPesquisaAvancada .fortm_select 	{float:right; width:100px; }
#OcultaPesquisaAvancada .fortm_input	{float:right; width:220px}
#OcultaPesquisaAvancada .fortm_bt		{float:right; width:35px; margin:2px 10px ;}


#MostraPesquisaAvancada{}
#MostraPesquisaAvancada .fortm_bt		{float:right; width:35px; margin:2px 10px ;}

#BarraPesquisaAvancadaLoad{  margin-left:2px; margin-top:0px;float:right;  clear:both; }
#BarraPesquisaCodigoLoad{  margin-left:5px; margin-top:0px; float:left;   }
</style>


<script>
var btPesqQ=1;	
	
function uniKeyCode(event) {
  var key = event.keyCode;
	if(key== 39){
  
	
 
		
	// e.preventDefault();
	  
	  document.getElementById("PesquisaAvancada").innerHTML = "The Unicode KEY code is: " + key;	

	  
	  var xPesq = $("#PesquisaAvancada").val();
	  var qtdd = $("#PesquisaAvancada").val().length;
	  var PesquisaAvancadaColunas= $("#PesquisaAvancadaColunas option:selected").val();
		
		

	//apertou 1 vez o enter, pesquisa novamente, senão vai para o proximo registro da lista.
	if(btPesqQ==1){
	 loadsData('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_alt_load.php','&xPesq='+xPesq+'&PesquisaAvancadaColunas='+PesquisaAvancadaColunas);
	   
	   btPesqQ=2;
	}else{
	  loadsData('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_alt_load.php'+encapsularBtAvanca,'&xPesq='+xPesq+'&PesquisaAvancadaColunas='+PesquisaAvancadaColunas);
	}
		
	 
		
	}else{
	  btPesqQ=1;
	  }
}	
	
$(function(){
	

$('#btMostra').click(function(){
	alert();
	//inverte função
	$("#OcultaPesquisaAvancada").show();
	$("#MostraPesquisaAvancada").hide(); 
	
	});
$('#btOculta').click(function(){
	alert();
	//restalra função
	$("#OcultaPesquisaAvancada").hide();
	$("#MostraPesquisaAvancada").show(); 
	
	});
	
//AÇÂO DE PESQUISA	
//var btPesqQ=1;	
//captura o botão [ENTER]
$('#PesquisaAvancada').on('keypress', function(e){

	
	
if (e.keyCode == 39) {
	  e.preventDefault();
	  
	  var xPesq = $(this).val();
	  var qtdd = $(this).val().length;
	  var PesquisaAvancadaColunas= $("#PesquisaAvancadaColunas option:selected").val();

	//apertou 1 vez o enter, pesquisa novamente, senão vai para o proximo registro da lista.
	if(btPesqQ==1){
	 loadsData('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_alt_load.php','&xPesq='+xPesq+'&PesquisaAvancadaColunas='+PesquisaAvancadaColunas);
	   
	   btPesqQ=2;
	}else{
	  loadsData('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_alt_load.php'+encapsularBtAvanca,'&xPesq='+xPesq+'&PesquisaAvancadaColunas='+PesquisaAvancadaColunas);
	}
	  
  }else{
	  btPesqQ=1;
	  }
});

/*	
	
//seleciona as mascaras no opções de pesquisas
$('#PesquisaAvancadaColunas').on('change', function(e){
	
	$('#PesquisaAvancada').addClass("mask_cel");
	$(".mask_cel").mask("(99)9.9999-9999");
	$("#testespesq").addClass("important");
	
	
	var x = $('select option:selected').val;
	//$('this option[value=val2]').attr('selected','selected');
	$("#testespesq").text("Hello world!"+x);
});
	
	*/
	
	$('#PesquisaAvancadaColunas').change(function(){
	var val_pesqAvanca_opcao_val=$(this).val();
		
	//$('#PesquisaAvancada').addClass("mask_cel");
	//$(".mask_cel").mask("(99)9.9999-9999");
	$("#testespesq").text("o valor é:"+val_pesqAvanca_opcao_val);
//
	
		
	
switch (val_pesqAvanca_opcao_val){
		
	case 'cel': //mask_cel_barra
		//remove
		$('#PesquisaAvancada').removeClass("mask_fone_barra");
		$(".mask_fone_barra").unmask("(99)9999-9999");
		//add
		$('#PesquisaAvancada').addClass("mask_cel_barra");
		$(".mask_cel_barra").mask("(99)9.9999-9999");
		break;
	case 'fone': //mask_fone_barra
		//remove
		$('#PesquisaAvancada').removeClass("mask_cel_barra");
		$(".mask_cel_barra").unmask("(99)9.9999-9999");
		//add
		$('#PesquisaAvancada').addClass("mask_fone_barra");
		$(".mask_fone_barra").mask("(99)9999-9999");
		break;
  	default :
		//remove
		$(".mask_fone_barra").unmask("(99)9999-9999");
		$(".mask_cel_barra").unmask("(99)9.9999-9999");
		$('#PesquisaAvancada').removeClass("mask_cel_barra");
		$('#PesquisaAvancada').removeClass("mask_fone_barra");

		
		
				
}
	
	
	
});
	
	
});

	
	
	
</script>


<div  class="DivBarraFixed" id="OcultaPesquisaAvancada" style="display:none;" >

    <!-- fa fa-chevron-circle-left-->
	<div class="fortm_bt" title="Oculta Pesquisa Avançada" id="btOculta">
		<div class="btn btn-default image-preview-input">
			 <i class="fa fa-chevron-right"></i>
        </div>
	</div>
	 <div  class="fortm_input">
  		<input name="PesquisaAvancada" type="texto"   onkeydown="uniKeyCode(event)" required="required" class="form-control col-md-7 col-xs-12" id="PesquisaAvancada" placeholder="Pesquisar" autocomplete="off" value="">
	</div>
    <div  class=" fortm_select" >
    <select id="PesquisaAvancadaColunas" name="PesquisaAvancadaColunas" style="text-indent:-5px" onChange="masc_pesquisa_list()">
	  <option value="todos" title="Pesquisa todos os campos">Todos</option>
      <option value="Nome" class="linha1">Nome</option>
      <option value="Codigo">Código</option>
	  <option value="CPF" class="linha1">CPF</option>
      <option value="RG">RG</option>
	  <option value="Idade" class="linha1">Idade</option>
	  <option value="CEP">CEP</option>
      <option value="Endereco" title="Endereço" class="linha1">Endereço</option>
      <option value="bairro" title="Bairro">Bairro</option>
	  <option value="cel" title="Pesquisa todos os Telefones" class="linha1" id="pesquisa_cel" >Celulares</option>	
      <option value="fone" title="Pesquisa todos os Telefones" class="linha2" id="pesquisa_fone">Telefones</option>
	  <option value="telefones" title="Pesquisa todos os Telefones" class="linha1">Telefones antigo</option>
      <option value="EMail" title="EMail">E-Mail</option>
      <option value="Objetivo" title="Objetivos" class="linha1">Objetivos</option>
      <option value="Observacoes" title="Observações">Observações</option>
      <option value="RegistroData" title="Data Registro" class="linha1">Data Registro</option>
      <option value="RegistroDataAlterado" title="Data Registro Alteração">Data Registro Alteração</option>
	</select>
    </div>



<div id="BarraPesquisaAvancadaLoad"></div>
<div id="BarraPesquisaCodigoLoad"></div>

</div>

<div class="DivBarraFixed"  title="Mostrar Pesquisa Avançada" id="MostraPesquisaAvancada">
	<div  class="fortm_bt" >
		<div class="btn btn-default image-preview-input" id="btMostra">
            <i class="fa fa-chevron-left"></i>
        </div>
</div>
</div>

