<?php
//permissao
if($conteudo=='perm_empresa'){
	$modulo_local= "../mod_empresa/index.php";
	$sistema_nome_perm='Mod Empresa';
}
######################################### MODULO EMPRESA ############################################
######################################### SUBMODULO P.FÍSICA/P.JURÍDICA ##########################################
//--------------------------------------------------------------------------> APLICATIVO  EMPRESA  CLIENTES
include ("../mod_empresa_clientes/conf_url.php");
include ("../mod_empresa_clientes/conf_url_class.php");
//--------------------------------------------------------------------------> APLICATIVO  EMPRESA  FORNECEDORES
include ("../mod_empresa_fornecedores/conf_url.php");
include ("../mod_empresa_fornecedores/conf_url_atuacao.php");

//--------------------------------------------------------------------------> APLICATIVO  EMPRESA  FUNCIONARIOS
include ("../mod_empresa_funcionarios/conf_url.php");
//include ("../mod_empresa_funcionarios/conf_url_atuacao.php");


############################################# SUBMODULO  PRODUTOS/SERVIÇÕS  #####################################

//--------------------------------------------------------------------------> APLICATIVO  PRODUTOS
include ("../mod_empresa_produtos/conf_url.php");
//--------------------------------------------------------------------------> APLICATIVO  PRODUTOS SETOR
include ("../mod_empresa_produtos_classificacao/conf_url_setor.php");
//--------------------------------------------------------------------------> APLICATIVO  PRODUTOS CATEGORIA
include ("../mod_empresa_produtos_classificacao/conf_url_categoria.php");
//--------------------------------------------------------------------------> APLICATIVO  PRODUTOS SUBCATEGORIA
include ("../mod_empresa_produtos_classificacao/conf_url_subcategoria.php");
##################  OPÇÕES DOS PRODUTOS
//--------------------------------------------------------------------------> APLICATIVO  PRODUTOS CATEGORIA
include ("../mod_empresa_produtos_marcas/conf_url.php");
//--------------------------------------------------------------------------> APLICATIVO  PRODUTOS SUBCATEGORIA
include ("../mod_empresa_produtos_volt/conf_url.php");
##################  OPÇÕES DOS SERVIÇOS
//--------------------------------------------------------------------------> APLICATIVO  SERVIÇOS
include ("../mod_empresa_produtos_servicos/conf_url.php");
####
//--------------------------------------------------------------------------> APLICATIVO  PROPAGANDA PRODUTOS E SERVIÇOS
//include ("../mod_empresa_propaganda/conf_url.php");

//--------------------------------------------------------------------------> APLICATIVO  QRCOD
include ("../mod_empresa_qrcod/conf_url.php");
############################################# IMPOSTOS ##########################################
##################  IMPOSTOS PRODUTOS
//--------------------------------------------------------------------------> APLICATIVO  PRODUTOS CATEGORIA
include ("../mod_empresa_impostos_produtos/conf_url.php");

##################  IMPOSTOS SERVIÇOS
//--------------------------------------------------------------------------> APLICATIVO  PRODUTOS CATEGORIA
include ("../mod_empresa_impostos_rh/conf_url.php");
##################  IMPOSTOS RH
//--------------------------------------------------------------------------> APLICATIVO  PRODUTOS CATEGORIA
include ("../mod_empresa_impostos_servicos/conf_url.php");

######################################### SUBMODULO VENDAS ##########################################
//--------------------------------------------------------------------------> SUBMODULO  VENDAS
//include ("../mod_empresa_vendas/conf_url.php");

######################################### E-MAIL ##########################################
//--------------------------------------------------------------------------> SUBMODULO  EMAIL
include ("../mod_empresa_email/conf_url.php");
//--------------------------------------------------------------------------> SUBMODULO  EMAIL MENSAGEM
include ("../mod_empresa_email_msn/conf_url.php");

######################################################################################################
######################################### FINANCEIRO #################################################

include ("../mod_empresa_financeiro/conf_url.php");


######################################################################################################
######################################### PEDIDOS ####################################################

include ("../mod_empresa_pedidos/conf_url.php");

