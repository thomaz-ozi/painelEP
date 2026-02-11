<?php //  include"../funcoes/estilo.php"; ?>

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

<div  class="div_absolute"></div>
<div  class="div_absolute_msn"> 
  <form action="../usuario_class/receitas_acao_excluir_res.php?id=<?php echo $row_list_excluir['id']; ?>&amp;idUsuario=<?php echo $_GET[idUsuario]; ?>" method="POST" name="add_receita" id="add" ><br /><br />
  <table width="658" border="0" cellpadding="0" cellspacing="1" class="texto" align="center">
    <tr>
      <td width="293" align="left" background="../icons/financeiro_linhas.png">&nbsp;</td>
    </tr>
    <tr>
      <td height="31" bgcolor="#E7E6EB" class="txt-indece-titulo"><div align="center">
        <table  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="<?php echo "../usuario_class/$local_icons"; ?><?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
            <td  align="left"><?php echo "$sistema_nome"; ?></td>
            <td ><img src="<?php echo "../usuario_class/$local_icons"; ?>add-30.png" width="30" height="30" /></td>
            <td  align="left">Adicionar</td>
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
          <td colspan="2" ><div align="center" class="style3 style4"> O conteudo foi<span class="txt-Botao-ADD"> &quot;ADICIONADO&quot;</span> com sucesso!</div></td>
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
      <td valign="top"  class="txt-Indece"><div align="center"><a href="?<?php echo $usuario_get; ?>&amp;conteudo=<?php echo $conteudo_inf; ?>"><img src="<?php echo "../usuario_class/$local_icons"; ?>botao_form_ok.png" width="80" height="22" border="0" /></a></div></td>
    </tr>
    <tr></tr>
  </table>
  
  
  
</form></div>
