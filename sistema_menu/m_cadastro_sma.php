<?php
		
		//---------------> SMA <------------// 
		 if ($row_perfusuario['ativo_sma']==1) {?> 
          <?php if ($row_perfusuario['id_perm_animais']==1) {?>
         <li><a href="?startmod=animais&conteudo=animais" >
			<div class="topDiv">ANIMAIS</div></a>
		</li> 
        <?php } ?>
         <?php if ($row_perfusuario['id_perm_origem']==1) {?>
         <li><a href="?startmod=origem&conteudo=origem" >
		<div class="topDiv">ORIGEM</div></a>
		</li>  
        <?php } ?>
         <?php if ($row_perfusuario['id_perm_portoes']==1) {?>        
        
        <li><a href="?startmod=portao&conteudo=portao" >
			<div class="topDiv">PORTÕES</div></a>
		</li> 
        <?php } ?>
         <?php if ($row_perfusuario['id_perm_racas']==1) {?>        
         <li><a href="?startmod=racas&conteudo=racas" >
		<div class="topDiv">RAÇAS</div></a>
		</li> 
         <?php } ?>
         <?php if ($row_perfusuario['id_perm_lotes']==1) {?>
        <li><a href="?startmod=lotes&conteudo=lotes" >
			<div class="topDiv">LOTES</div></a>
		</li>
         <?php } ?>
        <?php } ?>