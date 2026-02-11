<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" language="javascript" src="dtable/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="dtable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="dtable_base.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/utils.js"></script>



<script type="text/javascript" charset="utf-8">
	dTable("#example","relatorio_manejo_animais_data.php")
	function editar(id){
		alert(id);	
	}
	function apagar(id){
		alert(id);	
	}
	function novo(){
		CarregarDiv("#dform","cep_novo.php");
	}
	
</script>
<script type="text/javascript">
//<![CDATA[
 $(document).ready(function() {
   
  $('table#example tbody tr').hover(
  function() {
   $(this).addClass('destacar');   
  },
  function() {
   $(this).removeClass('destacar');   
  });
 });
// ]]> 
</script>
<style type="text/css" title="currentStyle">
			@import "dtable/media/css/demo_page.css"; 
			@import "dtable/media/css/demo_table.css";
			@import "jquery-ui-1.8.16.custom.css";
			@import "tables_heade.css";
			
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RELATORIO DE MANEJO DE ANIMAIS 4.0</title>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="javascript:novo();">Novo Registro</a></td>
  </tr>
  <tr>
    <td><div id="dform"></div></td>
  </tr>
  <tr>
    <td><table width="500" border="0" cellpadding="0" cellspacing="0" class="display" id="example">
      <thead>
        <tr>
          <th width="14%" align="left">COD ANIMAL</th>
          <th width="13%" align="left">&nbsp;</th>
          <th width="13%" align="left">MANEJO</th>
          <th width="8%" align="left">NEJO</th>
          <th width="7%" align="left">PESO</th>
          <th width="16%" align="left">LOCAIS</th>
          <th width="15%" align="left">LOTE</th>
          <th width="24%" align="left">SETOR</th>
          <th  align="right">Editar</th>
          <th  align="right">Apagar</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="8" class="dataTables_empty">Loading data from server</td>
        </tr>
      </tbody>
     
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>