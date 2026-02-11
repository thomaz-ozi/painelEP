<?php 	
if($_SESSION['startmod']=='candidatosRelatorios'){
	if (($row_perfusuario['id_perm_status_pess_funcionario']<=1)and($row_perfusuario['id_perm_status_pess_funcionario']>=1)) {	
			$conf_url="../mod_candidatosRelatorios/";	
		switch($conteudo){
		case 'relNome':
			$modulo_local=$conf_url."relNome.php";
			break;
		case 'relBairro':
			$modulo_local=$conf_url."relBairro.php";
			break;
		case 'relObjetivo':
			$modulo_local=$conf_url."relObjetivo.php";
			break;

	default:
}include $conf_url."conf.php";		
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>