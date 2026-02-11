<?php

$CEPForm = ' 
 <div class="col-md-12 col-sm-12 col-xs-12" >
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Endereço  </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        <input type="text" id="Endereco" name="Endereco"  class="form-control col-md-7 col-xs-12" placeholder="Endereço"
         value="">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Numero   </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="text" id="Endereco_nro" name="Endereco_nro"  class="form-control col-md-7 col-xs-12" placeholder="Nº" value="">
        </div>
        
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bairro   </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="Bairro" type="text"  class="form-control col-md-7 col-xs-12" id="first-name" placeholder="Bairro" value="">
        </div>
        </div>
        
         <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cidade  </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="Cidade" type="text"  class="form-control col-md-7 col-xs-12" id="Cidade" placeholder="Cidade/UF" value="">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Estado  </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
        <input name="Estado" type="text"  class="form-control col-md-7 col-xs-12" id="first-name" placeholder="Estado"  value="">
        <input name="end_cPais" type="hidden" id="end_cPais" value="">
      	 <input name="end_xPais" type="hidden" id="end_xPais" value="">
        </div>

        <br><br><br>
</div>

';

/**
 *    Exemplo de utilização de utilização de WebService Kinghost
 *    www.kinghost.com.br
 */


$cep = str_replace('-', '', $_POST['content']);
if ($cep != '') {


$url = "https://brasilapi.com.br/api/cep/v2/$cep";
?>
<script>
    $.ajax({
        url: "<?php echo $url?>", success: function (result) {
            $("#Endereco").val(result.street);
            $("#Endereco_nro").val();
            $("#Bairro").val(result.neighborhood);
            $("#Cidade").val(result.city);
            $("#Estado").val(result.state);
        }
    });

</script>


<div id="div1">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Endereço </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="text" id="Endereco" name="Endereco" class="form-control col-md-7 col-xs-12"
                   placeholder="Endereço"
                   value="">
        </div>

        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Numero </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
            <input type="text" id="Endereco_nro" name="Endereco_nro" class="form-control col-md-7 col-xs-12"
                   placeholder="Nº" value="">
        </div>


        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bairro </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <input name="Bairro" type="text" class="form-control col-md-7 col-xs-12" id="Bairro"
                   placeholder="Bairro" value="">
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cidade </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <input name="Cidade" type="text" class="form-control col-md-7 col-xs-12" id="Cidade"
                   placeholder="Cidade/UF" value="">
        </div>

        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Estado </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
            <input name="Estado" type="text" class="form-control col-md-7 col-xs-12" id="Estado"
                   placeholder="Estado" value="">
            <input name="end_cPais" type="hidden" id="end_cPais" value="55">
            <input name="end_xPais" type="hidden" id="end_xPais" value="br">
        </div>
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Compl. </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input name="Complemento" type="text" class="form-control col-md-7 col-xs-12" id="Complemento"
                   placeholder="Complemento" autocomplete="off" value="">
        </div>
        <br><br><br>
    </div>


    <script>
        $(function () {
            $(<?php if ($select == '1') {
                echo "'#endereco'";
            } else {
                echo "'#Endereco_nro'";
            }?>).select();
        });
    </script>
    <?php

    } else {
        echo '	

		<div class="col-md-6 col-sm-6 col-xs-12" >
	   		<div class="alert alert-danger alert-dismissible fade in" role="alert">
       		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
       		Preencha corretamento o  <strong>CEP</strong>
       </div></div>
	
	';
    }


    ?>
 


