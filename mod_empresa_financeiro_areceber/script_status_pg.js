// JavaScript Document

$(function(){
$('.bt_pgn').click(function(){
	var bt_pgn=$(this).val();
	  loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_pgn.php',bt_pgn);
   });   
 $('.bt_pg').click(function(){
	var bt_pg=$(this).val();
	  loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_pg.php',bt_pg);
   });   
$('.bt_cob').click(function(){
	var bt_can=$(this).val();
	  loadsDataAbsoluto('#LoadOpcoes','../mod_empresa_financeiro_areceber/load_cobranca.php',bt_can);
   });   
});
