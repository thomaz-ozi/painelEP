<?php 
//versão
$versao="V: 2.4";
//icones
$icons_sistema_categoria= "produto-55.png";
$icons_sistema_nome= "produto-30.png";
//Nome do Modulos
$sistema_categoria="Produstos";
$sistema_nome="Textos";
//ID da tabela do banco de dados
$id_sistema="id_produtos";
//link do conteudo
$conteudo_inf="prod";

//EDITAR ITENS DO PRODUTOS
//1=Ativado
//2=Desativado OU COMENTADO
$cliente_mod_produtos_volt=2;
$cliente_mod_produtos_cod_loja=2;
$cliente_mod_produtos_cod_barra=2;
$cliente_mod_produtos_cod_fabricante=2;
$cliente_mod_produtos_qtdd=2;
$cliente_mod_produtos_qtdd_mini=2;
$cliente_mod_produtos_cores=2;
$cliente_mod_produtos_marcas=2;
$cliente_mod_produtos_dimencoes=2;
$cliente_mod_produtos_desc_tec=2;
$cliente_mod_produtos_valor_custo=2;
$cliente_mod_produtos_valor=2;
$cliente_mod_produtos_valor_promocao=2;
$cliente_mod_produtos_forma_pagamento=2;
//---------- nomeclaturas
$cliente_mod_produtos_nome_produtos='Titulo';
$cliente_mod_produtos_descricao='Texto';
$cliente_mod_produtos_tec='Dados Tecnicos';
$cliente_mod_produtos_imagens='Imagens';

//-------------------------- PRUDOTUS ORDEM
if($_GET['conteudo']==empresa_ordem){
	include ("../empresa_ordem_servicos/conf.php");
	}else{
		//retira os 4 caracteres da letra
		$subconteudo = substr($_GET['conteudo'], 0, -4);
			if($subconteudo==empresa_ordem){
			include ("../empresa_ordem_servicos/conf.php");
	}}	


//-------------------------- PRUDOTUS ORDEM - TIPO
if($_GET['conteudo']==empresa_ordem_tipo){
	include ("../empresa_ordem_servicos/conf_tipo.php");
	}else{
		//retira os 4 caracteres da letra
		$subconteudo = substr($_GET['conteudo'], 0, -4);
			if($subconteudo==empresa_ordem_tipo){
			include ("../empresa_ordem_servicos/conf_tipo.php");
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