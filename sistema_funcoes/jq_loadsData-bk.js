// JavaScript Document
// CARREGANDO DADOS
//EX
//alert('oi1');
//onClick="loadsData('#panel_mod_menu_content_middle','system_conf/mod_application.php',1)"
 function loadsData(div,pg,content) {
	$.ajax(
		{
		  type: "POST",
		  url: pg,
		  data: "content="+content,
		  
		  beforeSend: function() {
 			
			$(div).html('<center><div class="loadsData"></div> </center>');
		  },
		  success: function(txt) {
			$(div).html(txt);
		  },
		  error: function(txt) {
		 	// em caso de erro você pode dar um alert('erro');
		  }
		}
	);
 }

//-------------------------------------------------------------
function loadsDataAbsoluto(div,pg,content) {
	$.ajax(
		{
		  type: "POST",
		  url: pg,
		  data: "content="+content,
		  
		  beforeSend: function() {
		  var msnDiv='<div  class="div_absolute"></div>';
			  msnDiv+='<div  class="div_absolute_msn">';
			  msnDiv+='	<br><br>';
			  msnDiv+='	<div class="x_panel" style=" width: 65%;">';
			  msnDiv+='		<div class="x_title">';
			  msnDiv+='			<button class="loadsDataSimples" title="LOAD" type="button" style="float:left;" value="4"> </button>';
			  msnDiv+='			<h2>&nbsp;&nbsp;  Carregando </h2>';
			  msnDiv+='			<a class="close-link" style="float:right;" onclick="loadsDataClear(\''+div+'\')"><i class="fa fa-close"></i></a>';
			  msnDiv+='			<div class="clearfix"></div>';
			  msnDiv+='		</div><br>';
			  msnDiv+='		<center><div class="loadsData"></div></center>';
			  msnDiv+='		Carregando... <br><br>';
			  msnDiv+='        <div class="ln_solid"></div>';
			  msnDiv+='		<button type="button" onClick="loadsDataClear(\''+div+'\')" class="btn btn-default"><i class="fa fa-close"></i>&nbsp;FECHAR</button>';
			  msnDiv+='	</div>';
			  msnDiv+='</div>';
		  $(div).html(msnDiv);
		  },
		  success: function(txt) {
			  $(div).html(txt);
		  },
		  error: function(txt) {
			  // em caso de erro você pode dar um alert('erro');
		  }
		}
	);
 }
 //-------------------------------------------------------------
function loadsDataSimples(div,pg,content) {
	$.ajax(
		{
		  type: "POST",
		  url: pg,
		  data: "content="+content,
		  
		  beforeSend: function() {
 			
			$(div).html('<center><button type="button" class="loadsDataSimples"></button> </center>');
		  },
		  success: function(txt) {
			$(div).html(txt);
		  },
		  error: function(txt) {
		 	// em caso de erro você pode dar um alert('erro');
		  }
		}
	);
 }
//-------------------------------------------------------------
 function loadsDataClear(div) {
	 
		loadsDataAbsoluto(div,'../sistema/nullo.php');

 }
//-------------------------------------------------------------
function divLoadMsn(local,icon,title,xclose){
 
 if(icon !=''){
	  icon = '<button class="'+icon+'" title="'+title+'" type="button" style="float:left;" value="4"> </button>';
	  }else{ icon ='';}
	var content=$(local).html();
	var msnDiv='<div  class="div_absolute"></div>';
		msnDiv+='<div  class="div_absolute_msn">';
		msnDiv+='	<div class="x_panel divLoadMsn" style=" ">';
		msnDiv+='		<div class="x_title">';
		msnDiv+='			'+icon+'';
		msnDiv+='			<h2>&nbsp;&nbsp;  '+title+' </h2>';
		msnDiv+='			<a class="close-linkv divLoadMsnClouse " style="float:right;" onclick="loadsDataClear(\''+xclose+'\')"><i class="fa fa-close "></i></a>';
		msnDiv+='			<div class="clearfix"></div>';
		msnDiv+='		</div>';
		msnDiv+='		'+content+'';
		msnDiv+='	</div>';
		msnDiv+='</div>';
		$(local).html(msnDiv);


	}
//EX:
//<style onload="divLoadMsn('.divLoadMsnLocal','.options_fin_conbra','Cobrança','#LoadOpcoes')"></style> 
//<div class="divLoadMsnLocal">TESTE</div>

//----------------------------------------------> LOADSDATAFORMFILE <----------------------------------------------//
//Versão:1 Data:30/01/2018
//Cargas Formulário de Dados
//onClick="loadsDataFormFile('#formMSN','../mod_connections/conf_url.php','#acaoform','teste&auto=carro&conteudo=teste1&conteudo2=teste2')"

