<?php 
//versão
$versao="V: 3.3";
//icones
$icons_sistema_categoria= $conf_url."icons/default.png";
$icons_sistema_nome= $conf_url."icons/default.png";
//Nome do Modulos
$sistema_categoria="Produstos&nbsp;&nbsp;";
$sistema_nome="Produstos&nbsp;&nbsp;";
//ID da tabela do banco de dados
$id_sistema="id_produtos";
//link do conteudo
$conteudo_inf="prod";

//SETOR
$opcao_setor='-list_setor';
//categoria
$opcao_cat='_cat';

//EDITAR ITENS DO PRODUTOS
//1=Ativado
//2=Desativado OU COMENTADO
$cliente_mod_produtos_volt=1;
$cliente_mod_produtos_cod_loja=1;
$cliente_mod_produtos_cod_barra=2;
$cliente_mod_produtos_cod_fabricante=1;
$cliente_mod_produtos_qtdd=1;
$cliente_mod_produtos_qtdd_mini=1;
$cliente_mod_produtos_cores=2;
$cliente_mod_produtos_marcas=1;
$cliente_mod_produtos_dimencoes=2;
$cliente_mod_produtos_desc_tec=1;
$cliente_mod_produtos_valor_custo=1;
$cliente_mod_produtos_valor=1;
$cliente_mod_produtos_valor_promocao=1;
$cliente_mod_produtos_forma_pagamento=1;
$cliente_mod_produtos_vitrine=1;

//---------- nomeclaturas
$cliente_mod_produtos_nome_produtos='Nome do Produto';
$cliente_mod_produtos_descricao='Descri&ccedil;&atilde;o do Produto';
$cliente_mod_produtos_tec='Dados Tecnicos';
$cliente_mod_produtos_imagens='Imagens';

//-------------------------- PRUDOTUS MARCAS
if($_GET['conteudo']==prod_marcas){
	include ("conf_marcas.php");
	}else{
		//retira os 4 caracteres da letra
		$subconteudo = substr($_GET['conteudo'], 0, -4);
			if($subconteudo==prod_marcas){
			include ("conf_marcas.php");
	}}	
	//------------------------ PRODUTOS CORES
if($_GET['conteudo']==prod_cores){
	include ("conf_cores.php");
	}else{
		//retira os 4 caracteres da letra
		$subconteudo = substr($_GET['conteudo'], 0, -4);
			if($subconteudo==prod_cores){
			include ("conf_cores.php");
	}}
	//---------------------- PRODUTOS DIMENCAO
if($_GET['conteudo']==prod_dimen){
	include ("conf_dimen.php");
	}else{
		//retira os 4 caracteres da letra
		$subconteudo = substr($_GET['conteudo'], 0, -4);
			if($subconteudo==prod_dimen){
			include ("conf_dimen.php");
	}}

//Só é abilitado nas versões "Next Sistem Web" mais baixas"
// insira o caminho p conf para as versões EX:
/*  <?php  include "../produtos/conf_produtos.php"; ?> */
		//------------------------> Versão 3.X
		//$usuario_get="usuario=".$_GET['usuario']."&";
		//-------------------------> Versão 3.o
		//$local_icons="../icons/";
		//-------------------------> Versão 3.1
		//$local_icons="../icons/circulo_red/";
		


?>