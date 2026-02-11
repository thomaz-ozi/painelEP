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
					
					<h2><img src="<?php echo "$icons_sistema_nome"; ?>" />&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp; &nbsp;<img src="<?php echo "$local_icons"; ?>add-30.png" width="30" height="30" />  Adicionar </h2>
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
            <button type="button" class="btn btn-primary bt_divPermanecer"  ><i class="fa fa-file-text-o"></i> Novo</button>
            <button type="button" onclick="MM_goToURL('parent','?<?php echo $usuario_get; ?>&conteudo=<?php echo $conteudo_inf; ?>');return document.MM_returnValue" 
           accesskey="c"  class="btn btn-success"><i class="fa fa-check"></i> Concluido</button>
              </div>
                
                
                
			</div>
		</div>
</div>

