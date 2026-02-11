
<?php if ($row_perfusuario['ativo_empresa']==1) {?>
<li class="top">
      <a href="#nogo2" id="products" class="top_link">
      <span class="down">
        Cadastrar
      </span>
      </a>
	
	  <ul class="sub">
	    <?php // if ($row_perfusuario['id_perm_status_usuario_local']==1) {?>
      
        <li>
        <a href="#" class="fly">
        <div class="topDiv">
        Configurações*
        </div></a>
          <ul>
            <li><a href="?startmod=cadas_local&conteudo=local" >
		<div class="topDiv">Dados Empresa</div></a>
			</li>
            <li><a href="?startmod=cad_email&conteudo=email" >
				<div class="topDiv">Conf. E-MAIL</div></a>
			</li>
             <li><a href="?startmod=cad_emailMsn&conteudo=emailm" >
			<div class="topDiv"> Mensagem para E-mail</div>
            </a></li>
             <li><a href="?startmod=pagseguro&conteudo=pagseguro" >
			<div class="topDiv"> Conf. PagSeguro</div>
            </a></li>
            
            
          </ul>
        </li>
        
        
        
        <?php // } ?>
	  
	  <?php if ($row_perfusuario['id_perm_status_prod']==1) {?>
        <li>
        <a href="#" class="fly">
        <div class="topDiv">
        Produtos/Serviços
        </div></a>
          <ul>
          
		  <?php if (($row_perfusuario['id_perm_status_prod_opcoes']<=3)and($row_perfusuario['id_perm_status_prod_opcoes']>=1)) {?>
          	<li><a href="?startmod=prod_marcas&conteudo=marcas" >
			<div class="topDiv">Fabricantes</div></a>
			</li>
          <?php } ?>
           <?php if (($row_perfusuario['id_perm_status_prod_opcoes']<=3)and($row_perfusuario['id_perm_status_prod_opcoes']>=1)) {?>
          	<li><a href="?startmod=prod_volt&conteudo=volt" >
			<div class="topDiv">Volt</div></a>
			</li>
          <?php } ?>
          <?php if (($row_perfusuario['id_perm_status_prod_class']<=3)and($row_perfusuario['id_perm_status_prod_class']>=1)) {?>  
            <li><a href="?startmod=produtos_setor&conteudo=prod_setor" >
			<div class="topDiv">Classificar </div>
            </a></li>
            <?php } ?>
            <?php if (($row_perfusuario['id_perm_status_prod_prod']<=3)and($row_perfusuario['id_perm_status_prod_prod']>=1)) {?> 
            <li>
            <a href="?startmod=produtos&conteudo=prod" >
            <div class="topDiv">Produtos</div></a>
            </li>
            <?php } ?>
            <?php if (($row_perfusuario['id_perm_status_prod_serv']<=3)and($row_perfusuario['id_perm_status_prod_serv']>=1)) {?> 
            <li>
            <a href="?startmod=servicos&conteudo=serv" >
            <div class="topDiv">Serviços</div></a>
            </li>
            <?php } ?>
          </ul>
        
		</li>
               
        <?php }//submodulo Produtos/Serviços?>
        
        
        
		<?php if ($row_perfusuario['id_perm_status_pess']==1) {?>
        <li>
        <a href="#nogo11" class="fly">
        <div class="topDiv">P.Física/Jurícia</div></a>
        <ul>
		 <?php if (($row_perfusuario['id_perm_status_pess_clientes']<=3)and($row_perfusuario['id_perm_status_pess_clientes']>=1)) {?> 
        <li>
        <a href="?startmod=empresa_clientes&conteudo=clien" >
		<div class="topDiv">Clientes</div></a>
		</li>
		 <?php } ?>
         <?php if (($row_perfusuario['id_perm_status_pess_fornec']<=3)and($row_perfusuario['id_perm_status_pess_fornec']>=1)) {?> 
        <li><a href="?startmod=mod_empresa_for&conteudo=fornece" >
		<div class="topDiv">Fornecedores</div></a>
		</li>
        <?php } ?>
         <?php if (($row_perfusuario['id_perm_status_pess_funcionario']<=3)and($row_perfusuario['id_perm_status_pess_funcionario']>=1)) {?>
        <li><a href="?startmod=mod_empresa_funcionarios&conteudo=funcio" >
		<div class="topDiv">Colaboradores/Terceirizados</div></a>
		</li>
        <?php } ?>
        </ul>
		</li>
        
        <?php //----------> MÓDULO EMPRESA <----------// ?>
        <li>
        <a href="#" class="fly">
        <div class="topDiv">
        Cadas. Bancário
        </div></a>
          <ul>
            <li><a href="?startmod=mbancario_bac&conteudo=bol_bb-add_img" >
			<div class="topDiv"> Logo do Boleto </div>
            </a></li>
             <li><a href="?startmod=mbancario_bac&conteudo=bac" >
			<div class="topDiv"> Banco/Agencia/Conta</div>
            </a></li>
            <li><a href="?startmod=mbancario&conteudo=bol_bb" >
			<div class="topDiv">Boleto Banco do Brasil</div>
            </a></li>
   
            
          </ul>
		</li>
        <?php }//submodulo P.Física/P.Jurídica?>
         <li><a href="?startmod=qrcod&conteudo=qrcod" >
		<div class="topDiv">QRCOD</div></a>
		</li> 
        
		<?php 
		//-----------------------> SMA <-----------------------//
		//include ("../sistema_menu/m_cadastro_sma.php");?>
		

             
	</ul>
    
</li>
<?php }?>

