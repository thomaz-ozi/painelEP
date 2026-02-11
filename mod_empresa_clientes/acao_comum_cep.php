
 <?php
/**
 *    Exemplo de utilização de utilização de WebService Kinghost
 *    www.kinghost.com.br
 */
 
$cep= $_POST['content'];

if($cep!=''){
$webservice_url     = 'http://webservice.kinghost.net/web_cep.php';
$webservice_query    = array(
    'auth'    => 'b14a7b8059d9c055954c92674ce60032', //Chave de autenticação do WebService - Consultar seu painel de controle
    'formato' => 'query_string', //Valores possíveis: xml, query_string ou javascript
    'cep'     => $cep //CEP que será pesquisado
);

//Forma URL
$webservice_url .= '?';
foreach($webservice_query as $get_key => $get_value){
    $webservice_url .= $get_key.'='.urlencode($get_value).'&';
}

parse_str(file_get_contents($webservice_url), $resultado);

switch($resultado['resultado']){  
    case '2':  
 	?>
 
 

 <div class="text_del">Cidade com CEP único</div>
 <table width="600" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="55%" ><?php echo utf8_encode($resultado['logradouro']); ?>
      <input name="end_xLgr" type="text" id="end_xLgr" style="width:280px;" value="<?php echo utf8_encode($resultado['logradouro']); ?>">
      <input name="end_xMun" type="hidden" id="end_xMun" value="<?php echo utf8_encode($resultado['cidade']); ?>">
      <input name="end_cMun" type="hidden" id="end_cMun" value="<?php echo $row_list_ibge['cMun']; ?>">
      <input name="end_xBairro" type="hidden" id="end_xBairro" value="<?php echo $row_list_ibge['bairro'] ; ?>">
      <input name="end_xCpl" type="hidden" id="end_xCpl" value="<?php echo $resultado['xCpl']; ?>">
      <input name="end_UF" type="hidden" id="end_UF" value="<?php echo $resultado['uf']; ?>">
      <input name="end_cUF" type="hidden" id="end_cUF" value="<?php echo $resultado['uf']; ?>">
      <input name="end_cPais" type="hidden" id="end_cPais" value="<?php echo $row_list_ibge['cPais']; ?>">
      <input name="end_xPais" type="hidden" id="end_xPais" value="<?php echo 'brasil'; ?>">
    </td>
    <td width="12%" align="center" class="txt"><input type="text" tabindex="35" name="end_nro" id="end_nro" style="width:50px;"></td>
    <td width="26%" align="center" class="txt"><?php echo utf8_encode($resultado['cidade']); ?></td>
    <td width="7%" class="txt"><?php echo $resultado['uf']; ?></td>
  </tr>
  <tr>
    <td colspan="4" >Complemento
    <input type="text" name="end_cmpto" id="end_cmpto" style="width:400px;"></td>
    </tr>
 </table>
 
 <script>
$(function(){
	$('#end_xLgr').select();
});
</script>	
 
 
 
 	<?php         
    break;  
      
    case '1':
	
	
	 
	$xMun = $resultado['cidade'];
	
	include("../sistema_funcoes/ibge.php");
	
	?>
	
	
	
	<table width="600" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="55%" ><?php echo utf8_encode($resultado['logradouro']); ?>
      <input name="end_xLgr" type="hidden" id="end_xLgr" value="<?php echo utf8_encode($resultado['logradouro']); ?>">
      <input name="end_xMun" type="hidden" id="end_xMun" value="<?php echo utf8_encode($row_list_ibge['xMun']); ?>">
      <input name="end_cMun" type="hidden" id="end_cMun" value="<?php echo $row_list_ibge['cMun']; ?>">
      <input name="end_xBairro" type="hidden" id="end_xBairro" value="<?php echo $row_list_ibge['bairro'] ; ?>">
      <input name="end_xCpl" type="hidden" id="end_xCpl" value="<?php echo $resultado['xCpl']; ?>">
      <input name="end_UF" type="hidden" id="end_UF" value="<?php echo $row_list_ibge['UF']; ?>">
      <input name="end_cUF" type="hidden" id="end_cUF" value="<?php echo $row_list_ibge['cUF']; ?>">
      <input name="end_cPais" type="hidden" id="end_cPais" value="<?php echo $row_list_ibge['cPais']; ?>">
      <input name="end_xPais" type="hidden" id="end_xPais" value="<?php echo 'brasil'; ?>">
    </td>
    <td width="12%" align="center" class="txt"><input type="text" tabindex="35" name="end_nro" id="end_nro" style="width:50px;"></td>
    <td width="26%" align="center" class="txt"><label for="end_nro"><?php echo utf8_encode($resultado['cidade']); ?></label></td>
    <td width="7%" class="txt"><?php echo $resultado['uf']; ?></td>
  </tr>
  <tr>
    <td colspan="4" >Complemento
    <input type="text" name="end_cmpto" id="end_cmpto" style="width:400px;"></td>
    </tr>
 </table>

<script>
$(function(){
	$('#end_nro').select();
});
</script>	
	
	
<?php
	
    break;  
    //FALAR OU NÂO EXITE  
    default:  
       echo  $texto = "Fala ao buscar cep: ".$resultado['resultado'];  
	   
 ?>

      
       
<?php
	   
	   
    break;  
}
}else{ echo "Preencha corretamento o CEP";}

?> 

