<?php 	
if($_SESSION['startmod']=='candidatos'){
	echo $row_perfusuario['id_perm_status_pess_funcionario'];
	if (($row_perfusuario['id_perm_status_pess_funcionario']<=3)and($row_perfusuario['id_perm_status_pess_funcionario']>=1)) {	
			$conf_url="../mod_iep_candidatos/";	
		switch($conteudo){
		case 'candidatos':
			$modulo_local=$conf_url."index.php";
			break;
		case 'candidatos-add':
			$modulo_local=$conf_url."acao_add.php";
			break;
		case 'candidatos-alt':
			$modulo_local=$conf_url."acao_alt.php";
			break;
		case 'candidatos-exc':
			$modulo_local=$conf_url."acao_del.php";
			break;
	default:
}include $conf_url."conf.php";		
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>