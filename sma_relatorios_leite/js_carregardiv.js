
 function carregarDiv(div,pg,content) {
	$.ajax(
		{
		  type: "POST",
		  url: pg,
		  data: 'content='+content,
		  
		  beforeSend: function() {
 			
			$(div).html("<center><img src=\"../images/carregando.gif\"  alt=\"carregando\" / > </center>");
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
