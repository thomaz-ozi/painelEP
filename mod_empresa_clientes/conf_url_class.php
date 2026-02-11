<?php
		if($_SESSION['startmod']=='empresa_clientes_class'){
	if ($row_perfusuario['id_perm_status_pess_clientes']==1) {		
		$conf_url="../mod_empresa_clientes/";
					
		switch($conteudo){
		case 'clien_class':
			$modulo_local= $conf_url."index_class.php";
			break;
		case 'clien_class-add':
			$modulo_local= $conf_url."class_acao_add.php";
			break;
		case 'clien_class-alt':
			$modulo_local= $conf_url."class_acao_alt.php";
			break;
		case 'clien_class-exc':
			$modulo_local= $conf_url."class_acao_exc.php";
			break;
		default:
	}include $conf_url."conf_class.php";}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>	