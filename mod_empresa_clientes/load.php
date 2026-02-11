
<style onload="divLoadMsn('.divLoadMsnlocal','options_action_search','Pesquisa','#loadPesquisa')"></style> 
<div class="divLoadMsnlocal">
<script>

$(function(){
$('#pesquisa_fom').select();
	
$('#pesquisa_fom').keyup(function(){
	var xNome=$(this).val();
	loadsData('#list_pesquisa_produto','../mod_empresa_clientes/load_list.php',xNome);
	
	
		
});
});	

function addContentClientes(id,xNome,n,r){
		//alert(n);
			$('#pesquisa_id_clientes').val(id);
			$('#pesquisa_clientes').val(xNome);
			$('#pesquisa_clientes_x').html(xNome);
			$('.pesquisa_cnpj_cpj').text(n);
			$('.pesquisa_cnpj_cpj').val(n);
			$('.pesquisa_responsavel').html(r);

		loadsDataClear('#loadPesquisa');
		PedidosOperacaoReiniciar();
		}	
		  



</script>



      <input name="pesquisa_fom" placeholder="Pesquisar"  type="text" id="pesquisa_fom" title=" FA&Ccedil;A SUA PESQUISA"    value="<?php echo $pesquisa_fom; ?>" style="width:250px; text-transform: lowercase;"/>

 
      <table width="100%" align="center" cellpadding="0" cellspacing="0"  class="table table-hover"   >
          <thead>
            <tr  >
              <th width="6%" scope="col">Id</th>
              <th width="57%" scope="col">Clientes</th>
              <th width="32%" height="0" scope="col">CNPJ/CPF </th>
            </tr>
          </thead>
  		</table> 
        <div id="list_pesquisa_produto" style=" height:300px;overflow-x: hidden; overflow-y: scroll; margin-top:-22px;">
		<?php  include('../mod_empresa_clientes/load_list.php'); ?>
		</div>
        

</div>
