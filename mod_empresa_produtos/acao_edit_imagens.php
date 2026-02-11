<table width="100%" border="0" cellpadding="1" cellspacing="2">
  <tr>
    <td width="20%">1 - Imagem</td>
    <td width="20%">2 - Imagem</td>
    <td width="20%">3 - Imagem</td>
    <td width="20%">4 - Imagem</td>
    <td width="20%">5 - Imagem</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr class="txt-opcoes">
        <td align="center"><?php if(empty($row_list_acao['img1']))	{ ?>
          <a href="?conteudo=<?php echo $conteudo_inf; ?>-alt&<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&imagens_edit=imagens_add1&img1=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /></a>
          <?php } ?></td>
        <td align="center"><?php if(isset($row_list_acao['img1']))	{ ?>
          <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_alt1&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></td>
        <td align="center"><a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_exc1&amp;img_nome=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a>
          <?php } ?></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><span class="txt">
          <?php if(isset($row_list_acao['img1']))	{ ?>
          <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img1']; ?>" width="110" height="82" />
          <?php } ?>
        </span></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr class="txt-opcoes">
        <td align="center"><?php if(empty($row_list_acao['img2']))	{ ?>
          <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_add2&amp;img2=<?php echo $row_list_acao['img2']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /></a>
          <?php } ?></td>
        <td align="center"><?php if(isset($row_list_acao['img2']))	{ ?>
          <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_alt2&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img2']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></td>
        <td><a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_exc2&amp;img_nome=<?php echo $row_list_acao['img2']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a>
          <?php } ?></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><span class="txt">
          <?php if(isset($row_list_acao['img2']))	{ ?>
          <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img2']; ?>" width="110" height="82" />
          <?php } ?>
        </span></td>
        </tr>
    </table></td>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr class="txt-opcoes">
        <td align="center"><?php if(empty($row_list_acao['img3']))	{ ?>
          <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_add3&amp;img1=<?php echo $row_list_acao['img1']; ?>"> <img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /></a>
          <?php } ?></td>
        <td><?php if(isset($row_list_acao['img3']))	{ ?>
          <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_alt3&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img2']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></td>
        <td align="center"><a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_exc3&amp;img_nome=<?php echo $row_list_acao['img3']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a>
          <?php } ?></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><span class="txt">
          <?php if(isset($row_list_acao['img3']))	{ ?>
          <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img3']; ?>" width="110" height="82" />
          <?php } ?>
        </span></td>
        </tr>
    </table></td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="txt-opcoes">
        <td align="center"><?php if(empty($row_list_acao['img4']))	{ ?>
          <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_add4&amp;img1=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /></a>
          <?php } ?></td>
        <td align="center"><?php if(isset($row_list_acao['img4']))	{ ?>
          <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_alt4&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img1']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></td>
        <td align="center"><a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_exc4&amp;img_nome=<?php echo $row_list_acao['img4']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a>
          <?php } ?></td>
      </tr>
      <tr>
        <td colspan="3"><span class="txt">
          <?php if(isset($row_list_acao['img4']))	{ ?>
          <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img4']; ?>" width="110" height="82" />
          <?php } ?>
        </span></td>
        </tr>
    </table></td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="txt-opcoes">
        <td align="center"><?php if(empty($row_list_acao['img5']))	{ ?>
          <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_add5&amp;img1=<?php echo $row_list_acao['img5']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_add-20.png" width="20" height="20" border="0" title=" ADICIONAR IMAGENS " /></a>
          <?php } ?></td>
        <td align="center"><?php if(isset($row_list_acao['img5']))	{ ?>
          <a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_alt5&amp;imagens_alt=imagens_alt&amp;img_nome=<?php echo $row_list_acao['img5']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_alt-20.png" width="20" height="20" border="0" title=" ALTERAR IMAGENS "  /></a></td>
        <td align="center"><a href="?<?php echo $usuario_get; ?>conteudo=<?php echo $conteudo_inf; ?>-alt&amp;<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&amp;imagens_edit=imagens_exc5&amp;img_nome=<?php echo $row_list_acao['img5']; ?>"><img src="<?php echo "$local_icons"; ?>imagens_exc-20.png" width="20" height="20" border="0" title=" EXCLUIR IMAGENS " /></a>
          <?php } ?></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><span class="txt">
          <?php if(isset($row_list_acao['img5']))	{ ?>
          <img src="<?php echo $local_imagem; ?><?php echo $row_list_acao['img5']; ?>" width="110" height="82" />
          <?php } ?>
        </span></td>
        </tr>
    </table></td>
  </tr>
</table>
