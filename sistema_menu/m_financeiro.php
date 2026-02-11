  <?php //----------> MÓDULO FINANCEIRO <----------// ?>
 <?php if ($row_perfusuario['ativo_financeiro']==1) {?>  
 <li class="top">
      <a href="#nogo2" id="products" class="top_link">
      <span class="down">
      
        Movimento
      </span>
      </a>

	<ul class="sub">
       <?php //----------> MÓDULO MOVIMENTO BANCÁRIO <----------// ?>
       <?php if ($row_perfusuario['id_perm_mbancario']==1) {?>  
        <li>
        <a href="#" class="fly">
        M. Bancário
        </a>
          <ul>

     
            <li><a href="?startmod=produtos_setor&conteudo=prod_setor" >
			Movimento Bancário
            </a></li>
            
             <li><a href="?startmod=produtos_marcas&conteudo=prod_marcas" >
			Relatórios</a>
			</li>
          </ul>
		</li>
      <?PHP }?>     
	  <?php //----------> MÓDULO Fluxo de Caixa <----------// ?>
      
        <li>
        <a href="#nogo11" class="fly">
        
        Fluxo de Caixa</a>
          <ul>
          	<?php if ($row_perfusuario['id_perm_financ_cadastro']==1) {?>
			<li><a href="?startmod=financeiro&amp;conteudo=financeiro_painel&amp;data_ano=<?php echo date('Y'); ?>&amp;data_mes=<?php echo date('m'); ?>&amp;data_dia=<?php echo date('d'); ?>" >
				Conf Financeiro</a>
			</li>
            <?php } ?>
     		<?php if ($row_perfusuario['id_perm_despesa']==1) {?>
			<li><a href="?startmod=fluxo_despesas&amp;conteudo=despesas&amp;data_ano=<?php echo date('Y'); ?>&amp;data_mes=<?php echo date('m'); ?>" >
				Despesa</a>
			</li>
			<?php } ?>
            <?php if ($row_perfusuario['id_perm_receita']==1) {?>
			<li><a href="?startmod=fluxo_receita&amp;conteudo=receita&amp;data_ano=<?php echo date('Y'); ?>&amp;data_mes=<?php echo date('m'); ?>" >
				Receita</a>
			</li>
            <?php } ?>
          </ul>
		</li>
       
       
       
        <?php if ($row_perfusuario['id_perm_receita']==1) {?>
        <li> <a href="?startmod=vendas&conteudo=vendas">
          Pedido de Vendas
        </a> </li>
        <?php } ?> 
         <?php if ($row_perfusuario['id_perm_receita']==1) {?>
        <li> <a href="?startmod=areceber&conteudo=areceber">
          À Receber
        </a> </li>
        <?php } ?>   
        

	</ul>
    
    
</li>
<?php } ?>