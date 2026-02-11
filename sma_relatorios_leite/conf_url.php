<?php 	

//-----------------------------------------------------------------------------> MODULO AGENDA

if($_SESSION['startmod']=='reletorio_leite'){
	$conf_url="../sma_relatorios_leite/";
	switch($conteudo){
	
	case 'animais':
		$modulo_local=$conf_url."index.php";
		break;
	case 'animais-add':

//--------------------------------------- inicio do FAZENDA
		case 'relatorios':
			$modulo_local=$conf_url."index.php";
			break;
		case 'relatorios-add':
			$modulo_local= $conf_url."acao_add.php";
			break;
			
		case 'relatorios-abat':
			$modulo_local= $conf_url."index_abatidos.php";
			break;
		case 'relatorios-add_rapido':
			$modulo_local= $conf_url."acao_add_rapido.php";
			break;
		case 'relatorios-add_res':
			$modulo_local= $conf_url."res_add2.php";
			break;

		case 'relatorios-alt':
			$modulo_local= $conf_url."acao_alt.php";
			break;
		case 'relatorios-rel':
			$modulo_local= $conf_url."acao_rel_animal_manejo.php";
			break;
		case 'relatorios-exc':
			$modulo_local= $conf_url."acao_exc.php";
			break;
	default:
	}			
				//carrega cas configuracoes do modulo
				include $conf_url."conf.php";
	}

?>