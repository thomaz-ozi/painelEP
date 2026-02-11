<?php
//iniciar configuração de permissão
if($_SESSION['startmod']=='versao'){
	if (($row_perfusuario['id_perm_status_usuario_versao']<=3)and($row_perfusuario['id_perm_status_usuario_versao']>=1)) {			
		$conf_url="../sistema_versao/";
					
		switch($conteudo){
		case 'versao':
			$modulo_local= $conf_url."index.php";
			break;
		case 'versao-add':
			$modulo_local= $conf_url."acao_add.php";
			break;
		case 'versao-alt':
			$modulo_local= $conf_url."acao_alt.php";
			break;
		case 'versao-exc':
			$modulo_local= $conf_url."acao_exc.php";
			break;

	default:
	}include $conf_url."conf.php";
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>