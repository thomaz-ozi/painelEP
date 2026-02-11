<input id="xNome_contato" class="mask_fone" type="text" tabindex="24" value="" name="xNome_contato" >
&nbsp;&nbsp;Ramal: <input name="xNome_contato2" tabindex="25"  type="text" id="xNome_contato2" style="width:60px;" value="" maxlength="6" >
<script>
$(function($){
   $(".mask_fone").mask("(99)9999-9999");
   $('#xNome_contato').select();

});
</script>

