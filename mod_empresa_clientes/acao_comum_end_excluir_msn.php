

<div  class="div_absolute"></div>
<div  class="div_absolute_msn"> 
  <form  method="POST" name="acao" id="add" >
  <br />
<br />
<table width="658" border="0" cellpadding="0" cellspacing="1" class="texto" align="center">
    <tr>
      <td width="293" align="left" >&nbsp;</td>
    </tr>
    <tr>
      <td height="31" bgcolor="#E7E6EB" class="txt-indece-titulo"><div align="center">
        <table  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left"><div class="options_action_del_sec" title=" EXCLUIR " ></div></td>
            <td  align="left">Excluir<?php echo "$sistema_nome"; ?></td>
            <td align="left">&nbsp;</td>
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
          <td colspan="2" bgcolor="#FFFFFF" class="msn_selecionado" ><div align="center"   >
            <p>Tem certeza em <span class="txt-Botao-Excluir"> &quot;EXCLUIR&quot;</span> o item?</p>
          </div></td>
          </tr>
        <tr>


        <tr>
          <td colspan="2" >&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td valign="top"  class="txt-Indece"><div align="center">
        <input type="button" name="Fechar" id="Fechar" value="Fechar" onClick="loadsDataClear('#msn')">
        <input type="button" name="EXCLUIR" id="EXCLUIR" onClick="end_excluir_tr('<?php echo $_POST['n']?>','<?php echo $_POST['content']?>'),loadsDataClear('#msn')" value="EXCLUIR">
      </div></td>
    </tr>
    <tr></tr>
  </table>
  
  
  
</form></div>
