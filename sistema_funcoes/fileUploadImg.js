     window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
        });

	$(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Passe o mouse antes de fechar a pré-visualização
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Criar o botão Fechar
    var closebtn = $('<button/>', {
        type:"button",
        text: '_',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    //Defina o conteúdo padrão do popover
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Visualizar</strong>"+$(closebtn)[0].outerHTML,
        content: "Não há imagem",
        placement:'bottom'
    });
    // Limpa o evento
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
		//botão de selecionar 1
        $(".image-preview-input-title").text(""); 
    }); 
    // Crie a imagem de pré-visualização
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
			//Botão de selecionado 2
            $(".image-preview-input-title").html('');
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});