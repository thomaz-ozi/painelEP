
<?php if($_POST['cpfPesq']!="1"){?>
<script src="../mod_iep_candidatos/script_acao_pesq.js"></script>
<script src="../mod_iep_candidatos/script_cep.js"></script>

<?php include ("acao_pesq.php");
}?>
<style>
.x_content {

    background-color: #E5E5E5;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}

</style>


<?php 
/*$acao_comum="Alterar";
$acao_icons="alt-30.png";
include ("../sistema/index_content_head.php");*/?>

<div id="divPesq">
<div id="PesquisaAvancadaLoad">
<?php include ("../mod_iep_candidatos/acao_alt_load.php");?>
</div>
<div id="msn"></div>

<?php include ("../mod_iep_candidatos/acao_alt_load_pesquisa.php");?>

 </div>

