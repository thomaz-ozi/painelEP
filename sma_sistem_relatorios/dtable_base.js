function dTable(table,ajaxserver){

var oTable;
var giRedraw = false;
			$(document).ready(function() {/*
				$(table + " tbody").click(function(event) {
					$(oTable.fnSettings().aoData).each(function (){
						$(this.nTr).removeClass('row_selected');
					});
					$(event.target.parentNode).addClass('row_selected');
				});
				 
				/* Add a click handler for the delete row */
				/*$('#delete').click( function() {
					var anSelected = fnGetSelected( oTable );
					oTable.fnDeleteRow( anSelected[0] );
				} );
				*/
			
				
				 oTable = $(table).dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					
					"bJQueryUI": true,
					"sAjaxSource": ajaxserver,
					//"sPaginationType": "full_numbers",
							
					  "oLanguage": {
            				"sProcessing": "Processando...",
							"sLengthMenu": "Mostrar _MENU_ registros",
							"sZeroRecords": "Não foram encontrados resultados",
							"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
							"sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
							"sInfoFiltered": "(filtrado de _MAX_ registros no total)",
							"sInfoPostFix": "",
							"sSearch": "Buscar:",
							"sUrl": "",
							"oPaginate": {
								"sFirst":    "Primeiro",
								"sPrevious": "Anterior",
								"sNext":     "Seguinte",
								"sLast":     "Último"
							}
							
        				}
				} );
			} );
			
			
}
function fnGetSelected( oTableLocal )
			{
				var aReturn = new Array();
				var aTrs = oTableLocal.fnGetNodes();
				 
				for ( var i=0 ; i<aTrs.length ; i++ )
				{
					if ( $(aTrs[i]).hasClass('row_selected') )
					{
						aReturn.push( aTrs[i] );
					}
				}
				return aReturn;
}