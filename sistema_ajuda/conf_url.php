<?php
//iniciar configuração de permissão
if($_SESSION['startmod']=='ajuda_tutorial'){
	if (($row_perfusuario['id_perm_status_usuario_ajuda']<=3)and($row_perfusuario['id_perm_status_usuario_ajuda']>=1)) {			
		$conf_url="../sistema_ajuda/";
					
		switch($conteudo){
		case 'tutorial':
			$modulo_local= $conf_url."index.php";
			break;
		case 'tutorial-add':
			$modulo_local= $conf_url."acao_add.php";
			break;
		case 'tutorial-alt':
			$modulo_local= $conf_url."acao_alt.php";
			break;
		case 'tutorial-ver':
			$modulo_local= $conf_url."acao_ver.php";
			break;
		case 'tutorial-exc':
			$modulo_local= $conf_url."acao_exc.php";
			break;

	default:
	}include $conf_url."conf.php";
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>