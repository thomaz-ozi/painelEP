 
<table  border="0" align="center">
          <tr>
            <td > <div class="btn-group"><?php if ($pageNumList_list_acao > 0) { // Show if not first page ?>
              
                            <button class="btn btn-success" type="button"  onClick="MM_goToURL('parent','?conteudo=candidatos&Objetivo=<?php echo $_POST['Objetivo'];?>&xBairro=<?php echo $_POST['xBairro'];?><?php printf("%s&pageNumList_list_acao=%d%s", $currentPage, 0, $queryString_list_acao); ?>');return document.MM_returnValue">|&lt; inicio</button>
                            
              <?php } // Show if not first page ?>
              <?php if ($pageNumList_list_acao > 0) { // Show if not first page ?>
              
              <button class="btn btn-success" type="button"  onClick="MM_goToURL('parent','?conteudo=candidatos&Objetivo=<?php echo $_POST['Objetivo'];?>&xBairro=<?php echo $_POST['xBairro'];?><?php printf("%s&pageNumList_list_acao=%d%s", $currentPage, max(0, $pageNumList_list_acao - 1), $queryString_list_acao); ?>');return document.MM_returnValue">&lt; voltar</button>
              
              
              <?php } // Show if not first page ?>              <button class="btn btn-default" type="button">&nbsp;&nbsp;De &nbsp;&nbsp;<?php echo ($startRow_list_acao + 1) ?> &nbsp;&nbsp;at&eacute; &nbsp;&nbsp;<?php echo min($startRow_list_acao + $maxRows_list_acao, $totalRows_list_acao) ?>&nbsp;&nbsp;para&nbsp;&nbsp; <?php echo $totalRows_list_acao ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
              <?php if ($pageNumList_list_acao < $totalPages_list_acao) { // Show if not last page ?>
             
             <button class="btn btn-success" type="button"  onClick="MM_goToURL('parent','?conteudo=candidatos&Objetivo=<?php echo $_POST['Objetivo'];?>&xBairro=<?php echo $_POST['xBairro'];?><?php printf("%s&pageNumList_list_acao=%d%s", $currentPage, min($totalPages_list_acao, $pageNumList_list_acao + 1), $queryString_list_acao); ?>');return document.MM_returnValue">Avan&ccedil;ar &gt;</button>
              <?php } // Show if not last page ?>
              <?php if ($pageNumList_list_acao < $totalPages_list_acao) { // Show if not last page ?>
              
              
              <button class="btn btn-success" type="button"  onClick="MM_goToURL('parent','?conteudo=candidatos&Objetivo=<?php echo $_POST['Objetivo'];?>&xBairro=<?php echo $_POST['xBairro'];?><?php printf("%s&pageNumList_list_acao=%d%s", $currentPage, $totalPages_list_acao, $queryString_list_acao); ?>');return document.MM_returnValue">FIM &gt;|</button>
              <?php } // Show if not last page ?> </div></td>
          </tr>
        </table>

       