5555<?php 	
echo $row_perfusuario['id_perm_status_pess_clientes'];
//-----------------------------------------------------------------------------> MODULO CLIENTE
if($_SESSION['startmod']=='empresa_clientes'){
	if (($row_perfusuario['id_perm_status_pess_clientes']<=3)and($row_perfusuario['id_perm_status_pess_clientes']>=1)) {			

			$conf_url="../mod_empresa_clientes/";	
			
		switch($conteudo){

//---------------------------------------------------------> INICIADO URL
		case 'clien':
			$modulo_local=$conf_url."index.php";
			break;
		case 'clien-add':
			$modulo_local=$conf_url."acao_add.php";
			break;
		case 'clien-alt':
			$modulo_local=$conf_url."acao_alt.php";
			break;
		case 'clien-exc':
			$modulo_local=$conf_url."acao_exc.php";
			break;
	default:
}include $conf_url."conf.php";		
}else{ $modulo_local= "sem_permissao.php"; include "../sistema_inicio/conf.php"; }}

?>