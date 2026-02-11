

  <input type="hidden" name="MM_update" value="form1" />
  <table width="58%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="22%" align="left" class="txt-opcoes">Nome:</td>
      <td width="78%" align="left" class="txt"><?php echo $row_list_senha['tratamento']; ?>&nbsp;<?php echo $row_list_senha['nome']; ?></td>
    </tr>
    <tr>
      <td colspan="2" align="left" class="txt">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="left" class="txt"><div align="center"><?php echo $resposta; ?></div></td>
    </tr>
    <tr>
      <td colspan="2" align="left" class="txt">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"  class="txt" align="center">&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2" align="left"><div align="center"><a href="?conteudo=uu-alt&amp;id_usuario=<?php echo base64_encode($_GET[id_usuario]); ?>" ><img src="<?php echo "$local_icons"; ?>botao_form_ok.png" width="80" height="22" border="0"></a></div></td>
    </tr>
  </table>
