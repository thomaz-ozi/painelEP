<?php 
//-----------------------------------------------------------------------------> MODULO USUARIO	
//-----------------------------------------------------------------------------> SUBMODULO APARENCIA
// verivicação de permissão...
//----------> ATIVAR/DESATIVAR MODULOS  <-------
if ($row_perfusuario['id_perm_status_usuario_aparencia']==1) {
					//COMPARA E INICIAR O MODULO ...
		if($_SESSION['startmod']=='usuario_aparencia'){
			$conf_url="../sistema_usuario_aparencia/";
			
		switch($conteudo){

//---------------------------------------------------------> INICIADO URL
		case 'uap':
			$modulo_local =$conf_url."acao_alterar_aparencia.php";
			break;	
		case 'uap-t':
			$modulo_local =$conf_url."acao_alterar_aparencia_temas.php";
			break;
		case 'uap-w':
			$modulo_local =$conf_url."acao_alterar_aparencia-w.php";
			break;	
		case 'uap_person':
			$modulo_local =$conf_url."acao_alterar_aparencia_person.php";
			break;	

		default:
	}	
//----------------------------------------------------------> Carrega cas configuracoes do modulo CONFIG.PHP
				include $conf_url."conf.php";		
	}}

?>	