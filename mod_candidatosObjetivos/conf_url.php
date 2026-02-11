<?php 	
//-----------------------------------------------------------------------------> MODULO CLIENTE
if($_SESSION['startmod']=='Objetivos'){
	if (($row_perfusuario['id_perm_status_pess_clientes']<=3)and($row_perfusuario['id_perm_status_pess_clientes']>=1)) {			

			$conf_url="../mod_candidatosObjetivos/";	
			
		switch($conteudo){

//---------------------------------------------------------> INICIADO URL
		case 'CandObjetivos':
			$modulo_local=$conf_url."index.php";
			break;
		case 'CandObjetivos-add':
			$modulo_local=$conf_url."acao_add.php";
			break;
		case 'CandObjetivos-alt':
			$modulo_local=$conf_url."acao_alt.php";
			break;
		case 'CandObjetivos-exc':
			$modulo_local=$conf_url."acao_exc.php";
			break;
	default:
}include $conf_url."conf.php";		
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>