function loadsDataFormFile(formMsn,formURL,formID,formGET,formPOST,formURL2){
		
		$(formID+' input[type=file]').each(function(i){
			 var vRequired = $(this).attr('required');
			 var vValue = $(this).val();
		//	 var vId = $(this).attr('id');
			 console.log(vRequired+vValue);
			var vPermitidofile=false;
			
		if(vRequired=="required"){
		  if(vValue==''){ 
			vPermitidofile=false;

		 }else{
		 	vPermitidofile=true;
		 }}else{
			if(vValue!=''){
			vPermitidofile=true;
			}
		 }
		 
		
			 
		if(vPermitidofile==true){
			console.log('foi'+vPermitidofile);
			
			$(formID+' input[type=file]').simpleUpload(formURL+'?formGET='+formGET+'&tt='+vRequired, {
		
			start: function(file){
				//upload started
				console.log("upload started");
			},

			progress: function(progress){
				$(formMsn).append('<progress value="0" max="100"></progress><span id="porcentagem">0%</span>');
				//received progress
				console.log("upload progress: " + Math.round(progress) + "%");
				
				$(formMsn+' progress').attr('value', Math.round(progress));
				$(formMsn+'#porcentagem').html( Math.round(progress) + "%");
			},

			success: function(data){
				//upload successful
				console.log("upload successful!"+formURL2);
				console.log(data);
					if(formURL2!=''){
					loadsDataForm(formMsn,formURL2,formID,formGET,formPOST);
					}
				 
				//loadsData(formMsn,formURL2+'?'+formGET);
			},

			error: function(error){
				//upload failed
				console.log("upload error: " + error.name + ": " + error.message);
			}

		});
		}else{			
					if(formURL2!=''){
					loadsDataForm(formMsn,formURL2,formID,formGET,formPOST);
					}
		}
	});//FIM INPUT
	}

