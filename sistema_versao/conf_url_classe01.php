
<?php
if($_SESSION['startmod']=='versao_class01'){
	echo $conf_url="../sistema_versao/";
		switch($conteudo){
		case 'versao_class01':
		echo	$modulo_local= $conf_url."index_classe01.php";
			break;
		case 'versao_class01-add':
			$modulo_local= $conf_url."classe01_acao_add.php";
			break;
		case 'versao_class01-alt':
			$modulo_local= $conf_url."classe01_acao_alt.php";
			break;
		case 'versao_class01-exc':
			$modulo_local= $conf_url."classe01_acao_excluir.php";
			break;
	default:
}include $conf_url."conf_classe01.php";	}

?>	