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
 $query_list_comunicacao = "SELECT * FROM tbnext_mod_empresa_clientes_comunicacao WHERE id_clientes = '".$id_clientes."' ORDER BY id_comunicacao_tipo ASC";
$list_comunicacao = mysql_query($query_list_comunicacao, $connection) or die(mysql_error());
$row_list_comunicacao = mysql_fetch_assoc($list_comunicacao);
$totalRows_list_comunicacao = mysql_num_rows($list_comunicacao);
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="txt-opcoes">
    <td width="14%" align="left" >Classificação</td>
    <td width="21%" align="left" >Tipo</td>
    <td width="60%" align="left" >Valor</td>
    <td width="5%" align="left" ></td>
  </tr>
</table>
<div style="height:200px; overflow:auto;">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="idtabela">
  <tr class="txt-opcoes">
    <td width="14%" align="left" ></td>
    <td width="21%" align="left" ></td>
    <td width="60%" align="left" ></td>
    <td width="5%" align="left" ></td>
  </tr> 
  
  <?php
  $l=1;
  
   do { ?>
   <?php if($totalRows_list_comunicacao!='0'){ ?>
  <tr class="linhas1"  id="comun_tr<?php echo $l; ?>"  >
   
      <td align="left" class="txt-opcoes"  >      
      <?php  $id_class=$row_list_comunicacao['id_class'];  include('../mod_empresa_clientes/include_list_class.php');  echo $xNome=$row_include_class['xNome']; ?>
      
      </td>
      <td align="left" class="txt-opcoes" ><?php   $id_comunicacao_tipo= $row_list_comunicacao['id_comunicacao_tipo'];  include('../mod_empresa_clientes/include_list_comun_tipo.php'); echo $row_include_tipo['xNome']; ?>
      </td>
    <td align="left"><?php echo $row_list_comunicacao['xNome_contato']; ?><?php echo $row_list_comunicacao['xNome_contato_2']; ?></td>
      <td align="left"  bgcolor="#FFFFFF"><?php if($exc!='disabled'){?>
      
      <div onclick="excluir(<?php echo $l; ?>,<?php echo $row_list_comunicacao['id_comunicacao']; ?>)" class="options_action_del_sec" title=" EXCLUIR "></div>
      <?php } ?></td>
  </tr> 
  <?php } ?>
<script>
   c_i=<?php $l++; echo $l; ?>;
</script>
  
  <?php 
  
  
  } while ($row_list_comunicacao = mysql_fetch_assoc($list_comunicacao)); ?>
</table>
</div>
<?php
mysql_free_result($list_comunicacao);
?>
