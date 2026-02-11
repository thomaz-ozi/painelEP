<?php 	
if($_SESSION['startmod']=='produtos'){
	if (($row_perfusuario['id_perm_status_prod_prod']<=3)and($row_perfusuario['id_perm_status_prod_prod']>=1)) {			
			$conf_url="../mod_empresa_produtos/";	
		switch($conteudo){
		case 'prod':
			$modulo_local=$conf_url."index.php";
			break;
		case 'prod-add':
			$modulo_local=$conf_url."acao_add.php";
			break;
		case 'prod-alt':
			$modulo_local=$conf_url."acao_alt.php";
			break;
		case 'prod-exc':
			$modulo_local=$conf_url."acao_exc.php";
			break;
	default:
}include $conf_url."conf.php";		
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>