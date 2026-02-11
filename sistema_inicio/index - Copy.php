
 
  



<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td width="2%" class="txt-Indece">&nbsp;</td>
    <td width="94%" class="txt-Indece"><?php echo $row_perfusuario['tratamento']; ?>&nbsp;<?php echo $row_perfusuario['nome']; ?>,</td>
    <td width="4%" align="center" class="txt-Indece">&nbsp;</td>
  </tr>
  <tr>
    <td class="txt">&nbsp;</td>
    <td align="left" class="txt"><br>      <br></td>
    <td class="txt">&nbsp;</td>
  </tr>
  <tr>
    <td class="txt">&nbsp;</td>
    <td rowspan="3" align="center" class="txt"><?php echo $row_perfusuario['texto']; ?></td>
    <td align="center" class="txt">&nbsp;</td>
  </tr>
  <tr>
    <td class="txt">&nbsp;</td>
    <td align="center" class="txt">&nbsp;</td>
  </tr>
  <tr>
    <td class="txt">&nbsp;</td>
    <td class="txt">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="txt-Indece">&nbsp;</td>
  </tr>
</table><br />
<?php
if($_GET['local']=='selec'){include('../sistema_empresa_local/local_select.php');}


 ?>



<?php 

$edit_texto=$_GET['edit_texto'];

switch ($edit_texto){
	
	case '1':
	include ("acao_alt.php");
	break;
	case '2':
	include ("");
	break;
}
?>
