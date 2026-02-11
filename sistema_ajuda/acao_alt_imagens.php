<table width="100%" border="0" cellpadding="0" cellspacing="1" >
  <tr>
    <td width="19%" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" class="txt-opcoes" >Titulo da foto - 1</td>
        </tr>
      <tr>
        <td colspan="4" align="center" ><input name="img_titulo1" type="text" class="txt-form" id="img_titulo1" title=" ADINIONA AT&Eacute; 250 CARACTERES " value="<?php echo $row_list_acao['img_titulo1']; ?>" size="20" />        </td>
        </tr>
      <tr class="txt-Indece">
        <td >&nbsp;</td>
    <?php if(empty($row_list_acao['img1']))	{ ?>
        <td align="left"><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_add1&amp;img1=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /> </a></td>
       <?php } ?> 
       <?php if(isset($row_list_acao['img1']))	{ ?>
        <td><span ><span  > &nbsp;<a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_alt1&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></span></span></td>
        <td><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;imagens_edit=imagens_exc1&amp;img_nome=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a></td>
     <?php }?> </tr>
    </table></td>
    <td width="19%" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" class="txt-opcoes">Titulo da foto - 2 </td>
        </tr>
      <tr>
        <td colspan="4" align="center"><input name="img_titulo2" type="text" class="txt-form" id="img_titulo2" title=" ADINIONA AT&Eacute; 250 CARACTERES " value="<?php echo $row_list_acao['img_titulo2']; ?>" size="20" /></td>
        </tr>
      <tr class="txt-Indece">
        <td>&nbsp;</td>  <?php if(empty($row_list_acao['img2']))	{ ?>
        <td align="left"><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_add2&amp;img2=<?php echo $row_list_acao['img2']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /> </a></td>
         <?php } ?> 
       <?php if(isset($row_list_acao['img2']))	{ ?>
        
        <td><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_alt2&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img2']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></td>
        <td><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;imagens_edit=imagens_exc2&amp;img_nome=<?php echo $row_list_acao['img2']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a></td> <?php } ?> 
       
      </tr>
    </table></td>
    <td width="19%" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" class="txt-opcoes">Titulo da foto - 3</td>
        </tr>
      <tr>
        <td colspan="4" align="center"><input name="img_titulo3" type="text" class="txt-form" id="img_titulo3" title=" ADINIONA AT&Eacute; 250 CARACTERES " value="<?php echo $row_list_acao['img_titulo3']; ?>" size="20"/></td>
        </tr>
      <tr class="txt-Indece">
        <td>&nbsp;</td><?php if(empty($row_list_acao['img3']))	{ ?>
        <td align="left"><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_add3&amp;img1=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /> </a></td> <?php } ?> 
       <?php if(isset($row_list_acao['img3']))	{ ?>
        <td><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_alt3&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img2']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></td>
        <td><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;imagens_edit=imagens_exc3&amp;img_nome=<?php echo $row_list_acao['img3']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a></td> <?php } ?> 

      </tr>
    </table></td>
    <td width="22%" align="right" ><table width="99%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" class="txt-opcoes">Titulo da foto - 4 </td>
        </tr>
      <tr>
        <td colspan="4" align="center"><input name="img_titulo4" type="text" class="txt-form" id="img_titulo4" title=" ADINIONA AT&Eacute; 250 CARACTERES " value="<?php echo $row_list_acao['img_titulo4']; ?>" size="20"/></td>
        </tr>
      <tr class="txt-Indece">
        <td>&nbsp;</td><?php if(empty($row_list_acao['img4']))	{ ?>
        <td align="left"><span class="txt-Indece"><span class="txt-list">&nbsp;<a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_add4&amp;img1=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /></a></span></span></td>
         <?php } ?> 
       <?php if(isset($row_list_acao['img4']))	{ ?>
        <td><span class="txt-Indece"><span class="txt-list">&nbsp;<a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_alt4&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img4']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></span></span></td>
        <td><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;imagens_edit=imagens_exc4&amp;img_nome=<?php echo $row_list_acao['img4']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a></td> <?php } ?> 

      </tr>
    </table></td>
    <td width="21%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" class="txt-opcoes">Titulo da foto - 5</td>
      </tr>
      <tr>
        <td colspan="4" align="center"><input name="img_titulo5" type="text" class="txt-form" id="img_titulo5" title=" ADINIONA AT&Eacute; 250 CARACTERES " value="<?php echo $row_list_acao['img_titulo5']; ?>" size="20"/></td>
        </tr>
      <tr class="txt-Indece">
        <td>&nbsp;</td><?php if(empty($row_list_acao['img5']))	{ ?>
        <td align="left"><span class="txt-Indece"><span>&nbsp;<a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_add5&amp;img1=<?php echo $row_list_acao['img5']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /></a></span></span></td>  <?php } ?> 
       <?php if(isset($row_list_acao['img5']))	{ ?>
        <td><span class="txt-Indece"><span class="txt-list">&nbsp;<a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;imagens_edit=imagens_alt5&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img5']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></span></span></td>
        <td><a href="?usuario=<?php echo $_GET['usuario']; ?>&amp;conteudo=<?php echo $conteudo_imagens; ?>&amp;<?php echo $id_banco; ?>=<?php echo $id_banco_recebe; ?>&amp;imagens_edit=imagens_exc5&amp;img_nome=<?php echo $row_list_acao['img5']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a></td>  <?php } ?> 
 
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><span class="txt">
      <?php if(isset($row_list_acao['img1']))	{ ?>
      <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img1']; ?>" width="110" height="82" />
      <?php } ?>
    </span></td>
    <td><span class="txt">
      <?php if(isset($row_list_acao['img2']))	{ ?>
      <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img2']; ?>" width="110" height="82" />
      <?php } ?>
    </span></td>
    <td><span class="txt">
      <?php if(isset($row_list_acao['img3']))	{ ?>
      <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img3']; ?>" width="110" height="82" />
      <?php } ?>
    </span></td>
    <td><span class="txt">
      <?php if(isset($row_list_acao['img4']))	{ ?>
      <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img4']; ?>" width="110" height="82" />
      <?php } ?>
    </span></td>
    <td><span class="txt">
      <?php if(isset($row_list_acao['img5']))	{ ?>
      <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img5']; ?>" width="110" height="82" />
      <?php } ?>
    </span></td>
  </tr>
</table>
