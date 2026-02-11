&nbsp;

<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="../sistem_funcoes/openWindow.js" type="text/javascript"></script>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="texto">
  <tr>
    <td colspan="4" align="center" bgcolor="#FFFFFF" class="txt-Indece"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  align="center"><img src="<?php echo "$local_icons"; ?><?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
        <td >&nbsp;&nbsp;<?php echo "$sistema_nome"; ?> &nbsp;<?php echo "$versao"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <form id="qtdd" name="qtdd" method="get" action="?">
          </form>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="4" align="center"   class="txt">
      <form action="../sma_relatorios/relatorios_manejo_animal.php?" method="get" name="pesquisa" target="_blank" id="pesquisa">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" class="txt-Indece">Relatório por animal</td>
            </tr>
          <tr>
            <td align="center" class="txt"><span id="sprytextfield2">
              <input name="conteudo" type="hidden" id="conteudo" value="<?php echo $_GET['conteudo']; ?>" />
              <input name="list_qtdd" type="hidden" id="list_qtdd" value="<?php echo $_GET['list_qtdd']; ?>" />
              <input name="cod_animal" type="text" class="txt-form" id="cod_animal" value="<?php echo $_GET['cod_animal']; ?>" size="40" />
              </span>                <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar por animal" class="txt-Botao-ADD"  onclick="acao()"/>
              <br /><br />
</td>
            </tr>
        </table>
        </form>    </td>
  </tr>
  <tr>
    <td width="157" align="center" bgcolor="#FFFFFF"  class="txt-Indece">    
    ANIMAIS</td>
    <td width="221" align="center" bgcolor="#FFFFFF"  class="txt-Indece">LOTE</td>
    <td width="221" align="center" bgcolor="#FFFFFF"  class="txt-Indece">ABATIVOS</td>
    <td align="center" bgcolor="#FFFFFF"  class="txt-Indece">STATUS</td>
  </tr>

  <tr class="txt" >
    <td align="center" ><input type="button" name="Relatorio dos animais" id="Relatorio dos animais" value="Lista do animais " 
       onclick="MM_openBrWindow('../sma_relatorios/relatorios_manejo_animais_filtro.php','','status=yes,scrollbars=yes,resizable=yes,width=1024')" /></td>
    <td align="center" ><input type="button" name="Relatórios animais vendidos " id="Relatórios animais vendidos " value="Lista de LOTES" 
       onclick="MM_openBrWindow('../sma_relatorios/lote_peso_qtdd_animais.php','','status=yes,scrollbars=yes,resizable=yes')" /></td>
    <td align="center" ><input type="button" name="Relatorio dos LOTES" id="Relatorio dos animais abatidos2" value="Lista animais abatidos" 
       onclick="MM_openBrWindow('../sma_relatorios/relatorio_list_animais_abate_filtro.php','','status=yes,scrollbars=yes,resizable=yes,height=768')" /></td>
    <td align="center" ><input type="button" name="Relatorio dos animais abatidos" id="Relatorio dos animais abatidos" value="Status de lista animais" 
       onclick="MM_openBrWindow('../sma_relatorios/relatorio_list_animais_stats.php','','status=yes,scrollbars=yes,resizable=yes,height=768')" /></td>
  </tr>
  <tr class="txt" >
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr class="txt" >
    <td align="center" >PESO</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr class="txt" >
    <td align="center" ><input type="button" name="Relatorio dos animais abatidos2" id="Relatorio dos animais abatidos3" value="Média de peso" 
       onclick="MM_openBrWindow('../sma_relatorios/relatorio_list_animais_peso.php','','status=yes,scrollbars=yes,resizable=yes,height=768')" /></td>
    <td align="center" >teste</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr class="txt" >
    <td colspan="4" align="center" >&nbsp;</td>
  </tr>  



  <tr class="txt-Indece">
    <td colspan="4">&nbsp;</td>
  </tr>

</table>
