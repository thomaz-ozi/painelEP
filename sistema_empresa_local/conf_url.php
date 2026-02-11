<?php 	
//COMPARA E INICIAR O MODULO ...
if($_SESSION['startmod']=='cadas_local'){
if (($row_perfusuario['id_perm_status_usuario_local']<=3)and($row_perfusuario['id_perm_status_usuario_local']>=1)) {						
			$conf_url="../sistema_empresa_local/";
			
		switch($conteudo){

//--------------------------------------- inicio do FAZENDA
			case 'local':
			$modulo_local= $conf_url."index.php";
			break;
		
		case 'local-add':
			$modulo_local= $conf_url."acao_add.php";
			break;
		case 'local-alt':
			$modulo_local= $conf_url."acao_alt.php";
			break;
		case 'local-exc':
			$modulo_local= $conf_url."acao_exc.php";
			break;
	default:
			$modulo_local=$conf_url."index.php";
			break;
	}include $url_conf."conf.php";	
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}


?>