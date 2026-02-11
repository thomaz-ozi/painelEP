<?php
	//---------------------> SAC <--------------------------//

 	if ($row_perfusuario['ativo_sac']==1) {?>

	<li class="top">
      <a href="#nogo2" id="products" class="top_link">
      <span class="down">
        SAC
      </span>
      </a>
	
	<ul class="sub">
    	<?php if ($row_perfusuario['id_perm_assunto']==1) {?>
		<li><a href="?startmod=&conteudo=inicio&local=selec" >
		<div class="topDiv">Assunto</div></a>
		</li>
        <?php } ?>
		<?php if ($row_perfusuario['id_perm_atendimento']==1) {?>
        <li><a href="?startmod=cadas_local&conteudo=local" >
		<div class="topDiv">Atendimento</div></a>
		</li>
        <?php } ?>
        <?php if ($row_perfusuario['id_perm_servico']==1) {?>
        <li><a href="?startmod=vendas_pedidos&conteudo=pedidos" >
		<div class="topDiv">Serviços</div></a>
		</li>
         <?php } ?>
	</ul>
     
</li> 
<?php } ?>