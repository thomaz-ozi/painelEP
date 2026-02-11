<?php 	
//-----------------------------------------------------------------------------> SISTEMA USUARIO 
//-----------------------------------------------------------------------------> SISTEMA USUARIO CLASSIFICAÇÃO
// verivicação de permissão...
//----------> ATIVAR/DESATIVAR MODULOS  <-------


					//COMPARA E INICIAR O MODULO ...
		if($_SESSION['startmod']=='setor'){
if (($row_perfusuario['id_perm_status_usuario_setor']<=2)and($row_perfusuario['id_perm_status_usuario_setor']>=1)) {			
			$conf_url="../sistema_usuario_setor/";			
		switch($conteudo){

//---------------------------------------------------------> INICIADO URL
		case 'usu_setor-add':
			$modulo_local=$conf_url."acao_add.php";
			break;

		case 'usu_setor-alt':
			$modulo_local=$conf_url."acao_alt.php";
			break;

		case 'usu_setor-exc':
			$modulo_local=$conf_url."acao_exc.php";
			break;
		default:
			$modulo_local=$conf_url."index.php";
		break;
	}include $url_conf."conf.php";		
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>