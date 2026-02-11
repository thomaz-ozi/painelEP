<?php 	

if($_SESSION['startmod']=='local_perm'){
if (($row_perfusuario['id_perm_status_usuario_local']<=3)and($row_perfusuario['id_perm_status_usuario_local']>=1)) {	
	$conf_url="../sistema_empresa_local_permissao/";			
		switch($conteudo){

//--------------------------------------- inicio do FAZENDA
		case 'local_perm':
			$modulo_local= $conf_url."index.php";
			break;
		case 'local_perm-add':
			$modulo_local= $conf_url."acao_add.php";
			break;
		case 'local_perm-alt':
			$modulo_local= $conf_url."acao_alt.php";
			break;
		case 'local_perm-exc':
			$modulo_local= $conf_url."acao_exc.php";
			break;
	default:
	}include $conf_url."conf.php";
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}


?>