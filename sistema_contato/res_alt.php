<?php //  include"../sistem_funcoes/perfusuario.php"; ?>
&nbsp;
<style type="text/css">
<!--
.style2 {color: #006600}
.style3 {font-size: 16px}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<div id="apDiv1" style="position:absolute; position:fixed; left:0px; display:block; top:0px; width:100%;  height: auto; min-height:100%; z-index:1; background-image: url(../images/fundoBlackTransp.png); border: 1px none #000000;
"></div>
<div id="apDiv1" style="position:absolute; left:0px; display:block; top:0px; width:100%;  height: auto; min-height:100%; z-index:1; ">
  <form action="receitas_acao_excluir_res.php?id=<?php echo $row_list_excluir['id']; ?>&amp;idUsuario=<?php echo $_GET[idUsuario]; ?>" method="POST" name="add_receita" id="add" >
  <table width="658" border="0" cellpadding="0" cellspacing="1" class="texto" align="center">
    <tr>
      <td width="293" align="left" background="../icons/circulo_red/financeiro_linhas.png">&nbsp;</td>
    </tr>
    <tr>
      <td height="31" bgcolor="#E7E6EB" class="txt-indece-titulo"><div align="center">
        <table width="19%" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="41%"><div align="center"><img src="../icons/circulo_red/alt-30.png" width="30" height="30" border="0" title=" ADICIONAR " /></div></td>
            <td width="59%"><div align="left">ALTERAR</div>              </td>
          </tr>
        </table>
      </div></td>
    </tr>
    <tr></tr>
    <tr>
      <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt">
        <tr>
          <td colspan="2" >&nbsp;</td>
        </tr>
        <tr>
          <td width="48%" >&nbsp;</td>
          <td width="52%" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" ><div align="center" class="style3 style4"> O conteudo foi<span class="txt-Botao-Alterar"> &quot;ALTERADO&quot;</span> com sucesso!</div></td>
          </tr>
        <tr>
          <td colspan="2" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" >&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td valign="top"  class="txt-Indece"><div align="center"><a href="../sistema/painel.php?usuario=<?php echo $_GET[usuario]; ?>&amp;conteudo=infemp"><img src="../icons/circulo_red/botao_form_fechar.png" width="80" height="22" border="0" /></a></div></td>
    </tr>
    <tr></tr>
  </table>
  
  
  
</form></div>
