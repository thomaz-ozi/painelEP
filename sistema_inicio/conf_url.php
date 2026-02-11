<?php 
//-----------------------------------------------------------------------------> INICIANDO SISTEMA
// verivicação de permissão...
//----------> ATIVAR/DESATIVAR   <-------

if(empty($_SESSION['startmod'])){
		$conf_url="../sistema_inicio/";
		
				$modulo_local=  $conf_url."index.php";
				include $conf_url."conf.php";
	}
?>
