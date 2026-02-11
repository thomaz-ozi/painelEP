<?php 	
//----------> ATIVAR/DESATIVAR MODULOS  <-------
		//COMPARA E INICIAR O MODULO ...
		if($_SESSION['startmod']=='contato'){
	if (($row_perfusuario['id_perm_status_usuario_contato']<=3)and($row_perfusuario['id_perm_status_usuario_contato']>=1)) {			
			 $conf_url="../sistema_contato/";
		switch($conteudo){
//---------------------------------------------------------> INICIADO URL
		case 'contato':
			$modulo_local=$conf_url."acao_alt_conf_empresa.php";
			break;
		default:
	}include $conf_url."conf.php";		
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}


?>