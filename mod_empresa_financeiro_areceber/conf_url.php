<?php 	
if($_SESSION['startmod']=='areceber'){
	if (($row_perfusuario['id_perm_status_prod_opcoes']<=3)and($row_perfusuario['id_perm_status_prod_opcoes']>=1)) {	
			$conf_url="../mod_empresa_financeiro_areceber/";	
		switch($conteudo){
		case 'areceber':
			$modulo_local=$conf_url."index.php";
			break;
		case 'areceber-add':
			$modulo_local=$conf_url."acao_add.php";
			break;
		case 'areceber-alt':
			$modulo_local=$conf_url."acao_alt.php";
			break;
		case 'areceber-can':
			$modulo_local=$conf_url."acao_can.php";
			break;
	default:
}include $conf_url."conf.php";		
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>