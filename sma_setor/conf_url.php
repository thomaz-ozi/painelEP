<?php 	

//-----------------------------------------------------------------------------> MODULO AGENDA
// verivicação de permissão...
//----------> ATIVAR/DESATIVAR MODULOS para o FAZENDA <-------
// Configurar Perfil do Usuario "../funcoes/perfilusuario.php
if ($row_perfusuario['adm_mod_cad_setor']==1) {
					//COMPARA E INICIAR O MODULO ...
		if($_SESSION['startmod']=='setor'){
			
		switch($conteudo){

//--------------------------------------- inicio do FAZENDA
		case 'setor':
			$modulo_local="../sma_setor/index.php";
			break;
		case 'setor-add':
			$modulo_local= "../sma_setor/acao_add.php";
			break;
		case 'setor-alt':
			$modulo_local= "../sma_setor/acao_alt.php";
			break;
		case 'setor-exc':
			$modulo_local= "../sma_setor/acao_exc.php";
			break;
	default:
	}			
				include "../sma_setor/conf.php";
	}}

?>