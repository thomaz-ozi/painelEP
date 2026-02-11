<script>


//----------------------------> pesquisa avancada BOTÃO

$(function(){
	var 	bt='<div class="btn-group">';
			bt+='<?php if ($pageNum_list_acao > 0) { // Show if not first page ?><button type="button" class="btn btn-default" id="btVoltar"><i class="fa fa-caret-left"></i></button><?php } // Show if not first page ?>';
			
			bt+='<button type="button" class="btn btn-default" title="Total de registro encontrados" >';
			bt+=' <?php echo ($startRow_list_acao ) ?> ';
			bt+='&nbsp;at&eacute;<?php echo min($startRow_list_acao + $maxRows_list_acao, $totalRows_list_acao) ?>';
			bt+='&nbsp;para&nbsp;<?php echo $totalRows_list_acao ?>';
			bt+='</button>';
			bt+='<?php if ($pageNum_list_acao < $totalPages_list_acao) { // Show if not last page ?><button type="button" class="btn btn-default" id="btAvanca"><i class="fa fa-caret-right"></i></button><?php } // Show if not last page ?>';
			bt+='</div>';
$("#BarraPesquisaAvancadaLoad").html(bt);

		
//----------------------------> pesquisa avançada 

	encapsularBtAvanca='<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, min($totalPages_list_acao, $pageNum_list_acao + 1), $queryString_list_acao); ?>','&xPesq=<?php echo $_POST[xPesq];  ?>&PesquisaAvancadaColunas=<?php echo $_POST[PesquisaAvancadaColunas];  ?>'; 


$('#btAvanca').click(function(){
	var PesquisaAvancadaColunas= $("#PesquisaAvancadaColunas option:selected").val();
		loadsData('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_alt_load.php<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, min($totalPages_list_acao, $pageNum_list_acao + 1), $queryString_list_acao); ?>','&xPesq=<?php echo $_POST[xPesq];  ?>&PesquisaAvancadaColunas=<?php echo $_POST[PesquisaAvancadaColunas];  ?>');
		
	});
	
$('#btVoltar').click(function(){
	var PesquisaAvancadaColunas= $("#PesquisaAvancadaColunas option:selected").val();
		loadsData('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_alt_load.php<?php printf("%s?pageNum_list_acao=%d%s", $currentPage, max(0, $pageNum_list_acao - 1), $queryString_list_acao); ?>','&xPesq=<?php echo $_POST[xPesq];  ?>&PesquisaAvancadaColunas=<?php echo $_POST[PesquisaAvancadaColunas];  ?>');
	});	
});
</script>