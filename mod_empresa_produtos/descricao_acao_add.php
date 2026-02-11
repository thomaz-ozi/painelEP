<style onload="divLoadMsn('.divLoadMsnlocal','options_action_add_sec','Adicionar','#loadDescricao')"></style> 
<div class="divLoadMsnlocal">
<script>
$(function(){
	$('#saveDescricao').click(function(){
		addtableDescricao();
		
	});
});

</script>
 <script src="../sistema/ckeditor/ckeditor.js"></script>
 <div class="form-group">
 <input name="loadDescricao_id_produtos" type="hidden" id="loadDescricao_id_produtos" >
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">Titulo <span class="required">*</span>           </label>
    <input name="loadDescricao_xNome" type="text" required="required" class="form-control col-md-6  col-sm-3 col-xs-12" id="loadDescricao_xNome">
 </div>
 <div class="clearfix"></div>
<div class="form-group">	
    <label class="control-label col-md-12" for="first-name">Descrição</label>
    <div class="clearfix"></div>
    <textarea class="form-control"  id="loadDescricao_descricao" name="loadDescricao_descricao" rows="10" tabindex="1"><?php echo $row_list_produtos['descricao_produto']; ?></textarea>
	<script>
       CKEDITOR.replace( 'loadDescricao_descricao', {
       toolbar :'basic'
       });
    </script>
</div>

<div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default" onclick="loadsDataClear('#loadDescricao')" ><i class="fa fa-close"></i>&nbsp; FECHAR</button>
        <span id="concluir_verificar">
        <button type="button" class="btn btn-success" id="saveDescricao" ><i class="fa fa-save"></i> Salvar</button>
        </span>
      </div>
    </div>

</div>


