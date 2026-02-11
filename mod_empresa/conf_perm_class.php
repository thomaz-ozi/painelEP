<script>
$(function() {
	
$("#p_assunto").select();

	
	
$('.fecharmsn').click(function(){
	$('#class_funcao').html('');
	$('#id_class').val('');
	});	
});
function pesquisar(){
	var p_assunto=$("#p_assunto").val();
	var id_pesquisa=$("#id_pesquisa").val();
	loadsData('#pesquisar_assunto','../mod_empresa/conf_perm_class_func.php',p_assunto+'&id_pesquisa='+id_pesquisa)
}	
function selecionado(id,text){
	$('#class_funcao').html('<input name="id_pesquisa" id="id_pesquisa" type="hidden" value="'+id+'">'+text);
}	
</script>
<div  class="div_absolute"></div>
<div  class="div_absolute_msn"> <br>
<br>
<br>
<br>

<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr class="txt-indece-titulo">
    <td width="679" align="center">Pesquisar o assunto</td>
    <td width="21"><img  class="fecharmsn" src="../sistema_aparencia/icons/fechar-25.png" width="25" height="25"></td>
  </tr>
  <tr class="txt-indece-titulo">
    <td align="center">
<?php
  switch ($_POST['content']){
  case 1://cliente
	  echo "Cliente";
  break;
  case 2://Fornecedor
	  echo "Fornecedor";
  break;
  case 3://Funcionario
	  echo "Colaborador e Tercerizados";
  break;
  }
?></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="txt-indece-titulo">
    <td align="center"><input name="id_pesquisa" id="id_pesquisa" type="hidden" value="<?php echo $_POST['content']; ?>">
      <input type="text" name="p_assunto" id="p_assunto"  onKeyUp="pesquisar()">
      <input type="submit" name="button" id="button" value="pesquisar">
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="txt"> <div style="overflow:auto; height:200px;" id="pesquisar_assunto"></div>
    </td>
    </tr>
  <tr class="txt-indece-titulo">
    <td colspan="2">&nbsp;</td>
    </tr>
</table>

</div>