<?php

// recebe endereco do link	do conteudo	  
 $conteudo=$_GET['conteudo'];
 // ativando o sistema de modudos ele envia p session e consulta p a permissao 
if(isset($_GET['startmod'])){
   // *** inicia a session
	if (!isset($_SESSION)) {
	  session_start();
		}
	
//adicionando na session 
  	 $_SESSION['startmod'] = $_GET['startmod'];	  
}
	if ($row_perfusuario['id_perm_status_usuario_perfil']!=7) {	
		
// iniciando sistema de permissões e de modulos
// Valor "1" permitido
// Valor "2" ou diferente de 1 não tem permissão
######################################### MODULO SITE ###################################
//include ("../mod_site/conf_url.php");

######################################### MODULO EMPRESA ###################################
//include ("../mod_empresa/conf_url.php");

######################################### MODULO ECOMMERCE ###################################
//include ("../mod_empresa_ecommerce/conf_url.php");

######################################### MODULO SISTEMA IEP ###################################
include ("../mod_iep/conf_url.php");

#########################################  SISTEMA  #####################################
//AS PASTAS SISTEMAS SÃO AS ESTRUTURA DO PROGAMA

//--------------------------------------------------------------------------> MODULO CONFIGURAÇÃO DA EMPRESA
include ("../sistema_contato/conf_url.php");
//-------------------------------------------------------------------------> LOCAL EMPRESA
include ("../sistema_empresa_local/conf_url.php");
//-------------------------------------------------------------------------> LOCAL EMPRESA  PERMISSAO DE USUARIO
include ("../sistema_empresa_local_permissao/conf_url.php");

#----------------------------------------------- USUARIO -----------------------------------#
//--------------------------------------------------------------------------> MODULO USUARIO PERFIL
//MODULO USUARIO PERMISSOES
include ("../sistema_usuario/conf_url.php");
//--------------------------------------------------------------------------> MODULO USUARIO LOG
include ("../sistema_usuario/conf_url_log.php");
//--------------------------------------------------------------------------> MODULO USUARIO APARENCIA
include ("../sistema_usuario_aparencia/conf_url.php");
//--------------------------------------------------------------------------> MODULO USUARIO setor
include ("../sistema_usuario_setor/conf_url.php");
//--------------------------------------------------------------------------> SISTEMA VERSAO
//include ("../sistema_versao/conf_url.php");
//include ("../sistema_versao/conf_url_classe01.php");
//--------------------------------------------------------------------------> SISTEM DE AJUDA
include ("../sistema_ajuda/conf_url.php");
include ("../sistema_ajuda/conf_url_classe01.php");
//----------------------------------------------------------> FIM
include ("../sistema_inicio/conf_url.php");
#############################################################################################
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }

?>