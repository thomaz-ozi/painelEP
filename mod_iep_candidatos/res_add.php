<script>
$(function(){
  $('.bt_divPermanecer').click(function(){
	  $('#divPermanecer').html('');
  });
});
</script>
<div  id="divPermanecer">
	 <div  class="div_absolute"></div>
		<div  class="div_absolute_msn">
			<br><br>
			<div class="x_panel divLoadMsnRes" style=" width: 65%;">
				<div class="x_title">
					
					<h2><button class="options_action_add" title=" ADICIONAR "  type="button"> </button>&nbsp;&nbsp;  Adicionar </h2>
					<a class="close-link" style="float:right;" onclick="MM_goToURL('parent','?conteudo=<?php echo $_GET['conteudo']; ?>&<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&');return document.MM_returnValue"><i class="fa fa-close"></i></a>
					<div class="clearfix"></div>
				</div>
                <br>
                <br>
				

                
              <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <strong>Conteudo foi ADICIONADO com sucesso!</strong>
                  </div>
				<br>
				<br>
				<br>
            <div  class="txt-Indece">    
            <button type="button" class="btn btn-primary bt_divPermanecer" onclick="divPermanecer()" ><i class="fa fa-file-text-o"></i> Novo</button>
            <button type="button" class="btn btn-default bt_divPermanecer" 
            onClick="loadsDataForm('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_alt_load.php')"
            
            ><i class="fa fa-arrow-down"></i> Permanecer no cadastro</button>
            <button type="button" onclick="MM_goToURL('parent','?<?php echo $usuario_get; ?>&conteudo=<?php echo $conteudo_inf; ?>');return document.MM_returnValue" 
           accesskey="c"  class="btn btn-success"><i class="fa fa-check"></i> Concluido</button>
              </div>
                
                
                
			</div>
		</div>
</div>

