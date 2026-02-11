<script>
/*
$(function(){
  $('.bt_divPermanecer').click(function(){
	  $('#divPermanecer').remove();
  });
});
*/


</script>
<div  id="divPermanecer">
	 <div  class="div_absolute"></div>
		<div  class="div_absolute_msn">
			<br><br>
			<div class="x_panel divLoadMsnRes" style=" width: 65%;">
				<div class="x_title">
					
					<h2><img src="<?php echo "$icons_sistema_nome"; ?>" />&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp; &nbsp;<img src="<?php echo "$local_icons"; ?>alt-30.png" width="30" height="30" />  Alterar </h2>
					<a class="close-link bt_divResAlt" style="float:right;" ><i class="fa fa-close"></i></a>
					<div class="clearfix"></div>
				</div>
                <br>
                <br>
				

                
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <strong>Conteudo foi ALTERADO com sucesso!</strong>
                  </div>
				<br>
				<br>
				<br> 
                
                
                 <div class="clearfix"></div>
<div class="ln_solid"></div>
<div class="form-group" >
  <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3" align="center">
            <button type="button" class="btn btn-default bt_divPermanecer"  onclick="divPermanecer()" ><i class="fa fa-arrow-down"></i> Permanecer na tela</button>
    <button type="button" class="btn btn-success " onclick="MM_goToURL('parent','?<?php echo $usuario_get; ?>&conteudo=<?php echo $conteudo_inf; ?>');return document.MM_returnValue">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-check"></i> &nbsp;&nbsp;Concluido&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
  </div>
  
    <div class="clearfix"></div>               
                
                
			</div>
		</div>



  
  </div>
  </div>

