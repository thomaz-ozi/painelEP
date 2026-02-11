<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <input type="hidden" name="MM_update" value="form1" />
  <table  border="0" cellspacing="1" cellpadding="0" class="col-md-8 col-xs-12">
    <tr>
      <td align="left" class="txt-opcoes">Nome:</td>
      <td align="left" class="txt">
      <input name="" type="text" disabled class="txt-form col-md-12 col-xs-12" id=""  tabindex="3" autocomplete="off" value="<?php echo $row_list_senha['tratamento']; ?>&nbsp;<?php echo $row_list_senha['nome']; ?>"/></td>
    </tr>
    <tr>
      <td width="42%" align="left" class="txt-opcoes">Senha atual:
        <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_list_senha['id_usuario']; ?>" /></td>
      <td width="58%" align="left" class="txt"><input name="senha_atual" type="password" class="txt-form col-md-12 col-xs-12" id="senha_atual" placeholder="Senha atual"  tabindex="100" autocomplete="off" value=""/></td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Nova Senha:</td>
      <td align="left" class="txt">
       <div class="item form-group">
         <input id="senha" type="password" name="senha" data-validate-length="10,6" placeholder="6 ou 10 caracteres" class="form-control col-md-7 col-xs-12" tabindex="102" required="required">
 		</div>
      
      </td>
    </tr>
    <tr>
      <td align="left" class="txt-opcoes">Confirme a senha</td>
      <td align="left" class="txt">
      <div class="item form-group">
      <input name="senha_confirme" type="password" required="required" data-validate-linked="senha" class="txt-form col-md-12 col-xs-12" id="senha_confirme" placeholder="repita a senha novamente"  tabindex="103" autocomplete="off"/>
      </div></td>
    </tr>
    <tr>
      <td colspan="2"   align="center"><br><?php echo $resposta; ?></td>
    </tr>

  </table>
  <div class="clearfix"></div>
  <br>

                      
<div class="btn-group" >
                    
    <button type="button" class="btn btn-default" onclick="MM_goToURL('parent','?conteudo=<?php echo $_GET['conteudo']; ?>&<?php echo $id_sistema; ?>=<?php echo base64_encode($_GET[$id_sistema]); ?>&');return document.MM_returnValue"><i class="fa fa-close"></i> Fechar</button>

                    
  <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-edit"></i> Alterar &nbsp;&nbsp;&nbsp;&nbsp;</button>
</div>
</form>

    <!-- validator -->
    <script src="../vendors/validator/validator.min.js"></script>
 <!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->