<input id="xNome_contato" class="mask_cel" type="text"  tabindex="24"  value="" name="xNome_contato" >
<input name="xNome_contato2" id="xNome_contato2" type="hidden" value="">
<script>
$(function($){
   $(".mask_cel").mask("(99)9.9999-9999");
   $('#xNome_contato').select();
});
</script>