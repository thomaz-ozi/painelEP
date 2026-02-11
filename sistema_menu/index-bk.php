<?php

// verificando se a LOCAL iniciada

mysql_select_db($database_connection, $connection);
$query_filtro_permissao_usuario = "SELECT * FROM tbnext_mod_empresa_local_usuario_permisao WHERE id_usuario = '".  $row_perfusuario['id_usuario'] ."'  AND id_local= '".$_SESSION['LOCAL']."'";
$filtro_permissao_usuario = mysql_query($query_filtro_permissao_usuario, $connection) or die(mysql_error());
$row_filtro_permissao_usuario = mysql_fetch_assoc($filtro_permissao_usuario);
$totalRows_filtro_permissao_usuario = mysql_num_rows($filtro_permissao_usuario);
//perfil do usuario--> segurança
if ($row_perfusuario['id_perm_status_usuario_perfil']!=7) {	


   ?>

<ul id="nav" >



<span class="preload1"></span>
<span class="preload2"></span>


<?php //----------> PAINEL <----------// ?>
<li class="top">
      <a href="#nogo2" id="products" class="top_link">
      <span class="down">
        Painel
      </span>
      </a>

	<ul class="sub">
    	
		<li><a href="?startmod=&conteudo=inicio&local=selec" >
		<div class="topDiv">inicio</div></a>
		</li>
        
        
        
       <li class="top">
        <a href="#" class="fly">
      <span class="down">
      <div class="topDiv">
        Usuario
        </div>
      </span>
      </a>

            <ul >
              <?php if ($row_perfusuario['id_perm_status_usuario_aparencia']==1) {?>
              <li><a href="?startmod=usuario_aparencia&conteudo=uap" >
              <div class="topDiv">Aparência</div></a>
              </li>
              <?php } ?>
              <?php if ($row_perfusuario['id_perm_status_usuario_setor']==1) {?>
              <li><a href="?startmod=setor&conteudo=usu_setor" >
              <div class="topDiv">Setor</div></a>
              </li>
              <?php } ?>
              <li><a href="?startmod=locaEmpres&conteudo=contato" >
              <div class="topDiv">Empresa</div></a>
              </li>
              <?php if ($row_perfusuario['id_perm_status_usuario_log']==1) {?>
      
              <li><a href="?startmod=usuario_log&conteudo=ulog" >
              <div class="topDiv">Log de usuario</div></a>
              </li>
              <?php } ?>
              <?php if (($row_perfusuario['id_perm_status_usuario_perfil']<=2)and($row_perfusuario['id_perm_status_usuario_perfil']>=1)) {?>       
              <li><a href="?startmod=usuario&conteudo=uu" >
              <div class="topDiv">Perfil do usuario</div></a>
              </li>
              <?php } ?>
			</ul>
		</li> 
        
        

        

         <?php if ($row_perfusuario['id_perm_status_usuario_versao']==1) {?>
        <li><a href="?startmod=versao&conteudo=versao" >
		<div class="topDiv">Versão</div></a>
		</li>
        <?php } ?>
        <?php if (($row_perfusuario['id_perm_status_usuario_ajuda']<=3)and($row_perfusuario['id_perm_status_usuario_ajuda']>=1)) {
			?>
        <li><a href="?startmod=ajuda_tutorial&conteudo=tutorial" >
		<div class="topDiv">Ajuda</div></a>
		</li>
        <?php } ?>
        
	</ul>
</li>

<?php

 if($totalRows_filtro_permissao_usuario > 0){

 ?>


<?php // include('../sistema_menu/m_site.php'); ?>
<?php //include ("../sistema_menu/m_sma.php");?>
<?php include ("../sistema_menu/m_cadastro.php");?>
<?php include ("../sistema_menu/m_financeiro.php");?>
 
 <?php 
 //----------------------> SAC <------------------------//
 //include ("../sistema_menu/m_sac.php");?>

 
 
</ul>

 <?php 
 
 }else{echo "...";}//FECHAR SESSAO DA LOCAL
 }else{ echo "Permissão de Segurança";}//perfil do usuario--> segurança

mysql_free_result($filtro_permissao_usuario);
?>