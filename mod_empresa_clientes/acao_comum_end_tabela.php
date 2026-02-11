<?php require_once('../Connections/connection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_connection, $connection);
$query_list_endereco = "SELECT * FROM tbnext_mod_empresa_clientes_endereco WHERE id_clientes = '".$id_clientes."' ORDER BY xMun ASC";
$list_endereco = mysql_query($query_list_endereco, $connection) or die(mysql_error());
$row_list_endereco = mysql_fetch_assoc($list_endereco);
$totalRows_list_endereco = mysql_num_rows($list_endereco);
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="txt-opcoes">
    <td width="9%" align="left" >Classificação</td>
    <td width="15%" align="left" >CEP</td>
    <td width="39%" align="left" >Rua</td>
    <td width="8%" align="left" >Nro</td>
    <td width="17%" align="left" >Cidade</td>
    <td width="5%" align="left" >UF</td>
    <td width="7%" align="left" ></td>
  </tr>
</table>
<div style="height:200px; overflow:auto;">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="idtabela_end">
  <tr class="txt-opcoes">
    <td width="9%" align="left" ></td>
    <td width="15%" align="left" ></td>
    <td width="39%" align="left" ></td>
    <td width="8%" align="left" ></td>
    <td width="17%" align="left" ></td>
    <td width="5%" align="left" ></td>
    <td width="7%" align="left" ></td>
  </tr> 
  
  <?php
  $l=1;
  
   do { ?>
   <?php if($totalRows_list_endereco!='0'){ ?>
  <tr  id="end_tr<?php echo $l; ?>" class="linhas1"  >
   
      <td align="left" class="txt-opcoes"  ><?php  $id_class=$row_list_endereco['id_class'];  include('../mod_empresa_clientes/include_list_class.php');  echo $xNome=$row_include_class['xNome']; ?></td>
      <td  align="left" class="txt-opcoes" ><?php echo $CEP=$row_list_endereco['CEP']; ?></td>
      <td align="left" ><?php echo utf8_encode($row_list_endereco['xLgr']); ?></td>
      <td  align="left" ><?php echo $row_list_endereco['nro']; ?></td>
      <td  align="left"  ><?php echo $row_list_endereco['xMun']; ?></td>
    <td align="left"><?php echo $row_list_endereco['UF']; ?></td>
      <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF" > <?php if($exc!='disabled'){?>
      
      <button   type="button" onclick="end_excluir(<?php echo $l; ?>,<?php echo $row_list_endereco['id_enderecos']; ?>)" class="options_action_del_sec" title=" EXCLUIR "></button>
      <?php } ?></td>
  </tr>
  <tr  bgcolor="#FFFFFF"  id="end_tr2<?php echo $l; ?>" >
    <td align="left" class="txt-opcoes" >Complemento: </td>
    <td colspan="5" align="left"  ><?php echo $row_list_endereco['cmpto']; ?></td>
    </tr> 
  <?php } ?>
<script>
   e_i=<?php $l++; echo $l; ?>;
</script>
    <?php 
  
  
  } while ($row_list_endereco = mysql_fetch_assoc($list_endereco)); ?>
</table>
</div>
<?php
mysql_free_result($list_endereco);
?>
