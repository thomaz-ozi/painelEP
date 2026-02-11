

<?php include ("../sistema/index_content_head.php");?>


<?php // include ("../DOCs_layout/index_graficos.php");?>
<?php if($_GET['local']=='selec'){include('../sistema_empresa_local/local_select.php');} ?>



<div class="x_title">

<div class="col-md-2 "><img src="../mod_images/logo.jpg" alt="..." class="img-circle profile_img"></div>
<h2>IEP- Instituto de Educação Profissional e Recursos Humanos Ltda.</h2>



<div class="clearfix"></div>
</div>
<?php // include ("../mod_empresa_financeiro_areceber/index_painel.php");?>


<div class="col-md-12 col-sm-12 col-xs-12">
<?php //include ("../mod_empresa_vendas_pedidos/acao_add_verificacao_parcelas_periodo.php");?>
</div>
<?php 

$edit_texto=$_GET['edit_texto'];

switch ($edit_texto){
	
	case '1':
	include ("acao_alt.php");
	break;
	case '2':
	include ("");
	break;
}
?>
