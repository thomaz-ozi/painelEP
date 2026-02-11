<?php 	
//-----------------------------------------------------------------------------> SISTEMA USUARIO
//-----------------------------------------------------------------------------> SISTEMA USUARIO PERMISSOES
// verivicação de permissão...
//----------> ATIVAR/DESATIVAR MODULOS  <-------

	
					//COMPARA E INICIAR O MODULO ...
if($_SESSION['startmod']=='usuario'){
if ($row_perfusuario['id_perm_status_usuario_perfil']<=3) {			
			$conf_url="../sistema_usuario/";	
			
		switch($conteudo){

//---------------------------------------------------------> INICIADO URL
		case 'uu':
			echo $modulo_local=$conf_url."index.php";
			break;
		case 'uu-add':
			$modulo_local=$conf_url."acao_add_usuario.php";
			break;
		case 'uu-add_local':
			$modulo_local=$conf_url."acao_add_local.php";
			break;	

		case 'uu-alt':
			$modulo_local=$conf_url."acao_alterar_usuario.php";
			break;

		case 'uu-exc':
			$modulo_local=$conf_url."acao_excluir_usuario.php";
			break;

//---------------------------------------------------------> SUBMODULO PERMISSAO
		case 'upe':
			$modulo_local=$conf_url."acao_alterar_permicao.php";
			break;
		case 'uper':
			$modulo_local=$conf_url."acao_alterar_usuario.php";
			break;
	default:
	}//----------------------------------------------------------> Carrega cas configuracoes do modulo CONFIG.PHP	
include $conf_url."conf.php";
	}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }
	
	}

?>