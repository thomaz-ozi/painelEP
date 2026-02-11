// JavaScript Document


function divPermanecer(){
	// $('#divPermanecer').remove();
	document.getElementById('divPermanecer').remove()
	}




//****************** disable[ENTER] ******************//

function disableEnter(){
window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);

//window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='form'&&e.target.getElementById("acao")){e.preventDefault();return false;}}},true);

}

//VERIFICA A QUANTIDADE DE EX: CLASSE, ID, OUTROS'
function VerificaQtdd(n){ 
	var conteudo=0;
	$(n).each(function(i){
 		conteudo ++;
	});
	return (conteudo)

}

//****************** TAB ******************//
$(function() {
	$( "#tabs" ).tabs();
	$( ".tabs" ).tabs();
});


//****************** Acordeon ******************//
$(function() {
    $( ".accordion" ).accordion();
});

//****************** MASK ******************//

$(function($){
   $(".mask_fone").mask("(99)9999-9999");
   $(".mask_cel").mask("(99)9.9999-9999");
   $(".mask_tin").mask("99-9999999");
   $(".mask_ssn").mask("999-99-9999");
   $(".mask_cpf").mask("999.999.999-99");
   $(".mask_cnh").mask("999.999.999.99");
   $(".mask_rg").mask("99.999.99?9-9");/*muito bom!!!*/
   $(".mask_cnpj").mask("99.999.999/9999-99");
   $(".mask_cep").mask("99999-999");

   $(".mask_number2").mask("99");
   $(".mask_number3").mask("999");
   //--> date time
   $(".mask_date").mask("99/99/9999");
   $(".mask_datetime").mask("99/99/9999 99:99:99");
   $(".mask_time").mask("99:99:99");
   

	/*exemplo*/
	$.mask.definitions['h'] = "[*-9]";
	$(".phone").mask("#hhhhhh");

	// $("#phone").mask("(999) 999-9999? x99999");
   $.mask.definitions['~']='[+-]';
   $(".eyescript").mask("~9.99 ~9.99 999");



//****************** MASK  Money ******************//

	//DOLLER
	$(".msk_money").maskMoney();
	//BR
	$(".msk_money_br").maskMoney({ allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
	$(".msk_money_brt").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
	//EURO
	$(".msk_money_euro").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' €'});

});










//****************** PALHETA DE CORES ******************//

$("input[type=color]").spectrum({
    allowEmpty:true,
	preferredFormat: "hex3",
    chooseText: "Selecionar",
    cancelText: "Cancelar",
    showPalette:true,
    palette: [
        ['black','gray', 'white'],
        ['blue','red', 'yellow', 'green'],
		['brown', 'violet','pink','orange','beige']
    ]
	
});

//****************** DIALOG   ******************//

  $(function() {
    $( ".dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 10
      },
      hide: {
        effect: "explode",
        duration: 10
      }
    });
 
    $( ".opener" ).click(function() {
      $( ".dialog" ).dialog( "open" );
    });
  });
  
  //****************** BUTTON   ******************//
    $(function() {
    $( "button[type=submit]" )
      .button()
      .click(function( event ) {
        event.preventDefault();
      });
  });