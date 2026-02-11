<?php
//copiado de notivia p produtos
	$imagens_edit=$_GET['imagens_edit'];
	
	switch($imagens_edit){
//-----------------------------------------------------------------> IMAGEM-1
// -----------------------------------------ADINIONAR IMAGEM-1
		case 'imagens_add1':
			include "foto.php";
			break;
// -----------------------------------------ALTERAR IMAGEM-1			
		case 'imagens_alt1':
			include "foto.php";
			break;
// -----------------------------------------ADINIONAR/ALTERAR IMAGEM CONCLUIDA -1
		case 'imagens_edit1':
			$img_full='img1'; 
			$largura_full= 'largura1'; 
			$altura_full='altura1';
			$nome_dimencao_full='nome_dimencao1';
			include "foto_acao.php";
			break;
//------------------------------------------> EXCLUIR - 1
// 04/11/2009
		case 'imagens_exc1':
			include "foto_exc.php";
			break;
//------------------------------------------> EXCLUIR - ACAO -1
// 04/11/2009
		case 'imagens_exc11':
			include "foto_exc_acao.php";
			break;
//-----------------------------------------------------------------> IMAGEM-2
// -----------------------------------------ADINIONAR IMAGEM-2
		case 'imagens_add2': 
			include "foto.php";
			break;
// -----------------------------------------ALTERAR IMAGEM-2			
		case 'imagens_alt2':
			include "foto.php";
			break;
// -----------------------------------------ADINIONAR/ALTERAR IMAGEM CONCLUIDA -2
		case 'imagens_edit2':
			$img_full='img2'; 
			$largura_full= 'largura2'; 
			$altura_full='altura2';
			$nome_dimencao_full='nome_dimencao2';
			include "foto_acao.php";
			break;
//------------------------------------------> EXCLUIR - 2
// 04/11/2009
		case 'imagens_exc2':
			include "foto_exc.php";
			break;
//------------------------------------------> EXCLUIR - ACAO -2
// 04/11/2009
		case 'imagens_exc22':
			include "foto_exc_acao.php";
			break;

//-----------------------------------------------------------------> IMAGEM-3
// -----------------------------------------ADINIONAR IMAGEM-3
		case 'imagens_add3':
			include "foto.php";
			break;
// -----------------------------------------ALTERAR IMAGEM-3			
		case 'imagens_alt3':
			include "foto.php";
			break;
// -----------------------------------------ADINIONAR/ALTERAR IMAGEM CONCLUIDA -3
		case 'imagens_edit3':
			$img_full='img3'; 
			$largura_full= 'largura3'; 
			$altura_full='altura3';
			$nome_dimencao_full='nome_dimencao3';
			include "foto_acao.php";
			break;
//------------------------------------------> EXCLUIR - 3
// 04/11/2009
		case 'imagens_exc3':
			include "foto_exc.php";
			break;
//------------------------------------------> EXCLUIR - ACAO -3
// 04/11/2009
		case 'imagens_exc33':
			include "foto_exc_acao.php";
			break;

//-----------------------------------------------------------------> IMAGEM-4
// -----------------------------------------ADINIONAR IMAGEM-4
		case 'imagens_add4':
			include "foto.php";
			break;
// -----------------------------------------ALTERAR IMAGEM-4			
		case 'imagens_alt4':
			include "foto.php";
			break;
// -----------------------------------------ADINIONAR/ALTERAR IMAGEM CONCLUIDA -4
		case 'imagens_edit4':
			$img_full='img4'; 
			$largura_full= 'largura4'; 
			$altura_full='altura4';
			$nome_dimencao_full='nome_dimencao4';
			include "foto_acao.php";
			break;
//------------------------------------------> EXCLUIR - 4
// 04/11/2009
		case 'imagens_exc4':
			include "foto_exc.php";
			break;
//------------------------------------------> EXCLUIR - ACAO -4
// 04/11/2009
		case 'imagens_exc44':
			include "foto_exc_acao.php";
			break;

//-----------------------------------------------------------------> IMAGEM-5
// 30/11/2009
// -----------------------------------------ADINIONAR IMAGEM-5
		case 'imagens_add5':
			include "foto.php";
			break;
// -----------------------------------------ALTERAR IMAGEM-5			
		case 'imagens_alt5':
			include "foto.php";
			break;
// -----------------------------------------ADINIONAR/ALTERAR IMAGEM CONCLUIDA -5
		case 'imagens_edit5':
			$img_full='img5'; 
			$largura_full= 'largura5'; 
			$altura_full='altura5';
			$nome_dimencao_full='nome_dimencao5';
			include "foto_acao.php";
			break;
//------------------------------------------> EXCLUIR - 5
// 30/11/2009
		case 'imagens_exc5':
			include "foto_exc.php";
			break;
//------------------------------------------> EXCLUIR - ACAO -5
// 30/11/2009
		case 'imagens_exc55':
			include "foto_exc_acao.php";
			break;


default:
	}
?>