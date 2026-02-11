function CarregarDiv(div,pg) {
	$.ajax(
		{
		  type: "POST",
		  url: pg,
		  
		  beforeSend: function() {
 			
			$(div).html("<img src=\"imagens/carregando.gif\"  alt=\"carregando\" />");
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
