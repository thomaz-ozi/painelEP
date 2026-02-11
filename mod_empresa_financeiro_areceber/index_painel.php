<?php require_once('../Connections/connection.php'); ?>
<?php
	require_once "../sistema_funcoes/converte_datas.php";
	require_once "../sistema_funcoes/converte_datas_horas.php";
	require_once("../sistema_funcoes/extrair_data.php");
	require_once "../sistema_funcoes/converter_numero_moeda.php"; 
	require_once "../sistema_funcoes/limit_txt.php"; 
 ?>
 
 <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top">R<i class="fa fa-dollar"></i> Total Vencido</span>
              <div class="count"><?php include ("../mod_empresa_financeiro_areceber/index_painel_vencido.php"); echo converter_numero_moeda( $row_list_vencido['total']); ?></div>
            </div>
            
            <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top">R<i class="fa fa-dollar"></i>  Total a Vencer</span>
              <div class="count"><?php include ("../mod_empresa_financeiro_areceber/index_painel_vencer.php"); echo converter_numero_moeda( $row_list_vencer['total']); ?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top">R<i class="fa fa-dollar"></i> Total a Receber (vencido+ Vencer) 	</span>
              <div class="count "><?php echo  converter_numero_moeda( $receber=$row_list_vencer['total']+$row_list_vencido['total']); ?></div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top">R<i class="fa fa-dollar"></i>  Total Recebido</span>
              <div class="count"><?php include ("../mod_empresa_financeiro_areceber/index_painel_recebido.php"); echo converter_numero_moeda($row_list_recebido['total']); ?></div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top">R<i class="fa fa-dollar"></i> Total(AReceber + Recebido)</span>
              <div class="count green"><?php echo   converter_numero_moeda($receber+$row_list_recebido['total']);?></div>
            </div>
         </div>
          <!-- /top tiles -->
 
 