//----------------------------------------------> LOADSDATAFORM <----------------------------------------------//
//Versão:6 Data:30/01/2018
//Cargas Formulário de Dados
//onClick="loadsDataForm('#formMSN','../mod_connections/conf_url.php','#acaoform','teste&auto=carro&conteudo=teste1&conteudo2=teste2')"
function loadsDataForm(formMsn,formURL,formID,formGET,formPOST) {

var vPermitidoIE=true;
var vPermitidoI=true;
var vPermitidoS=true;
var vPermitidoT=true; 
//--------------------> INPUT <------------------------//
  $(formID+' input').each(function(i){
      var vRequired = $(this).attr("required");
	  var vDisabled = $(this).attr('disabled');
	  var vValue = $(this).val();
	  var vName = $(this).attr('name');
	  var vId = $(this).attr('id');
	  var vType = $(this).attr('type');
	  var vMin = $(this).attr('min');//Especifica um valor mínimo para um elemento <input>
	  var vMax = $(this).attr('max');//Especifica o valor máximo para um elemento <input>
	  //var vChecked = $(this).attr('checked');

	 $('#reportarLoadForm').append(vRequired+'-'+vDisabled+'-'+vValue+'-'+vName+'-'+vId+'-'+vType+'-'+vMin+'-'+vMax+'<br>'); //teste
	
	//VALIDAÇÃO INPUT
	if(vRequired=="required"){
	  if(vDisabled!="disabled"){	
	  
		 if(vValue==''){	
		 	//Impedido
			$("#"+vId).removeClass( "validacaoPermitido" );
		 	$("#"+vId).addClass( "validacaoImpedido" );
			vPermitidoI=false;
			
		 //VERIFICAR EMAIL
		 }else if(vType=='email'){
		 	
		   	//FILTRO DO EMAIL
			var txt=vValue;
		  	if ((txt.length != 0) && ((txt.indexOf("@") < 1) || (txt.indexOf('.') < 7)||(txt.indexOf("#") >2)||(txt.indexOf(",") >2)))
		  	{ 	//Impedido
				$("#"+vId).removeClass( "validacaoPermitido" );
		 		$("#"+vId).addClass( "validacaoImpedido" );
				vPermitidoIE=false;
		  	}else{
				//Permitido	
		 		$("#"+vId).addClass( "validacaoPermitido" );
			 	$("#"+vId).removeClass( "validacaoImpedido" );
				vPermitidoIE=true;			
			}
		 }else{
		 	//Permitido
			$("#"+vId).addClass( "validacaoPermitido" );
			$("#"+vId).removeClass( "validacaoImpedido" );
			vPermitidoI=true;
		 }
	  }//Desabilitado
	}//Requer conteudo
  });//FIM INPUT
   

//--------------------> SELECT <------------------------//
  $(formID+' select').each(function(i){
      var vRequired = $(this).attr("required");
	  var vDisabled = $(this).attr('disabled');
	  var vValue = $(this).val();
	  var vName = $(this).attr('name');
	  var vId = $(this).attr('id');
	//$('#msn').append(vRequired+'-'+vDisabled+'-'+vValue+'-'+vName+'-'+vId+'<br>');//teste
	
	//VALIDAÇÃO SELECT
	if(vRequired=="required"){
	  if(vDisabled!="disabled"){
		 if(vValue==''){ 
		 	//Impedido	
		 	$("#"+vId).removeClass( "validacaoPermitido" );
		 	$("#"+vId).addClass( "validacaoImpedido" );
			vPermitidoS=false;
		 }else{
			 //Permitido
		 	$("#"+vId).addClass( "validacaoPermitido" );
			$("#"+vId).removeClass( "validacaoImpedido" ); 
			vPermitidoS=true;
		}
	  }//Desabilitado
	}//Requer conteudo
  });//FIM SELECT


//--------------------> TEXTAREA <------------------------//
  $(formID+' textarea').each(function(i){
      var vRequired = $(this).attr("required");
	  var vValue = $(this).val();
	  var vName = $(this).attr('name');
	  var vId = $(this).attr('id');
	  var vDisabled = $(this).attr('disabled');
	  var vMin = $(this).attr('min');//Especifica um valor mínimo para um elemento <input>
	  var vMax = $(this).attr('max');//Especifica o valor máximo para um elemento <input>
	//$('#reportarLoadForm').append(vRequired+'-'+vValue+'-'+vName+'-'+vId+'-'+vDisabled+'<br>');//teste

	//VALIDAÇÃO TEXTAREA
	if(vRequired=="required"){
	  if(vDisabled!="disabled"){
		 if(vValue==''){	
		 	//Impedido"
			$("#"+vId).removeClass( "validacaoPermitido" );
		 	$("#"+vId).addClass( "validacaoImpedido" );
			vPermitidoT=false; 
		 }else{
		 	//Permitido
			$("#"+vId).addClass( "validacaoPermitido" );
			$("#"+vId).removeClass( "validacaoImpedido" );
			vPermitidoT=true; 
		 }
	  }//Desabilitado
	}//Requer conteudo
  });//FIM TEXTAREA
  
//$('#reportarLoadForm').append(vPermitidoI+'-'+vPermitidoIE+'-'+vPermitidoS+'-'+vPermitidoT+'<br>');//teste


//VALIDADO O FORMULARIO
 	var msnDiv='<div  id="divPermanecer"><div  class="div_absolute"></div>';
		msnDiv+='<div  class="div_absolute_msn">';
		msnDiv+='	<br><br>';
		msnDiv+='	<div class="x_panel" style=" width: 65%;">';
		msnDiv+='		<div class="x_title">';
		msnDiv+='			<button class="options_action_appl_warning_1" title="LOAD" type="button" style="float:left;" value="4"> </button>';
		msnDiv+='			<h2>&nbsp;&nbsp;  Aten&ccedil;&atilde;o   </h2>';
		msnDiv+='			<a class="close-link" style="float:right;" onclick="loadsDataClear(\''+formMsn+'\')"><i class="fa fa-close"></i></a>';
		msnDiv+='			<div class="clearfix"></div>';
		msnDiv+='		</div><br>';
		msnDiv+='		<div class="alert alert-warning">Preencha o(s) campo(s) obrigat&oacute;(s)</div><br><br>';
		msnDiv+='		<br><br>              ';
		msnDiv+='        <div class="ln_solid"></div>';
		msnDiv+='		<button type="button" class="btn btn-default bt_divPermanecer" onclick="divPermanecer()" ><i class="fa fa-arrow-down"></i> Ocultar</button>';
		msnDiv+='	</div>';
		msnDiv+='</div></div>'; 

  if(((vPermitidoI==true)&(vPermitidoIE==true)&(vPermitidoS==true)&(vPermitidoT==true))==true){
		//ENVIAR OS DADOS FORMULARIO 
	var dataForm = "&formMsn="+formMsn+"&formURL="+formURL+"&formPOST="+formPOST;
	 	dataForm += $(formID).serialize()
	$.ajax({
	  type: 'POST',
	  url: formURL+'?formGET='+formGET,
	  data: dataForm,
	   
	    beforeSend: function() {
			$(formMsn).html('<center><div class="loadsData"></div> </center>');
		  },
		  success: function(txt) {//o (txt) é para gerar o carregamento da pagina na div escolhida
			$(formMsn).html(txt);
		  },
		  error: function(txt) {
		  }
	   
	   
	   
	});//FIM ENVIAR O FORMULARIO  
	
	
	
	
	
	
  }else{ $(formMsn).append(msnDiv);  }//FIM FORMULARIO
}//FIM

