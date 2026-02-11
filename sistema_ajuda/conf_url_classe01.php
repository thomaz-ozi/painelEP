
<?php
if($_SESSION['startmod']=='ajuda_tutorial01'){
	$conf_url="../sistema_ajuda/";
		switch($conteudo){
		case 'tutorial01':
			$modulo_local= $conf_url."index_classe01.php";
			break;
		case 'tutorial01-add':
			$modulo_local= $conf_url."classe01_acao_add.php";
			break;
		case 'tutorial01-alt':
			$modulo_local= $conf_url."classe01_acao_alt.php";
			break;
		case 'tutorial01-exc':
			$modulo_local= $conf_url."classe01_acao_excluir.php";
			break;

	default:
	}include $conf_url."conf_classe01.php";}

?>	