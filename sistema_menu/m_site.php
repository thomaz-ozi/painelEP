<?php  //----------> MÓDULO SITE <----------// 
 if ($row_perfusuario['ativo_site']==1) {?>


<li class="top">
      <a href="#nogo2" id="products" class="top_link">
      <span class="down">
        M. Site
      </span>
      </a>

	  <ul class="sub">
         <?php if ($row_perfusuario['id_perm_status_usuario_contato']==1) {?>
        <li><a href="?startmod=contato&conteudo=contato" >
		<div class="topDiv">Contato</div></a>
		</li>
         <?php } ?>
         
         
         
        <?php if ($row_perfusuario['ativo_empresa']==1) {?>
         <li> <a href="#" class="fly">
           <div class="topDiv"> Marketing </div>
           </a>
           <ul>
             <li><a href="?startmod=mbancario_bac&conteudo=bac" >
               <div class="topDiv"> Publico Alvo</div>
             </a></li>
             <li><a href="?startmod=mbancario&conteudo=bol_bb" >
               <div class="topDiv">E-mail Marketing</div>
             </a></li>
           </ul>
         </li>
         <?php } ?>
        <?php if (($row_perfusuario['id_perm_status_agendas']<=3)and($row_perfusuario['id_perm_status_agendas']>=1)) {?>
        <li><a href="?startmod=agenda&amp;conteudo=agenda" >
		<div class="topDiv">Agenda</div></a>
		</li>
        <?php } ?>
        <?php if (($row_perfusuario['id_perm_status_banner']<=3)and($row_perfusuario['id_perm_status_banner']>=1)) {?>
        <li><a href="?startmod=banner&amp;conteudo=banner" >
		<div class="topDiv">Banner</div></a>
		</li>
        <?php } ?>
        
         <?php if (($row_perfusuario['id_perm_status_updown']<=3)and($row_perfusuario['id_perm_status_updown']>=1))  {?>
         <li><a href="?startmod=updown&amp;conteudo=updown" >
		<div class="topDiv">Up/Down</div></a>
		</li>
        <?php } ?>
        <?php if (($row_perfusuario['id_perm_status_downloads']<=3)and($row_perfusuario['id_perm_status_downloads']>=1)) {?>
        <li><a href="?startmod=downloads&amp;conteudo=downloads" >
		<div class="topDiv">Lista de Downloads</div></a>
		</li>
        <?php } ?>
        <?php if (($row_perfusuario['id_perm_status_noticias']<=3)and($row_perfusuario['id_perm_status_noticias']>=1)) {?>
        <li><a href="?startmod=noticia&amp;conteudo=noticia" >
		<div class="topDiv">Noticias</div></a>
		</li>
        <?php } ?>
        <?php if (($row_perfusuario['id_perm_status_albuns']<=3)and($row_perfusuario['id_perm_status_albuns']>=1)) {?>
        <li><a href="?startmod=albuns&amp;conteudo=albuns" >
		<div class="topDiv">Galeria de Albuns</div></a>
		</li>
        <?php } ?>
        <?php if (($row_perfusuario['id_perm_status_textos']<=3)and($row_perfusuario['id_perm_status_textos']>=1)) {?>
        <li><a href="?startmod=textos&amp;conteudo=ost" >
		<div class="topDiv">Texto do site </div></a>
		</li>
        <?php } ?>

        <?php if (($row_perfusuario['id_perm_status_msg']<=3)and($row_perfusuario['id_perm_status_msg']>=1)) {?>
        <li><a href="?startmod=msg&amp;conteudo=msg-alt" >
		<div class="topDiv">Mensagem</div></a>
		</li>
        <?php } ?>
        <?php if (($row_perfusuario['id_perm_status_propaganda']<=3)and($row_perfusuario['id_perm_status_propaganda']>=1)) {?>
        <li><a href="?startmod=propa_empresa&amp;conteudo=prop" >
		<div class="topDiv">Propaganda/Produtos</div></a>
		</li>
        <?php } ?>
        <?php if (($row_perfusuario['id_perm_status_youtube']<=3)and($row_perfusuario['id_perm_status_youtube']>=1)) {?>
        <li><a href="?startmod=youtube&amp;conteudo=youtube" >
		<div class="topDiv">You Tube</div></a>
		</li>
        <?php } ?>
        
  	</ul>
</li>
<?php }?>